// verify-header-redesign.mjs
// Верификация: логотип уменьшен, theme-btn увеличены, границы добавлены в обеих темах.
import { chromium } from 'playwright';
import { mkdirSync } from 'node:fs';

const URL = 'http://localhost:8080/';
const OUT = 'tmp/redesign';
mkdirSync(OUT, { recursive: true });

const browser = await chromium.launch();

const results = {};

for (const colorScheme of ['light', 'dark']) {
  const context = await browser.newContext({
    colorScheme,
    viewport: { width: 1280, height: 800 },
  });
  const page = await context.newPage();
  await page.goto(URL, { waitUntil: 'networkidle' });
  await page.waitForTimeout(400);

  const data = await page.evaluate(() => {
    const logo = document.querySelector('.logo-mark');
    const logoBox = logo.getBoundingClientRect();
    const themeBtn = document.querySelector('.theme-btn[data-theme="dark"]');
    const tbBox = themeBtn.getBoundingClientRect();
    const tbStyle = getComputedStyle(themeBtn);
    const iconBtn = document.querySelector('.header-icon-btn');
    const ibBox = iconBtn.getBoundingClientRect();
    const ibStyle = getComputedStyle(iconBtn);
    const switcher = document.querySelector('.theme-switcher');
    const swStyle = getComputedStyle(switcher);
    const nav = document.querySelector('.nav-wrapper');
    const navStyle = getComputedStyle(nav);
    const dataTheme = document.documentElement.getAttribute('data-theme');
    return {
      dataTheme,
      logo: {
        width: logoBox.width,
        height: logoBox.height,
      },
      themeBtn: {
        width: tbBox.width,
        height: tbBox.height,
        border: tbStyle.border,
        borderColor: tbStyle.borderColor,
        borderRadius: tbStyle.borderRadius,
        transition: tbStyle.transition,
        fontSize: tbStyle.fontSize,
      },
      headerIconBtn: {
        width: ibBox.width,
        height: ibBox.height,
        border: ibStyle.border,
        borderColor: ibStyle.borderColor,
        borderRadius: ibStyle.borderRadius,
        transition: ibStyle.transition,
        fontSize: ibStyle.fontSize,
      },
      themeSwitcher: {
        gap: swStyle.gap,
        padding: swStyle.padding,
        border: swStyle.border,
      },
      navWrapper: {
        alignItems: navStyle.alignItems,
        gap: navStyle.gap,
        minHeight: navStyle.minHeight,
      },
    };
  });
  results[colorScheme] = data;
  console.log(`\n=== ${colorScheme.toUpperCase()} (system pref) ===`);
  console.log('  data-theme:', data.dataTheme);
  console.log('  .logo-mark:', `${data.logo.width}x${data.logo.height}px (target: 40x40)`);
  console.log('  .theme-btn:', `${data.themeBtn.width}x${data.themeBtn.height}px (target: 36x36 inside switcher)`);
  console.log('    border:', data.themeBtn.border.split(' ').slice(0, 3).join(' '));
  console.log('    borderRadius:', data.themeBtn.borderRadius);
  console.log('    transition:', data.themeBtn.transition.split(',').slice(0, 3).join(','));
  console.log('  .header-icon-btn:', `${data.headerIconBtn.width}x${data.headerIconBtn.height}px (target: 44x44)`);
  console.log('    border:', data.headerIconBtn.border.split(' ').slice(0, 3).join(' '));
  console.log('    borderColor:', data.headerIconBtn.borderColor);
  console.log('    borderRadius:', data.headerIconBtn.borderRadius);
  console.log('    transition:', data.headerIconBtn.transition.split(',').slice(0, 3).join(','));
  console.log('  .theme-switcher gap:', data.themeSwitcher.gap, ' padding:', data.themeSwitcher.padding);
  console.log('  .nav-wrapper:', `alignItems=${data.navWrapper.alignItems} gap=${data.navWrapper.gap} minHeight=${data.navWrapper.minHeight}`);

  await page.screenshot({ path: `${OUT}/${colorScheme}-header.png`, clip: { x: 0, y: 0, width: 1280, height: 100 } });
  await page.screenshot({ path: `${OUT}/${colorScheme}-full.png` });

  // Проверка aria-pressed после клика на dark
  if (colorScheme === 'light') {
    await page.click('.theme-btn[data-theme="dark"]');
    await page.waitForTimeout(300);
    const afterClick = await page.evaluate(() => {
      const darkBtn = document.querySelector('.theme-btn[data-theme="dark"]');
      const lightBtn = document.querySelector('.theme-btn[data-theme="light"]');
      return {
        dataTheme: document.documentElement.getAttribute('data-theme'),
        darkBtnPressed: darkBtn.getAttribute('aria-pressed'),
        lightBtnPressed: lightBtn.getAttribute('aria-pressed'),
      };
    });
    console.log('  After click [dark]:', JSON.stringify(afterClick));
  }

  await context.close();
}

await browser.close();
console.log('\n✓ Скриншоты:', OUT);
