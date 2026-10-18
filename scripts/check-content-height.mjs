import { chromium } from 'playwright';
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
await p.waitForTimeout(200);

const data = await p.evaluate(() => {
  const headers = document.querySelectorAll('.offcanvas-header, .oc-side-panel__header');
  return Array.from(headers).map(h => {
    const cs = getComputedStyle(h);
    return {
      cls: h.className.split(' ').filter(c => c.startsWith('offcanvas') || c.startsWith('oc-'))[0],
      offsetHeight: h.offsetHeight,
      padding: cs.padding,
      contentHeight: h.scrollHeight,
      childrenHeights: Array.from(h.children).map(c => ({
        cls: c.className.split(' ')[0],
        offsetHeight: c.offsetHeight,
      })),
    };
  });
});
console.log(JSON.stringify(data, null, 2));
await b.close();
