import { chromium } from 'playwright';
const b = await chromium.launch();
const ctx = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 800 } });
const p = await ctx.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

// Открываем offcanvas через клик по бургеру (только на мобильных, но мы открываем напрямую через JS)
await p.evaluate(() => {
  const off = document.querySelector('#offcanvasRubrics');
  if (off) {
    off.classList.add('is-open');
    off.setAttribute('aria-hidden', 'false');
  }
});
await p.waitForTimeout(300);

const data = await p.evaluate(() => {
  const offcanvasHeader = document.querySelector('.offcanvas-header');
  const ocSidePanelHeaders = document.querySelectorAll('.oc-side-panel__header');
  const closeBtns = document.querySelectorAll('.close-btn');
  const result = {
    offcanvasHeader: offcanvasHeader ? {
      offsetHeight: offcanvasHeader.offsetHeight,
      minHeight: getComputedStyle(offcanvasHeader).minHeight,
      padding: getComputedStyle(offcanvasHeader).padding,
    } : null,
    ocSidePanelHeaders: Array.from(ocSidePanelHeaders).map(h => ({
      offsetHeight: h.offsetHeight,
      minHeight: getComputedStyle(h).minHeight,
      padding: getComputedStyle(h).padding,
    })),
    closeBtns: Array.from(closeBtns).map(b => ({
      offsetWidth: b.offsetWidth,
      offsetHeight: b.offsetHeight,
      ariaLabel: b.getAttribute('aria-label'),
    })),
    titles: Array.from(document.querySelectorAll('.offcanvas-title, .oc-side-panel__title')).map(t => ({
      cls: t.className,
      textOverflow: getComputedStyle(t).textOverflow,
      whiteSpace: getComputedStyle(t).whiteSpace,
      overflow: getComputedStyle(t).overflow,
    })),
  };
  return result;
});

console.log('=== offcanvas-header ===');
console.log(JSON.stringify(data.offcanvasHeader, null, 2));
console.log('\n=== oc-side-panel__header (×' + data.ocSidePanelHeaders.length + ') ===');
data.ocSidePanelHeaders.forEach((h, i) => {
  console.log(`#${i}: height=${h.offsetHeight}, minHeight=${h.minHeight}, padding=${h.padding}`);
});
console.log('\n=== close-btn (×' + data.closeBtns.length + ') ===');
data.closeBtns.forEach((b, i) => {
  console.log(`#${i}: ${b.offsetWidth}x${b.offsetHeight}px aria="${b.ariaLabel}"`);
});
console.log('\n=== titles text-overflow ===');
data.titles.forEach(t => {
  console.log(`  .${t.cls}: textOverflow=${t.textOverflow}, whiteSpace=${t.whiteSpace}, overflow=${t.overflow}`);
});

await p.screenshot({ path: 'tmp/offcanvas-headers.png', clip: { x: 0, y: 0, width: 1280, height: 800 } });
await b.close();
