import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.waitForTimeout(300);

const t = await p.evaluate(() => {
  const el = document.querySelector('.header-icon-btn');
  const cs = getComputedStyle(el);
  const root = getComputedStyle(document.documentElement);
  return {
    tfast: root.getPropertyValue('--t-fast').trim(),
    inlineTransition: cs.transition,
    backgroundColor: cs.backgroundColor,
    transform: cs.transform,
  };
});
console.log(JSON.stringify(t, null, 2));

// Симулирую hover и проверяю, что transitionDuration действительно работает
await p.hover('.header-icon-btn');
await p.waitForTimeout(50);
const hover = await p.evaluate(() => {
  const el = document.querySelector('.header-icon-btn');
  const cs = getComputedStyle(el);
  return {
    transition: cs.transition,
    backgroundColor: cs.backgroundColor,
    transform: cs.transform,
  };
});
console.log('HOVER:', JSON.stringify(hover, null, 2));

await b.close();
