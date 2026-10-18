import { chromium } from 'playwright';
const b = await chromium.launch();
for (const theme of ['light', 'dark', 'high-contrast']) {
  const ctx = await b.newContext({
    colorScheme: theme === 'dark' ? 'dark' : 'light',
    viewport: { width: 1280, height: 2200 }
  });
  const p = await ctx.newPage();
  await p.goto('http://localhost:8080/', { waitUntil: 'networkidle' });
  await p.evaluate((t) => document.documentElement.setAttribute('data-theme', t), theme);
  await p.waitForTimeout(300);
  const data = await p.evaluate(() => {
    const footer = document.querySelector('.site-footer');
    const cs = getComputedStyle(footer);
    return {
      backgroundColor: cs.backgroundColor,
      backgroundImage: cs.backgroundImage.slice(0, 80),
      bgPrimary: getComputedStyle(document.documentElement).getPropertyValue('--bg-primary').trim(),
      bgSecondary: getComputedStyle(document.documentElement).getPropertyValue('--bg-secondary').trim(),
      bgSubtle: getComputedStyle(document.documentElement).getPropertyValue('--bg-subtle').trim(),
    };
  });
  console.log(`\n=== ${theme.toUpperCase()} ===`);
  console.log(`  --bg-primary: ${data.bgPrimary}`);
  console.log(`  --bg-secondary: ${data.bgSecondary}`);
  console.log(`  --bg-subtle: ${data.bgSubtle}`);
  console.log(`  footer.backgroundColor: ${data.backgroundColor}`);
  console.log(`  footer.backgroundImage: ${data.backgroundImage}`);
  await ctx.close();
}
await b.close();
