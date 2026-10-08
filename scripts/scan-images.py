#!/usr/bin/env python3
"""
Сканирует все изображения в old/new-stack/site/assets/images/,
составляет CSV-инвентарь.

Источник: Этап 1.3 чек-листа миграции.
Выход: migration-source/images-inventory.csv
"""

import csv
import re
from pathlib import Path

REPO_ROOT = Path(__file__).resolve().parent.parent
IMAGES_ROOT = REPO_ROOT / "old" / "new-stack" / "site" / "assets" / "images"
HTML_ROOT = REPO_ROOT / "old" / "new-stack" / "site"
OUTPUT_CSV = REPO_ROOT / "migration-source" / "images-inventory.csv"

IMAGE_EXTENSIONS = {".png", ".jpg", ".jpeg", ".gif", ".webp", ".svg", ".bmp", ".ico"}


def find_image_usage(image_name: str, html_files: list[Path]) -> list[str]:
    """Ищет, на каких HTML-страницах используется изображение."""
    pages = []
    for html_file in html_files:
        try:
            content = html_file.read_text(encoding="utf-8", errors="ignore")
            # Ищем по имени файла
            if image_name in content:
                rel = html_file.relative_to(HTML_ROOT)
                pages.append(str(rel))
        except Exception:
            pass
    return pages


def extract_alt_from_html(html_file: Path, image_path: str) -> str:
    """Пытается извлечь alt для данного изображения из HTML."""
    try:
        content = html_file.read_text(encoding="utf-8", errors="ignore")
        # Ищем <img src="...image_path" ... alt="...">
        # Учитываем разные кавычки и порядок атрибутов
        # Упрощённый паттерн: alt="..." с этим src
        for pattern in [
            rf'src="[^"]*{re.escape(image_path)}"[^>]*\s+alt="([^"]*)"',
            rf'alt="([^"]*)"[^>]*\s+src="[^"]*{re.escape(image_path)}"',
            rf"src='[^']*{re.escape(image_path)}'[^>]*\s+alt='([^']*)'",
            rf"alt='([^']*)'[^>]*\s+src='[^']*{re.escape(image_path)}'",
        ]:
            m = re.search(pattern, content)
            if m:
                return m.group(1)
        # Если не нашли по полному пути, ищем по имени файла
        name = Path(image_path).name
        for pattern in [
            rf'src="[^"]*{re.escape(name)}"[^>]*\s+alt="([^"]*)"',
            rf'alt="([^"]*)"[^>]*\s+src="[^"]*{re.escape(name)}"',
        ]:
            m = re.search(pattern, content)
            if m:
                return m.group(1)
    except Exception:
        pass
    return ""


def main():
    print("=" * 70)
    print("Сканирование изображений в old/new-stack/site/assets/images/")
    print("=" * 70)

    if not IMAGES_ROOT.exists():
        print(f"⚠️  Папка не найдена: {IMAGES_ROOT}")
        return

    # Собираем все HTML-файлы
    html_files = list(HTML_ROOT.rglob("*.html"))
    print(f"\n📂 HTML-файлов для поиска использований: {len(html_files)}")

    # Собираем все изображения
    images = []
    for ext in IMAGE_EXTENSIONS:
        images.extend(IMAGES_ROOT.rglob(f"*{ext}"))
        images.extend(IMAGES_ROOT.rglob(f"*{ext.upper()}"))

    print(f"🖼️  Изображений найдено: {len(images)}")

    # Группируем по размеру для понимания
    total_size = sum(img.stat().st_size for img in images if img.exists())
    print(f"   Общий размер: {total_size / (1024 * 1024):.1f} MB")

    OUTPUT_CSV.parent.mkdir(parents=True, exist_ok=True)

    with open(OUTPUT_CSV, "w", newline="", encoding="utf-8") as f:
        writer = csv.writer(f)
        writer.writerow([
            "path",
            "filename",
            "extension",
            "size_bytes",
            "size_human",
            "pages_used_on",
            "alt",
            "new_alt",
            "webp_needed",
        ])

        for img_path in sorted(images):
            rel_path = img_path.relative_to(IMAGES_ROOT.parent.parent)
            # Путь относительно корня сайта
            url_path = "/" + str(img_path.relative_to(IMAGES_ROOT.parent.parent)).replace("\\", "/")
            # Убираем "assets/images/" из начала для краткости в файле
            short_path = str(img_path.relative_to(IMAGES_ROOT.parent.parent)).replace("\\", "/")

            size = img_path.stat().st_size
            if size < 1024:
                size_human = f"{size} B"
            elif size < 1024 * 1024:
                size_human = f"{size / 1024:.1f} KB"
            else:
                size_human = f"{size / (1024 * 1024):.2f} MB"

            # Ищем использования
            filename = img_path.name
            pages = find_image_usage(filename, html_files)
            pages_str = " | ".join(pages) if pages else ""

            # Ищем alt
            alt = ""
            for html_file in html_files:
                a = extract_alt_from_html(html_file, filename)
                if a:
                    alt = a
                    break

            # Нужна ли конвертация в WebP?
            ext = img_path.suffix.lower()
            webp_needed = "да" if ext in [".png", ".jpg", ".jpeg", ".bmp", ".gif"] else "нет"

            writer.writerow([
                short_path,
                filename,
                ext,
                size,
                size_human,
                pages_str,
                alt,
                "",  # new_alt — заполняется вручную
                webp_needed,
            ])

    # Статистика
    with open(OUTPUT_CSV, encoding="utf-8") as f:
        reader = csv.DictReader(f)
        rows = list(reader)

    print(f"\n✅ Записано: {OUTPUT_CSV}")
    print(f"   Записей: {len(rows)}")

    # Группировка по расширениям
    by_ext = {}
    for r in rows:
        ext = r["extension"]
        by_ext.setdefault(ext, []).append(r)
    print("\n📊 По форматам:")
    for ext in sorted(by_ext.keys()):
        items = by_ext[ext]
        total = sum(int(i["size_bytes"]) for i in items)
        print(f"   {ext}: {len(items)} файлов, {total / (1024 * 1024):.2f} MB")

    # Изображения без alt
    no_alt = [r for r in rows if not r["alt"] and r["extension"] != ".svg"]
    print(f"\n⚠️  Без alt-текста: {len(no_alt)} файлов (нужно заполнить на Этапе 5.2)")

    # Изображения, не используемые на страницах
    unused = [r for r in rows if not r["pages_used_on"]]
    print(f"⚠️  Не найдены в использовании: {len(unused)} файлов (возможно, удалены)")


if __name__ == "__main__":
    main()
