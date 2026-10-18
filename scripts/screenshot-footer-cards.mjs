import { chromium } from 'playwright';
const b = await chromium.launch();
const context = await b.newContext({ colorScheme: 'light', viewport: { width: 1280, height: 2200 } });
const p = await context.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);
const el = await p.$('.site-footer .footer-resources');
const box = await el.boundingBox();
console.log('footer-resources box:', JSON.stringify(box));
await p.screenshot({
  path: 'tmp/footer-fix/light-cards-only.png',
  clip: { x: 0, y: Math.max(0, box.y - 30), width: 1280, height: box.height + 60 }
});
await b.close();
