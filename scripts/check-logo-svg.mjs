import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);
await p.evaluate(() => {
  const off = document.querySelector('#offcanvasRubrics');
  if (off) { off.classList.add('is-open'); off.setAttribute('aria-hidden', 'false'); }
});
await p.waitForTimeout(200);

const data = await p.evaluate(() => {
  const logo = document.querySelector('.offcanvas-brand .logo-mark');
  if (!logo) return { error: 'not found' };
  return {
    tag: logo.tagName,
    isSVG: logo.tagName === 'svg',
    width: logo.getBoundingClientRect().width,
    height: logo.getBoundingClientRect().height,
    text: logo.textContent.trim(),
    color: getComputedStyle(logo.closest('.offcanvas-brand')).color,
  };
});
console.log(JSON.stringify(data, null, 2));
await p.screenshot({ path: 'tmp/offcanvas-with-logo.png', clip: { x: 840, y: 0, width: 440, height: 120 } });
await b.close();
