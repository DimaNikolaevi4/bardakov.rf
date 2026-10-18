import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';
const OUT = 'tmp/footer-bg-fix';
mkdirSync(OUT, { recursive: true });

const b = await chromium.launch();
for (const theme of ['light', 'dark']) {
  const ctx = await b.newContext({
    colorScheme: theme === 'dark' ? 'dark' : 'light',
    viewport: { width: 1280, height: 2200 }
  });
  const p = await ctx.newPage();
  await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
  await p.evaluate((t) => document.documentElement.setAttribute('data-theme', t), theme);
  await p.waitForTimeout(300);
  await p.evaluate(() => document.querySelector('.site-footer')?.scrollIntoView({ block: 'start' }));
  await p.waitForTimeout(200);
  await p.screenshot({
    path: `${OUT}/${theme}-footer.png`,
    clip: { x: 0, y: 0, width: 1280, height: 1000 }
  });
  await ctx.close();
}
await b.close();
console.log('✓ Скриншоты:', OUT);
