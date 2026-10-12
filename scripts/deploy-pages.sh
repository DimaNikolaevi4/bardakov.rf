#!/bin/bash
# deploy-pages.sh — Сборка и деплой на GitHub Pages (gh-pages ветка)
# Создано: 2026-10-11, обновлено: 2026-10-12
#
# Что делает:
# 1. Собирает сайт (npx eleventy)
# 2. Пост-обработка путей для GitHub Pages (/→/bardakov.rf/)
# 3. Копирует во временную директорию
# 4. Создаёт orphan ветку gh-pages
# 5. Коммитит и пушит
# 6. Возвращается на исходную ветку

set -e

REPO_DIR=$(git rev-parse --show-toplevel)
CURRENT_BRANCH=$(git branch --show-current)
TMP_DIR=$(mktemp -d)

echo "🚀 Deploy to GitHub Pages"
echo "   Ветка: $CURRENT_BRANCH"
echo ""

# 1. Сборка
echo "📦 1/6. Сборка сайта..."
cd "$REPO_DIR"
rm -rf public
./node_modules/.bin/eleventy

# 2. Пост-обработка путей
echo "🔧 2/6. Пост-обработка путей для GitHub Pages..."
python3 scripts/fix-paths-for-pages.py

# 3. Копирование во временную директорию
echo "📋 3/6. Копирование файлов..."
cp -r public/* "$TMP_DIR/"
touch "$TMP_DIR/.nojekyll"

# 4. Создание orphan ветки
echo "🌿 4/6. Создание gh-pages ветки..."
git checkout --orphan gh-pages 2>/dev/null || git checkout gh-pages
git rm -rf . 2>/dev/null || true

# 5. Коммит и push
echo "💾 5/6. Коммит и push..."
cp -r "$TMP_DIR/"* .
cp "$TMP_DIR/.nojekyll" . 2>/dev/null || true
git add -A
git -c core.quotepath=false commit -m "Deploy to GitHub Pages ($(date +'%Y-%m-%d %H:%M'))"
git push origin gh-pages --force

# 6. Возврат
echo "🔄 6/6. Возврат на $CURRENT_BRANCH..."
git checkout "$CURRENT_BRANCH"
rm -rf "$TMP_DIR"

echo ""
echo "✅ Сайт: https://dimanikolaevi4.github.io/bardakov.rf/"
echo "⏳ Обновление через 1-2 минуты."
