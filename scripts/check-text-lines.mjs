import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

const data = await p.evaluate(() => {
  return Array.from(document.querySelectorAll('.site-footer .footer-resource')).slice(8).map((c) => {
    const text = c.querySelector('.footer-resource-text');
    const cs = getComputedStyle(text);
    const r = text.getBoundingClientRect();
    // Точное число строк через getClientRects
    const range = document.createRange();
    range.selectNodeContents(text);
    const rects = range.getClientRects();
    const lineCount = Array.from(rects).filter(r => r.height > 0).length;
    return {
      text: text.textContent.trim(),
      textLength: text.textContent.trim().length,
      clientWidth: r.width.toFixed(2),
      clientHeight: r.height.toFixed(2),
      scrollHeight: text.scrollHeight,
      lineHeight: cs.lineHeight,
      fontSize: cs.fontSize,
      lineCount,
      rectsHeight: Array.from(rects).map(r => r.height.toFixed(2)),
    };
  });
});
console.log(JSON.stringify(data, null, 2));
await b.close();
