# Руководство для контрибьюторов

> **Сайт:** https://бардаков.рф
> **Репозиторий:** https://github.com/DimaNikolaevi4/bardakov.rf

---

## 🚀 Быстрый старт

### Установка

```bash
git clone https://github.com/DimaNikolaevi4/bardakov.rf.git
cd bardakov.rf
npm install
```

### Локальная разработка

```bash
npm run dev          # Запуск dev-сервера на http://localhost:8080
```

### Сборка

```bash
npm run build        # Production-сборка в public/
npm test             # Сборка + валидация HTML + проверка ссылок
```

---

## 📁 Структура проекта

```
src/
├── _data/           # Глобальные данные (JSON)
├── _includes/
│   ├── layouts/     # Базовые шаблоны (base, section, article, kontakty)
│   └── components/  # Переиспользуемые компоненты (header, footer, card, button, ...)
├── assets/          # Статика (CSS, JS, шрифты, изображения)
├── content/         # Контент страницы (Nunjucks и Markdown)
└── styles/          # Исходные CSS-файлы дизайн-системы
```

---

## 📝 Добавление новой страницы

### 1. Создайте файл

**Markdown** (для статей):
```bash
src/content/obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no10.md
```

**Nunjucks** (для страниц разделов):
```bash
src/content/obuchenie/kip/index.njk
```

### 2. Заполните frontmatter

**Обязательные поля:**

```yaml
---
title: "Практическая работа №10"           # 1–100 символов
description: "Изучение устройства..."       # 50–160 символов (SEO!)
layout: article.njk                         # один из layouts/
date: 2026-10-11                            # YYYY-MM-DD
---
```

**Полный список полей:** см. [`docs/frontmatter-spec.md`](frontmatter-spec.md)

### 3. Валидация

Frontmatter автоматически проверяется при коммите через husky + lint-staged.

Если валидация упадёт — коммит будет отклонён. Проверьте вручную:

```bash
npm run check:frontmatter
```

---

## 🎨 Дизайн-система

- **Токены:** `src/styles/tokens.css` (цвета, шрифты, отступы, тени, радиусы)
- **3 темы:** light (по умолчанию) / dark / high-contrast
- **Палитра:** «Золотой день / Ночное небо»
- **Шрифты:** Inter (body), Merriweather (цитаты), Caveat (формулы на фоне)
- **Подробности:** [`design-reference/STRUCTURE.md`](../design-reference/STRUCTURE.md)

---

## 🔧 Команды

| Команда | Описание |
|---|---|
| `npm run dev` | Локальная разработка с hot-reload |
| `npm run build` | Production-сборка в `public/` |
| `npm test` | Сборка + валидация HTML + проверка ссылок |
| `npm run check:frontmatter` | Валидация YAML frontmatter |
| `npm run lint:md` | Линт Markdown файлов |
| `npm run format` | Форматирование через Prettier |
| `bash scripts/deploy-pages.sh` | Деплой на GitHub Pages |

---

## 📋 Правила коммитов

- Используйте осмысленные сообщения: `docs: добавлен анализ структуры меню`
- Один коммит = одна логическая задача
- Frontmatter проверяется автоматически при коммите

---

## 🌐 Деплой на GitHub Pages

```bash
bash scripts/deploy-pages.sh
```

Сайт доступен по адресу: **https://dimanikolaevi4.github.io/bardakov.rf/**

---

*Документ создан: 2026-10-11*
