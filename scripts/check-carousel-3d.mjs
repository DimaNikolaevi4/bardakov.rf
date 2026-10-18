import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';
mkdirSync('tmp/carousel-3d', { recursive: true });

const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(500);

// Проверка 1: Blob-форма на активном слайде
const imgData = await p.evaluate(() => {
  const img = document.querySelector('.home-carousel__slide.is-active .home-carousel__image');
  if (!img) return { error: 'no image' };
  const cs = getComputedStyle(img);
  return {
    borderRadius: cs.borderRadius.slice(0, 60),
    animationName: cs.animationName,
    boxShadow: cs.boxShadow.slice(0, 60),
  };
});
console.log('=== Blob image ===');
console.log(JSON.stringify(imgData, null, 2));

// Проверка 2: 3D flip transitions
const slideData = await p.evaluate(() => {
  const slide = document.querySelector('.home-carousel__slide');
  const activeSlide = document.querySelector('.home-carousel__slide.is-active');
  const cs = getComputedStyle(slide);
  const activeCs = getComputedStyle(activeSlide);
  return {
    transition: cs.transition.slice(0, 60),
    activeTransform: activeCs.transform.slice(0, 60),
    activeOpacity: activeCs.opacity,
    perspective: getComputedStyle(document.querySelector('.home-carousel__slides')).perspective,
  };
});
console.log('\n=== 3D Flip ===');
console.log(JSON.stringify(slideData, null, 2));

// Проверка 3: Overlays
const overlayData = await p.evaluate(() => {
  const slides = document.querySelectorAll('.home-carousel__slide');
  return Array.from(slides).map(s => {
    const overlay = s.querySelector('.slide-overlay');
    const isActive = s.classList.contains('is-active');
    const dataSlide = s.getAttribute('data-slide');
    if (!overlay) return { dataSlide, hasOverlay: false };
    const cs = getComputedStyle(overlay);
    const parentCs = getComputedStyle(s);
    return {
      dataSlide,
      hasOverlay: true,
      overlayDisplay: cs.display,
      overlayOpacity: cs.opacity,
      overlayTransform: cs.transform.slice(0, 30),
      slideDisplay: parentCs.display,
    };
  });
});
console.log('\n=== Overlays ===');
overlayData.forEach(o => console.log(`  Slide #${o.dataSlide}: overlay=${o.hasOverlay} display=${o.overlayDisplay || 'N/A'} opacity=${o.overlayOpacity || 'N/A'}`));

// Проверка 4: Controls
const controlsData = await p.evaluate(() => {
  const arrows = document.querySelectorAll('.home-carousel__arrow');
  const dots = document.querySelectorAll('.home-carousel__dot');
  return {
    arrowCount: arrows.length,
    arrowSize: arrows[0] ? { w: arrows[0].offsetWidth, h: arrows[0].offsetHeight } : null,
    dotCount: dots.length,
    activeDot: Array.from(dots).find(d => d.getAttribute('aria-current') === 'true') ? 'found' : 'not found',
  };
});
console.log('\n=== Controls ===');
console.log(JSON.stringify(controlsData, null, 2));

// Проверка 5: Автопрокрутка (ждём 4 сек и смотрим, сменился ли слайд)
console.log('\n=== Autoplay test (waiting 12s for first slide change at 3s delay + 8s interval) ===');
const slide1 = await p.evaluate(() => document.querySelector('.home-carousel__slide.is-active')?.getAttribute('data-slide'));
console.log(`  Before wait: active slide = #${slide1}`);
await p.waitForTimeout(12000);
const slide2 = await p.evaluate(() => document.querySelector('.home-carousel__slide.is-active')?.getAttribute('data-slide'));
console.log(`  After 12s: active slide = #${slide2}`);
console.log(`  ${slide1 !== slide2 ? '✓ Autoplay работает!' : '⚠ Автопрокрутка не сработала (возможно prefers-reduced-motion)'}`);

// Скриншот
await p.screenshot({ path: 'tmp/carousel-3d/light-carousel.png', fullPage: false });
console.log('\n✓ Скриншот: tmp/carousel-3d/light-carousel.png');

await b.close();
