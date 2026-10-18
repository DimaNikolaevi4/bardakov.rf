import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

const data = await p.evaluate(() => {
  return Array.from(document.querySelectorAll('.site-footer .footer-resource')).slice(8).map((c) => {
    const img = c.querySelector('.footer-resource-icon img');
    const r = img.getBoundingClientRect();
    const cs = getComputedStyle(img);
    return {
      text: c.querySelector('.footer-resource-text').textContent.trim(),
      naturalWidth: img.naturalWidth,
      naturalHeight: img.naturalHeight,
      renderedWidth: r.width,
      renderedHeight: r.height,
      offsetTop: img.offsetTop,
      offsetParent: img.offsetParent?.className || '',
    };
  });
});
console.log(JSON.stringify(data, null, 2));
await b.close();
