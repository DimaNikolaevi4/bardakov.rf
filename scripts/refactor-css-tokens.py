#!/usr/bin/env python3
"""
ФАЗА 1b: Глобальная замена старых имён CSS-токенов на новые.

Замены (порядок важен — длинные имена идут раньше коротких, чтобы
избежать частичных замен):
  --color-bg            → --bg-primary
  --color-surface-alt   → --bg-subtle
  --color-surface       → --bg-primary
  --color-text-muted    → --text-muted
  --color-text          → --text-primary
  --color-primary-hover → --accent-hover
  --color-primary-text  → --color-on-accent
  --color-primary       → --accent
  --color-border        → --border
  --color-accent        → --accent
  --color-focus-ring    → --accent-ring
  --transition-fast     → --t-fast
  --transition-base     → --t-base
  --radius-md           → --radius

Файлы: typography.css, layout.css, a11y.css, components.css
tokens.css НЕ трогаем (там алиасы уже определены).
"""
import re
import sys
from pathlib import Path

STYLES_DIR = Path(__file__).resolve().parent.parent / "src" / "styles"

TARGETS = [
    "typography.css",
    "layout.css",
    "a11y.css",
    "components.css",
]

# Порядок важен: сначала более длинные/специфичные имена.
REPLACEMENTS = [
    ("--color-surface-alt",    "--bg-subtle"),
    ("--color-surface",        "--bg-primary"),
    ("--color-bg",             "--bg-primary"),
    ("--color-text-muted",     "--text-muted"),
    ("--color-text",           "--text-primary"),
    ("--color-primary-hover",  "--accent-hover"),
    ("--color-primary-text",   "--color-on-accent"),
    ("--color-primary",        "--accent"),
    ("--color-border",         "--border"),
    ("--color-accent",         "--accent"),
    ("--color-focus-ring",     "--accent-ring"),
    ("--transition-fast",      "--t-fast"),
    ("--transition-base",     "--t-base"),
    ("--radius-md",            "--radius"),
]

def main():
    total_changes = 0
    for name in TARGETS:
        path = STYLES_DIR / name
        if not path.exists():
            print(f"  ⚠ Пропуск (нет файла): {name}")
            continue
        text = path.read_text(encoding="utf-8")
        original = text
        file_changes = 0
        for old, new in REPLACEMENTS:
            count = text.count(old)
            if count:
                text = text.replace(old, new)
                file_changes += count
        if text != original:
            path.write_text(text, encoding="utf-8")
            print(f"  ✅ {name}: замен {file_changes}")
            total_changes += file_changes
        else:
            print(f"  – {name}: без изменений")
    print(f"\nИтого замен: {total_changes}")

if __name__ == "__main__":
    main()
