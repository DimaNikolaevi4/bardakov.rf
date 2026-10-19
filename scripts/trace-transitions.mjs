import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(500);

async function getSlideStates() {
  return await p.evaluate(() => {
    return Array.from(document.querySelectorAll('.home-carousel__slide')).map(s => ({
      index: s.getAttribute('data-slide'),
      cls: Array.from(s.classList).filter(c => c.startsWith('is-')),
    }));
  });
}

async function clickAndTrace(btn, label) {
  console.log(`\n--- ${label} ---`);
  const before = await getSlideStates();
  console.log(`  Before: ${JSON.stringify(before)}`);
  
  await p.click(btn);
  await p.waitForTimeout(50);
  
  const during = await getSlideStates();
  console.log(`  During: ${JSON.stringify(during)}`);
  
  await p.waitForTimeout(1000);
  
  const after = await getSlideStates();
  console.log(`  After:  ${JSON.stringify(after)}`);
}

// Слайд 0 (активный)
console.log('=== Начало: слайд 0 ===');
console.log(JSON.stringify(await getSlideStates()));

// 1. Вправо: 0 → 1
await clickAndTrace('.home-carousel__arrow--next', 'Next: 0 → 1 (должен: is-prev=0, is-active=1, is-next=2)');

// 2. Вправо: 1 → 2
await clickAndTrace('.home-carousel__arrow--next', 'Next: 1 → 2 (должен: is-prev=1, is-active=2, is-next=0)');

// 3. Вправо: 2 → 0 (wrap)
await clickAndTrace('.home-carousel__arrow--next', 'Next: 2 → 0 (wrap, должен: is-prev=2, is-active=0, is-next=1)');

// 4. Влево: 0 → 2 (wrap)
await clickAndTrace('.home-carousel__arrow--previous', 'Prev: 0 → 2 (wrap, должен: is-next=0, is-active=2, is-prev=1)');

// 5. Влево: 2 → 1
await clickAndTrace('.home-carousel__arrow--previous', 'Prev: 2 → 1 (должен: is-next=2, is-active=1, is-prev=0)');

// 6. Влево: 1 → 0
await clickAndTrace('.home-carousel__arrow--previous', 'Prev: 1 → 0 (должен: is-next=1, is-active=0, is-prev=2)');

await b.close();
