#!/usr/bin/env python3
"""
Пост-обработка собранного сайта для GitHub Pages.
Заменяет все абсолютные пути /... на /bardakov.rf/...
"""
import re
from pathlib import Path
import sys

PUBLIC_DIR = Path(__file__).resolve().parent.parent / "public"
PREFIX = "/bardakov.rf"

SKIP_PREFIXES = ["http://", "https://", "mailto:", "tel:", "data:", "#", "//", "javascript:"]

def should_skip(path):
    for s in SKIP_PREFIXES:
        if path.startswith(s):
            return True
    return False

def fix_html(content):
    """Заменяет href="/..." и src="/..." на href="/bardakov.rf/..." """
    def replace_attr(m):
        attr = m.group(1)
        path = m.group(2)
        if should_skip(path):
            return m.group(0)
        return f'{attr}="{PREFIX}{path}"'
    content = re.sub(r'(href)="(/[^"]*)"', replace_attr, content)
    content = re.sub(r'(src)="(/[^"]*)"', replace_attr, content)
    return content

def fix_css(content):
    """Заменяет url(/...) на url(/bardakov.rf/...) в CSS"""
    def replace_url(m):
        path = m.group(1)
        if should_skip(path):
            return m.group(0)
        return f'url("{PREFIX}{path}")'
    content = re.sub(r'url\(["\']?(/[^"\']*)["\']?\)', replace_url, content)
    return content

def main():
    if not PUBLIC_DIR.exists():
        print(f"❌ Папка public/ не найдена: {PUBLIC_DIR}")
        sys.exit(1)

    total = 0
    # HTML
    for f in PUBLIC_DIR.rglob("*.html"):
        content = f.read_text(encoding="utf-8")
        new_content = fix_html(content)
        if new_content != content:
            f.write_text(new_content, encoding="utf-8")
            total += 1
            print(f"  ✅ {f.relative_to(PUBLIC_DIR)}")

    # CSS
    for f in PUBLIC_DIR.rglob("*.css"):
        content = f.read_text(encoding="utf-8")
        new_content = fix_css(content)
        if new_content != content:
            f.write_text(new_content, encoding="utf-8")
            total += 1
            print(f"  ✅ {f.relative_to(PUBLIC_DIR)}")

    # JS
    js_dir = PUBLIC_DIR / "assets" / "js"
    if js_dir.exists():
        for f in js_dir.glob("*.js"):
            content = f.read_text(encoding="utf-8")
            new_content = fix_html(content)
            if new_content != content:
                f.write_text(new_content, encoding="utf-8")
                total += 1
                print(f"  ✅ {f.relative_to(PUBLIC_DIR)}")

    print(f"\n✅ Обработано файлов: {total}")

if __name__ == "__main__":
    main()
