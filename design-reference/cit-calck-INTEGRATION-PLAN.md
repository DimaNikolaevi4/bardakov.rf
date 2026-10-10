# Анализ репозитория cit-calck.rf и план интеграции

> **Источник:** https://github.com/DimaNikolaevi4/cit-calck.rf (клонирован в `/home/z/my-project/cit-calck.rf`)
> **Дата анализа:** 2026-10-10
> **Цель:** Взять за основу верхнее меню и архитектуру сit-calck.rf, адаптировав под:
> - Наш дизайн «Золотой день / Ночное небо» (палитра, шрифты, фон с формулами)
> - Наш контент (персональный сайт преподавателя, не сайт техникума)
> - Наши 5 разделов: Обо мне / Обучение / Абитуриенту / Воспитание / Контакты

---

## 📊 Что в cit-calck.rf

### Стек
- **Eleventy** (как у нас)
- **Bootstrap 5** (как у нас) + Bootstrap Icons
- **AOS** (анимации) + **GLightbox** (лайтбокс)
- **Lunr.js** для поиска (со stemming для русского)
- **Netlify CMS** в `src/admin/` (редактирование контента через web-интерфейс)

### Архитектура
- 6 layout-ов: `base.njk`, `page.njk`, `page-full.njk`, `post.njk`, `listing.njk`, `svedenija-page.njk`
- 9 компонентов: `header.njk`, `footer.njk`, `hero.njk`, `about.njk`, `news.njk`, `sidebar.njk`, `breadcrumbs.njk`, `popular.njk`
- 4 partial-компонента: `card.njk`, `anti-corruption-content.njk`, `related.njk`, `pagination.njk`, `share.njk`

### Контент
- **11 пунктов главного меню** с дочерними
- **9 рубрик** верхнего уровня (`rubrics.yaml`)
- Новости, теги, поиск, sitemap, robots.txt
- Категории: абитуриентам, выпускникам, общественное мнение

---

## 🎯 Ключевые элементы для переноса

### 1. Header (главное меню)

**Файл:** `cit-calck-reference/header.njk` (404 строки)

**Структура:**
```
┌──────────────────────────────────────────────────────────────┐
│ [Logo]   [📋 Сведения] [🎓 Абитуриентам] [💻 ЭОС] [📞 Phone]  │
│                                          [VK][✉][🔍][👁][🌙]  │
│                                          [☰ Все разделы]      │
└──────────────────────────────────────────────────────────────┘
```

**Особенности:**
- 5 пунктов в десктоп-навигации (с show/hide по брейкпоинтам `d-none d-xl-flex`)
- 5 иконок-действий: ВКонтакте, Email, Поиск, A11y, Dark-theme
- Отдельная кнопка "Все разделы" (offcanvas-toggle)
- Мобильный бургер (открывает offcanvas)

**Адаптация под наш сайт:**
- Убрать пункт «ЭОС» (нет образовательной системы)
- Убрать телефон (нет публичного номера)
- Заменить логотип техникума на монограмму «БД» из design-reference
- 5 пунктов меню: Обо мне / Обучение / Абитуриенту / Воспитание / Контакты

---

### 2. Search Modal (модальное окно поиска)

**Файл:** `cit-calck-reference/header.njk` (строки 127–186)

**2 секции поиска:**
1. **Поиск по разделам** — `<select>` с деревом всех рубрик (3 уровня вложенности, с отступами `&nbsp;`)
2. **Поиск по фразам** — input + кнопка «Найти» + мгновенные результаты (instant search через lunr.js)

**Преимущества:**
- Пользователь может быстро выбрать раздел из списка
- Мгновенный поиск без перезагрузки страницы
- Lunr.js с русской морфологией (lunr.ru.js + stemmer)

**Перенос:**
- ✅ Скопировать структуру search-modal.njk
- ✅ Использовать Pagefind вместо Lunr.js (уже установлен)
- ✅ Адаптировать рубрики под наши 5 разделов

---

### 3. Offcanvas (мобильное меню, 3 уровня)

**Файл:** `cit-calck-reference/header.njk` (строки 188–380)

**3-уровневая навигация:**
- **Панель 1** (`#ocPanel1`): список рубрик 1-го уровня + иконки действий (только мобильные)
- **Панель 2** (`#ocPanel2`): подразделы выбранной рубрики (заполняется через JS)
- **Панель 3** (`#ocPanel3`): под-подразделы (заполняется через JS)

**Скрипт:** `cit-calck-reference/offcanvas-nav.js` (410 строк)
- Чтение данных из `<script type="application/json" id="rubricsData">`
- Анимация сдвига панелей
- Хлебные крошки в заголовках панелей
- Закрытие по Esc / клику вне

**Преимущества:**
- Пользователь видит только 1 уровень за раз (не перегружен)
- Хлебные крошки показывают путь
- Кнопка «Открыть весь раздел» для перехода на страницу рубрики

---

### 4. Base Layout с Critical CSS

**Файл:** `cit-calck-reference/base.njk` (165 строк)

**Оптимизации производительности:**
1. **Critical CSS inline** — стили первого экрана прямо в `<head>` (через `criticalCSS` data)
2. **Async CSS** через preload+onload (паттерн filamentgroup loadCSS):
   ```html
   <link rel="preload" as="style" href="..." onload="this.onload=null;this.rel='stylesheet'">
   <noscript><link rel="stylesheet" href="..."></noscript>
   ```
3. **Все скрипты с `defer`** — не блокируют рендер
4. **JSON-LD Schema.org** — `EducationalOrganization` микроразметка
5. **Open Graph + Twitter Card** мета-теги
6. **PWA manifest** + theme-color
7. **FOUC protection** — inline-скрипт восстанавливает тему/a11y до рендера
8. **Scroll-to-top** кнопка

---

### 5. Rubrics YAML (дерево разделов)

**Файл:** `cit-calck-reference/rubrics.yaml` (287 строк)

**Структура:**
```yaml
main_rubrics:
  - code: "1"
    title: "АБИТУРИЕНТАМ"
    slug: abiturientam
    level: 0
    children:
      - code: "1.1"
        title: "Слово директора"
        slug: slovo-direktora
      - code: "1.2"
        title: "Специальности и профессии"
        slug: specialnosti
```

**Используется:**
- В header.njk для offcanvas-меню
- В search-modal.njk для select-списка
- В offcanvas-nav.js через `<script type="application/json" id="rubricsData">`

---

## 📋 План интеграции в наш проект

### Этап A: Подготовка данных (30 мин)

| # | Задача | Файл |
|---|---|---|
| A1 | Создать `rubrics.yaml` под наши 5 разделов | `src/_data/rubrics.yaml` |
| A2 | Обновить `menu.yaml` (главное меню) | `src/_data/menu.yaml` |
| A3 | Обновить `contacts.yaml` (только email) | `src/_data/contacts.yaml` |
| A4 | Создать `social.yaml` (ВК, почта) | `src/_data/social.yaml` |

**Наша структура рубрик (адаптированная):**
```yaml
main_rubrics:
  - code: "1"
    title: "Обо мне"
    slug: obo-mne
    children:
      - "1.1" Биография
      - "1.2" Методическая работа
      - "1.3" Достижения
      - "1.4" Хобби (Нейро Мульт Студия)
      - "1.5" Контакты

  - code: "2"
    title: "Обучение"
    slug: obuchenie
    children:
      - "2.1" КИП (контрольно-измерительные приборы)
      - "2.2" КСК (компьютерные системы и комплексы)
      - "2.3" Электромонтёр
      - "2.4" ПМ.02 Лекции
      - "2.5" Практические работы

  - code: "3"
    title: "Абитуриенту"
    slug: abiturientu
    children:
      - "3.1" Профессии (7 шт.)
      - "3.2" Специальности (2 шт.)
      - "3.3" Документация

  - code: "4"
    title: "Воспитание"
    slug: vospitanie
    children:
      - "4.1" Для родителей (6 статей)
      - "4.2" Разговоры о важном (30+ PDF)
      - "4.3" Советы студентам
      - "4.4" Нормативные документы

  - code: "5"
    title: "Поиск"
    slug: search
```

---

### Этап B: Перенос Header (1 час)

| # | Задача | Файл |
|---|---|---|
| B1 | Создать новый `header.njk` на основе cit-calck | `src/_includes/components/header.njk` |
| B2 | Адаптировать лого → монограмма «БД» из design-reference | внутри header.njk |
| B3 | 5 пунктов меню: Обо мне / Обучение / Абитуриенту / Воспитание / Контакты | внутри header.njk |
| B4 | 4 иконки: Email / Поиск / A11y / Dark-theme (убрать ВК — нет ссылки) | внутри header.njk |
| B5 | Кнопка «Все разделы» → offcanvas | внутри header.njk |
| B6 | Бургер для мобильных | внутри header.njk |

**Сохранить из нашего дизайна:**
- Палитра «Золотой день / Ночное небо»
- Sticky header с `backdrop-filter: blur(14px)`
- Логотип-монограмма «БД» в градиентном квадрате
- Inline SVG иконки (не Bootstrap Icons)

---

### Этап C: Перенос Search Modal (30 мин)

| # | Задача | Файл |
|---|---|---|
| C1 | Создать `search-modal.njk` на основе cit-calck | `src/_includes/components/search-modal.njk` |
| C2 | 2 секции: поиск по разделам + поиск по фразам | внутри search-modal.njk |
| C3 | Заменить Lunr.js на Pagefind (уже установлен) | внутри search-modal.njk |
| C4 | Дерево рубрик из `rubrics.yaml` | внутри search-modal.njk |

---

### Этап D: Перенос Offcanvas (1 час)

| # | Задача | Файл |
|---|---|---|
| D1 | Создать 3-уровневый offcanvas (Панель 1/2/3) | внутри header.njk |
| D2 | Скопировать и адаптировать `offcanvas-nav.js` | `src/assets/js/offcanvas-nav.js` |
| D3 | JSON с rubrics в `<script type="application/json">` | внутри header.njk |
| D4 | Хлебные крошки + кнопка «Открыть весь раздел» | внутри header.njk |
| D5 | Закрытие по Esc / клику вне | внутри offcanvas-nav.js |

---

### Этап E: Обновление Base Layout (30 мин)

| # | Задача | Файл |
|---|---|---|
| E1 | Добавить Critical CSS inline (стили первого экрана) | `src/_includes/layouts/base.njk` |
| E2 | Async CSS через preload+onload | внутри base.njk |
| E3 | JSON-LD Schema.org (Person вместо EducationalOrganization) | внутри base.njk |
| E4 | Open Graph + Twitter Card мета-теги | внутри base.njk |
| E5 | Scroll-to-top кнопка | внутри base.njk |
| E6 | FOUC protection (уже есть, проверить) | внутри base.njk |

---

### Этап F: Стили (1 час)

| # | Задача | Файл |
|---|---|---|
| F1 | Извлечь header-стили из `design-reference/style.css` | `src/styles/components.css` (секция header) |
| F2 | Добавить offcanvas-стили | `src/styles/components.css` (секция offcanvas) |
| F3 | Добавить search-modal-стили | `src/styles/components.css` (секция search) |
| F4 | Добавить scroll-top-стили | `src/styles/components.css` |
| F5 | Critical CSS (минимальный набор для первого экрана) | `src/styles/critical.css` (новый) |

---

### Этап G: Тестирование (30 мин)

| # | Задача |
|---|---|
| G1 | `npm run build` — без ошибок |
| G2 | `npm test` — lint + check-links проходят |
| G3 | Скриншоты 3 тем через Playwright |
| G4 | Проверка offcanvas на мобильном (360px) |
| G5 | Проверка search-modal (открывается, 2 секции) |
| G6 | VLM-анализ скриншотов |

---

## 🎨 Что сохраняем из design-reference

✅ **Палитра** «Золотой день / Ночное небо» (cream/light, deep-blue/dark, black/high-contrast)
✅ **3 шрифта:** Inter + Merriweather (цитаты) + Caveat (формулы на фоне)
✅ **Фон с 11 физическими формулами** (U=I·R, P=I²·R, Φ=B·S и др.)
✅ **Hero с SVG-многогранником** («Кристалл знаний»)
✅ **Карточки с glow-фонариком** + reveal-анимации
✅ **Sticky header с backdrop-filter: blur(14px)**
✅ **Логотип-монограмма «БД»** в градиентном квадрате
✅ **Reveal-анимации** через IntersectionObserver
✅ **Карточки с glow-эффектом** (mousemove → radial-gradient)

## 🆕 Что берём из cit-calck.rf

✅ **3-уровневый offcanvas** (Панель 1/2/3, заполнение через JS)
✅ **Search modal с 2 секциями** (по разделам + по фразам)
✅ **Critical CSS inline** в `<head>` (быстрый FCP)
✅ **Async CSS** через preload+onload
✅ **JSON-LD Schema.org** микроразметка
✅ **Open Graph + Twitter Card** мета-теги
✅ **Scroll-to-top** кнопка
✅ **Rubrics YAML** (дерево разделов с кодами 1/1.1/1.1.1)
✅ **offcanvas-nav.js** (логика 3-уровневой навигации)
✅ **search-modal.js** (логика мгновенного поиска)
✅ **init-components.js** (инициализация AOS, GLightbox и др.)

## ❌ Что НЕ переносим

- ❌ Пункт «ЭОС» (нет образовательной системы)
- ❌ Телефон в шапке (нет публичного номера)
- ❌ ВКонтакте (нет ссылки)
- ❌ EducationalOrganization Schema.org (заменить на Person)
- ❌ Lunr.js (заменить на Pagefind)
- ❌ Netlify CMS (пока не нужно)
- ❌ Пункты меню: Сведения / УМР / Сотрудничество / Безопасность / Студентам / Центр Карьеры / Профессионалы (не релевантны персональному сайту)

---

## 📊 Сравнение структур меню

| cit-calck.rf (13 пунктов) | bardakov.rf (5 пунктов) |
|---|---|
| Главная | Обо мне |
| О техникуме | — |
| Сведения об образовательной организации | — |
| Абитуриентам | Абитуриенту |
| Учебно-методическая работа | Обучение |
| Воспитание | Воспитание |
| Сотрудничество | — |
| Безопасность | — |
| Студентам и родителям | — |
| Центр Карьеры | — |
| Профессионалы-2026 | — |
| Новости | — |
| Контакты | Контакты |

---

## 🚀 Порядок выполнения

1. **Зафиксировать этот план в репозитории** ✅ (этот файл)
2. **Скопировать reference-файлы** ✅ (уже в `design-reference/cit-calck-reference/`)
3. **Этап A:** Создать rubrics.yaml + menu.yaml + contacts.yaml + social.yaml
4. **Этап B:** Перенести header.njk (адаптировать под наши 5 разделов)
5. **Этап C:** Перенести search-modal.njk (с Pagefind вместо Lunr)
6. **Этап D:** Перенести offcanvas + offcanvas-nav.js
7. **Этап E:** Обновить base.njk (Critical CSS, async CSS, JSON-LD, scroll-top)
8. **Этап F:** Обновить components.css (header + offcanvas + search-modal стили)
9. **Этап G:** Тестирование + скриншоты

---

*Документ создан: 2026-10-10*
*Источник: https://github.com/DimaNikolaevi4/cit-calck.rf*
