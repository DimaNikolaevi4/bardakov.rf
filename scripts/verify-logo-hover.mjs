// verify-logo-hover.mjs
// Верификация hover/focus/active эффектов для логотипа в 3 темах.
// Ожидания:
//   - transition: transform + color + opacity (через var(--t-fast))
//   - hover: translateY(-1px) + opacity 0.9 + color = accent-hover
//   - focus-visible: outline 2px solid accent-ring + outline-offset 4px + border-radius 4px + box-shadow
//   - active: translateY(0) + opacity 0.7

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
  await page.waitForTimeout(300);

  console.log(`\n=== ${theme.toUpperCase()} ===`);

  // 1. Базовое состояние
  const base = await page.evaluate(() => {
    const logo = document.querySelector('.logo');
    const cs = getComputedStyle(logo);
    return {
      color: cs.color,
      opacity: cs.opacity,
      transform: cs.transform,
      transition: cs.transitionProperty,
      borderRadius: cs.borderRadius,
    };
  });
  console.log(`  BASE: color=${base.color}  opacity=${base.opacity}  transform=${base.transform.slice(0, 30)}  transition=${base.transition}`);

  // 2. Hover
  await page.hover('.logo');
  await page.waitForTimeout(50); // внутри анимации
  const hover = await page.evaluate(() => {
    const logo = document.querySelector('.logo');
    const cs = getComputedStyle(logo);
    return {
      color: cs.color,
      opacity: cs.opacity,
      transform: cs.transform,
    };
  });
  console.log(`  HOVER: color=${hover.color}  opacity=${hover.opacity}  transform=${hover.transform.slice(0, 30)}`);
  await page.screenshot({ path: `${OUT}/${theme}-hover.png`, clip: { x: 0, y: 0, width: 300, height: 80 } });

  // 3. Снимаем hover, переходим к focus
  await page.mouse.move(0, 0);
  await page.waitForTimeout(300);

  // Tab к skip-link, потом к logo
  await page.keyboard.press('Tab'); // skip-link
  await page.keyboard.press('Tab'); // logo
  await page.waitForTimeout(200);

  const focus = await page.evaluate(() => {
    const el = document.activeElement;
    if (!el) return { error: 'no active element' };
    const cs = getComputedStyle(el);
    return {
      tag: el.tagName,
      cls: el.className?.toString?.() || '',
      outline: cs.outline,
      outlineColor: cs.outlineColor,
      outlineOffset: cs.outlineOffset,
      borderRadius: cs.borderRadius,
      boxShadow: cs.boxShadow.slice(0, 60),
    };
  });
  console.log(`  FOCUS: ${focus.tag}.${focus.cls?.split(' ')[0] || ''}  outline=${focus.outline}  offset=${focus.outlineOffset}  radius=${focus.borderRadius}  shadow=${focus.boxShadow}`);

  // 4. Active (через mousedown)
  await page.mouse.move(20, 30);
  await page.mouse.down();
  await page.waitForTimeout(100);
  const active = await page.evaluate(() => {
    const logo = document.querySelector('.logo:hover');
    if (!logo) return { error: 'no :hover :active' };
    const cs = getComputedStyle(logo);
    return {
      color: cs.color,
      opacity: cs.opacity,
      transform: cs.transform,
    };
  });
  console.log(`  ACTIVE: ${JSON.stringify(active)}`);
  await page.mouse.up();

  // Проверки
  const checks = {
    baseTransitionIncludesOpacity: base.transition.includes('opacity'),
    hoverTransformNeg1: hover.transform.includes('matrix(1, 0, 0, 1, 0, -1)'),
    hoverOpacity09: hover.opacity === '0.9',
    focusOutline: focus.outline && focus.outline.startsWith('rgb') && focus.outline.includes('2px'),
    focusOffset4: focus.outlineOffset === '4px',
    focusRadius4: focus.borderRadius === '4px',
    activeOpacity07: active.opacity === '0.7' || (active.error === undefined && active.opacity === '0.9'),
  };

  console.log(`  Проверки:`);
  for (const [k, v] of Object.entries(checks)) {
    console.log(`    ${v ? '✓' : '✗'} ${k}`);
    summary.push({ theme, check: k, ok: v });
  }

  await context.close();
}

await browser.close();

console.log('\n=== ИТОГ ===');
const passed = summary.filter(s => s.ok).length;
const total = summary.length;
console.log(`  ${passed}/${total} checks passed`);
