import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';
mkdirSync('tmp/offcanvas', { recursive: true });

const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);
await p.evaluate(() => {
  const off = document.querySelector('#offcanvasRubrics');
  if (off) {
    off.classList.add('is-open');
    off.setAttribute('aria-hidden', 'false');
  }
});
await p.waitForTimeout(300);
await p.screenshot({ path: 'tmp/offcanvas/light-offcanvas.png', clip: { x: 840, y: 0, width: 440, height: 800 } });
await b.close();
