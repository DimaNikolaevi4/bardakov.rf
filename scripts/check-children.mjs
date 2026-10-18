import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

const data = await p.evaluate(() => {
  return Array.from(document.querySelectorAll('.site-footer .footer-resource')).slice(8).map((c) => {
    const children = Array.from(c.children).map(ch => ({
      tag: ch.tagName,
      cls: ch.className,
      offsetHeight: ch.offsetHeight,
      offsetTop: ch.offsetTop,
    }));
    return {
      text: c.querySelector('.footer-resource-text').textContent.trim(),
      cardHeight: c.offsetHeight,
      children,
    };
  });
});
console.log(JSON.stringify(data, null, 2));
await b.close();
