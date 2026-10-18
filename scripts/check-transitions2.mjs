import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.waitForTimeout(300);

const targets = [
  '.btn',
  '.header-icon-btn',
  '.theme-btn',
  '.footer-social-link',
  '.footer-resource',
  '.main-nav a.main-nav-link',
];

for (const sel of targets) {
  const t = await p.evaluate((s) => {
    const el = document.querySelector(s);
    if (!el) return null;
    const cs = getComputedStyle(el);
    return {
      property: cs.transitionProperty,
      duration: cs.transitionDuration,
      timing: cs.transitionTimingFunction,
    };
  }, sel);
  console.log(`${sel.padEnd(35)} → prop=${t.property}  dur=${t.duration}  timing=${t.timing.slice(0, 30)}`);
}

await b.close();
