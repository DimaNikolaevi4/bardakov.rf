import { chromium } from 'playwright';
const b = await chromium.launch();
const p = await b.newPage();
await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
await p.evaluate(() => document.documentElement.setAttribute('data-theme', 'light'));
await p.waitForTimeout(300);

const data = await p.evaluate(() => {
  return Array.from(document.querySelectorAll('.site-footer .footer-resource')).slice(8).map((c) => {
    const icon = c.querySelector('.footer-resource-icon');
    const img = icon.querySelector('img');
    const cs = getComputedStyle(icon);
    const imgCs = getComputedStyle(img);
    return {
      text: c.querySelector('.footer-resource-text').textContent.trim(),
      // icon
      iconWidth: cs.width,
      iconHeight: cs.height,
      iconBoxSizing: cs.boxSizing,
      iconBorder: cs.border,
      iconPadding: cs.padding,
      iconRect: JSON.stringify(icon.getBoundingClientRect()),
      // img
      imgWidth: imgCs.width,
      imgHeight: imgCs.height,
      imgMaxWidth: imgCs.maxWidth,
      imgMaxHeight: imgCs.maxHeight,
      imgObjectFit: imgCs.objectFit,
      imgRect: JSON.stringify(img.getBoundingClientRect()),
      imgNaturalW: img.naturalWidth,
      imgNaturalH: img.naturalHeight,
    };
  });
});
console.log(JSON.stringify(data, null, 2));
await b.close();
