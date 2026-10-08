# 🗺️ Чек-лист миграции сайта бардаков.рф

> **Источник правды для миграции.** Каждая задача должна быть отмечена перед переходом к следующему этапу. Файл обновляется по мере прогресса.
>
> **Связанные документы:**
> - `old/DESIGN.md` — Дизайн-система сайта (токены цветов, типографика, темы)
> - `old/CHECKLIST.md` — Старый чек-лист (архивный, не активен)
> - `old/replit.md` — Описание проекта
> - Дорожная карта: см. описание задачи в чате или в `old/`

---

## 📋 Легенда

- `[ ]` — не начато
- `[~]` — в работе
- ✅ выполнено
- `[!]` — заблокировано (нужно решение)
- `[-]` — отменено/неактуально

---

## 🏁 Общие принципы миграции

1. **Один этап за раз.** Не переходить к следующему этапу, пока не закрыты все обязательные задачи текущего.
2. **Definition of Done (DoD) на каждом этапе.** Этап считается завершённым только когда выполнены все его DoD-критерии.
3. **Маленькие коммиты.** Логическая единица изменения = один коммит. Один коммит = одна задача или связная группа задач.
4. **Документация синхронна с кодом.** Если меняется архитектура — обновляется README и этот чек-лист.
5. **Старый код в `old/` — только для чтения.** Изменения в `old/` только в случае критического бага на действующем сайте.

---

## 🟦 Этап 1. Ревизия и аудит (Текущее состояние)

**Цель:** Зафиксировать текущее состояние репозитория и живого сайта, собрать полный инвентарь контента и URL-адресов для будущей миграции без потерь SEO и контента.

**Definition of Ready (DoR):**
- Доступ к репозиторию `DimaNikolaevi4/bardakov.rf` с правами на push
- Доступ к файлам живого сайта на хостинге Beget (файловый менеджер + phpMyAdmin для БД Joomla, если нужно)
- Доступ к домену `бардаков.рф` (DNS, редиректы)

### 1.1 Аудит репозитория bardakov.rf

- [x] Клонировать репозиторий локально для работы
- [x] Создать папку `old/` и перенести туда всё предыдущее содержимое репозитория (commit `d0ba9fa7`)
- [x] Проверить, что в корне остались только `.gitignore` и `.replit`
- ✅ ⚠️ Проверить, что в `.gitignore` корректно исключены:
  - `old/joomla/images/Animation/Бардаков_самопризентация.mp4` (большой файл)
  - `old/joomla/images/Animation/2-1-2400.mp4` (большой файл)
  - `node_modules/`
  - ⚠️ **`package-lock.json` НЕ исключать** — он должен быть в репозитории для воспроизводимости сборок в CI/CD (см. Этап 6.3)
- ✅ Составить таблицу «что лежит в `old/`» (краткая сводка по директориям: `joomla/`, `new-stack/site/`, `homepage/`, `attached_assets/`) → см. `docs/old-inventory.md`
- ✅ Зафиксировать в `README.md` (будущем) назначение папки `old/` — «Архив старой версии на Joomla 5 и промежуточных статических страниц. Не изменять, кроме критических багов.» (см. секцию «Структура репозитория» в README.md)

### 1.2 Инвентаризация живого сайта (SEO-аудит)

- [~] Собрать список всех URL живого сайта `бардаков.рф` через:
  - ✅ `sitemap.xml` Joomla (см. `old/joomla/sitemap.xml`) — распарсен, 148 URL
  - [!] Google Search Console (если есть доступ) — 🔒 **заблокировано**: нет доступа к GSC
  - [!] Yandex.Webmaster (если есть доступ) — 🔒 **заблокировано**: нет доступа к Yandex.Webmaster
  - ✅ Ручное прохождение меню сайта — выполнено через сканирование HTML-файлов в `old/new-stack/site/` (50 страниц)
- ✅ Сохранить полный список URL в `migration-source/redirects.csv` со столбцами:
  - `old_url` — старый URL (например, `/index.php/obo-mne`)
  - `new_url` — новый URL (например, `/obo-mne/`)
  - `status` — `301` по умолчанию
  - `lastmod`, `priority` — из sitemap
  - `notes` — комментарии (например, «объединить с X»)
  - **Итог: 119 записей** (70 редиректов + 49 прямых URL), 4 совпадают с new-stack, 4 сопоставлены вручную, 4 требуют проверки (приватная страница + глубокие nested URL ПМ.02)
  - Скрипт: `scripts/parse-sitemap.py`
  - Ручные правки: `migration-source/manual-redirects-overrides.csv`
- [!] Проверить каждый URL на HTTP-статус 200, зафиксировать 404/410 — 🔒 **заблокировано**: требует доступа к живому сайту (выполнить после получения доступа к Beget или через `curl` с задержкой)
- [!] Идентифицировать страницы с высоким трафиком (по Yandex.Metrika) — приоритет для миграции — 🔒 **заблокировано**: нет доступа к Yandex.Metrika
- [!] Зафиксировать все внешние ссылки на сайт (если есть сторонние ссылки на конкретные страницы) — 🔒 **заблокировано**: требует доступа к GSC/Ahrefs
- ✅ Зафиксировать все входящие обратные ссылки из `old/joomla/robots.txt` и `old/joomla/yandex_*.html`:
  - `old/joomla/robots.txt` — изучен (см. Этап 1.3)
  - `old/joomla/yandex_0ff2f2d3e1d3590d.html` — файл верификации Yandex.Webmaster (нужно перенести в новый сайт)

### 1.3 Экспорт контента

- [ ] Тексты всех страниц → Markdown-файлы в `migration-source/content/`:
  - [ ] Раздел «Обо мне» (5 страниц)
  - [ ] Раздел «Обучение» (16 страниц: КИП, КСК, электромонтёр, ПМ.02 лекции/практики)
  - [ ] Раздел «Абитуриенту» (12 страниц: профессии, специальности, документация)
  - [ ] Раздел «Воспитание» (10 страниц: для родителей, разговоры о важном, советы студентам)
  - [ ] Главная страница
  - [ ] 404
- [ ] Меню и структура навигации → `migration-source/menu.yaml`:
  - [ ] Главное меню (header)
  - [ ] Меню разделов (sidebar)
  - [ ] Футер-ссылки
  - [ ] Иконки-ссылки на гос. ресурсы (см. `old/new-stack/site/assets/images/ikonccilki/`)
- [ ] Изображения → `migration-source/images-inventory.csv` со столбцами:
  - `path` — относительный путь
  - `page` — на каких страницах используется
  - `alt` — текущий alt (если есть)
  - `new_alt` — предложенный alt
  - `webp_needed` — да/нет
- [ ] Документы (PDF, DOCX) → `migration-source/docs-inventory.csv`
- [ ] Контактные данные → `migration-source/contacts.yaml` (телефон, email, адрес СИТ, график работы, ссылки на ГБПОУ РО «СИТ»)
- [ ] Yandex.Metrika ID → `migration-source/analytics.yaml`
- [ ] Favicon → `migration-source/favicon.ico` + проверка всех размеров (16, 32, 48, 180, 192, 512)
- [ ] 🔒 **Наследие старого сайта (конфигурация сервера):**
  - [ ] Скачать текущий `.htaccess` с живого сайта `бардаков.рф` → `migration-source/htaccess-original.txt`
  - [ ] Проанализировать правила: ЧПУ (SEF URLs), редиректы, защиты, кэширование, кодировки
  - [ ] Зафиксировать правила, которые нужно перенести в новый `.htaccess` (например, запрет индексации админки, редирект `index.php` на `/`, gzip-сжатие, безопасность)
  - [ ] Скачать текущий `robots.txt` с живого сайта → `migration-source/robots-original.txt`
  - [ ] Сравнить с `old/joomla/robots.txt` и `old/new-stack/site/robots.txt`
  - [ ] Зафиксировать директивы `Disallow`, `Host`, `Sitemap` для адаптации в новом `robots.txt`

**Definition of Done (DoD) для Этапа 1:**
- [ ] Папка `old/` изолирована и не мешает разработке
- [ ] Список URL живого сайта сохранён в CSV, статус 200/404 проверен
- [ ] Весь контент (тексты, изображения, документы, контакты) выгружен в `migration-source/`
- [ ] Сделан коммит `Этап 1: ревизия и аудит завершены`

---

## 🟦 Этап 2. Определение необходимого и подготовка стека

**Цель:** Подготовить чистую, воспроизводимую среду разработки с современным статическим генератором (Eleventy) и зафиксировать стек в `package.json`.

**Definition of Ready:**
- Этап 1 завершён (DoD выполнен)
- Установлен Node.js LTS (проверить `node -v` → должно быть v20+)

### 2.1 Инициализация зависимостей

- [ ] Обновить `package.json` в корне репозитория (взять за основу `old/package.json`, переработать):
  - [ ] Поле `"name": "bardakov-rf"`
  - [ ] Поле `"version": "2.0.0"`
  - [ ] Поле `"type": "module"` (если используем ESM)
  - [ ] Поле `"description"` — короткое описание проекта
  - [ ] Поле `"license": "MIT"` или явно указать
  - [ ] Поле `"author": "Dmitry Bardakov"`
- [ ] Зависимости (dependencies):
  - [ ] `@11ty/eleventy` (latest stable) — генератор статики
  - [ ] `nunjucks` — шаблонизатор
  - [ ] `bootstrap` (5.3.x) — UI-фреймворк
  - [ ] `aos` — анимации при скролле
  - [ ] `glightbox` — лайтбокс для изображений
  - [ ] `@11ty/eleventy-plugin-rss` — RSS-фид (опционально)
- [ ] Зависимости разработки (devDependencies):
  - [ ] `pagefind` (latest) — статический поиск по сайту
  - [ ] `sharp` или `eleventy-img` — оптимизация изображений в WebP
  - [ ] `html-validate` — валидация HTML
  - [ ] `markdownlint-cli2` — линтер Markdown
  - [ ] `prettier` — форматирование
  - [ ] `husky` + `lint-staged` — pre-commit хуки (опционально)
- [ ] Запустить `npm install` и проверить отсутствие ошибок
- [ ] Зафиксировать `package-lock.json` (НЕ добавлять в `.gitignore`)
- [ ] Создать `.nvmrc` с версией Node.js (для воспроизводимости в CI)

### 2.2 Создание структуры папок

- [ ] Создать структуру каталогов:
  ```
  src/
  ├── _data/              # Глобальные данные (сайт, навигация, контакты)
  │   ├── site.json       # Название, описание, URL, автор
  │   ├── navigation.json # Меню
  │   └── contacts.json   # Контакты
  ├── _includes/          # Шаблоны и компоненты
  │   ├── layouts/         # Базовые layout-ы
  │   │   ├── base.njk
  │   │   └── page.njk
  │   ├── components/      # Переиспользуемые компоненты
  │   │   ├── header.njk
  │   │   ├── footer.njk
  │   │   ├── card.njk
  │   │   ├── button.njk
  │   │   ├── nav-burger.njk
  │   │   ├── theme-switcher.njk
  │   │   ├── breadcrumb.njk
  │   │   └── a11y-panel.njk
  │   └── partials/        # Прочие переиспользуемые куски
  ├── content/            # Контент в Markdown/Nunjucks
  │   ├── index.njk        # Главная
  │   ├── obo-mne/
  │   ├── obuchenie/
  │   ├── abiturientu/
  │   ├── vospitanie/
  │   ├── search.njk       # Страница поиска Pagefind
  │   └── 404.njk          # 404
  ├── assets/             # Статика (копируется в public/)
  │   ├── css/
  │   ├── js/
  │   ├── fonts/          # Inter, Manrope (self-hosted)
  │   ├── images/
  │   └── docs/           # PDF/DOCX документы
  └── styles/             # Исходные SCSS/CSS для дизайн-системы
      ├── tokens.css      # CSS-переменные (цвета, тени, радиусы)
      ├── typography.css
      ├── layout.css
      └── components.css
  ```
- [ ] Создать `.eleventy.js` (или `.eleventy.cjs`) с конфигурацией:
  - [ ] `input: "src"`
  - [ ] `output: "public"`
  - [ ] `includes: "_includes"`
  - [ ] `data: "_data"`
  - [ ] Passthrough для `assets/`, `robots.txt`, `favicon.ico`
  - [ ] Настройка шаблонизаторов (nunjucks + markdown)
  - [ ] Кастомные фильтры (slugify, date-format, truncate и т. д.)
  - [ ] Плагины (если нужны)
- [ ] Добавить `public/` в `.gitignore` (результат сборки — не коммитится)

### 2.3 Настройка скриптов

- [ ] `package.json` scripts:
  - [ ] `"clean": "rimraf public"` — очистка результата сборки
  - [ ] `"dev": "npm run clean && eleventy --serve --watch"` — локальная разработка с hot-reload
  - [ ] `"build": "npm run clean && eleventy"` — production-сборка
  - [ ] `"pagefind": "pagefind --site public"` — индексация поиска
  - [ ] `"postbuild": "npm run pagefind"` — автоиндексация после сборки
  - [ ] `"serve:public": "npx serve public"` — быстрый предпросмотр собранного
  - [ ] `"lint:md": "markdownlint-cli2 'src/content/**/*.md'"`
  - [ ] `"lint:html": "html-validate 'public/**/*.html'"`
  - [ ] `"format": "prettier --write 'src/**/*.{js,njk,md,css,json}'"`
  - [ ] `"check:links": "linkinator public --recurse"` — проверка битых ссылок
  - [ ] `"test": "npm run build && npm run lint:html && npm run check:links"`
- [ ] Создать `.editorconfig` для единообразия (отступы, переводы строк)
- [ ] Создать `.prettierrc` с базовыми настройками

**Definition of Done для Этапа 2:**
- [ ] `package.json` зафиксирован, зависимости установлены, `node_modules/` игнорируется
- [ ] Структура каталогов `src/` создана
- [ ] Команда `npm run dev` запускает локальный сервер на http://localhost:8080 (пустая страница, но без ошибок)
- [ ] Команда `npm run build` успешно собирает пустой сайт в `public/`
- [ ] Коммит `Этап 2: стек инициализирован`

---

## 🔄 Этап 3. Разработка дизайн-системы и утверждение визуального стиля (Design First)

**Цель:** Утвердить «лицо» сайта до начала массового наполнения. Изменения дизайна после этого этапа — только через новую итерацию чек-листа.

**Definition of Ready:**
- Этап 2 завершён
- `old/DESIGN.md` изучен (там уже есть проработанная дизайн-система: «Кристалл знаний», токены, темы, a11y)

### 3.1 Определение дизайн-токенов

- [ ] Создать `src/styles/tokens.css` на основе `old/DESIGN.md`:
  - [ ] Цветовые примитивы (blue, orange, neutral)
  - [ ] Семантические токены (light)
  - [ ] Семантические токены для dark-темы через `[data-theme="dark"]`
  - [ ] Семантические токены для VI-темы через `[data-theme="vi"]` (режим для слабовидящих)
  - [ ] Шкала типографики (text-xs ... text-5xl)
  - [ ] Межстрочные интервалы (leading-tight / snug / normal)
  - [ ] Веса шрифтов (400 / 500 / 600 / 700)
  - [ ] Базовая единица пространства (8px) и шкала отступов
  - [ ] Радиусы (6 / 10 / 16 / 9999px)
  - [ ] Тени (sm / md / lg) и правила для dark-темы
  - [ ] Брейкпоинты (sm 640, md 768, lg 1024, xl 1280)
- [ ] Создать `src/styles/typography.css` с правилами:
  - [ ] Подключение Inter (body) и Manrope (headings) через `@font-face` (self-hosted, woff2)
  - [ ] `font-display: swap`
  - [ ] Подмножество: latin + cyrillic
- [ ] Создать `src/styles/layout.css`:
  - [ ] `.container` с максимальной шириной 1280px
  - [ ] Mobile-first медиа-запросы
  - [ ] Базовые стили для `body`, `main`, `article`
- [ ] Создать `src/styles/a11y.css`:
  - [ ] Видимый `:focus-visible` (outline 3px solid `--color-focus-ring`)
  - [ ] Skip-link «Перейти к контенту»
  - [ ] Уважение `prefers-reduced-motion`
  - [ ] Стили для `[data-theme="vi"]` (большой шрифт, чёрный фон)
- [ ] Inline-скрипт в `<head>` для защиты от FOUC при переключении тем (см. `old/DESIGN.md` §8.3)

### 3.2 Создание UI-кита (библиотеки компонентов)

- [ ] Создать страницу-витрину `src/content/_ui-kit.njk` (не попадает в production-меню) для визуального контроля всех компонентов
- [ ] Компоненты в `src/_includes/components/`:
  - [ ] `header.njk`:
    - [ ] Логотип слева (имя/фамилия или монограмма)
    - [ ] Навигация по центру (5 разделов: Обо мне / Обучение / Абитуриенту / Воспитание / Контакты)
    - [ ] Справа: переключатель тем (light/dark/vi) + иконка поиска
    - [ ] Sticky (`position: sticky; top: 0`) с лёгкой тенью при скролле
    - [ ] Мобильная версия: гамбургер-меню, открывается фуллскрин-оверлеем
  - [ ] `footer.njk`:
    - [ ] 3 колонки на desktop (Контакты / Разделы / Государственные ресурсы)
    - [ ] 1 колонка на mobile
    - [ ] Копирайт внизу
    - [ ] Ссылки на: ГБПОУ РО «СИТ», Минпросвещения, Рособразование, Минтруд, Роструд и др. (использовать иконки из `old/new-stack/site/assets/images/ikonccilki/`)
    - [ ] Ссылка на политику конфиденциальности
  - [ ] `nav-burger.njk`:
    - [ ] Доступная разметка (`aria-expanded`, `aria-controls`)
    - [ ] Закрытие по `Esc`
    - [ ] Фокус-ловушка
  - [ ] `card.njk`:
    - [ ] Props: `category`, `title`, `description`, `link`, `image` (optional)
    - [ ] Hover: `border-color: --color-primary` + тень
    - [ ] Минимальная кликабельная зона 44×44px
  - [ ] `button.njk`:
    - [ ] Варианты: `primary`, `accent`, `secondary`, `ghost`
    - [ ] Минимальная высота 44px
    - [ ] `:focus-visible` с outline 3px
  - [ ] `theme-switcher.njk`:
    - [ ] 3 кнопки: light ☀ / dark 🌙 / vi ♿
    - [ ] Активная — `--color-primary`
    - [ ] Сохранение в `cookie` + `localStorage` (см. `old/DESIGN.md` §8.2)
  - [ ] `a11y-panel.njk`:
    - [ ] Регулировка размера шрифта: A- / A / A+
    - [ ] Кнопка «Без изображений»
    - [ ] Кнопка «Обычный шрифт»
    - [ ] Кнопка «Сбросить всё»
  - [ ] `breadcrumb.njk` — хлебные крошки с микроразметкой schema.org
  - [ ] `section-divider.njk` — прямой или волнистый разделитель (по `old/DESIGN.md` §3.5)
  - [ ] `badge.njk` — бейдж категории (используется в карточках)
  - [ ] `contact-form.njk`:
    - [ ] Форма обратной связи через внешний сервис (Formspree / Web3Forms / Formspark)
    - [ ] Поля: имя, email, сообщение
    - [ ] Honeypot-поле от спама
    - [ ] `<label>` для каждого поля
    - [ ] `aria-describedby` для ошибок

### 3.3 Сборка прототипа главной страницы (index.njk)

- [ ] Создать `src/content/index.njk` с использованием утверждённых компонентов:
  - [ ] **Hero-блок**:
    - [ ] Приветствие «Бардаков Дмитрий Николаевич»
    - [ ] Подзаголовок: «Преподаватель Сальского индустриального техникума»
    - [ ] Краткое описание (1–2 предложения)
    - [ ] CTA-кнопки: «Обо мне» (primary) + «Связаться» (secondary)
  - [ ] **Цитата / педагогическое кредо**:
    - [ ] Крупная цитата с акцентным цветом
    - [ ] Подпись автора
  - [ ] **Сетка быстрых ссылок** (4 карточки):
    - [ ] Обо мне
    - [ ] Обучение
    - [ ] Абитуриенту
    - [ ] Воспитание
    - [ ] Каждая карточка с иконкой, заголовком, описанием и стрелкой «→»
  - [ ] **Блок о технике (опционально)**:
    - [ ] Логотип / название ГБПОУ РО «СИТ»
    - [ ] Ссылка на сайт техникума
  - [ ] **Контакты (краткая версия)**:
    - [ ] Email, телефон, адрес
    - [ ] Ссылка на полную страницу контактов
  - [ ] **Государственные ссылки** (footer — вынесен в layout)

### 3.4 Утверждение дизайна

- [ ] Запустить локальную сборку: `npm run dev`
- [ ] Проверить страницу на всех брейкпоинтах:
  - [ ] 360px (маленький мобильник)
  - [ ] 414px (iPhone Plus)
  - [ ] 768px (планшет)
  - [ ] 1024px (ноутбук)
  - [ ] 1280px (десктоп)
  - [ ] 1920px (большой экран)
- [ ] Проверить все 3 темы:
  - [ ] Light — контраст ≥ 4.5:1 для текста
  - [ ] Dark — контраст корректный, тени заменены разницей тонов
  - [ ] VI — чёрный фон, жёлтый акцент, крупный шрифт, нет теней/градиентов
- [ ] Проверить доступность:
  - [ ] Lighthouse Accessibility score ≥ 95
  - [ ] Tab-навигация работает, фокус виден
  - [ ] Все кликабельные зоны ≥ 44×44px
  - [ ] `prefers-reduced-motion` уважается
  - [ ] Нет FOUC при перезагрузке с сохранённой темой
- [ ] Проверить производительность:
  - [ ] Lighthouse Performance ≥ 90
  - [ ] Шрифты загружаются с `font-display: swap`
  - [ ] Нет внешних CDN (кроме аналитики Yandex.Metrika)
- [ ] 🌐 **Кроссбраузерная проверка** (отсутствие артефактов рендеринга):
  - [ ] **Chrome / Edge (Blink)** — baseline, референс
  - [ ] **Firefox (Gecko)** — проверить CSS-переменные, grid/flex, `aspect-ratio`, `gap` в flex
  - [ ] **Safari (WebKit)** — проверить `backdrop-filter`, `position: sticky`, `font-display: swap`, размеры шрифтов (Safari может рендерить крупнее), flexbox-баги
  - [ ] **Safari iOS** — проверить `100vh` (лучше использовать `100dvh`), тач-зоны ≥ 44×44px, `:hover` (не работает на тач-устройствах, нужен fallback)
  - [ ] Зафиксировать минимально поддерживаемые версии браузеров в `docs/browser-support.md` (например: последние 2 версии каждого крупного браузера)
  - [ ] Если найдены расхождения — добавить вендорные префиксы через `autoprefixer` или `@supports`
- [ ] ⏸ **Точка утверждения**: пользователь (заказчик) подтверждает, что дизайн замораживается
- [ ] Сделать скриншоты всех вариантов → сохранить в `docs/design-review/`
- [ ] Зафиксировать версию дизайн-системы в `src/_data/site.json` → `"designVersion": "1.0.0"`

**Definition of Done для Этапа 3:**
- [ ] Все токены определены в `tokens.css`
- [ ] UI-кит собран, страница-витрина работает
- [ ] Главная страница `index.njk` собирается из компонентов
- [ ] Дизайн утверждён пользователем (точка утверждения пройдена)
- [ ] Скриншоты сохранены в `docs/design-review/`
- [ ] Версия дизайн-системы зафиксирована
- [ ] Коммит `Этап 3: дизайн-система утверждена`

---

## 🔄 Этап 4. Определение видов страниц и архитектуры данных

**Цель:** Адаптировать контент под готовый дизайн. Зафиксировать список шаблонов и строгую спецификацию Frontmatter для будущей автоматизации (включая ИИ-агентов).

**Definition of Ready:**
- Этап 3 завершён (дизайн заморожен)

### 4.1 Финализация списка шаблонов страниц

- [ ] Создать `src/_includes/layouts/` с базовыми layout-ами:
  - [ ] `base.njk` — общий каркас (`<html>`, `<head>`, header, footer, тема)
  - [ ] `page.njk` — наследник `base.njk`, добавляет `<main>` с контентом
- [ ] Создать специализированные шаблоны в `src/_includes/layouts/`:
  - [ ] `page-about.njk` — Обо мне:
    - [ ] Hero с фото
    - [ ] Биография (текст + изображение)
    - [ ] Таймлайн (образование, карьера, достижения)
    - [ ] Блок «Методическая работа»
    - [ ] Блок «Хобби» (галерея с glightbox)
    - [ ] Блок «Достижения» (сетка грамот/сертификатов)
  - [ ] `page-education.njk` — Обучение:
    - [ ] Hero раздела
    - [ ] Сетка дисциплин (КИП, КСК, электромонтёр, ПМ.02)
    - [ ] Подсписки: лекции, практические работы
    - [ ] Ссылки на ЭОС (электронные образовательные среды)
  - [ ] `page-upbringing.njk` — Воспитание:
    - [ ] Педагогическое кредо (цитата)
    - [ ] Методические материалы (карточки)
    - [ ] Ссылки на «Разговоры о важном» (PDF из `assets/docs/razgovor/`)
    - [ ] Советы родителям и студентам
  - [ ] `page-contacts.njk` — Контакты:
    - [ ] Реквизиты (ФИО, должность, место работы)
    - [ ] График работы
    - [ ] Телефон, email, мессенджеры
    - [ ] Карта (Yandex.Maps embed)
    - [ ] Форма обратной связи (через Formspree)
  - [ ] `page-list.njk` — общий шаблон списка (для индексов разделов)
  - [ ] `page-article.njk` — общий шаблон статьи (для практических работ, лекций)
  - [ ] `404.njk` — кастомная страница 404:
    - [ ] Понятный текст «Страница не найдена»
    - [ ] Поиск по сайту (Pagefind)
    - [ ] Ссылки на главные разделы
- [ ] Создать `src/_data/page-types.json` со списком всех типов страниц и их метаданных

### 4.2 Разработка строгой спецификации Frontmatter

- [ ] Создать `docs/frontmatter-spec.md` с полным описанием обязательных и опциональных полей:
  
  **Обязательные поля (для всех страниц):**
  ```yaml
  ---
  title: "Заголовок страницы"        # string, 1-100 символов
  description: "Meta description"    # string, 50-160 символов (SEO)
  layout: page.njk                    # один из определённых в layouts/
  date: 2026-10-08                    # ISO 8601, дата публикации/обновления
  ---
  ```
  
  **Опциональные поля:**
  ```yaml
  permalink: /custom/url/             # если нужен нестандартный URL
  section: obo-mne                    # раздел сайта (для хлебных крошек)
  order: 1                            # порядок в списке раздела
  heroImage: /assets/images/foo.webp  # главное изображение
  heroImageAlt: "Описание изображения"
  tags: [обучение, кип]               # теги для Pagefind
  noindex: false                      # true → <meta name="robots" content="noindex">
  changefreq: monthly                 # для sitemap.xml: always/hourly/daily/weekly/monthly/yearly/never
  priority: 0.8                       # для sitemap.xml: 0.0-1.0
  ---
  ```
  
  **Специфичные поля (по типам страниц):**
  
  - `page-about.njk`: `timeline: [...]` (массив событий), `credentials: [...]`
  - `page-education.njk`: `disciplines: [...]` (массив с name, link, icon)
  - `page-upbringing.njk`: `materials: [...]` (ссылки на PDF)
  - `page-contacts.njk`: `phone, email, address, workHours, mapEmbed`
  
- [ ] Создать JSON Schema в `docs/frontmatter.schema.json` для автоматической валидации в CI:
  - [ ] Использовать стандарт JSON Schema Draft 2020-12
  - [ ] Схема должна покрывать все поля из спецификации (обязательные и опциональные)
  - [ ] Добавить описание полей в `description` (для автодокументации и подсказок ИИ-агенту)
- [ ] Настроить скрипт валидации `scripts/validate-frontmatter.js`:
  - [ ] Использовать библиотеку **[`ajv`](https://www.npmjs.com/package/ajv)** (Another JSON Schema Validator) — это самый быстрый и стандартизованный валидатор JSON Schema для Node.js
  - [ ] Установить: `npm install --save-dev ajv ajv-formats`
  - [ ] Использовать `ajv-formats` для проверки форматов (date-time, uri, email)
  - [ ] Парсить frontmatter из Markdown-файлов через `gray-matter` (или `js-yaml`)
  - [ ] Проверка обязательных полей (`title`, `description`, `layout`, `date`)
  - [ ] Проверка типов и форматов (дата — ISO 8601, description — длина 50–160 символов, permalink — валидный URL)
  - [ ] Проверка `layout` на существование файла в `src/_includes/layouts/`
  - [ ] Проверка `permalink` на уникальность (никаких дубликатов)
  - [ ] Вывод понятных ошибок с указанием файла и поля (для человека и ИИ-агента)
  - [ ] Код возврата ≠ 0 при любой ошибке (для блокировки CI)
- [ ] Добавить в `package.json`:
  - [ ] `"check:frontmatter": "node scripts/validate-frontmatter.js"`
  - [ ] Включить в `"test"` скрипт
- [ ] 🪝 **Настроить автоматический запуск через husky** (pre-commit hook):
  - [ ] Установить: `npm install --save-dev husky lint-staged`
  - [ ] Инициализировать: `npx husky init`
  - [ ] Создать `.husky/pre-commit`, запускающий валидацию только изменённых `.md` и `.njk` файлов:
    ```bash
    npx lint-staged
    ```
  - [ ] Настроить `lint-staged` в `package.json`:
    ```json
    "lint-staged": {
      "src/content/**/*.{md,njk}": "node scripts/validate-frontmatter.js --staged"
    }
    ```
  - [ ] Добавить поддержку флага `--staged` в `validate-frontmatter.js` (через `lint-staged` получает список файлов)
  - [ ] Проверить, что коммит блокируется при невалидном frontmatter
  - [ ] Документировать в `docs/CONTRIBUTING.md`: «Перед коммитом автоматически проверяется frontmatter — если валидация упадёт, коммит будет отклонён»

### 4.3 Архитектура данных для навигации

- [ ] Создать `src/_data/site.json`:
  ```json
  {
    "name": "Бардаков Дмитрий Николаевич",
    "title": "Бардаков.рф — персональный сайт преподавателя",
    "description": "...",
    "url": "https://бардаков.рф",
    "author": "Бардаков Дмитрий Николаевич",
    "designVersion": "1.0.0",
    "language": "ru",
    "metrikaId": "<ID из Yandex.Metrika>"
  }
  ```
- [ ] Создать `src/_data/navigation.json`:
  - [ ] Главное меню (5 пунктов с icon, title, url)
  - [ ] Подменю для каждого раздела (если есть)
  - [ ] Футер-меню
- [ ] Создать `src/_data/contacts.json` — все контактные данные
- [ ] Создать `src/_data/government-links.json` — массив ссылок на гос. ресурсы с путями к иконкам

**Definition of Done для Этапа 4:**
- [ ] Все layout-ы созданы и доступны
- [ ] `docs/frontmatter-spec.md` написан и согласован
- [ ] JSON Schema для frontmatter создана
- [ ] Скрипт валидации frontmatter работает (`npm run check:frontmatter` проходит)
- [ ] Файлы данных (`site.json`, `navigation.json`, `contacts.json`, `government-links.json`) заполнены
- [ ] Коммит `Этап 4: шаблоны и спецификация frontmatter готовы`

---

## 🟦 Этап 5. Наполнение контентом и оптимизация

**Цель:** Перенести весь контент из `migration-source/` в новые шаблоны с соблюдением спецификации frontmatter, оптимизировать медиа и подготовить редиректы.

**Definition of Ready:**
- Этап 4 завершён
- Контент выгружен в `migration-source/` (из Этапа 1)

### 5.1 Миграция текстов

- [ ] Создать страницы по разделам:
  
  **Раздел «Обо мне» (5 страниц):**
  - [ ] `src/content/obo-mne/index.njk` — раздел-оглавление
  - [ ] `src/content/obo-mne/biografiya.md` — биография
  - [ ] `src/content/obo-mne/metodicheskaya-rabota.md` — методическая работа
  - [ ] `src/content/obo-mne/dostizheniya.md` — достижения (грамоты, сертификаты)
  - [ ] `src/content/obo-mne/khobbi.md` — хобби (с галереей glightbox)
  - [ ] `src/content/obo-mne/kontakty.md` — контакты (или отдельный раздел)
  
  **Раздел «Обучение» (16 страниц):**
  - [ ] `src/content/obuchenie/index.njk` — оглавление раздела
  - [ ] `src/content/obuchenie/kip/index.njk` — КИП (контрольно-измерительные приборы)
  - [ ] `src/content/obuchenie/kip/prakticheskie-kip/` — 9 практических работ (`prakticheskaya-rabota-no1.md` ... `no9.md`)
  - [ ] `src/content/obuchenie/ksk.md` — компьютерные системы и комплексы
  - [ ] `src/content/obuchenie/elektromonter.md` — электромонтёр
  - [ ] `src/content/obuchenie/pm02/lektsii/index.md` — лекции ПМ.02
  - [ ] `src/content/obuchenie/pm02/lektsii/razdel-1.md` — раздел 1 лекций
  
  **Раздел «Абитуриенту» (12 страниц):**
  - [ ] `src/content/abiturientu/index.njk` — оглавление
  - [ ] `src/content/abiturientu/professii/index.njk` — список профессий
  - [ ] 6 страниц профессий:
    - [ ] `15-01-31-master-kip.md`
    - [ ] `prodavets-kontroler-kassir.md`
    - [ ] `13-01-10-elektromonter.md`
    - [ ] `43-01-09-povar-konditer.md`
    - [ ] `08-01-07-master-obshchestroitelnykh-rabot.md`
    - [ ] `15-01-05-svarshchik.md`
  - [ ] `src/content/abiturientu/spetsialnosti/index.njk` — список специальностей
  - [ ] 2 страницы специальностей:
    - [ ] `kompyuternye-sistemy-i-kompleksy.md`
    - [ ] `ekonomika-i-bukhgalterskij-uchet.md`
  - [ ] `src/content/abiturientu/dokumentatsiya.md` — документация
  
  **Раздел «Воспитание» (10 страниц):**
  - [ ] `src/content/vospitanie/index.njk` — оглавление
  - [ ] `src/content/vospitanie/dlya-roditelej.md` — для родителей
  - [ ] `src/content/vospitanie/dlya-roditelej/` — 6 статей:
    - [ ] `nuzhno-li-obsuzhdat-s-rebenkom-temu-alkogolya-i-narkotikov.md`
    - [ ] `yuridicheskaya-otvetstvennost.md`
    - [ ] `16-vazhnykh-pravil-pro-eto.md`
    - [ ] `kak-pomoch-podrostku-spravlyatsya-so-stressom.md`
    - [ ] `prakticheskie-sovety-roditelyam-vo-vremya-ekzamena.md`
    - [ ] `kak-ne-dopustit-suitsid-u-podrostka.md`
  - [ ] `src/content/vospitanie/razgovory-o-vazhnom.md` — разговоры о важном (30+ PDF)
  - [ ] `src/content/vospitanie/prakticheskie-sovety-studentam.md`
  
  **Прочее:**
  - [ ] `src/content/search.njk` — страница поиска Pagefind
  - [ ] `src/content/404.njk`
  - [ ] `src/content/robots.txt` (или через Eleventy template)
  - [ ] `src/content/sitemap.xml.njk` — генерация sitemap
- [ ] Для каждой страницы:
  - [ ] Заполнить frontmatter по спецификации (Этап 4)
  - [ ] Перенести текст из `migration-source/content/`
  - [ ] Проверить уникальность `permalink`
  - [ ] Проставить `tags` для поиска
  - [ ] Указать `section` для хлебных крошек
- [ ] Прогнать `npm run check:frontmatter` — все страницы должны пройти

### 5.2 Оптимизация медиа

- [ ] Скопировать все изображения из `old/new-stack/site/assets/images/` в `src/assets/images/`
- [ ] Конвертация в WebP:
  - [ ] Настроить `eleventy-img` или скрипт на `sharp` в `scripts/optimize-images.js`
  - [ ] Для каждого изображения создать:
    - [ ] `.webp` (основной формат)
    - [ ] `.webp` с уменьшенным разрешением для retina (2x)
    - [ ] Сохранить оригинал как fallback (для очень старых браузеров — `<1%`)
  - [ ] Размеры для адаптивности: 360, 640, 1024, 1920px
- [ ] В шаблонах использовать `<picture>` с `source srcset`:
  ```html
  <picture>
    <source type="image/webp" srcset="img-360.webp 360w, img-640.webp 640w" sizes="100vw">
    <img src="img-640.webp" width="640" height="480" alt="..." loading="lazy">
  </picture>
  ```
- [ ] Проставить для каждого изображения:
  - [ ] `alt` — осмысленное описание (для скринридеров и SEO)
  - [ ] `width` и `height` (для предотвращения layout shift)
  - [ ] `loading="lazy"` (кроме выше-the-fold изображений)
  - [ ] `decoding="async"`
- [ ] Скопировать все PDF/DOCX документы в `src/assets/docs/`:
  - [ ] `obuchenie/` — учебные материалы
  - [ ] `vospitanie/` — нормативные документы
  - [ ] `razgovor/` — 30+ PDF «Разговоры о важном»
- [ ] Оптимизировать PDF (если есть тяжёлые):
  - [ ] Сжать через `ghostscript` или `qpdf`
  - [ ] Проверить, что текст выделяется (не сканы)
- [ ] Favicon:
  - [ ] Создать набор иконок: `favicon.ico`, `favicon-16x16.png`, `favicon-32x32.png`, `apple-touch-icon.png` (180×180), `android-chrome-192x192.png`, `android-chrome-512x512.png`
  - [ ] Создать `site.webmanifest`
  - [ ] Прописать все размеры в `<head>`

### 5.3 Подготовка правил редиректов

- [ ] На основе `src/_data/redirects.csv` (из Этапа 1) составить `.htaccess`:
  - [ ] Один редирект на строку: `Redirect 301 /old-url https://бардаков.рф/new-url`
  - [ ] Групповые редиректы для целых разделов (если структура изменилась)
  - [ ] Редирект с `index.php` на чистый URL
  - [ ] Редирект с www на без www (или наоборот)
  - [ ] Редирект с HTTP на HTTPS
- [ ] Создать `src/_data/redirects.json` (для CI-проверки уникальности)
- [ ] Создать `docs/redirects.md` с пояснениями по каждому нетривиальному редиректу
- [ ] Сохранить готовый `.htaccess` в `public/.htaccess` (чтобы попал на хостинг)

**Definition of Done для Этапа 5:**
- [ ] Все 49+ страниц созданы с корректным frontmatter
- [ ] `npm run check:frontmatter` проходит без ошибок
- [ ] Все изображения в WebP с alt и width/height
- [ ] Все PDF/DOCX перенесены в `assets/docs/`
- [ ] `.htaccess` с редиректами готов
- [ ] Поиск Pagefind индексирует все страницы
- [ ] Коммит `Этап 5: контент мигрирован и оптимизирован`

---

## 🟦 Этап 6. Очистка репозитория (Production-ready)

**Цель:** Оставить в репозитории только то, что нужно для работы и поддержки. Удалить временные файлы, миграционные скрипты и архивы.

**Definition of Ready:**
- Этап 5 завершён
- Сайт собирается и работает локально
- Резервная копия `old/` сделана локально (вне репозитория)

### 6.1 Архивация старого

- [ ] Создать отдельную ветку `archive-joomla` от текущего `main` (где `old/` ещё есть):
  ```bash
  git branch archive-joomla
  git push origin archive-joomla
  ```
- [ ] Сделать локальный tar.gz-архив `old/` и сохранить вне репозитория (например, на Яндекс.Диск / Google Drive):
  ```bash
  tar -czf ~/backups/bardakov.rf-old-$(date +%Y%m%d).tar.gz old/
  ```
- [ ] ⚠️ После подтверждения, что резервная копия сделана и ветка `archive-joomla` запушена:
  - [ ] Удалить папку `old/` из `main`:
    ```bash
    git rm -r old/
    ```
  - [ ] Удалить записи `old/...` из `.gitignore` (больше не нужны)
- [ ] Удалить папку `migration-source/` (контент уже в `src/content/`):
  ```bash
  git rm -r migration-source/
  ```
- [ ] В `README.md` добавить ссылку на ветку `archive-joomla` и пояснение, что старый код там

### 6.2 Удаление мусора

- [ ] Удалить временные файлы:
  - [ ] `docs/design-review/` (если скриншоты не нужны в production)
  - [ ] Любые `*.bak`, `*.tmp`, `*.old` файлы
  - [ ] Папки `.vscode/`, `.idea/` (если случайно попали)
- [ ] Удалить миграционные скрипты (после успешной миграции):
  - [ ] `scripts/migrate-from-joomla.js` (если был)
  - [ ] `scripts/export-content.js` (если был)
- [ ] Удалить дубликаты изображений (если при оптимизации создавались временные)
- [ ] Проверить, что нет неиспользуемых зависимостей:
  - [ ] Запустить `npx depcheck`
  - [ ] Удалить неиспользуемые пакеты из `package.json`

### 6.3 Финализация .gitignore

- [ ] Проверить, что `.gitignore` содержит как минимум:
  ```gitignore
  # Dependencies
  node_modules/
  package-lock.json  # спорно — обычно коммитят, обсудить
  
  # Build output
  public/
  .cache/
  .eleventy-cache/
  
  # Environment
  .env
  .env.local
  .env.*.local
  
  # IDE & OS
  .vscode/
  .idea/
  .DS_Store
  Thumbs.db
  
  # Logs
  *.log
  npm-debug.log*
  
  # Pagefind index (если генерируется в public/, то уже покрыто)
  ```
- [ ] Принять решение по `package-lock.json`:
  - **Рекомендация:** коммитить, для воспроизводимости в CI
  - Если коммитим — удалить из `.gitignore`
- [ ] Удалить все упоминания `old/` из `.gitignore` (после удаления папки на Этапе 6.1)

### 6.4 Обновление README.md

- [ ] Создать лаконичный `README.md` в корне со структурой:
  ```markdown
  # Бардаков.рф
  
  Персональный сайт преподавателя Бардакова Дмитрия Николаевича.
  
  ## Технологии
  - Eleventy (статический генератор)
  - Nunjucks (шаблонизатор)
  - Bootstrap 5.3
  - Pagefind (поиск)
  - Self-hosted шрифты (Inter, Manrope)
  
  ## Установка
  ```bash
  git clone https://github.com/DimaNikolaevi4/bardakov.rf.git
  cd bardakov.rf
  npm install
  ```
  
  ## Команды
  | Команда | Описание |
  |---|---|
  | `npm run dev` | Локальная разработка с hot-reload |
  | `npm run build` | Production-сборка в `public/` |
  | `npm run pagefind` | Индексация поиска |
  | `npm test` | Сборка + линт + проверка ссылок |
  
  ## Структура
  - `src/` — исходники (контент, шаблоны, стили)
  - `public/` — результат сборки (gitignored)
  - `docs/` — документация
  
  ## Добавление новой страницы (для ИИ-агента)
  1. Создай файл в `src/content/<раздел>/<slug>.md`
  2. Заполни frontmatter по спецификации `docs/frontmatter-spec.md`
  3. Запусти `npm run check:frontmatter` для валидации
  4. Запусти `npm run dev` для предпросмотра
  5. Сделай коммит и PR
  
  ## Архив
  Старая версия на Joomla 5 — в ветке `archive-joomla`.
  ```
- [ ] Создать `docs/CONTRIBUTING.md` с подробной инструкцией для контрибьюторов (и ИИ-агента)
- [ ] Создать `docs/frontmatter-spec.md` (если ещё не создан на Этапе 4)
- [ ] Обновить `LICENSE` (если нужно)

**Definition of Done для Этапа 6:**
- [ ] Ветка `archive-joomla` создана и запушена
- [ ] Локальный tar.gz-архив сделан
- [ ] Папка `old/` удалена из `main`
- [ ] Временные файлы и миграционные скрипты удалены
- [ ] `.gitignore` финализирован
- [ ] `README.md` написан и содержит инструкцию для ИИ-агента
- [ ] `depcheck` не находит неиспользуемых зависимостей
- [ ] Коммит `Этап 6: репозиторий очищен и готов к production`

---

## 🟦 Этап 7. Тестирование и Деплой

**Цель:** Провести финальное тестирование и выгрузить сайт на хостинг Beget, настроить редиректы и проверить работу в production.

**Definition of Ready:**
- Этап 6 завершён
- Доступ к хостингу Beget (FTP/SSH)
- Доступ к домену `бардаков.рф` (DNS-записи)

### 7.1 Локальное тестирование

- [ ] Запустить `npm run build` — сборка должна пройти без ошибок
- [ ] Проверить, что `public/` содержит все ожидаемые файлы:
  - [ ] `index.html`
  - [ ] Все страницы разделов (49+ HTML-файлов)
  - [ ] `assets/css/`, `assets/js/`, `assets/fonts/`, `assets/images/`, `assets/docs/`
  - [ ] `robots.txt`, `sitemap.xml`, `favicon.ico`, `site.webmanifest`
  - [ ] `pagefind/` (индекс поиска)
  - [ ] `.htaccess` (если хостинг Beget поддерживает Apache)
- [ ] Открыть `public/` через локальный сервер:
  ```bash
  npx serve public
  ```
- [ ] Проверить адаптивность на реальных устройствах:
  - [ ] iPhone SE (375px)
  - [ ] iPhone 12 Pro (390px)
  - [ ] iPad (768px)
  - [ ] MacBook Air 13" (1280px)
  - [ ] Внешний монитор 24" (1920px)
- [ ] Проверить тёмную тему:
  - [ ] Все блоки корректно переключаются
  - [ ] Контраст текста ≥ 4.5:1
  - [ ] Изображения не «выжигают» (если нужно — `filter: brightness(0.9)`)
- [ ] Проверить VI-режим:
  - [ ] Шрифт увеличен в 1.5×
  - [ ] Изображения отключаются кнопкой
  - [ ] Все кликабельные зоны ≥ 56×56px
  - [ ] Анимации отключены
- [ ] Проверить поиск Pagefind:
  - [ ] Поиск по русским словам работает
  - [ ] Подсветка результатов корректная
  - [ ] Пустой запрос не возвращает ошибку
- [ ] Проверить форму обратной связи:
  - [ ] Отправка тестового письма через Formspree работает
  - [ ] Валидация полей срабатывает
  - [ ] Honeypot блокирует ботов
- [ ] Проверить все внутренние ссылки (через `npm run check:links`)
- [ ] Проверить все внешние ссылки на gov. ресурсы
- [ ] Проверить метаданные:
  - [ ] `<title>` уникальный на каждой странице
  - [ ] `<meta description>` 50-160 символов
  - [ ] Open Graph теги (`og:title`, `og:description`, `og:image`)
  - [ ] `<html lang="ru">`

### 7.2 Запуск CI-проверок

- [ ] Создать `.github/workflows/ci.yml`:
  ```yaml
  name: CI
  on: [push, pull_request]
  jobs:
    test:
      runs-on: ubuntu-latest
      steps:
        - uses: actions/checkout@v4
        - uses: actions/setup-node@v4
          with:
            node-version: '20'
        - run: npm ci
        - run: npm run check:frontmatter
        - run: npm run build
        - run: npm run lint:html
        - run: npm run check:links
  ```
- [ ] Убедиться, что GitHub Actions проходят (зелёный статус на значке)
- [ ] Если есть провалы — исправить до зелёного

### 7.3 Настройка деплоя

- [ ] 🔑 **Настроить SSH-ключ для беспарольного доступа к Beget** (обязательно для rsync):
  - [ ] Сгенерировать SSH-ключ (если ещё нет):
    ```bash
    ssh-keygen -t ed25519 -C "deploy@bardakov.rf" -f ~/.ssh/bardakov_deploy
    ```
  - [ ] ⚠️ Приватный ключ `~/.ssh/bardakov_deploy` **никогда** не должен попасть в репозиторий (проверить `.gitignore`)
  - [ ] Зайти в панель управления Beget → раздел **«SSH доступ»** (или «SSH-ключи»)
  - [ ] Добавить содержимое публичного ключа `~/.ssh/bardakov_deploy.pub` в форму
  - [ ] Дождаться активации ключа (обычно до 15 минут)
  - [ ] Проверить подключение:
    ```bash
    ssh -i ~/.ssh/bardakov_deploy user@server.beget.com "echo OK"
    ```
  - [ ] При необходимости добавить конфиг в `~/.ssh/config`:
    ```
    Host bardakov-beget
      HostName server.beget.com
      User your_username
      IdentityFile ~/.ssh/bardakov_deploy
      IdentitiesOnly yes
    ```
  - [ ] Для GitHub Actions: добавить приватный ключ как Repository Secret `DEPLOY_SSH_KEY` (Settings → Secrets and variables → Actions)
- [ ] Создать `scripts/deploy.sh`:
  ```bash
  #!/bin/bash
  set -e
  
  echo "Сборка проекта..."
  npm run build
  
  echo "Деплой на Beget..."
  # Через rsync по SSH (рекомендуется, требует настроенный SSH-ключ — см. выше)
  rsync -avz --delete \
    -e "ssh -i ~/.ssh/bardakov_deploy -o StrictHostKeyChecking=no" \
    public/ user@server.beget.com:~/bardakov.rf/public_html/
  
  # Или через FTP (fallback, если rsync недоступен)
  # lftp -c "open ftp://user:pass@server; mirror -R public/ ~/bardakov.rf/public_html/"
  
  echo "Готово!"
  ```
- [ ] Сделать скрипт исполняемым: `chmod +x scripts/deploy.sh`
- [ ] Создать `.env.example` с переменными окружения для деплоя (без секретов):
  ```
  DEPLOY_HOST=server.beget.com
  DEPLOY_USER=your_username
  DEPLOY_PATH=~/bardakov.rf/public_html/
  DEPLOY_SSH_KEY_PATH=~/.ssh/bardakov_deploy
  ```
- [ ] Добавить `.env` в `.gitignore`
- [ ] ⚠️ Зафиксировать в `docs/deploy.md`: «Приватный SSH-ключ хранится только локально (и в GitHub Secrets для CI). Никогда не коммитить.»
- [ ] Опционально: настроить автодеплой через GitHub Actions при пуше в `main`:
  - [ ] Использовать секрет `DEPLOY_SSH_KEY` в workflow
  - [ ] Шаг деплоя: `appleboy/ssh-action` или напрямую `rsync` через `easingthemes/ssh-deploy`

### 7.4 Финальный релиз

- [ ] Сделать резервную копию текущего сайта на хостинге:
  ```bash
  ssh user@server "tar -czf ~/backups/bardakov.rf-old-$(date +%Y%m%d).tar.gz ~/bardakov.rf/public_html/"
  ```
- [ ] ⚠️ **Точка невозврата**: запустить `./scripts/deploy.sh`
- [ ] Проверить работу сайта по основному домену `https://бардаков.рф`:
  - [ ] Главная страница открывается
  - [ ] Все разделы доступны
  - [ ] Поиск работает
  - [ ] Форма обратной связи работает
  - [ ] Аналитика Yandex.Metrika получает события
- [ ] Проверить редиректы:
  - [ ] Старые URL Joomla редиректят на новые (проверить 5-10 ключевых)
  - [ ] `http://` → `https://`
  - [ ] `www.` → без www (или наоборот)
- [ ] Прогнать проверку через Yandex.Webmaster:
  - [ ] Загрузить новый `sitemap.xml`
  - [ ] Проверить, что нет ошибок индексации
  - [ ] Отследить, что старые URL помечаются как «редирект»
- [ ] Прогнать проверку через Google Search Console (если сайт там добавлен)
- [ ] Проверить Lighthouse в production:
  - [ ] Performance ≥ 90
  - [ ] Accessibility ≥ 95
  - [ ] Best Practices ≥ 90
  - [ ] SEO ≥ 90
- [ ] Создать Git-тег релиза:
  ```bash
  git tag -a v2.0.0 -m "Релиз новой версии сайта на Eleventy"
  git push origin v2.0.0
  ```
- [ ] Создать `CHANGELOG.md` с описанием изменений:
  ```markdown
  # Changelog
  
  ## [2.0.0] - 2026-MM-DD
  
  ### Added
  - Новая архитектура на Eleventy
  - Тёмная тема и режим для слабовидящих
  - Поиск Pagefind
  - Оптимизация изображений в WebP
  
  ### Removed
  - Joomla 5 (см. ветку archive-joomla)
  
  ### Migrated
  - 49 страниц контента
  - Все PDF и DOCX документы
  ```

**Definition of Done для Этапа 7:**
- [ ] Все локальные тесты пройдены
- [ ] CI в GitHub Actions зелёный
- [ ] Скрипт деплоя создан и протестирован
- [ ] Резервная копия старого сайта на хостинге сделана
- [ ] Сайт выгружен на `бардаков.рф`
- [ ] Все редиректы работают (проверено вручную)
- [ ] Yandex.Webmaster видит новый `sitemap.xml`
- [ ] Lighthouse в production соответствует требованиям
- [ ] Git-тег `v2.0.0` создан и запушен
- [ ] `CHANGELOG.md` обновлён
- [ ] Коммит `Этап 7: релиз v2.0.0`

---

## 📊 Сводный прогресс

| Этап | Статус | Дата завершения |
|---|---|---|
| 1. Ревизия и аудит | 🟡 В процессе | — |
| 2. Подготовка стека | ⏳ Ожидает | — |
| 3. Дизайн-система | ⏳ Ожидает | — |
| 4. Шаблоны и frontmatter | ⏳ Ожидает | — |
| 5. Наполнение контентом | ⏳ Ожидает | — |
| 6. Очистка репозитория | ⏳ Ожидает | — |
| 7. Тестирование и деплой | ⏳ Ожидает | — |

**Общий прогресс:** 0 / 7 этапов завершено

---

## 🔗 Полезные ссылки

- Репозиторий: https://github.com/DimaNikolaevi4/bardakov.rf
- Ветка с архивом Joomla: https://github.com/DimaNikolaevi4/bardakov.rf/tree/archive-joomla (после создания на Этапе 6)
- Дизайн-система (архив): [`old/DESIGN.md`](old/DESIGN.md)
- Старый чек-лист (архив): [`old/CHECKLIST.md`](old/CHECKLIST.md)
- Хостинг: Beget (https://beget.com)
- Домен: `бардаков.рф`

---

## 📝 Журнал изменений чек-листа

- **2026-10-08** — Создан подробный чек-лист на основе дорожной карты миграции
- **2026-10-08 (rev 2)** — Точечные улучшения по ревью:
  - `package-lock.json` исключён из `.gitignore` (Этап 1.1) и зафиксирован как обязательный к коммиту (Этап 6.3) — гарантия воспроизводимости сборок в CI/CD
  - Добавлен пункт про SSH-ключ для Beget в Этап 7.3 — обязателен для работы rsync по SSH (публичный ключ добавляется в панели Beget → раздел «SSH доступ»)
  - Добавлен пункт про анализ старых `.htaccess` и `robots.txt` с живого сайта в Этап 1.3 — перенос полезных правил (ЧПУ, защиты, кэширование, Disallow и т.д.)
  - Добавлена кроссбраузерная проверка в Этап 3.4 — Chrome (Blink), Firefox (Gecko), Safari (WebKit) + Safari iOS, фикс минимальных версий в `docs/browser-support.md`
  - Уточнена автоматизация проверки frontmatter в Этап 4.2 — `ajv` + `ajv-formats` для JSON Schema Draft 2020-12, `gray-matter` для парсинга, `husky` + `lint-staged` для pre-commit хука

---

*Последнее обновление: 2026-10-08*
