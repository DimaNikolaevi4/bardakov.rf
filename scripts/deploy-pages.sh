#!/bin/bash
# deploy-pages.sh — Сборка и деплой на GitHub Pages (gh-pages ветка)
# Создано: 2026-10-11
#
# Использование: bash scripts/deploy-pages.sh
#
# Что делает:
# 1. Собирает сайт (npm run build)
# 2. Создаёт orphan ветку gh-pages
# 3. Копирует туда собранные файлы из public/
# 4. Пушит на GitHub
# 5. Возвращается на исходную ветку
#
# Сайт доступен по адресу: https://dimanikolaevi4.github.io/bardakov.rf/

set -e

REPO_DIR=$(git rev-parse --show-toplevel)
CURRENT_BRANCH=$(git branch --show-current)
TMP_DIR=$(mktemp -d)

echo "🚀 Deploy to GitHub Pages"
echo "   Текущая ветка: $CURRENT_BRANCH"
echo "   Временная директория: $TMP_DIR"
echo ""

# 1. Сборка
echo "📦 1/5. Сборка сайта..."
cd "$REPO_DIR"
npm run build

# 2. Копирование во временную директорию
echo "📋 2/5. Копирование файлов..."
cp -r public/* "$TMP_DIR/"
cp -r public/.* "$TMP_DIR/" 2>/dev/null || true
touch "$TMP_DIR/.nojekyll"

# 3. Создание orphan ветки
echo "🌿 3/5. Создание gh-pages ветки..."
git checkout --orphan gh-pages
git rm -rf . 2>/dev/null || true

# 4. Копирование и коммит
echo "💾 4/5. Коммит..."
cp -r "$TMP_DIR/"* .
cp "$TMP_DIR/.nojekyll" . 2>/dev/null || true
git add -A
git -c core.quotepath=false commit -m "Deploy to GitHub Pages ($(date +'%Y-%m-%d %H:%M'))"

# 5. Push
echo "📤 5/5. Push на GitHub..."
git push origin gh-pages --force

# Возврат
echo "🔄 Возврат на $CURRENT_BRANCH..."
git checkout "$CURRENT_BRANCH"

# Очистка
rm -rf "$TMP_DIR"

echo ""
echo "✅ Готово! Сайт доступен по адресу:"
echo "   https://dimanikolaevi4.github.io/bardakov.rf/"
echo ""
echo "⏳ GitHub Pages может потребоваться 1-2 минуты для обновления."
