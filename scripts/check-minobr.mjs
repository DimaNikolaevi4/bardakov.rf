import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

const cards = await p.evaluate(() => {
  return Array.from(document.querySelectorAll('.site-footer .footer-resource')).map((c, i) => {
    const cs = getComputedStyle(c);
    const icon = c.querySelector('.footer-resource-icon');
    const iconRect = icon.getBoundingClientRect();
    const iconCs = getComputedStyle(icon);
    const img = c.querySelector('.footer-resource-icon img');
    const imgRect = img.getBoundingClientRect();
    const imgCs = getComputedStyle(img);
    const text = c.querySelector('.footer-resource-text');
    const textRect = text.getBoundingClientRect();
    const textCs = getComputedStyle(text);
    const r = c.getBoundingClientRect();
    return {
      i,
      text: text.textContent.trim(),
      cardHeight: r.height,
      cardMinHeight: cs.minHeight,
      cardPadding: cs.padding,
      cardBorder: cs.borderWidth,
      iconWidth: iconRect.width,
      iconHeight: iconRect.height,
      iconImg: imgCs.width + 'x' + imgCs.height + ' (maxW=' + imgCs.maxWidth + ', maxH=' + imgCs.maxHeight + ')',
      textHeight: textRect.height,
      textWidth: textRect.width,
      textFontSize: textCs.fontSize,
      textLineHeight: textCs.lineHeight,
    };
  });
});
// Только последняя строка (индексы 8-11)
console.log('=== Последняя строка (проблемная) ===');
for (const c of cards.slice(8)) {
  console.log(`#${c.i} "${c.text}":`);
  console.log(`  card: height=${c.cardHeight}, min-height=${c.cardMinHeight}, padding=${c.cardPadding}, border=${c.cardBorder}`);
  console.log(`  icon: ${c.iconWidth}x${c.iconHeight}, img=${c.iconImg}`);
  console.log(`  text: ${c.textHeight}px height, ${c.textWidth}px width, font=${c.textFontSize}, lineH=${c.textLineHeight}`);
  console.log();
}
await b.close();
