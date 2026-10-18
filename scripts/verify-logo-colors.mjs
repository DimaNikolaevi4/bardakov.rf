// verify-logo-colors.mjs
// Проверка цвета логотипа в трёх темах.
// Ожидаемый результат:
//   light:         #0F172A (тёмно-синий)
//   dark:          #818CF8 (светло-фиолетовый)
//   high-contrast: #FFFF00 (ярко-жёлтый)

import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';

const URL = 'http://localhost:8080/';
const OUT = 'tmp/logo-colors';
mkdirSync(OUT, { recursive: true });

const browser = await chromium.launch();

const themes = [
  { name: 'light',         expected: '#0F172A', expectedRgb: [15, 23, 42] },
  { name: 'dark',           expected: '#818CF8', expectedRgb: [129, 140, 248] },
  { name: 'high-contrast',  expected: '#FFFF00', expectedRgb: [255, 255, 0] },
];

for (const theme of themes) {
  const context = await browser.newContext({
    colorScheme: theme.name === 'dark' ? 'dark' : 'light',
    viewport: { width: 1280, height: 800 },
  });
  const page = await context.newPage();
  await page.goto(URL, { waitUntil: 'networkidle' });

  // Принудительно ставим тему, чтобы проверить именно её
  await page.evaluate((t) => document.documentElement.setAttribute('data-theme', t), theme.name);
  await page.waitForTimeout(300);

  const data = await page.evaluate(() => {
    const logo = document.querySelector('.logo');
    const logoMark = document.querySelector('.logo-mark');
    if (!logo) return { error: 'logo not found' };
    const cs = getComputedStyle(logo);
    const svg = document.querySelector('.logo-mark');
    const svgFill = svg ? svg.querySelector('circle, rect, path') : null;
    return {
      color: cs.color,
      logoColorToken: getComputedStyle(document.documentElement).getPropertyValue('--logo-color').trim(),
      accentToken: getComputedStyle(document.documentElement).getPropertyValue('--accent').trim(),
      highlightToken: getComputedStyle(document.documentElement).getPropertyValue('--highlight').trim(),
      dataTheme: document.documentElement.getAttribute('data-theme'),
    };
  });

  // Скриншот шапки для визуальной проверки
  await page.screenshot({ path: `${OUT}/${theme.name}-header.png`, clip: { x: 0, y: 0, width: 300, height: 80 } });

  console.log(`\n=== ${theme.name.toUpperCase()} ===`);
  console.log(`  data-theme: ${data.dataTheme}`);
  console.log(`  --logo-color (token): ${data.logoColorToken}`);
  console.log(`  --accent (token):     ${data.accentToken}`);
  console.log(`  --highlight (token):  ${data.highlightToken}`);
  console.log(`  .logo computed color: ${data.color}`);
  console.log(`  ожидаемый:            ${theme.expected} (rgb ${theme.expectedRgb.join(',')})`);

  // Проверяем, соответствует ли цвет ожидаемому
  // computed style возвращает rgb(15, 23, 42) / rgb(129, 140, 248) / rgb(255, 255, 0)
  const match = data.color.includes(theme.expectedRgb.join(', ')) ||
                data.color.includes(theme.expectedRgb.join(','));
  console.log(`  ${match ? '✓ СООТВЕТСТВУЕТ' : '⚠ НЕ СОВПАДАЕТ'}`);

  await context.close();
}

await browser.close();
console.log('\n✓ Скриншоты:', OUT);
