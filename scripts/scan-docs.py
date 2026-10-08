#!/usr/bin/env python3
"""
Сканирует все документы (PDF, DOCX) в old/new-stack/site/assets/docs/,
составляет CSV-инвентарь.

Источник: Этап 1.3 чек-листа миграции.
Выход: migration-source/docs-inventory.csv
"""

import csv
from pathlib import Path

REPO_ROOT = Path(__file__).resolve().parent.parent
DOCS_ROOT = REPO_ROOT / "old" / "new-stack" / "site" / "assets" / "docs"
HTML_ROOT = REPO_ROOT / "old" / "new-stack" / "site"
OUTPUT_CSV = REPO_ROOT / "migration-source" / "docs-inventory.csv"

DOC_EXTENSIONS = {".pdf", ".doc", ".docx", ".xls", ".xlsx", ".ppt", ".pptx", ".odt", ".rtf"}


def find_doc_usage(doc_name: str, html_files) -> list[str]:
    pages = []
    for html_file in html_files:
        try:
            content = html_file.read_text(encoding="utf-8", errors="ignore")
            if doc_name in content:
                rel = html_file.relative_to(HTML_ROOT)
                pages.append(str(rel))
        except Exception:
            pass
    return pages


def main():
    print("=" * 70)
    print("Сканирование документов в old/new-stack/site/assets/docs/")
    print("=" * 70)

    if not DOCS_ROOT.exists():
        print(f"⚠️  Папка не найдена: {DOCS_ROOT}")
        return

    html_files = list(HTML_ROOT.rglob("*.html"))
    print(f"\n📂 HTML-файлов для поиска использований: {len(html_files)}")

    docs = []
    for ext in DOC_EXTENSIONS:
        docs.extend(DOCS_ROOT.rglob(f"*{ext}"))
        docs.extend(DOCS_ROOT.rglob(f"*{ext.upper()}"))

    print(f"📄 Документов найдено: {len(docs)}")

    total_size = sum(d.stat().st_size for d in docs if d.exists())
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
            "category",
            "notes",
        ])

        for doc_path in sorted(docs):
            short_path = str(doc_path.relative_to(DOCS_ROOT.parent.parent)).replace("\\", "/")
            filename = doc_path.name
            ext = doc_path.suffix.lower()
            size = doc_path.stat().st_size
            if size < 1024 * 1024:
                size_human = f"{size / 1024:.1f} KB"
            else:
                size_human = f"{size / (1024 * 1024):.2f} MB"

            pages = find_doc_usage(filename, html_files)
            pages_str = " | ".join(pages) if pages else ""

            # Категория по директории
            rel_to_docs = doc_path.relative_to(DOCS_ROOT)
            category = rel_to_docs.parts[0] if len(rel_to_docs.parts) > 1 else "корень"

            writer.writerow([
                short_path,
                filename,
                ext,
                size,
                size_human,
                pages_str,
                category,
                "",  # notes
            ])

    # Статистика
    with open(OUTPUT_CSV, encoding="utf-8") as f:
        reader = csv.DictReader(f)
        rows = list(reader)

    print(f"\n✅ Записано: {OUTPUT_CSV}")
    print(f"   Записей: {len(rows)}")

    by_ext = {}
    by_cat = {}
    for r in rows:
        by_ext.setdefault(r["extension"], []).append(r)
        by_cat.setdefault(r["category"], []).append(r)

    print("\n📊 По форматам:")
    for ext in sorted(by_ext.keys()):
        items = by_ext[ext]
        total = sum(int(i["size_bytes"]) for i in items)
        print(f"   {ext}: {len(items)} файлов, {total / (1024 * 1024):.2f} MB")

    print("\n📊 По категориям:")
    for cat in sorted(by_cat.keys()):
        items = by_cat[cat]
        total = sum(int(i["size_bytes"]) for i in items)
        print(f"   {cat}: {len(items)} файлов, {total / (1024 * 1024):.2f} MB")

    unused = [r for r in rows if not r["pages_used_on"]]
    print(f"\n⚠️  Не найдены в использовании: {len(unused)} файлов")


if __name__ == "__main__":
    main()
