import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(500);

// 1. Blob
const blob = await p.evaluate(() => {
  const img = document.querySelector('.home-carousel__slide.is-active .home-carousel__image');
  if (!img) return { error: 'no image' };
  const cs = getComputedStyle(img);
  return { animationName: cs.animationName, borderRadius: cs.borderRadius.slice(0, 40) };
});
console.log('=== Blob ===');
console.log(JSON.stringify(blob));

// 2. 3D flip
const flip = await p.evaluate(() => {
  const slide = document.querySelector('.home-carousel__slide.is-active');
  const cs = getComputedStyle(slide);
  return { transform: cs.transform.slice(0, 50), opacity: cs.opacity, transition: cs.transition.slice(0, 50) };
});
console.log('\n=== 3D Flip ===');
console.log(JSON.stringify(flip, null, 2));

// 3. Нет оверлеев
const overlays = await p.evaluate(() => document.querySelectorAll('.slide-overlay').length);
console.log(`\n=== Оверлеи: ${overlays} (должно быть 0) ===`);

// 4. Текст
const text = await p.evaluate(() => ({
  eyebrow: document.getElementById('hero-eyebrow')?.textContent,
  h1: document.getElementById('hero-h1')?.innerHTML.slice(0, 30),
  visible: document.querySelectorAll('.page-showcase__copy .visible').length,
}));
console.log('\n=== Текст (слайд 1) ===');
console.log(JSON.stringify(text, null, 2));

// 5. Autoplay + text change
console.log('\n=== Autoplay (12s) ===');
const before = await p.evaluate(() => document.getElementById('hero-h1')?.innerHTML.slice(0, 20));
console.log(`  Before: "${before}"`);
await p.waitForTimeout(12000);
const after = await p.evaluate(() => ({
  h1: document.getElementById('hero-h1')?.innerHTML.slice(0, 20),
  slide: document.querySelector('.home-carousel__slide.is-active')?.getAttribute('data-slide'),
  visible: document.querySelectorAll('.page-showcase__copy .visible').length,
}));
console.log(`  After:  "${after.h1}" slide=#${after.slide} visible=${after.visible}`);
console.log(`  ${before !== after.h1 ? '✓ Текст изменился!' : '⚠ Не изменился'}`);

// 6. Скриншот
await p.screenshot({ path: 'tmp/hybrid-hero.png', fullPage: false });
console.log('\n✓ Скриншот: tmp/hybrid-hero.png');
await b.close();
