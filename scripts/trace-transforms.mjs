import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(500);

async function traceTransforms(label) {
  const data = await p.evaluate(() => {
    return Array.from(document.querySelectorAll('.home-carousel__slide')).map(s => {
      const cs = getComputedStyle(s);
      const r = s.getBoundingClientRect();
      return {
        i: s.getAttribute('data-slide'),
        cls: Array.from(s.classList).filter(c => c.startsWith('is-')),
        x: Math.round(r.x),
        transform: cs.transform.slice(0, 30),
      };
    });
  });
  console.log(`${label}:`);
  data.forEach(d => console.log(`  slide ${d.i}: cls=${d.cls} x=${d.x} transform=${d.transform}`));
}

await traceTransforms('Initial (slide 0 active)');

// Next: 0 → 1
console.log('\n--- Next: 0 → 1 (forward) ---');
await traceTransforms('Before click');
await p.click('.home-carousel__arrow--next');
await p.waitForTimeout(100);
await traceTransforms('During (50ms after click)');
await p.waitForTimeout(1000);
await traceTransforms('After (settled)');

// Prev: 1 → 0
console.log('\n--- Prev: 1 → 0 (backward) ---');
await traceTransforms('Before click');
await p.click('.home-carousel__arrow--previous');
await p.waitForTimeout(100);
await traceTransforms('During (50ms after click)');
await p.waitForTimeout(1000);
await traceTransforms('After (settled)');

await b.close();
