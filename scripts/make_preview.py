#!/usr/bin/env python3
"""
Создаёт автономный preview HTML файл со всеми CSS и JS встроенными inline.
Это позволяет пользователю открыть превью в браузере без необходимости
запускать локальный сервер.

Создано: 2026-10-09 (Этап 3.4)
"""

import base64
import re
from pathlib import Path

REPO_ROOT = Path(__file__).resolve().parent.parent
PUBLIC_DIR = REPO_ROOT / "public"
SRC_DIR = REPO_ROOT / "src"
OUTPUT_FILE = REPO_ROOT / "download" / "preview.html"


def read_file(path: Path) -> str:
    try:
        return path.read_text(encoding="utf-8")
    except Exception:
        return ""


def file_to_base64(path: Path, mime_type: str) -> str:
    """Кодирует файл в base64 data URI."""
    try:
        data = path.read_bytes()
        b64 = base64.b64encode(data).decode("ascii")
        return f"data:{mime_type};base64,{b64}"
    except Exception:
        return ""


def inline_css(html: str) -> str:
    """Заменяет <link rel=stylesheet href="/assets/..."> на inline <style>."""
    pattern = r'<link\s+rel="stylesheet"\s+href="([^"]+)"[^>]*>'

    def replace(match):
        href = match.group(1)
        if href.startswith("http"):
            return match.group(0)  # Внешние оставляем
        # Локальный путь
        path = PUBLIC_DIR / href.lstrip("/")
        css = read_file(path)
        if css:
            return f'<style>\n/* {href} */\n{css}\n</style>'
        return match.group(0)

    return re.sub(pattern, replace, html)


def inline_js(html: str) -> str:
    """Заменяет <script src="/assets/..."> на inline <script>."""
    pattern = r'<script\s+src="([^"]+)"[^>]*></script>'

    def replace(match):
        src = match.group(1)
        if src.startswith("http"):
            return match.group(0)  # Внешние оставляем
        path = PUBLIC_DIR / src.lstrip("/")
        js = read_file(path)
        if js:
            return f'<script>\n// {src}\n{js}\n</script>'
        return match.group(0)

    return re.sub(pattern, replace, html)


def inline_images(html: str) -> str:
    """Заменяет <img src="/assets/..."> на base64 data URI."""
    pattern = r'<img\s+([^>]*?)src="([^"]+)"([^>]*?)>'

    def replace(match):
        before, src, after = match.group(1), match.group(2), match.group(3)
        if src.startswith("http") or src.startswith("data:"):
            return match.group(0)
        path = PUBLIC_DIR / src.lstrip("/")
        if not path.exists():
            return match.group(0)
        ext = path.suffix.lower()
        mime_map = {
            ".png": "image/png",
            ".jpg": "image/jpeg",
            ".jpeg": "image/jpeg",
            ".gif": "image/gif",
            ".webp": "image/webp",
            ".svg": "image/svg+xml",
            ".ico": "image/x-icon",
        }
        mime = mime_map.get(ext, "application/octet-stream")
        data_uri = file_to_base64(path, mime)
        return f'<img {before}src="{data_uri}"{after}>'

    return re.sub(pattern, replace, html)


def inline_css_url_references(css: str) -> str:
    """Заменяет url(...) в CSS на base64 data URI."""
    pattern = r'url\((["\']?)([^"\'\)]+)\1\)'

    def replace(match):
        url = match.group(2)
        if url.startswith("data:") or url.startswith("http"):
            return match.group(0)
        path = PUBLIC_DIR / url.lstrip("/")
        if not path.exists():
            return match.group(0)
        ext = path.suffix.lower()
        mime_map = {
            ".png": "image/png",
            ".jpg": "image/jpeg",
            ".jpeg": "image/jpeg",
            ".gif": "image/gif",
            ".webp": "image/webp",
            ".svg": "image/svg+xml",
            ".woff": "font/woff",
            ".woff2": "font/woff2",
            ".ttf": "font/ttf",
        }
        mime = mime_map.get(ext, "application/octet-stream")
        data_uri = file_to_base64(path, mime)
        return f'url("{data_uri}")'

    return re.sub(pattern, replace, css)


def main():
    print("=" * 60)
    print("Создание автономного preview.html")
    print("=" * 60)

    index_html = read_file(PUBLIC_DIR / "index.html")
    if not index_html:
        print("❌ Не найден public/index.html")
        return

    print(f"📄 Исходный HTML: {len(index_html)} символов")

    # 1. Inline CSS
    html = inline_css(index_html)
    print(f"🎨 CSS встроены")

    # 2. Inline JS
    html = inline_js(html)
    print(f"⚙️  JS встроены")

    # 3. Inline изображения в HTML
    html = inline_images(html)
    print(f"🖼  Изображения встроены")

    # 4. Inline url() в <style> тегах
    def replace_url_in_style(match):
        css = match.group(1)
        return f"<style>{inline_css_url_references(css)}</style>"

    html = re.sub(r"<style>(.*?)</style>", replace_url_in_style, html, flags=re.DOTALL)
    print(f"🔧 url() в CSS заменены на base64")

    # Удаляем FOUC-скрипт, который ссылается на localStorage (бесполезно в file://)
    # И удаляем Yandex.Metrika (чтобы не делала запросы при превью)
    html = re.sub(
        r"<!-- FOUC protection.*?</script>",
        "<!-- FOUC protection disabled for preview -->",
        html,
        flags=re.DOTALL,
    )
    html = re.sub(
        r"<!-- Yandex.Metrika.*?</noscript>",
        "<!-- Yandex.Metrika disabled for preview -->",
        html,
        flags=re.DOTALL,
    )

    OUTPUT_FILE.parent.mkdir(parents=True, exist_ok=True)
    OUTPUT_FILE.write_text(html, encoding="utf-8")

    size_mb = OUTPUT_FILE.stat().st_size / (1024 * 1024)
    print(f"\n✅ Создан: {OUTPUT_FILE}")
    print(f"   Размер: {size_mb:.2f} MB")
    print(f"   Можно открыть в браузере напрямую (file://)")


if __name__ == "__main__":
    main()
