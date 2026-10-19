import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(500);

const data = await p.evaluate(() => {
  const carousel = document.querySelector('.home-carousel');
  const cs = getComputedStyle(carousel);
  return {
    background: cs.background,
    backgroundColor: cs.backgroundColor,
    backgroundImage: cs.backgroundImage,
    borderRadius: cs.borderRadius,
    boxShadow: cs.boxShadow.slice(0, 30),
    overflow: cs.overflow,
    height: cs.height,
  };
});
console.log(JSON.stringify(data, null, 2));
await p.screenshot({ path: 'tmp/no-bg-carousel.png', fullPage: false });
await b.close();
