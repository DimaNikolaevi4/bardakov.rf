#!/usr/bin/env python3
"""ФАЗА 2: Заменить все ссылки 'old/DESIGN.md' на 'docs/DESIGN.md'
в отслеживаемых файлах (кроме ./old/, ./download/, ./public/, ./.git/)."""
import subprocess
from pathlib import Path

ROOT = Path("/home/z/my-project/bardakov.rf")

# Целевые расширения для поиска
EXTS = {".md", ".njk", ".html", ".js", ".json", ".css"}

# Директории, которые НЕ трогаем
SKIP_DIRS = {".git", "node_modules", "old", "download", "public", ".agents"}

OLD = "old/DESIGN.md"
NEW = "docs/DESIGN.md"

changed = []
for path in ROOT.rglob("*"):
    if not path.is_file():
        continue
    if path.suffix not in EXTS:
        continue
    # Проверяем, что путь не в skip-директориях
    rel = path.relative_to(ROOT)
    if any(part in SKIP_DIRS for part in rel.parts):
        continue
    try:
        text = path.read_text(encoding="utf-8")
    except (UnicodeDecodeError, PermissionError):
        continue
    if OLD not in text:
        continue
    count = text.count(OLD)
    new_text = text.replace(OLD, NEW)
    path.write_text(new_text, encoding="utf-8")
    changed.append((str(rel), count))

print(f"Обновлено файлов: {len(changed)}")
for f, c in changed:
    print(f"  {f}: {c} замен")
