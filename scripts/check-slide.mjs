import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(500);

const before = await p.evaluate(() => {
  const slide = document.querySelector('.home-carousel__slide.is-active');
  const cs = getComputedStyle(slide);
  return {
    transform: cs.transform.slice(0, 50),
    opacity: cs.opacity,
    transition: cs.transition.slice(0, 60),
  };
});
console.log('=== Слайд 1 (is-active) ===');
console.log(JSON.stringify(before, null, 2));

// Кликаем next
await p.click('.home-carousel__arrow--next');
await p.waitForTimeout(100); // в начале анимации

const during = await p.evaluate(() => {
  const active = document.querySelector('.home-carousel__slide.is-active');
  const prev = document.querySelector('.home-carousel__slide.is-prev');
  const activeCs = getComputedStyle(active);
  const prevCs = prev ? getComputedStyle(prev) : null;
  return {
    active: { transform: activeCs.transform.slice(0, 40), opacity: activeCs.opacity },
    prev: prevCs ? { transform: prevCs.transform.slice(0, 40), opacity: prevCs.opacity } : null,
  };
});
console.log('\n=== Во время перехода (начало) ===');
console.log(JSON.stringify(during, null, 2));

// Ждём завершения
await p.waitForTimeout(1000);
const after = await p.evaluate(() => {
  const active = document.querySelector('.home-carousel__slide.is-active');
  return {
    dataSlide: active.getAttribute('data-slide'),
    transform: getComputedStyle(active).transform.slice(0, 40),
    opacity: getComputedStyle(active).opacity,
  };
});
console.log('\n=== После перехода ===');
console.log(JSON.stringify(after, null, 2));

await p.screenshot({ path: 'tmp/slide-transition.png', fullPage: false });
await b.close();
