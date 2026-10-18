import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(500);

// 1. Проверка веерной раскладки
const slides = await p.evaluate(() => {
  return Array.from(document.querySelectorAll('.home-carousel__slide')).map(s => {
    const cs = getComputedStyle(s);
    const r = s.getBoundingClientRect();
    return {
      cls: s.className.split(' ').filter(c => c.startsWith('is-'))[0] || 'none',
      transform: cs.transform.slice(0, 40),
      opacity: parseFloat(cs.opacity).toFixed(2),
      zIndex: cs.zIndex,
      width: Math.round(r.width),
      left: Math.round(r.left),
    };
  });
});
console.log('=== Веерная раскладка (3 слайда) ===');
slides.forEach((s, i) => {
  console.log(`  Slide #${i}: cls=${s.cls} opacity=${s.opacity} z=${s.zIndex} w=${s.width}px left=${s.left}px transform=${s.transform}`);
});

// 2. Проверка blob-формы
const blob = await p.evaluate(() => {
  const img = document.querySelector('.home-carousel__slide.is-active .home-carousel__image');
  if (!img) return { error: 'no image' };
  const cs = getComputedStyle(img);
  return { animationName: cs.animationName, borderRadius: cs.borderRadius.slice(0, 40) };
});
console.log('\n=== Blob ===');
console.log(JSON.stringify(blob));

// 3. Проверка текста
const text = await p.evaluate(() => {
  return {
    eyebrow: document.getElementById('hero-eyebrow')?.textContent,
    h1: document.getElementById('hero-h1')?.innerHTML.slice(0, 30),
    visible: document.querySelectorAll('.page-showcase__copy .visible').length,
  };
});
console.log('\n=== Текст (слайд 1) ===');
console.log(JSON.stringify(text, null, 2));

// 4. Проверка controls
const controls = await p.evaluate(() => {
  return {
    arrows: document.querySelectorAll('.home-carousel__arrow').length,
    dots: document.querySelectorAll('.home-carousel__dot').length,
    activeDot: document.querySelector('.home-carousel__dot[aria-current="true"]') ? 'found' : 'not found',
  };
});
console.log('\n=== Controls ===');
console.log(JSON.stringify(controls));

// 5. Проверка автопрокрутки + динамического текста
console.log('\n=== Autoplay + text change test (12s) ===');
const before = await p.evaluate(() => document.getElementById('hero-h1')?.innerHTML.slice(0, 20));
console.log(`  Before: h1="${before}"`);
await p.waitForTimeout(12000);
const after = await p.evaluate(() => {
  return {
    h1: document.getElementById('hero-h1')?.innerHTML.slice(0, 20),
    activeSlide: document.querySelector('.home-carousel__slide.is-active')?.getAttribute('data-slide'),
    visibleCount: document.querySelectorAll('.page-showcase__copy .visible').length,
  };
});
console.log(`  After:  h1="${after.h1}" activeSlide=#${after.activeSlide} visible=${after.visibleCount}`);
console.log(`  ${before !== after.h1 ? '✓ Текст изменился!' : '⚠ Текст не изменился'}`);

// 6. Нет оверлеев
const overlays = await p.evaluate(() => document.querySelectorAll('.slide-overlay').length);
console.log(`\n=== Оверлеи: ${overlays} (должно быть 0) ===`);

// Скриншот
await p.screenshot({ path: 'tmp/fan-carousel.png', fullPage: false });
console.log('\n✓ Скриншот: tmp/fan-carousel.png');
await b.close();
