import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

// Скроллим к футеру
await p.evaluate(() => document.querySelector('.site-footer .footer-resources')?.scrollIntoView({ block: 'center' }));
await p.waitForTimeout(200);

// Получаем все карточки footer-resource
const cards = await p.evaluate(() => {
  const cards = Array.from(document.querySelectorAll('.site-footer .footer-resource'));
  return cards.map((c, i) => {
    const r = c.getBoundingClientRect();
    const text = c.querySelector('.footer-resource-text')?.textContent?.trim() || '';
    const textEl = c.querySelector('.footer-resource-text');
    const textRect = textEl?.getBoundingClientRect();
    return {
      i,
      width: Math.round(r.width),
      height: Math.round(r.height),
      top: Math.round(r.top),
      text,
      textHeight: textRect ? Math.round(textRect.height) : 0,
      textLineCount: textEl ? Math.ceil(textEl.scrollHeight / parseFloat(getComputedStyle(textEl).lineHeight)) : 0,
    };
  });
});

console.log('=== Все footer-resource карточки ===');
for (const c of cards) {
  console.log(`#${c.i}: ${c.width}x${c.height}px (top=${c.top}) — text "${c.text}" (${c.textHeight}px, ${c.textLineCount} lines)`);
}

// Группировка по строкам (одинаковый top)
const rows = {};
for (const c of cards) {
  if (!rows[c.top]) rows[c.top] = [];
  rows[c.top].push(c);
}
console.log('\n=== Группировка по строкам ===');
for (const [top, rowCards] of Object.entries(rows)) {
  const heights = rowCards.map(c => c.height);
  const minHeight = Math.min(...heights);
  const maxHeight = Math.max(...heights);
  console.log(`Row top=${top}: ${rowCards.length} cards, heights=[${heights.join(',')}] (min=${minHeight}, max=${maxHeight}, diff=${maxHeight-minHeight})`);
  for (const c of rowCards) {
    console.log(`  "${c.text}" — ${c.height}px, text ${c.textLineCount} lines`);
  }
}

await p.screenshot({ path: 'tmp/footer-cards-before.png', clip: { x: 0, y: 600, width: 1280, height: 400 } });
await b.close();
