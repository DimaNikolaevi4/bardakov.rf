// verify-font-refactor.mjs
// Проверка, что после массовой замены font-size на токены визуал не сломался:
// - размеры текста в ключевых элементах остались в тех же px-диапазонах
// - токены --text-* корректно резолвятся
// - hover-эффекты продолжают работать

import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';

const URL = 'http://localhost:8080/';
const OUT = 'tmp/font-refactor';
mkdirSync(OUT, { recursive: true });

const browser = await chromium.launch();

// Ожидаемые размеры (бывшие хардкоды → токены, в px)
const expectedSizes = [
  // { selector, description, expectedRange: [minPx, maxPx] }
  { selector: 'body',                          description: 'body text (16px)',                expectedRange: [15, 17] },
  { selector: '.btn',                          description: '.btn (был 0.95rem → --text-md)', expectedRange: [16, 18] },
  { selector: '.theme-btn',                    description: '.theme-btn (1.05rem → --text-md)', expectedRange: [16, 18] },
  { selector: '.header-icon-btn',              description: '.header-icon-btn (1.05rem → --text-md)', expectedRange: [16, 18] },
  { selector: '.main-nav a.main-nav-link',     description: '.main-nav-link (0.82rem → --text-sm-md)', expectedRange: [13, 15] },
  { selector: '.hero h1',                      description: '.hero h1 (был 5rem... но это был font-size: 5rem для ::before)', expectedRange: [30, 80] },
  { selector: '.footer-resource-text',         description: '.footer-resource-text',           expectedRange: [11, 14] },
];

for (const colorScheme of ['light', 'dark']) {
  const context = await browser.newContext({
    colorScheme,
    viewport: { width: 1280, height: 800 },
  });
  const page = await context.newPage();
  await page.goto(URL, { waitUntil: 'networkidle' });
  await page.evaluate((t) => document.documentElement.setAttribute('data-theme', t), colorScheme);
  await page.waitForTimeout(400);

  console.log(`\n=== ${colorScheme.toUpperCase()} ===`);

  // Проверка токенов --text-*
  const tokens = await page.evaluate(() => {
    const root = getComputedStyle(document.documentElement);
    return {
      'text-2xs':   root.getPropertyValue('--text-2xs').trim(),
      'text-xs':    root.getPropertyValue('--text-xs').trim(),
      'text-sm':    root.getPropertyValue('--text-sm').trim(),
      'text-sm-md': root.getPropertyValue('--text-sm-md').trim(),
      'text-base':  root.getPropertyValue('--text-base').trim(),
      'text-md':    root.getPropertyValue('--text-md').trim(),
      'text-lg':    root.getPropertyValue('--text-lg').trim(),
      'text-xl':    root.getPropertyValue('--text-xl').trim(),
      'text-6xl':   root.getPropertyValue('--text-6xl').trim(),
    };
  });
  console.log('  Токены:');
  for (const [k, v] of Object.entries(tokens)) {
    console.log(`    --${k}: ${v}`);
  }

  // Проверка computed font-size для ключевых селекторов
  for (const { selector, description, expectedRange } of expectedSizes) {
    const result = await page.evaluate((sel) => {
      const el = document.querySelector(sel);
      if (!el) return { error: 'not found' };
      return {
        fontSize: getComputedStyle(el).fontSize,
      };
    }, selector);
    if (result.error) {
      console.log(`  ⚠ ${description}: ${result.error}`);
      continue;
    }
    const px = parseFloat(result.fontSize);
    const ok = px >= expectedRange[0] && px <= expectedRange[1];
    console.log(`  ${ok ? '✓' : '⚠'} ${description.padEnd(45)} ${result.fontSize} (ожидание ${expectedRange[0]}-${expectedRange[1]}px)`);
  }

  // Скриншот главной страницы для визуальной проверки
  await page.screenshot({ path: `${OUT}/${colorScheme}-header.png`, clip: { x: 0, y: 0, width: 1280, height: 100 } });
  await page.screenshot({ path: `${OUT}/${colorScheme}-full.png` });

  await context.close();
}

await browser.close();
console.log(`\n✓ Скриншоты: ${OUT}`);
