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
    return {
      text: text.textContent.trim(),
      cardScrollHeight: c.scrollHeight,
      cardOffsetHeight: c.offsetHeight,
      cardClientHeight: c.clientHeight,
      iconScrollHeight: icon.scrollHeight,
      textScrollHeight: text.scrollHeight,
      // Дополнительно: проверим, есть ли в тексте hidden-пробелы
      textRaw: JSON.stringify(text.textContent),
      textCharCodes: Array.from(text.textContent).map(c => c.charCodeAt(0)),
    };
  });
});
console.log(JSON.stringify(data, null, 2));
await b.close();
