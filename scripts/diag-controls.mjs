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
  
  if (!controls) return { error: 'controls not found' };
  
  const cs = getComputedStyle(controls);
  const rect = controls.getBoundingClientRect();
  
  // Проверка display
  let displayValue = cs.display;
  
  // Проверка каждой стрелки
  const arrowData = Array.from(arrows).map(a => {
    const acs = getComputedStyle(a);
    const ar = a.getBoundingClientRect();
    return {
      width: ar.width,
      height: ar.height,
      display: acs.display,
      visibility: acs.visibility,
      opacity: acs.opacity,
      color: acs.color,
      background: acs.backgroundColor,
      position: acs.position,
      overflow: acs.overflow,
      hasSvg: !!a.querySelector('svg'),
      svgSize: a.querySelector('svg') ? {
        w: getComputedStyle(a.querySelector('svg')).width,
        h: getComputedStyle(a.querySelector('svg')).height,
      } : null,
    };
  });
  
  // Проверка точек
  const dotData = Array.from(dots).map(d => {
    const dcs = getComputedStyle(d);
    const dr = d.getBoundingClientRect();
    const before = getComputedStyle(d, '::before');
    return {
      width: dr.width,
      height: dr.height,
      display: dcs.display,
      visibility: dcs.visibility,
      opacity: dcs.opacity,
      before: {
        width: before.width,
        height: before.height,
        background: before.backgroundColor,
        opacity: before.opacity,
        content: before.content,
      },
    };
  });
  
  return {
    controls: {
      display: displayValue,
      position: cs.position,
      visibility: cs.visibility,
      opacity: cs.opacity,
      overflow: cs.overflow,
      rect: { w: rect.width, h: rect.height, top: rect.top, left: rect.left },
    },
    arrows: arrowData,
    dots: dotData,
  };
});
console.log(JSON.stringify(data, null, 2));
await p.screenshot({ path: 'tmp/diag-controls.png', clip: { x: 0, y: 300, width: 1280, height: 300 } });
await b.close();
