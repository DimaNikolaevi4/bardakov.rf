import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';
mkdirSync('tmp/offcanvas-logo', { recursive: true });

const b = await chromium.launch();
for (const theme of ['light', 'dark']) {
  const ctx = await b.newContext({
    colorScheme: theme === 'dark' ? 'dark' : 'light',
    viewport: { width: 1280, height: 800 }
  });
  const p = await ctx.newPage();
  await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
  await p.evaluate((t) => document.documentElement.setAttribute('data-theme', t), theme);
  await p.waitForTimeout(300);
  await p.evaluate(() => {
    const off = document.querySelector('#offcanvasRubrics');
    if (off) { off.classList.add('is-open'); off.setAttribute('aria-hidden', 'false'); }
  });
  await p.waitForTimeout(300);
  await p.screenshot({ path: `tmp/offcanvas-logo/${theme}-offcanvas.png`, clip: { x: 840, y: 0, width: 440, height: 200 } });
  await ctx.close();
}
await b.close();
console.log('✓ Скриншоты готовы');
