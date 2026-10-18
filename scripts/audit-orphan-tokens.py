#!/usr/bin/env python3
"""Поиск orphan-токенов: объявлены в tokens.css, но не используются ни в одном CSS-файле."""
import re
import subprocess
from pathlib import Path

ROOT = Path("/home/z/my-project/bardakov.rf")
TOKENS = ROOT / "src/styles/tokens.css"

# Все CSS-файлы проекта (где токены могут использоваться через var(...))
css_files = list((ROOT / "src/styles").glob("*.css"))

# 1. Извлечь все объявленные токены из tokens.css
declared = set()
text = TOKENS.read_text(encoding="utf-8")
for m in re.finditer(r'^\s*(--[a-zA-Z0-9-]+)\s*:', text, re.MULTILINE):
    declared.add(m.group(1))

print(f"Объявлено токенов в tokens.css: {len(declared)}")
print()

# 2. По каждому токену проверить использование var(--name) во всех CSS-файлах
orphans = []
usages = {}
for token in sorted(declared):
    count = 0
    for f in css_files:
        if f.name == "tokens.css":
            # В tokens.css не считаем self-references (var(--name) в алиасах)
            continue
        content = f.read_text(encoding="utf-8")
        # var(--name) или var(--name, fallback) — но не var(--name-other)
        # Используем точный regex: var(--name) или var(--name, ...)
        pattern = re.compile(r'var\(\s*' + re.escape(token) + r'\s*[,)]')
        count += len(pattern.findall(content))
    usages[token] = count
    if count == 0:
        orphans.append(token)

# 3. Также проверить a11y.css → typography.css → layout.css → components.css
print("=== Использование токенов по файлам ===")
print(f"{'Токен':<35} {'a11y':>6} {'typo':>6} {'layo':>6} {'comp':>6} {'TOTAL':>6}")
print("-" * 70)
for token in sorted(declared):
    counts = []
    total = 0
    for name in ["a11y.css", "typography.css", "layout.css", "components.css"]:
        f = ROOT / "src/styles" / name
        content = f.read_text(encoding="utf-8")
        pattern = re.compile(r'var\(\s*' + re.escape(token) + r'\s*[,)]')
        c = len(pattern.findall(content))
        counts.append(c)
        total += c
    if total > 0 or token in [
        "--color-on-accent",
        "--space-1", "--space-2", "--space-3", "--space-4", "--space-5",
        "--space-6", "--space-8", "--space-10", "--space-12", "--space-16",
        "--text-xs", "--text-sm", "--text-base", "--text-lg", "--text-xl",
        "--text-2xl", "--text-3xl", "--text-4xl", "--text-5xl",
        "--weight-regular", "--weight-medium", "--weight-semibold", "--weight-bold",
        "--leading-tight", "--leading-snug", "--leading-normal",
        "--font-body", "--font-heading", "--font-mono",
        "--container-sm", "--container-md", "--container-lg", "--container-xl",
        "--target-min", "--target-vi",
        "--shadow-md", "--shadow-lg", "--shadow-air",
        "--blue-100",
    ] or token.startswith("--color-") and "primary" in token or token.startswith("--radius-") or token.startswith("--transition-") or token == "--color-focus-ring":
        print(f"{token:<35} {counts[0]:>6} {counts[1]:>6} {counts[2]:>6} {counts[3]:>6} {total:>6}")

print()
print(f"=== ORPHAN-токены (0 использований в др. CSS): {len(orphans)} ===")
for t in orphans:
    print(f"  ⚠ {t}")
