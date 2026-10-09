#!/usr/bin/env python3
"""
Проверка локальных ссылок в собранном проекте.
Альтернатива linkinator, который плохо работает с локальными файлами.

Создано: 2026-10-09 (Этап 3.4)
"""

import re
import sys
from pathlib import Path
from urllib.parse import unquote, urlparse

PUBLIC_DIR = Path(__file__).resolve().parent.parent / "public"


def find_all_html_files():
    """Находит все HTML-файлы в public/."""
    return list(PUBLIC_DIR.rglob("*.html"))


def extract_links(html_content: str) -> list[str]:
    """Извлекает все href и src ссылки из HTML."""
    pattern = r'(?:href|src)\s*=\s*["\']([^"\']+)["\']'
    return re.findall(pattern, html_content)


def is_local_link(url: str) -> bool:
    """Проверяет, является ли ссылка локальной."""
    if url.startswith(("http://", "https://", "mailto:", "tel:", "#")):
        return False
    if url.startswith("data:"):
        return False
    return True


def resolve_local_path(url: str) -> Path:
    """Преобразует URL в путь к файлу."""
    parsed = urlparse(url)
    path = unquote(parsed.path)
    if path.startswith("/"):
        path = path[1:]
    return PUBLIC_DIR / path


def check_link(url: str) -> tuple[bool, str]:
    """
    Проверяет, существует ли локальный файл.
    Возвращает (is_ok, message).
    """
    if not is_local_link(url):
        return True, "external"

    # Убираем фрагмент (#...)
    url = url.split("#")[0]
    if not url:
        return True, "fragment only"

    # Убираем query string
    url = url.split("?")[0]

    if not url:
        return True, "empty"

    target = resolve_local_path(url)

    # Если URL заканчивается на /, ищем index.html
    if url.endswith("/"):
        target = target / "index.html"

    if target.exists() and target.is_file():
        return True, f"OK ({target.relative_to(PUBLIC_DIR)})"

    return False, f"NOT FOUND ({url})"


def main():
    print("=" * 70)
    print("Проверка локальных ссылок в собранном проекте")
    print("=" * 70)

    html_files = find_all_html_files()
    print(f"\n📂 Найдено HTML-файлов: {len(html_files)}")

    all_links = []
    broken_links = []
    checked = set()

    for html_file in html_files:
        try:
            content = html_file.read_text(encoding="utf-8", errors="ignore")
        except Exception as e:
            continue

        links = extract_links(content)
        for link in links:
            if link in checked:
                continue
            checked.add(link)

            is_ok, msg = check_link(link)
            all_links.append({
                "source": str(html_file.relative_to(PUBLIC_DIR)),
                "link": link,
                "is_ok": is_ok,
                "message": msg,
            })
            if not is_ok:
                broken_links.append(all_links[-1])

    print(f"🔍 Проверено ссылок: {len(all_links)}")
    print(f"   ✅ Рабочих: {len(all_links) - len(broken_links)}")
    print(f"   ❌ Битых: {len(broken_links)}")

    if broken_links:
        print("\n❌ Битые ссылки:")
        for b in broken_links:
            print(f"   {b['source']} → {b['link']} ({b['message']})")
        sys.exit(1)
    else:
        print("\n✅ Все локальные ссылки работают!")


if __name__ == "__main__":
    main()
