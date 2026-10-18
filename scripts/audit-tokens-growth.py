#!/usr/bin/env python3
"""Анализ прироста tokens.css: новые уникальные токены vs алиасы."""
import re
from pathlib import Path

TOKENS = Path("/home/z/my-project/bardakov.rf/src/styles/tokens.css")
text = TOKENS.read_text(encoding="utf-8")

# Достаём блок :root { ... } (исключаем [data-theme="..."])
root_match = re.search(r'(?<![\w-])\]\s*\n|^\)\s*\n|^:root\s*\{(.*?)\n\}', text, re.DOTALL | re.MULTILINE)
# Проще: ищем :root { ... } блок без вложенных { }
root_match = re.search(r'^:root\s*\{\n(.*?)\n\}', text, re.DOTALL | re.MULTILINE)
root_block = root_match.group(1) if root_match else ""

# Извлекаем все объявления вида --name: value;
decls = []
for line in root_block.splitlines():
    m = re.match(r'\s*(--[a-zA-Z0-9-]+)\s*:\s*(.+?);\s*(/\*.*)?$', line)
    if m:
        decls.append((m.group(1), m.group(2).strip(), m.group(3) or ""))

new_unique = []
aliases = []
for name, value, comment in decls:
    is_alias = value.startswith("var(")
    # Помечаем только новые (добавлены в этом коммите)
    # Используем маркеры в комментариях или проверяем, что имя новое
    if is_alias:
        aliases.append((name, value))
    else:
        new_unique.append((name, value))

# Группировка новых по категориям
categories = {
    "color-on-accent": [],
    "space-*": [],
    "text-* (font-size)": [],
    "weight-*": [],
    "leading-*": [],
    "font-*": [],
    "container-*": [],
    "target-*": [],
    "blue-*": [],
    "shadow-* (constants)": [],
    "other": [],
}

# Сравним с предыдущей версией tokens.css
import subprocess
prev = subprocess.run(
    ["git", "show", "HEAD~1:src/styles/tokens.css"],
    cwd="/home/z/my-project/bardakov.rf",
    capture_output=True, text=True
).stdout

prev_names = set()
for line in prev.splitlines():
    m = re.match(r'\s*(--[a-zA-Z0-9-]+)\s*:', line)
    if m and ":root" not in line:
        prev_names.add(m.group(1))

new_in_this_commit = []
for name, value, comment in decls:
    if name not in prev_names:
        new_in_this_commit.append((name, value, value.startswith("var(")))

print(f"Всего объявлений в :root: {len(decls)}")
print(f"  Было до коммита: {len(prev_names)}")
print(f"  Добавлено в этом коммите: {len(new_in_this_commit)}")
print()

new_unique_added = [t for t in new_in_this_commit if not t[2]]
aliases_added = [t for t in new_in_this_commit if t[2]]

print(f"  ── Новых уникальных токенов: {len(new_unique_added)}")
for name, val, _ in new_unique_added:
    print(f"        {name:25s} = {val}")

print()
print(f"  ── Новых алиасов (var(...)): {len(aliases_added)}")
for name, val, _ in aliases_added:
    print(f"        {name:25s} = {val}")

print()
total_lines = len(new_in_this_commit)
print(f"  Доля алиасов среди добавленных: {len(aliases_added)}/{total_lines} = {len(aliases_added)*100//total_lines}%")

# Проверка на дубликаты объявлений
print()
print("=== Дубликаты объявлений (один и тот же --name дважды в :root) ===")
name_counts = {}
for name, _, _ in decls:
    name_counts[name] = name_counts.get(name, 0) + 1
dupes = {n: c for n, c in name_counts.items() if c > 1}
if dupes:
    for n, c in dupes.items():
        print(f"  ⚠ {n}: {c} раз")
else:
    print("  ✅ дублей нет")
