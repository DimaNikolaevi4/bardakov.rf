import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

const data = await p.evaluate(() => {
  return Array.from(document.querySelectorAll('.site-footer .footer-resource')).slice(8).map((c) => {
    const text = c.querySelector('.footer-resource-text');
    const icon = c.querySelector('.footer-resource-icon');
    const card = c;
    // Точная позиция через offsetTop
    return {
      text: text.textContent.trim(),
      cardOffsetTop: card.offsetTop,
      iconOffsetTop: icon.offsetTop,
      textOffsetTop: text.offsetTop,
      textOffsetHeight: text.offsetHeight,
      iconOffsetHeight: icon.offsetHeight,
    };
  });
});
console.log(JSON.stringify(data, null, 2));
await b.close();
