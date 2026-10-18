import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';

const URL = 'http://localhost:8080/';
const OUT = 'tmp/footer-fix';
mkdirSync(OUT, { recursive: true });

const browser = await chromium.launch();

for (const theme of ['light', 'dark', 'high-contrast']) {
  const context = await browser.newContext({
    colorScheme: theme === 'dark' ? 'dark' : 'light',
    viewport: { width: 1280, height: 800 },
  });
  const page = await context.newPage();
  await page.goto(URL, { waitUntil: 'networkidle' });
  await page.evaluate((t) => document.documentElement.setAttribute('data-theme', t), theme);
  await page.waitForTimeout(300);
  await page.evaluate(() => document.querySelector('.site-footer .footer-resources')?.scrollIntoView({ block: 'center' }));
  await page.waitForTimeout(200);

  const cards = await page.evaluate(() => {
    return Array.from(document.querySelectorAll('.site-footer .footer-resource')).map((c) => {
      const r = c.getBoundingClientRect();
      return {
        text: c.querySelector('.footer-resource-text').textContent.trim(),
        height: Math.round(r.height),
        width: Math.round(r.width),
        top: Math.round(r.top),
      };
    });
  });

  // Группировка по строкам
  const rows = {};
  for (const c of cards) {
    if (!rows[c.top]) rows[c.top] = [];
    rows[c.top].push(c);
  }

  console.log(`\n=== ${theme.toUpperCase()} ===`);
  let allEqual = true;
  for (const [top, rowCards] of Object.entries(rows)) {
    const heights = rowCards.map(c => c.height);
    const min = Math.min(...heights);
    const max = Math.max(...heights);
    const diff = max - min;
    const ok = diff === 0;
    if (!ok) allEqual = false;
    console.log(`  Row top=${top}: ${rowCards.length} cards, heights=[${heights.join(',')}] diff=${diff} ${ok ? '✓' : '⚠'}`);
  }
  console.log(`  ${allEqual ? '✓ ВСЕ КАРТОЧКИ ОДИНАКОВОЙ ВЫСОТЫ' : '⚠ Есть разница в высоте'}`);

  // Скриншот footer
  await page.screenshot({ path: `${OUT}/${theme}-footer.png`, clip: { x: 0, y: 500, width: 1280, height: 400 } });
  await context.close();
}

await browser.close();
console.log('\n✓ Скриншоты:', OUT);
