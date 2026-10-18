import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.waitForTimeout(300);
const t = await p.evaluate(() => {
  const el = document.querySelector('.header-icon-btn');
  const cs = getComputedStyle(el);
  return {
    transitionProperty: cs.transitionProperty,
    transitionDuration: cs.transitionDuration,
    transitionTimingFunction: cs.transitionTimingFunction,
  };
});
console.log(JSON.stringify(t, null, 2));
await b.close();
