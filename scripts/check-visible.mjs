import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(500);

const data = await p.evaluate(() => {
  const controls = document.querySelector('.home-carousel__controls');
  const showcase = document.querySelector('.page-showcase');
  const cs = getComputedStyle(controls);
  const ss = getComputedStyle(showcase);
  const cr = controls.getBoundingClientRect();
  const sr = showcase.getBoundingClientRect();
  return {
    showcase: { overflow: ss.overflow, bottom: sr.bottom, top: sr.top },
    controls: { top: cr.top, bottom: cr.bottom, visible: cr.bottom <= sr.bottom },
    isCutOff: cr.bottom > sr.bottom,
  };
});
console.log(JSON.stringify(data, null, 2));
await p.screenshot({ path: 'tmp/controls-visible.png', fullPage: false });
await b.close();
