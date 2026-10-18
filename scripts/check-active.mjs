import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

// Hover + mousedown, читаем сразу в момент удержания
const box = await p.evaluate(() => {
  const el = document.querySelector('.logo');
  const r = el.getBoundingClientRect();
  return { x: r.x + r.width / 2, y: r.y + r.height / 2 };
});
await p.mouse.move(box.x, box.y);
await p.mouse.down();
// НЕ отпускаем! Читаем прямо в активном состоянии
await p.waitForTimeout(50);
const active = await p.evaluate(() => {
  const cs = getComputedStyle(document.querySelector('.logo'));
  return {
    color: cs.color,
    opacity: cs.opacity,
    transform: cs.transform,
  };
});
console.log('ACTIVE (during mousedown):', JSON.stringify(active, null, 2));
await p.mouse.up();
await b.close();
