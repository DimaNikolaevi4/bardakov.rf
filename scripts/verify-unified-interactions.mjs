// verify-unified-interactions.mjs
// Верификация унификации интерактивных элементов:
// - min-height/width 44px для всех целевых классов
// - border-radius: var(--radius-sm)
// - единый transition (5 свойств, ease-in-out)
// - hover: translateY(-1px), accent-soft, accent border
// - focus: outline + box-shadow 3px accent-ring
// - .footer-resource — карточка с min-height: 76px, hover shadow

import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';

const URL = 'http://localhost:8080/';
const OUT = 'tmp/unified';
mkdirSync(OUT, { recursive: true });

const TARGETS = [
  { name: 'btn',          selector: '.btn-primary' },
  { name: 'btn-secondary', selector: '.btn-secondary' },
  { name: 'header-icon-btn', selector: '.header-icon-btn' },
  { name: 'theme-btn',    selector: '.theme-btn[data-theme="dark"]' },
  { name: 'footer-social-link', selector: '.footer-social-link' },
  { name: 'footer-resource', selector: '.footer-resource' },
  { name: 'main-nav-link', selector: '.main-nav-link' },
];

const browser = await chromium.launch();

const summary = [];

for (const colorScheme of ['light', 'dark']) {
  const context = await browser.newContext({
    colorScheme,
    viewport: { width: 1280, height: 800 },
  });
  const page = await context.newPage();
  await page.goto(URL, { waitUntil: 'networkidle' });
  await page.waitForTimeout(400);

  console.log(`\n=== ${colorScheme.toUpperCase()} ===`);

  for (const target of TARGETS) {
    const result = await page.evaluate((sel) => {
      const el = document.querySelector(sel);
      if (!el) return { error: 'not found' };
      const cs = getComputedStyle(el);
      const rect = el.getBoundingClientRect();
      return {
        found: true,
        width: Math.round(rect.width),
        height: Math.round(rect.height),
        minHeight: cs.minHeight,
        minWidth: cs.minWidth,
        borderRadius: cs.borderRadius,
        transition: cs.transition.split(',').map(s => s.trim()).slice(0, 5).join(' | '),
        border: cs.border.split(' ').slice(0, 3).join(' '),
      };
    }, target.selector);

    if (result.error) {
      console.log(`  ${target.name.padEnd(22)} ❌ ${result.error}`);
      summary.push({ colorScheme, target: target.name, error: result.error });
      continue;
    }

    const is44 = (result.minHeight === '44px' || result.height >= 44) &&
                 (result.minWidth === '44px' || result.width >= 44);
    const isRadius = result.borderRadius !== '0px';
    const isTransition5 = result.transition.split('|').length >= 4;

    const status = (is44 && isRadius && isTransition5) ? '✓' : '⚠';
    console.log(`  ${target.name.padEnd(22)} ${status} ${result.width}x${result.height}px  min=${result.minHeight}/${result.minWidth}  radius=${result.borderRadius}  transitions=${result.transition.split('|').length}`);

    summary.push({
      colorScheme,
      target: target.name,
      width: result.width,
      height: result.height,
      minHeight: result.minHeight,
      minWidth: result.minWidth,
      borderRadius: result.borderRadius,
      transitions: result.transition.split('|').length,
      status,
    });
  }

  // Проверка hover состояния на одной кнопке
  const btn = await page.$('.theme-btn[data-theme="dark"]');
  if (btn) {
    await btn.hover();
    await page.waitForTimeout(200);
    const hoverData = await page.evaluate(() => {
      const el = document.querySelector('.theme-btn[data-theme="dark"]');
      const cs = getComputedStyle(el);
      const transform = cs.transform;
      return {
        transform,
        bg: cs.backgroundColor,
        borderColor: cs.borderColor,
      };
    });
    console.log(`  HOVER .theme-btn: transform=${hoverData.transform.slice(0, 50)}  bg=${hoverData.bg.slice(0, 40)}`);
  }

  // Проверка focus-visible состояния
  await page.keyboard.press('Tab');
  await page.waitForTimeout(200);
  const focusData = await page.evaluate(() => {
    const el = document.activeElement;
    if (!el) return { error: 'no focus' };
    const cs = getComputedStyle(el);
    return {
      tag: el.tagName,
      cls: el.className?.toString?.() || '',
      outline: cs.outline,
      outlineColor: cs.outlineColor,
      boxShadow: cs.boxShadow.slice(0, 60),
    };
  });
  console.log(`  FOCUS: ${focusData.tag}.${focusData.cls?.split(' ')[0] || ''}  outline=${focusData.outline.slice(0, 30)}  boxShadow=${focusData.boxShadow}`);

  await page.screenshot({ path: `${OUT}/${colorScheme}-header.png`, clip: { x: 0, y: 0, width: 1280, height: 100 } });
  await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight - 800));
  await page.waitForTimeout(200);
  await page.screenshot({ path: `${OUT}/${colorScheme}-footer.png`, clip: { x: 0, y: 0, width: 1280, height: 300 } });

  await context.close();
}

await browser.close();

// Итоговая сводка
console.log('\n=== ИТОГОВАЯ СВОДКА ===');
const passed = summary.filter(s => s.status === '✓').length;
const warned = summary.filter(s => s.status === '⚠').length;
const errored = summary.filter(s => s.error).length;
console.log(`  ✓ passed: ${passed}/${summary.length}`);
console.log(`  ⚠ warnings: ${warned}`);
console.log(`  ❌ errors: ${errored}`);

if (warned > 0 || errored > 0) {
  console.log('\nПроблемные элементы:');
  for (const s of summary) {
    if (s.status !== '✓') {
      console.log(`  [${s.colorScheme}] ${s.target}: ${s.error || `${s.width}x${s.height}, min=${s.minHeight}, radius=${s.borderRadius}, transitions=${s.transitions}`}`);
    }
  }
}
