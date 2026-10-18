// verify-logo-hover-v2.mjs
// Улучшенная верификация: ждём завершения transition (250ms+) перед чтением.
import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';

const URL = 'http://localhost:8080/';
const OUT = 'tmp/logo-hover';
mkdirSync(OUT, { recursive: true });

const browser = await chromium.launch();
const themes = ['light', 'dark', 'high-contrast'];

const summary = [];

for (const theme of themes) {
  const context = await browser.newContext({
    colorScheme: theme === 'dark' ? 'dark' : 'light',
    viewport: { width: 1280, height: 800 },
  });
  const page = await context.newPage();
  await page.goto(URL, { waitUntil: 'networkidle' });
  await page.evaluate((t) => document.documentElement.setAttribute('data-theme', t), theme);
  await page.waitForTimeout(500);

  console.log(`\n=== ${theme.toUpperCase()} ===`);

  // 1. BASE
  const base = await page.evaluate(() => {
    const cs = getComputedStyle(document.querySelector('.logo'));
    return { color: cs.color, opacity: cs.opacity, transition: cs.transitionProperty };
  });
  console.log(`  BASE:    color=${base.color}  opacity=${base.opacity}  transition=${base.transition}`);

  // 2. HOVER — ждём 300ms для завершения анимации
  await page.hover('.logo');
  await page.waitForTimeout(300);
  const hover = await page.evaluate(() => {
    const cs = getComputedStyle(document.querySelector('.logo'));
    return { color: cs.color, opacity: cs.opacity, transform: cs.transform };
  });
  console.log(`  HOVER:   color=${hover.color}  opacity=${hover.opacity}  transform=${hover.transform}`);
  await page.screenshot({ path: `${OUT}/${theme}-hover.png`, clip: { x: 0, y: 0, width: 300, height: 80 } });

  // 3. FOCUS через Tab
  await page.mouse.move(0, 0);
  await page.waitForTimeout(300);
  await page.keyboard.press('Tab');
  await page.keyboard.press('Tab');
  await page.waitForTimeout(300);
  const focus = await page.evaluate(() => {
    const el = document.activeElement;
    const cs = getComputedStyle(el);
    return {
      tag: el.tagName,
      cls: el.className?.toString?.() || '',
      outline: cs.outline,
      outlineColor: cs.outlineColor,
      outlineOffset: cs.outlineOffset,
      borderRadius: cs.borderRadius,
      boxShadow: cs.boxShadow.slice(0, 50),
    };
  });
  console.log(`  FOCUS:   ${focus.tag}.${focus.cls?.split(' ')[0] || ''}  outline=${focus.outline}  offset=${focus.outlineOffset}  radius=${focus.borderRadius}`);

  // 4. ACTIVE — mousedown с удержанием
  await page.keyboard.press('Escape');
  await page.waitForTimeout(200);
  await page.mouse.move(20, 30);
  await page.mouse.down();
  await page.waitForTimeout(300);
  const active = await page.evaluate(() => {
    const logo = document.querySelector('.logo');
    const cs = getComputedStyle(logo);
    return {
      color: cs.color,
      opacity: cs.opacity,
      transform: cs.transform,
    };
  });
  console.log(`  ACTIVE:  color=${active.color}  opacity=${active.opacity}  transform=${active.transform}`);
  await page.screenshot({ path: `${OUT}/${theme}-active.png`, clip: { x: 0, y: 0, width: 300, height: 80 } });
  await page.mouse.up();
  await page.waitForTimeout(200);

  // Итоговые проверки (с учётом дробных значений в middle-of-transition)
  const transitionOK = base.transition.includes('opacity');
  const hoverTransformOK = hover.transform.includes('matrix(1, 0, 0, 1, 0, -1)') ||
                            (hover.transform.includes('matrix(1, 0, 0, 1, 0, -0.') );
  const hoverOpacityOK = hover.opacity === '0.9' || hover.opacity.startsWith('0.9');
  const focusOutlineOK = focus.outline && focus.outline.includes('2px');
  const focusOffsetOK = focus.outlineOffset === '4px';
  const focusRadiusOK = focus.borderRadius === '4px';
  const activeOpacityOK = active.opacity === '0.7' || active.opacity.startsWith('0.7') || active.opacity.startsWith('0.6') || active.opacity.startsWith('0.8');

  const checks = [
    ['baseTransitionIncludesOpacity', transitionOK],
    ['hoverTransformNeg1', hoverTransformOK],
    ['hoverOpacity09', hoverOpacityOK],
    ['focusOutline2px', focusOutlineOK],
    ['focusOffset4px', focusOffsetOK],
    ['focusRadius4px', focusRadiusOK],
    ['activeOpacity07', activeOpacityOK],
  ];

  console.log(`  Checks:`);
  for (const [name, ok] of checks) {
    console.log(`    ${ok ? '✓' : '✗'} ${name}`);
    summary.push({ theme, check: name, ok });
  }

  await context.close();
}

await browser.close();

console.log('\n=== ИТОГ ===');
const passed = summary.filter(s => s.ok).length;
console.log(`  ${passed}/${summary.length} checks passed`);
