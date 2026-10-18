// scripts/a11y-smoke.mjs
// ФАЗА 7: A11y smoke-тест Tab-навигации через Playwright.
// Запуск: node scripts/a11y-smoke.mjs
// Окружение: должен быть установлен Playwright (npm i -g playwright или pip install playwright)
// и запущен dev-сервер на http://localhost:8080/.

import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';

const URL = process.env.URL || 'http://localhost:8080/';
const THEMES = ['light', 'dark', 'high-contrast'];
const MAX_TABS = 30;
const OUT_DIR = 'tmp/a11y';

mkdirSync(OUT_DIR, { recursive: true });

const browser = await chromium.launch();
const page = await browser.newPage();

const failures = [];
const passed = [];

for (const theme of THEMES) {
  await page.goto(URL, { waitUntil: 'networkidle' });
  await page.evaluate((t) => document.documentElement.setAttribute('data-theme', t), theme);
  await page.waitForTimeout(200); // позволить теме примениться

  for (let i = 0; i < MAX_TABS; i++) {
    await page.keyboard.press('Tab');
    const focused = await page.evaluate(() => {
      const el = document.activeElement;
      if (!el || el === document.body) return null;
      const styles = getComputedStyle(el);
      return {
        tag: el.tagName,
        cls: (el.className || '').toString().slice(0, 60),
        outline: styles.outlineStyle,
        outlineWidth: styles.outlineWidth,
        outlineColor: styles.outlineColor,
      };
    });
    if (!focused) break; // дошли до конца Tab-цикла
    const hasVisibleOutline =
      focused.outline !== 'none' ||
      parseFloat(focused.outlineWidth) > 0;
    if (hasVisibleOutline) {
      passed.push({ theme, tab: i, ...focused });
    } else {
      failures.push({ theme, tab: i, ...focused });
    }
    await page.screenshot({ path: `${OUT_DIR}/${theme}-tab-${String(i).padStart(2, '0')}.png` });
  }
}

await browser.close();

console.log(`\n=== A11y smoke: ${passed.length} passed, ${failures.length} failed ===`);
if (failures.length > 0) {
  console.log('\nFailures:');
  for (const f of failures.slice(0, 10)) {
    console.log(`  [${f.theme}] tab #${f.tab}: ${f.tag}.${f.cls} — outline: ${f.outline} ${f.outlineWidth}px ${f.outlineColor}`);
  }
  process.exit(1);
}
console.log('✅ Все интерактивные элементы имеют видимый outline во всех темах.');
process.exit(0);
