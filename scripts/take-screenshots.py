#!/usr/bin/env python3
"""
Делает скриншоты главной страницы в 3 темах и на разных брейкпоинтах.
Создано: 2026-10-09 (Этап 3.4)
"""

import asyncio
import os
import sys
from pathlib import Path
from playwright.async_api import async_playwright

URL = "http://21.0.2.241:8888/"
OUTPUT_DIR = Path("/home/z/my-project/bardakov.rf/docs/design-review")
OUTPUT_DIR.mkdir(parents=True, exist_ok=True)

# Брейкпоинты для проверки адаптивности
BREAKPOINTS = [
    {"name": "mobile-360", "width": 360, "height": 640},
    {"name": "mobile-414", "width": 414, "height": 896},
    {"name": "tablet-768", "width": 768, "height": 1024},
    {"name": "laptop-1024", "width": 1024, "height": 768},
    {"name": "desktop-1280", "width": 1280, "height": 800},
    {"name": "desktop-1920", "width": 1920, "height": 1080},
]


async def take_screenshot(page, name, theme=None):
    """Делает скриншот и сохраняет."""
    if theme:
        # Устанавливаем тему через localStorage
        await page.evaluate(f"localStorage.setItem('theme', '{theme}')")
        await page.reload(wait_until="domcontentloaded")
        # Дополнительное ожидание шрифтов
        await page.wait_for_timeout(1000)

    filename = OUTPUT_DIR / f"{name}.png"
    await page.screenshot(path=str(filename), full_page=True)
    print(f"  ✅ {filename.relative_to(OUTPUT_DIR)}")


async def main():
    print("=" * 60)
    print("Создание скриншотов главной страницы")
    print("=" * 60)

    async with async_playwright() as p:
        browser = await p.chromium.launch(
            args=["--no-sandbox", "--disable-setuid-sandbox", "--disable-web-security"]
        )

        # 1. Главную страницу в 3 темах (desktop 1280)
        print("\n🎨 Скриншоты 3 тем (1280x800):")
        for theme in ["light", "dark", "vi"]:
            context = await browser.new_context(
                viewport={"width": 1280, "height": 800},
                device_scale_factor=2,
            )
            page = await context.new_page()
            await page.goto(URL, wait_until="domcontentloaded")
            await page.wait_for_timeout(500)
            await take_screenshot(page, f"index-{theme}-1280", theme)
            await context.close()

        # 2. Главная в light на всех брейкпоинтах
        print("\n📐 Адаптивность главной (light):")
        for bp in BREAKPOINTS:
            context = await browser.new_context(
                viewport={"width": bp["width"], "height": bp["height"]},
                device_scale_factor=2 if bp["width"] < 768 else 1,
            )
            page = await context.new_page()
            await page.goto(URL, wait_until="domcontentloaded")
            await page.evaluate("localStorage.setItem('theme', 'light')")
            await page.reload(wait_until="domcontentloaded")
            await page.wait_for_timeout(500)
            await take_screenshot(page, f"index-light-{bp['name']}")
            await context.close()

        # 3. Главную страницу без скролла (viewport-only)
        print("\n🏠 Hero-блок (viewport only, 1280x800):")
        for theme in ["light", "dark", "vi"]:
            context = await browser.new_context(
                viewport={"width": 1280, "height": 800},
                device_scale_factor=2,
            )
            page = await context.new_page()
            await page.goto(URL, wait_until="domcontentloaded")
            await page.evaluate(f"localStorage.setItem('theme', '{theme}')")
            await page.reload(wait_until="domcontentloaded")
            await page.wait_for_timeout(500)
            filename = OUTPUT_DIR / f"hero-{theme}-1280.png"
            await page.screenshot(path=str(filename), full_page=False)
            print(f"  ✅ {filename.relative_to(OUTPUT_DIR)}")
            await context.close()

        # 4. Страницы разделов в light
        print("\n📄 Страницы разделов (light, 1280x800):")
        sections = [
            ("/obo-mne/", "section-obo-mne"),
            ("/obuchenie/", "section-obuchenie"),
            ("/abiturientu/", "section-abiturientu"),
            ("/vospitanie/", "section-vospitanie"),
            ("/search/", "section-search"),
            ("/404.html", "page-404"),
        ]
        for url, name in sections:
            context = await browser.new_context(
                viewport={"width": 1280, "height": 800},
                device_scale_factor=1,
            )
            page = await context.new_page()
            await page.goto(f"http://21.0.2.241:8888{url}", wait_until="domcontentloaded")
            await page.evaluate("localStorage.setItem('theme', 'light')")
            await page.reload(wait_until="domcontentloaded")
            await page.wait_for_timeout(500)
            await take_screenshot(page, name)
            await context.close()

        await browser.close()

    print(f"\n📁 Все скриншоты сохранены в: {OUTPUT_DIR}")
    files = sorted(OUTPUT_DIR.glob("*.png"))
    print(f"   Всего файлов: {len(files)}")
    total_size = sum(f.stat().st_size for f in files) / (1024 * 1024)
    print(f"   Общий размер: {total_size:.2f} MB")


if __name__ == "__main__":
    asyncio.run(main())
