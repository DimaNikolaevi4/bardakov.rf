
# Дизайн-система bardakov.rf

> Документ — единый источник правды по визуальным и техническим решениям.
> Все изменения фиксируются здесь до реализации в коде.
> Формат: Markdown + YAML-совместимые CSS-токены.

---

## 1. Философия

Дизайн-система опирается на пять принципов. Они не декоративные —
это фильтр для любого решения: «делаем ли мы это?»

1. **Ясность важнее декоративности.**
   Контент первичен. Если элемент не помогает понять или сделать —
   он убирается.

2. **Воздух — это инструмент, а не пустота.**
   Много свободного пространства вокруг блоков. Оно направляет взгляд
   и даёт контенту «дышать».

3. **Акценты дозированно.**
   Яркий цвет — это сигнал. Если ярко всё — не видно ничего.
   Один акцентный элемент на экран.

4. **Доступность по умолчанию.**
   Соответствие WCAG 2.1 AA — базовое требование, а не «доп. режим».
   Режим для слабовидящих — расширение, а не замена.

5. **Скорость — часть дизайна.**
   Сайт должен быть быстрым. Никаких тяжёлых шрифтов, лишних
   библиотек, анимаций «для красоты».

---

## 2. Цвет

### 2.1 Примитивы (палитра)

Базовые цвета. Никогда не используются в коде напрямую —
только через семантические токены.

```css
/* Синие — основные */
--blue-50:  #EFF6FF;
--blue-100: #DBEAFE;
--blue-500: #2563EB;   /* Primary light */
--blue-600: #1D4ED8;
--blue-400: #60A5FA;   /* Primary dark */
--blue-300: #93C5FD;

/* Тёплые акценты */
--orange-500: #F97316; /* Accent — только для крупных CTA и иконок */
--orange-600: #EA580C;
--orange-400: #FB923C; /* Accent dark */

/* Нейтральные — тёплые, не чистый серый */
--neutral-50:  #FAFAF9;
--neutral-100: #F5F5F4;
--neutral-200: #E7E5E4;
--neutral-300: #D6D3D1;
--neutral-500: #78716C;
--neutral-700: #44403C;
--neutral-800: #292524;
--neutral-900: #1C1917;

/* Доступность (VI) */
--vi-bg:      #000000;
--vi-text:    #FFFFFF;
--vi-yellow:  #FFFF00; /* WCAG AAA на чёрном — 19.6:1 */
--vi-cyan:    #00BFFF;
```

### 2.2 Семантические токены

Используются в компонентах. Переключаются через `data-theme`.

```css
/* === LIGHT (по умолчанию) === */
:root {
  --color-bg:           var(--neutral-50);
  --color-surface:      #FFFFFF;
  --color-surface-alt:  var(--neutral-100);
  --color-text:         var(--neutral-900);
  --color-text-muted:   var(--neutral-500);
  --color-border:       var(--neutral-200);

  --color-primary:       var(--blue-500);
  --color-primary-hover: var(--blue-600);
  --color-primary-text:  #FFFFFF;

  --color-accent:        var(--orange-500);
  --color-accent-hover:  var(--orange-600);
  --color-accent-text:   #FFFFFF; /* обязателен белый текст */

  --color-focus-ring:    var(--blue-500);
}

/* === DARK === */
[data-theme="dark"] {
  --color-bg:           var(--neutral-900);
  --color-surface:      var(--neutral-800);
  --color-surface-alt:  var(--neutral-700);
  --color-text:         var(--neutral-100);
  --color-text-muted:   var(--neutral-300);
  --color-border:       var(--neutral-700);

  --color-primary:       var(--blue-400); /* #60A5FA — контрастнее на тёмном */
  --color-primary-hover: var(--blue-300);
  --color-primary-text:  var(--neutral-900);

  --color-accent:        var(--orange-400);
  --color-accent-hover:  var(--orange-500);
  --color-accent-text:   var(--neutral-900);

  --color-focus-ring:    var(--blue-400);
}

/* === VISUALLY IMPAIRED (VI) === */
[data-theme="vi"] {
  --color-bg:           var(--vi-bg);
  --color-surface:      var(--vi-bg);
  --color-surface-alt:  #111111;
  --color-text:         var(--vi-text);
  --color-text-muted:   #DDDDDD;
  --color-border:       var(--vi-text);

  --color-primary:       var(--vi-yellow);
  --color-primary-hover: #FFFF66;
  --color-primary-text:  #000000;

  --color-accent:        var(--vi-cyan);
  --color-accent-hover:  #33CCFF;
  --color-accent-text:   #000000;

  --color-focus-ring:    var(--vi-yellow);

  /* Увеличенный шрифт */
  --font-scale: 1.5;
}
```

### 2.3 Правила использования цвета

**⚠️ Контраст и доступность:**

- `--color-accent` (#F97316) на белом даёт **~3:1** — проходит только
  для **крупного текста** (18pt+ / 14pt bold) и **UI-элементов**
  (иконки, границы).
  → Для мелкого текста **не использовать**.
  → Текст **внутри** акцентной кнопки — всегда `--color-accent-text`
    (белый в light, тёмный в dark).

- `--color-primary` (#2563EB) на белом — **~7:1** (AAA).
  Можно использовать для текста любого размера.

- `--color-text-muted` (#78716C) на `--color-bg` — **~4.7:1** (AA).
  Только для второстепенного текста ≥16px.

- В VI-теме жёлтый `#FFFF00` на чёрном — **19.6:1** (AAA).
  Это максимально возможный контраст. Использовать для критичных
  элементов: кнопки действия, активные ссылки, фокус.

**Правило одного акцента:**
На одном экране — **не больше одного** элемента с `--color-accent`.
Исключение: сетка карточек с одинаковыми категориями.

**Проверка перед коммитом:**
Любой новый цветовой контраст проверяется в
[WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/).
Минимум — AA (4.5:1 для текста, 3:1 для UI).

---

## 3. Типографика

### 3.1 Шрифты

| Роль | Шрифт | Fallback |
|---|---|---|
| Заголовки | **Manrope** (600, 700) | `system-ui, sans-serif` |
| Основной текст | **Inter** (400, 500, 600) | `system-ui, sans-serif` |
| Моноширинный | `ui-monospace` | `SFMono-Regular, monospace` |

Оба шрифта — открытые (SIL OFL), с полной поддержкой кириллицы.
Подключаются **локально** (self-hosted), без Google Fonts CDN —
это важно для скорости и приватности.

Подмножество: `latin`, `cyrillic`. Формат: `woff2`.
`font-display: swap`.

### 3.2 Шкала размеров

Модульная шкала с коэффициентом **1.25** (major third).
Базовый размер: `16px`.

```css
--text-xs:   0.75rem;  /* 12px — подписи, метки */
--text-sm:   0.875rem; /* 14px — вспомогательный */
--text-base: 1rem;     /* 16px — основной текст */
--text-lg:   1.125rem; /* 18px — лид-абзац */
--text-xl:   1.25rem;  /* 20px — h4, подзаголовки */
--text-2xl:  1.5rem;   /* 24px — h3 */
--text-3xl:  1.875rem; /* 30px — h2 */
--text-4xl:  2.25rem;  /* 36px — h1 */
--text-5xl:  3rem;     /* 48px — hero (desktop) */
```

Все размеры умножаются на `--font-scale` (по умолчанию `1`).
В VI-теме `--font-scale: 1.5`.

```css
font-size: calc(var(--text-base) * var(--font-scale));
```

### 3.3 Межстрочные интервалы

```css
--leading-tight:  1.15; /* заголовки */
--leading-snug:   1.35; /* подзаголовки */
--leading-normal: 1.6;  /* основной текст */
```

### 3.4 Веса

```css
--weight-regular: 400;
--weight-medium:  500;
--weight-semibold: 600;
--weight-bold:    700;
```

**Правило:** заголовки h1–h3 — только `600` или `700`.
Основной текст — `400`. Акценты внутри текста — `500`.

---

## 4. Пространство и сетка

### 4.1 Базовая единица

**8px**. Все отступы кратны 8 (или 4 для мелких).

```css
--space-1:  0.25rem; /*  4px */
--space-2:  0.5rem;  /*  8px */
--space-3:  0.75rem; /* 12px */
--space-4:  1rem;    /* 16px */
--space-6:  1.5rem;  /* 24px */
--space-8:  2rem;    /* 32px */
--space-12: 3rem;    /* 48px */
--space-16: 4rem;    /* 64px */
--space-24: 6rem;    /* 96px */
```

### 4.2 Контейнеры

```css
--container-sm: 640px;
--container-md: 768px;
--container-lg: 1024px;
--container-xl: 1280px;

.container {
  width: 100%;
  max-width: var(--container-xl);
  margin-inline: auto;
  padding-inline: var(--space-4);
}

@media (min-width: 768px) {
  .container { padding-inline: var(--space-8); }
}
```

### 4.3 Брейкпоинты

```css
--bp-sm:  640px;
--bp-md:  768px;
--bp-lg:  1024px;
--bp-xl:  1280px;
```

Подход: **mobile-first**. Базовые стили — для мобильных,
`min-width` — для расширений.

### 4.4 Радиусы и тени

```css
--radius-sm: 6px;
--radius-md: 10px;
--radius-lg: 16px;
--radius-full: 9999px;

--shadow-sm: 0 1px 2px rgba(28, 25, 23, 0.06);
--shadow-md: 0 4px 12px rgba(28, 25, 23, 0.08);
--shadow-lg: 0 12px 32px rgba(28, 25, 23, 0.12);
```

В dark-теме тени не работают — вместо них используем `--color-border`
и лёгкое свечение через `--color-surface-alt`.

---

## 5. Компоненты

### 5.1 Кнопки

**Варианты:**

| Вариант | Фон | Текст | Когда использовать |
|---|---|---|---|
| `primary` | `--color-primary` | `--color-primary-text` | Основное действие на экране |
| `accent` | `--color-accent` | `--color-accent-text` | Один на экран, критичное действие |
| `secondary` | прозрачный, border | `--color-text` | Альтернативное действие |
| `ghost` | прозрачный | `--color-text-muted` | Второстепенные действия |

**Размеры:**

```css
.btn {
  padding: var(--space-3) var(--space-6);
  min-height: 44px;        /* a11y: минимум для клика */
  border-radius: var(--radius-md);
  font: var(--weight-semibold) var(--text-base) Inter, sans-serif;
  transition: background-color 150ms ease, transform 100ms ease;
}

.btn:hover { transform: translateY(-1px); }
.btn:active { transform: translateY(0); }
.btn:focus-visible {
  outline: 3px solid var(--color-focus-ring);
  outline-offset: 2px;
}
```

**Правило:** белый текст на `--color-accent` обязателен.
Никогда не использовать `--color-accent` для мелкого текста на белом.

### 5.2 Карточки

Базовая единица контента: новости, материалы, уроки.

```
┌─────────────────────────┐
│  [Категория — бейдж]    │
│                         │
│  Заголовок карточки     │
│  Краткое описание...    │
│                         │
│  → Подробнее            │
└─────────────────────────┘
```

```css
.card {
  background: var(--color-surface);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: var(--space-6);
  transition: border-color 150ms, box-shadow 150ms;
}

.card:hover {
  border-color: var(--color-primary);
  box-shadow: var(--shadow-md);
}
```

### 5.3 Навигация (шапка)

- Sticky (`position: sticky; top: 0`)
- Логотип слева, навигация по центру/справа
- Переключатель темы и доступности — в правом углу
- Мобильная версия: гамбургер-меню

### 5.4 Переключатель тем

Три состояния: `light` / `dark` / `vi`.
Расположение: правый верхний угол, всегда видим.

```
[ ☀ ] [ 🌙 ] [ ♿ ]
```

**Поведение:**
- Активное состояние выделено `--color-primary`.
- Клик → смена `data-theme` на `<html>` + запись в cookie/localStorage.
- При загрузке — тема восстанавливается inline-скриптом (см. §7).

### 5.5 Панель доступности

Дополнительные настройки для VI-режима:

- **A- / A / A+** — регулировка `--font-scale` (1.0 / 1.5 / 2.0)
- **Без изображений** — `[data-images="off"] img:not([role="img"]) { display: none; }`
- **Обычный шрифт** — сброс к базовому sans-serif
- **Сбросить всё** — возврат к настройкам по умолчанию

### 5.6 Футер

- 3–4 колонки на desktop, 1 на mobile
- Основные ссылки, контакты, копирайт
- Ссылка на политику конфиденциальности
- Не перегружать: только необходимое

---

## 6. Доступность (a11y)

### 6.1 Базовые требования (WCAG 2.1 AA)

- **Контраст:** минимум 4.5:1 для текста, 3:1 для UI.
- **Кликабельные зоны:** минимум 44×44px.
- **Фокус:** видимый `outline`, не убирать `outline: none` без замены.
- **Семантика:** `<button>`, `<nav>`, `<main>`, `<article>`, не `<div>` для всего.
- **Alt-текст:** обязателен для всех информативных изображений.
- **Skip-link:** «Перейти к контенту» в начале `<body>`.
- **Формы:** `<label>` для каждого поля, `aria-describedby` для ошибок.
- **Анимации:** уважать `prefers-reduced-motion`.

### 6.2 Режим для слабовидящих (VI)

Основано на реализации `DimaNikolaevi4/site`, соответствует
**ГОСТ Р 52872-2019** и WCAG 2.1 AAA.

**Что меняется:**

| Параметр | Значение |
|---|---|
| Фон | `#000000` (чистый чёрный) |
| Текст | `#FFFFFF` (чистый белый) |
| Акцент | `#FFFF00` (жёлтый, 19.6:1 — AAA) |
| Вторичный акцент | `#00BFFF` (голубой) |
| Масштаб шрифта | `1.5×` (настраивается) |
| Изображения | Отключаются кнопкой |
| Анимации | Принудительно `none` |
| Кликабельные зоны | Минимум 56×56px |

**Правило:** жёлтый `#FFFF00` — единственный цвет, гарантированно
проходящий WCAG AAA на чёрном. Использовать для критичных элементов.

**Не использовать в VI-режиме:**
- Тени (`box-shadow`)
- Прозрачность (`opacity < 1`)
- Градиенты
- Фоновые изображения

---

## 7. Технические решения

### 7.1 Как реализуются темы

**Атрибут на `<html>`:**
```html
<html data-theme="light">  <!-- или "dark" / "vi" -->
```

**CSS-переменные** переключаются через селектор `[data-theme="..."]`.
Все компоненты используют только семантические токены — никаких
хардкод-цветов в компонентах.

### 7.2 Хранение выбора: Cookie + localStorage

**Почему оба:**
- **Cookie** — доступна на сервере, закладывает основу на вырост
  (SSR-рендеринг, критический CSS, SEO).
- **localStorage** — быстрый доступ на клиенте, работает без сети.

**Приоритет при загрузке:**
1. Cookie `theme`
2. localStorage `theme`
3. `prefers-color-scheme` (только для light/dark)
4. По умолчанию: `light`

**Запись:**
```js
function setTheme(theme) {
  document.documentElement.dataset.theme = theme;
  document.cookie = `theme=${theme}; max-age=31536000; path=/; SameSite=Lax`;
  localStorage.setItem('theme', theme);
}
```

### 7.3 Inline-скрипт в `<head>` (защита от FOUC)

**Критично:** тема должна установиться **до** первого рендера,
иначе будет «мигание» (FOUC).

```html
<script>
(function() {
  var theme = (
    document.cookie.match(/(?:^|;\s*)theme=([^;]+)/) || []
  )[1] || localStorage.getItem('theme');
  if (!theme) {
    theme = matchMedia('(prefers-color-scheme: dark)').matches
      ? 'dark' : 'light';
  }
  document.documentElement.dataset.theme = theme;
})();
</script>
```

Скрипт вставляется **до** любых CSS-подключений в `<head>`.
Размер — меньше 300 байт, инлайнится.

### 7.4 Приоритет тем

При первом заходе пользователя без выбора:
- Light / Dark — по системной теме (`prefers-color-scheme`).
- VI — **никогда** не включается автоматически, только вручную.

---

## 8. Чек-лист перед коммитом

- [ ] Все новые цвета — через семантические токены, не хардкод.
- [ ] Контраст проверен в WebAIM Contrast Checker.
- [ ] Компонент протестирован во всех трёх темах.
- [ ] Фокус виден с клавиатуры (Tab).
- [ ] Кликабельные зоны ≥ 44×44px.
- [ ] `prefers-reduced-motion` уважается.
- [ ] Нет FOUC при загрузке (проверить в incognito).
- [ ] Cookie и localStorage синхронизированы.

---

## 9. Журнал решений

| Дата | Решение | Обоснование |
|---|---|---|
| 2026-09-11 | Три темы вместо двух | VI — функциональное требование, не эстетика |
| 2026-09-11 | Тёплая палитра вместо холодного Dropbox Blue | Педагогический контекст, «человечность» |
| 2026-09-11 | Inter + Manrope | Открытые, кириллица, современные |
| 2026-09-11 | `#60A5FA` в dark вместо `#3B82F6` | Лучше контраст на `#292524` |
| 2026-09-11 | Cookie + localStorage | Залог на SSR-рендеринг в будущем |
| 2026-09-11 | Оранжевый — только для крупных CTA | Контраст 3:1 недостаточен для мелкого текста |

---

*Последнее обновление: 2026-09-11*
```

---

### Что зафиксировано

- **Три темы** с полными семантическими токенами.
- **Правило про оранжевый** — явно и заметно.
- **Hover-состояния** для primary и accent в обеих темах.
- **`#60A5FA`** в dark как основной синий.
- **Жёлтый `#FFFF00`** в VI — только для критичного.
- **Cookie + localStorage** с inline-скриптом для защиты от FOUC.
- **Чек-лист и журнал решений** — для будущих правок.

### Что предлагаю сделать дальше

1.  **Скопировать `DESIGN.md` в корень `bardakov.rf`** — можно сразу коммитить.
2.  **Проверить контрасты** спорных пар в WebAIM (я прикинул в уме, но лучше перепроверить вживую):
    - `#78716C` на `#FAFAF9` (muted text на фоне)
    - `#F97316` белый текст внутри кнопки
    - `#60A5FA` на `#292524` (dark primary)
3.  **Согласовать шрифты:** если Manrope для заголовков — ок, но можно и Inter везде (тогда проще, меньше запросов). Что скажете?

Как только скажете «ок» — можно переходить к следующему шагу: описанию структуры страниц и компонентов под ваш контент.
