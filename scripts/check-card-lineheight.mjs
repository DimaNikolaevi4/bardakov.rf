import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

const data = await p.evaluate(() => {
  return Array.from(document.querySelectorAll('.site-footer .footer-resource')).slice(8).map((c) => {
    const text = c.querySelector('.footer-resource-text');
    const cs = getComputedStyle(c);
    const textCs = getComputedStyle(text);
    return {
      text: text.textContent.trim(),
      // card
      cardDisplay: cs.display,
      cardAlignItems: cs.alignItems,
      cardLineHeight: cs.lineHeight,
      cardHeight: cs.height,
      // text
      textDisplay: textCs.display,
      textLineHeight: textCs.lineHeight,
      textVerticalAlign: textCs.verticalAlign,
      textWhiteSpace: textCs.whiteSpace,
      // scrollHeight (реальная высота контента)
      textScrollHeight: text.scrollHeight,
      textOffsetHeight: text.offsetHeight,
    };
  });
});
console.log(JSON.stringify(data, null, 2));
await b.close();
