import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(500);

const data = await p.evaluate(() => {
  const controls = document.querySelector('.home-carousel__controls');
  const arrows = document.querySelectorAll('.home-carousel__arrow');
  const dots = document.querySelectorAll('.home-carousel__dot');
  const activeDot = document.querySelector('.home-carousel__dot[aria-current="true"]');
  
  const controlsCs = getComputedStyle(controls);
  const arrowCs = arrows[0] ? getComputedStyle(arrows[0]) : null;
  const dotCs = dots[0] ? getComputedStyle(dots[0]) : null;
  
  return {
    controls: {
      position: controlsCs.position,
      display: controlsCs.display,
      bottom: controlsCs.bottom,
    },
    arrow: arrowCs ? {
      width: arrowCs.width,
      height: arrowCs.height,
      background: arrowCs.backgroundColor,
      border: arrowCs.border.split(' ').slice(0, 2).join(' '),
      borderRadius: arrowCs.borderRadius,
    } : null,
    dot: dotCs ? {
      width: dotCs.width,
      height: dotCs.height,
      background: dotCs.backgroundColor,
      border: dotCs.border.split(' ').slice(0, 2).join(' '),
    } : null,
    activeDot: activeDot ? {
      beforeWidth: getComputedStyle(activeDot, '::before').width,
      beforeHeight: getComputedStyle(activeDot, '::before').height,
      beforeBackground: getComputedStyle(activeDot, '::before').backgroundColor,
    } : null,
    arrowCount: arrows.length,
    dotCount: dots.length,
  };
});
console.log(JSON.stringify(data, null, 2));
await p.screenshot({ path: 'tmp/controls-check.png', fullPage: false });
await b.close();
