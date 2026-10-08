# Инвентарь папки `old/`

> Сводка содержимого архивной папки `old/` в репозитории `bardakov.rf`.
> Создано в рамках Этапа 1.1 чек-листа миграции.
> Дата: 2026-10-08

---

## Назначение папки

`old/` — **архив старой версии сайта** на Joomla 5 и промежуточных статических страниц.
**Не изменять**, кроме случаев критического бага на действующем сайте.
Полный архив будет перенесён в ветку `archive-joomla` на Этапе 6.

---

## Структура

```
old/
├── CHECKLIST.md           # Старый чек-лист (архивный, не активен)
├── DESIGN.md              # Дизайн-система (токены, темы, типографика) — источник правды для Этапа 3
├── package.json           # Старый package.json (pagefind зависимость)
├── replit.md              # Описание проекта для Replit
├── бардаков.рф.txt        # Исходная идея сайта
├── attached_assets/       # Временные ассеты (1 файл)
├── homepage/              # Альтернативная главная на jQuery/Flipster
├── joomla/                # Файлы сайта на Joomla 5 (только кастомные)
└── new-stack/             # Современная статическая версия (49 HTML-страниц + assets)
```

---

## Сводка по директориям

| Директория | Файлов | Размер | Назначение |
|---|---:|---:|---|
| `attached_assets/` | 1 | 12K | Временный ассет (фрагмент HTML футера) — не нужен в production |
| `homepage/` | 4 | 64K | Альтернативная главная страница на jQuery + Flipster — устарела |
| `joomla/` | 331 | 162M | Файлы сайта на Joomla 5: шаблон `rt_elixir`, изображения, PDF, документы |
| `new-stack/` | 466 | 185M | Современный статический сайт (49 HTML-страниц + CSS/JS/images/docs) |
| **Корневые файлы** | 5 | 33K | Документация и метаданные |

**Итого:** 807 файлов, ~347 MB.

---

## `new-stack/site/` — основной источник контента для миграции

Это самая ценная часть архива — здесь лежит уже переработанный статический сайт, из которого будем брать контент.

### HTML-страницы (50 шт.)

| Раздел | Страниц | Путь |
|---|---:|---|
| Главная + 404 + поиск | 3 | `index.html`, `404.html`, `search/index.html` |
| Обо мне | 5 | `obo-mne/index.html`, `kontakty.html`, `metodicheskaya-rabota.html`, `khobbi.html`, `dostizheniya.html` |
| Обучение | 16 | `obuchenie/index.html`, `kip/`, `kip/prakticheskie-kip/` (9 практик), `ksk.html`, `elektromonter.html`, `pm02/lektsii/` |
| Абитуриенту | 12 | `abiturientu/index.html`, `professii/` (6), `spetsialnosti/` (2), `dokumentatsiya.html` |
| Воспитание | 10 | `vospitanie/index.html`, `dlya-roditelej/` (6), `razgovory-o-vazhnom.html`, `prakticheskie-sovety-studentam.html` |

### Ассеты

- `assets/css/style.css` — текущие стили (будут заменены дизайн-системой из Этапа 3)
- `assets/components/` — `header.html`, `footer.html`, `page-template.html` (fetch-инклуды)
- `assets/images/` — все изображения сайта (нужно перенести и оптимизировать в WebP на Этапе 5.2)
- `assets/docs/` — PDF/DOCX документы (30+ PDF «Разговоры о важном», учебные материалы, нормативные документы)
- `favicon.ico`, `robots.txt`, `sitemap.xml`

---

## `joomla/` — архив Joomla 5

Только кастомные файлы (стандартные ядро Joomla исключены через `joomla/.gitignore`).

### Ключевые подсекции

- `joomla/templates/rt_elixir/` — кастомный шаблон сайта (не нужен в новой версии)
- `joomla/images/` — дубликаты изображений (часть уже скопирована в `new-stack/site/assets/images/`)
- `joomla/images/pdf/` — PDF-документы:
  - `vospitanie/` — 6 нормативных документов (Устав, Правила, Положения)
  - `razgovor/` — 30+ PDF «Разговоры о важном» (праздничные тематические материалы)
  - `obychen/` — курс лекций по материаловедению
- `joomla/dok24/` — 2 документа (`практосы комп модель1.doc`, `компьютерные сети.pdf`)
- `joomla/configuration.php.example` — шаблон конфигурации Joomla (с плейсхолдерами)
- `joomla/sitemap.xml` — карта сайта Joomla (источник URL для редиректов)
- `joomla/robots.txt` — robots.txt Joomla
- `joomla/yandex_0ff2f2d3e1d3590d.html` — верификация Yandex.Webmaster
- `joomla/.htaccess` — конфигурация Apache (ЧПУ, редиректы, безопасность)

### Большие файлы (исключены из git через `.gitignore`)

- `joomla/images/Animation/Бардаков_самопризентация.mp4` — видео самопрезентации
- `joomla/images/Animation/2-1-2400.mp4` — второе видео

---

## `attached_assets/` — временные ассеты

- `Pasted--section-class-footer-resources-aria-labelledby-footer-_1779374545602.txt` — фрагмент HTML футера
- **Можно удалить на Этапе 6** (очистка репозитория)

---

## `homepage/` — альтернативная главная

- `index.html`, `style.css`, `scripts/init.js`, `scripts/jquery.flipster.min.js`
- Использовала jQuery + Flipster для слайдера
- **Устарела** — будет заменена новой главной на Eleventy (Этап 3.3)

---

## Что брать для миграции

| Что | Откуда | Куда |
|---|---|---|
| Тексты страниц | `new-stack/site/**/*.html` | `src/content/**/*.md` (через `migration-source/`) |
| Изображения | `new-stack/site/assets/images/` | `src/assets/images/` (с конвертацией в WebP) |
| PDF/DOCX документы | `new-stack/site/assets/docs/` | `src/assets/docs/` |
| Структура меню | `new-stack/site/assets/components/header.html` | `src/_data/navigation.json` |
| Контакты | `new-stack/site/obo-mne/kontakty.html` | `src/_data/contacts.json` |
| Дизайн-токены | `old/DESIGN.md` | `src/styles/tokens.css` |
| URL для редиректов | `joomla/sitemap.xml` | `src/_data/redirects.csv` |
| Правила .htaccess | `joomla/.htaccess` | `public/.htaccess` (новый) |
| robots.txt | `joomla/robots.txt`, `new-stack/site/robots.txt` | `src/content/robots.txt` |
