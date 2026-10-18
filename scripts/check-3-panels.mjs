import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);
// Открываем offcanvas
await p.evaluate(() => {
  const off = document.querySelector('#offcanvasRubrics');
  if (off) { off.classList.add('is-open'); off.setAttribute('aria-hidden', 'false'); }
});
await p.waitForTimeout(200);

const data = await p.evaluate(() => {
  const main = document.querySelector('.offcanvas-header');
  const sides = document.querySelectorAll('.oc-side-panel__header');
  return {
    main: main ? { height: main.offsetHeight, padding: getComputedStyle(main).padding } : null,
    sides: Array.from(sides).map(s => ({ height: s.offsetHeight, padding: getComputedStyle(s).padding })),
  };
});
console.log('Main offcanvas-header:', JSON.stringify(data.main));
data.sides.forEach((s, i) => console.log(`Side panel #${i}:`, JSON.stringify(s)));
await b.close();
