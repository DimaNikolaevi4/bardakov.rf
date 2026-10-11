# Спецификация Frontmatter

> **Версия:** 1.0.0
> **Обновлено:** 2026-10-11
> **Связанные файлы:** `docs/frontmatter.schema.json`, `scripts/validate-frontmatter.js`

---

## Обязательные поля (для всех страниц)

```yaml
---
title: "Заголовок страницы"        # string, 1–100 символов
description: "Meta description"      # string, 50–160 символов (SEO)
layout: section.njk                 # один из layouts/ (base, section, article, kontakty)
date: 2026-10-11                    # ISO 8601 (YYYY-MM-DD), дата публикации/обновления
---
```

## Опциональные поля

```yaml
permalink: /custom/url/             # string, если нужен нестандартный URL
section: obo-mne                    # string, раздел сайта (для хлебных крошек и активного меню)
order: 1                            # number, порядок в списке раздела
eyebrow: "Раздел"                   # string, надзаголовок над h1
subtitle: "Подзаголовок"            # string, подзаголовок витрины
category: "КИП"                     # string, категория (для article)
author: "Бардаков Д. Н."           # string, автор материала
readTime: "5 мин"                   # string, время чтения
tags: [обучение, кип]               # array of strings, теги для Pagefind
noindex: false                      # boolean, true → <meta name="robots" content="noindex">
changefreq: monthly                 # string, для sitemap: always/hourly/daily/weekly/monthly/yearly/never
priority: 0.8                       # number 0.0–1.0, для sitemap
breadcrumbs:                        # array, хлебные крошки
  - title: "Главная"
    url: "/"
  - title: "Обучение"
    url: "/obuchenie/"
---
```

## Специфичные поля по типам страниц

### section.njk (Раздел/Подраздел)

```yaml
---
layout: section.njk
title: "Обучение"
description: "Учебные материалы по дисциплинам"
section: obuchenie
permalink: /obuchenie/index.html
eyebrow: "Раздел"
subtitle: "Учебные материалы и лекции"
cards:                              # array, карточки подразделов
  - title: "КИП"
    description: "Контрольно-измерительные приборы"
    url: /obuchenie/kip/
    icon: "bi-thermometer-half"
intro: |                            # string (HTML), вводный текст
  <p>Добро пожаловать в раздел обучения...</p>
extra: |                             # string (HTML), доп. информация
  <p>Дополнительные материалы...</p>
---
```

### article.njk (Материал/Статья)

```yaml
---
layout: article.njk
title: "Практическая работа №1"
description: "Изучение устройства и принципа работы..."
section: obuchenie
subsection: kip
date: 2024-09-09
author: "Бардаков Д. Н."
category: "КИП"
tags: ["практика", "кип"]
readTime: "15 мин"
documents:                          # array, документы для скачивания
  - title: "Задание"
    url: "https://сит.бардаков.рф/assets/documents/prakticheskaya-rabota-1.pdf"
    type: "pdf"
    size: "1.2 MB"
    external: true
related:                            # array, связанные материалы
  - title: "Практическая работа №2"
    description: "Изучение..."
    url: /obuchenie/kip/prakticheskie-kip/prakticheskaya-rabota-no2/
---
```

### kontakty.njk (Контакты)

```yaml
---
layout: kontakty.njk
title: "Контакты"
description: "Контактные данные преподавателя Бардакова Д. Н."
section: obo-mne
permalink: /obo-mne/kontakty/index.html
---
```

## Валидация

- Скрипт: `scripts/validate-frontmatter.js`
- Команда: `npm run check:frontmatter`
- JSON Schema: `docs/frontmatter.schema.json`
- Pre-commit hook через husky + lint-staged

### Ошибки и их коды

| Код | Сообщение | Действие |
|---|---|---|
| `FM001` | Missing required field: `title` | Добавить поле |
| `FM002` | Missing required field: `description` | Добавить поле |
| `FM003` | Missing required field: `layout` | Добавить поле |
| `FM004` | Missing required field: `date` | Добавить поле |
| `FM005` | `title` must be 1–100 characters | Сократить/расширить |
| `FM006` | `description` must be 50–160 characters | Сократить/расширить |
| `FM007` | `layout` does not exist: `xxx.njk` | Указать существующий layout |
| `FM008` | `date` must be ISO 8601 (YYYY-MM-DD) | Исправить формат |
| `FM009` | `permalink` is not unique | Уникализировать URL |
| `FM010` | Unknown field: `xxx` | Убрать или исправить |

---

*Документ создан: 2026-10-11*
