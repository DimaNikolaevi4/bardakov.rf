
# Дизайн-система bardakov.rf

> Единый источник правды по визуальным, пространственным и техническим
> решениям. Все изменения фиксируются здесь до реализации в коде.
> Формат: Markdown + CSS-токены.

---

## 1. Философия

Пять принципов. Они — не декор, а фильтр для любого решения:
«делаем ли мы это?»

1. **Ясность важнее декоративности.**
   Контент первичен. Если элемент не помогает понять или сделать — он убирается.

2. **Воздух — это инструмент, а не пустота.**
   Много свободного пространства вокруг блоков. Оно направляет взгляд
   и даёт контенту дышать.

3. **Акценты дозированно.**
   Яркий цвет — сигнал. Если ярко всё — не видно ничего.
   Один акцентный элемент на экран.

4. **Доступность по умолчанию.**
   WCAG 2.1 AA — базовое требование, а не «доп. режим».
   Режим для слабовидящих — расширение, а не замена.

5. **Скорость — часть дизайна.**
   Никаких тяжёлых шрифтов, лишних библиотек, анимаций «для красоты».
   3D-сцена загружается лениво, только при активации.

---

## 2. Цвет

### 2.1 Палитра «Золотой день / Ночное небо»

Актуальная палитра определена в `src/styles/tokens.css`. Примитивы
(`--blue-*`, `--orange-*`, `--neutral-*`) в коде не объявлены —
семантические токены хранят значения напрямую.

```css
/* LIGHT — «Золотой день» (тёплый кремовый фон, фиолетовый акцент) */
:root {
  --bg-primary:     #FFFFF5;
  --bg-secondary:   #E5E1DC;
  --bg-subtle:      #FEF9E7;

  --text-primary:   #0F172A;
  --text-secondary: #475569;
  --text-muted:     #78716C;

  --accent:         #4338CA;   /* основной акцент */
  --accent-hover:   #3730A3;
  --accent-soft:    rgba(67, 56, 202, 0.08);
  --accent-ring:    rgba(67, 56, 202, 0.30);

  --highlight:      #CA8A04;   /* тёплый второй акцент */
  --highlight-hover:#B45309;
  --highlight-soft: rgba(254, 249, 231, 0.6);

  --border:         #D4CFC7;
  --border-strong:  #B8B0A5;

  --color-on-accent: #ffffff;   /* текст на залитых кнопках */
}

/* DARK — «Ночное небо» (глубокий синий, светло-фиолетовый акцент) */
[data-theme="dark"] {
  --bg-primary:     #050A1F;
  --bg-secondary:   #0F172A;
  --bg-subtle:      #1E293B;

  --text-primary:   #F8FAFC;
  --text-secondary: #94A3B8;
  --text-muted:     #64748B;

  --accent:         #818CF8;
  --accent-hover:   #A5B4FC;
  --accent-soft:    rgba(129, 140, 248, 0.15);
  --accent-ring:    rgba(129, 140, 248, 0.40);

  --highlight:      #FACC15;
  --highlight-hover:#FDE047;
  --highlight-soft: rgba(250, 204, 21, 0.15);

  --border:         #2A3555;
  --border-strong:  #3D4C73;
}

/* HIGH-CONTRAST — версия для слабовидящих */
[data-theme="high-contrast"] {
  --bg-primary:     #000000;
  --bg-secondary:   #000000;
  --bg-subtle:      #0A0A0A;
  --text-primary:   #FFFF00;
  --text-secondary: #FFFFFF;
  --text-muted:     #DDDDDD;
  --accent:         #00FFFF;
  --accent-hover:   #66FFFF;
  --highlight:      #FFFF00;
  --border:         #FFFFFF;
  --border-strong:  #FFFFFF;
}
```

### 2.2 Deprecated-алиасы обратной совместимости

Эти алиасы существуют временно для совместимости со старым кодом.
Запланированы к удалению в следующем релизном цикле (см. issue P2).

```css
/* @deprecated since 2.1.0 — use --bg-primary */
--color-bg:           var(--bg-primary);
--color-surface:      var(--bg-primary);
--color-surface-alt: var(--bg-subtle);

/* @deprecated since 2.1.0 — use --text-primary / --text-muted */
--color-text:         var(--text-primary);
--color-text-muted:   var(--text-muted);

/* @deprecated since 2.1.0 — use --accent / --accent-hover */
--color-primary:      var(--accent);
--color-primary-hover:var(--accent-hover);
--color-primary-text: var(--color-on-accent);

/* @deprecated since 2.1.0 — use --border */
--color-border:       var(--border);

/* @deprecated since 2.1.0 — use --accent */
--color-accent:       var(--accent);

/* @deprecated since 2.1.0 — use --accent-ring */
--color-focus-ring:   var(--accent-ring);

/* @deprecated since 2.1.0 — use --radius */
--radius-md:          var(--radius);

/* @deprecated since 2.1.0 — use --t-fast / --t-base */
--transition-fast:    var(--t-fast);
--transition-base:   var(--t-base);
```

> ⚠️ **Новым кодом deprecated-имена не использовать.**
> CI-guardrail выдаёт `::warning::` при появлении в новых файлах.

### 2.3 Правила использования цвета

- `--accent` (`#4338CA` в light) на белом даёт ~7:1 (AAA). Можно
  использовать для текста любого размера и UI-элементов.
- `--highlight` (`#CA8A04` в light) — тёплый второй акцент. На белом
  ~5:1 (AA). Использовать для декоративных акцентов, иконок, бейджей.
- `--text-muted` (`#78716C`) на `--bg-primary` — ~4.7:1 (AA).
  Только для второстепенного текста ≥16px.
- В high-contrast теме жёлтый `#FFFF00` на чёрном — 19.6:1 (AAA).
  Только для критичных элементов: кнопки действия, ссылки, фокус.
- Текст внутри залитой кнопки — всегда `--color-on-accent` (`#ffffff`).
- **Правило одного акцента:** на одном экране не больше одного
  элемента с `--accent`. Исключение: сетка карточек с одинаковыми
  категориями.
- Любой новый контраст проверяется в
  [WebAIM Contrast Checker](https://webaim.org/resources/contrastchecker/).

> ⚠️ Deprecated-алиасы (`--color-bg`, `--color-surface`, `--color-text`,
> `--color-primary`, `--color-accent`, `--color-focus-ring` и т. д.)
> описаны в разделе 2.2 и запланированы к удалению.

---

## 3. Геометрия и навигация

Это ядро концепции. Раздел описывает, как устроено пространство сайта
и как по нему перемещается пользователь.

### 3.1 Концепция: «Кристалл знаний»

Сайт — не лента страниц, а **единый трёхмерный объект**. Многогранник,
каждая грань которого — отдельный смысловой раздел: «О себе»,
«Методики», «Проекты», «Контакты», «Материалы», «Связь».

- **Оболочка** — строгая геометрия многогранника. Задаёт структуру.
- **Наполнение** — плавная геометрия внутри граней: мягкие углы,
  лёгкая объёмность, едва заметные волны-разделители.
- **Контраст** между строгой формой и живым содержанием — есть суть.

### 3.2 Пространственная структура

- **Решётка.** Модульная сетка, унаследованная от швейцарской школы
  (brand.dropbox.com). Каждая грань — ячейка этой сетки в 3D.
- **Объём.** Создаётся через `perspective` и `transform-style: preserve-3d`.
- **Грани.** Позиционируются через `transform: rotateY(...) translateZ(...)`.

**Количество граней: 6.** Пять смысловых разделов + одна «навигационная»
(оглавление/карта сайта). Больше — теряется ориентация.

### 3.3 Навигация: два режима

Правило: **3D — захватывающий, но опциональный способ исследования.
Основной — линейный и предсказуемый.**

| Режим | Описание | Когда |
|---|---|---|
| **Линейный (по умолчанию)** | Обычная страница с последовательными секциями. Пользователь просто скроллит. | Всегда. Доступен всем. |
| **Пространственный (по действию)** | Страница «сворачивается» в многогранник. Вращение, приближение, выбор грани. | По желанию. Для обзора структуры. |

**Сценарий:**
1. Пользователь заходит и видит обычную, понятную страницу.
2. В правом верхнем углу — иконка «куб» рядом с переключателем тем.
3. Клик — страница плавно сворачивается в грань многогранника.
4. Вращение мышью/свайпом, активная грань подсвечивается.
5. Клик по грани — разворот в полноэкранный контент.
6. Кнопка «Назад к содержанию» возвращает в линейный режим.

### 3.4 Реализация: CSS 3D (первый этап)

Для прототипа — **CSS 3D**. Не Three.js, не WebGL. Это легче по
производительности и не требует внешних библиотек.

```css
.scene {
  perspective: 1200px;
}

.polyhedron {
  transform-style: preserve-3d;
  transition: transform 600ms cubic-bezier(0.33, 1, 0.68, 1);
}

.face {
  position: absolute;
  backface-visibility: hidden;
}
```

**Анимация перехода:** 600 мс, `cubic-bezier(0.33, 1, 0.68, 1)`.
Компромисс между чёткостью и «кинематографичностью».

**Ленивая загрузка.** 3D-сцена инициализируется только при активации
пространственного режима. По умолчанию — ноль 3D-вычислений.

### 3.5 Геометрические детали внутри граней

- **Скругления.** Не больше двух радиусов на странице:
  малый (6–8px) и большой (16–20px). Squircle — как progressive
  enhancement, fallback — обычный `border-radius`.
- **Волна.** Максимум один волнистый разделитель на 2–3 секции.
  Амплитуда 8–16px. Не под текстом.
- **Объём.** Многослойные тени + inset-подсветка сверху + разница тонов
  поверхности. Не более 1–2 типов элементов с объёмом на странице.
  В dark-теме — только разница тонов и inset, без теней.
- **Направление.** Только ортогональное: горизонтали и вертикали.
  Единственное исключение — декоративная линия-акцент под заголовком
  (наклон 2–3°).

**Бюджет мягкости.** У страницы ограниченный бюджет «мягкости».
Потратили на объёмный фон — не тратьте ещё и на скругления.
Сделали волну — следующий разделитель прямой.

**Два теста:**
1. Прищуриться. Если структура читается — геометрия работает.
2. В чёрно-белом. Если иерархия держится без цвета — она построена
   на геометрии, а не на цвете.

### 3.6 Доступность: структурный альтернативный вид

**Обязательное требование.** 3D-навигация несовместима с VI-режимом
и полноценным управлением с клавиатуры.

- **Структурный вид** — обычный список разделов ссылками. Работает
  с клавиатуры, читается скринридерами, доступен в VI-режиме.
- Переключение между пространственным и структурным видом — **явное**.
  Это не «fallback», а равноправный альтернативный способ навигации.
- Правило: **3D-навигация никогда не является единственным способом
  добраться до контента.**

---

## 4. Типографика

### 4.1 Шрифты

| Роль | Шрифт | Fallback |
|---|---|---|
| Заголовки | **Manrope** (600, 700) | `system-ui, sans-serif` |
| Основной текст | **Inter** (400, 500, 600) | `system-ui, sans-serif` |
| Моноширинный | `ui-monospace` | `SFMono-Regular, monospace` |

Оба — SIL OFL, полная поддержка кириллицы. Подключаются **локально**
(self-hosted), без Google Fonts CDN — важно для скорости и приватности.
Подмножество: `latin`, `cyrillic`. Формат: `woff2`. `font-display: swap`.

### 4.2 Шкала размеров

Модульная шкала с коэффициентом **1.25** (major third). База 16px.

```css
--text-xs:   0.75rem;   /* 12px — подписи, метки */
--text-sm:   0.875rem;  /* 14px — вспомогательный */
--text-base: 1rem;      /* 16px — основной текст */
--text-lg:   1.125rem;  /* 18px — лид-абзац */
--text-xl:   1.25rem;   /* 20px — h4, подзаголовки */
--text-2xl:  1.5rem;    /* 24px — h3 */
--text-3xl:  1.875rem;  /* 30px — h2 */
--text-4xl:  2.25rem;   /* 36px — h1 */
--text-5xl:  3rem;      /* 48px — hero (desktop) */
```

> ⚠️ **Запрет на хардкод `rem`/`px` для `font-size` в компонентах.**
>
> В файлах `components.css` и других компонентных CSS **запрещено**
> использовать прямые значения `font-size: X rem` или `font-size: Xpx`.
>
> Если требуется размер, которого нет в шкале `--text-*`:
> 1. Сначала добавьте новый токен в `tokens.css` (например,
>    `--text-2xs: 0.625rem; /* 10px — микро-подписи */`).
> 2. Затем используйте его в компоненте: `font-size: var(--text-2xs);`.
>
> **Текущий статус (на 2026-10-18):** в кодовой базе ~65 вхождений
> хардкод-`font-size` через `rem` — это технический долг, запланированный
> к устранению в отдельном PR через массовую замену.
> CI-guardrail для запрета новых хардкод-`font-size` пока не внедрён
> (см. issue P2).

Все размеры умножаются на `--font-scale` (по умолчанию `1`,
в a11y-режиме `1.5` или `2`).

> ⚠️ `--font-scale` **не объявлен в `tokens.css`** — значение устанавливается
> inline-стилем через JS (`a11y.js:139`,
> `document.documentElement.style.setProperty('--font-scale', scale)`).
> В CSS используется с fallback: `var(--font-scale, 1)` — см. `typography.css:86`.
> Возможные значения: 0.9 / 1 / 1.5 / 2 (см. `a11y-panel.njk`).

```css
font-size: calc(var(--text-base) * var(--font-scale, 1));
```

### 4.3 Межстрочные интервалы

```css
--leading-tight:  1.15; /* заголовки */
--leading-snug:   1.35; /* подзаголовки */
--leading-normal: 1.6;  /* основной текст */
```

### 4.4 Веса

```css
--weight-regular:  400;
--weight-medium:   500;
--weight-semibold: 600;
--weight-bold:     700;
```

**Правило:** заголовки h1–h3 — только `600` или `700`.
Основной текст — `400`. Акценты внутри текста — `500`.

---

## 5. Пространство и сетка

### 5.1 Базовая единица

**8px.** Все отступы кратны 8 (или 4 для мелких).

```css
--space-1:  0.25rem; /*  4px */
--space-2:  0.5rem;  /*  8px */
--space-3:  0.75rem; /* 12px */
--space-4:  1rem;    /* 16px */
--space-5:  1.5rem;  /* 24px */
--space-6:  2rem;    /* 32px */
--space-8:  3rem;    /* 48px */
--space-10: 4rem;    /* 64px */
--space-12: 6rem;    /* 96px */
--space-16: 8rem;    /* 128px */
```

**Ритм.** Чем крупнее блок, тем больше отступ:
- Секции разделяются 96px или 128px.
- Внутри секции — 32–48px.
- Внутри карточки — 16–24px.

Это создаёт визуальную иерархию без дополнительных цветов.

### 5.2 Контейнеры и брейкпоинты

```css
--container-sm: 640px;
--container-md: 768px;
--container-lg: 1024px;
--container-xl: 1160px;   /* максимальная ширина основного контейнера */
--container:    1160px;   /* алиас */
```

> ⚠️ В коде `--container-xl` и `--container` имеют одинаковое значение
> (`1160px`). Разделение сохранено для семантической ясности.

```css
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

Подход: **mobile-first**. Базовые стили — мобильные, расширения — `min-width`.

### 5.3 Радиусы и тени

```css
--radius:      16px;     /* основной радиус скругления */
--radius-sm:   10px;     /* мелкие элементы, кнопки */
--radius-full: 9999px;   /* пилюли, иконки */

--shadow-sm:    0 1px 3px rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0, 0, 0, 0.06);
--shadow:       0 4px 6px -1px rgba(0, 0, 0, 0.10), 0 2px 4px -1px rgba(0, 0, 0, 0.08);
--shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.10);
```

Алиасы для совместимости со старым кодом:

```css
--shadow-md:  var(--shadow);        /* @deprecated since 2.1.0 */
--shadow-lg:  var(--shadow-hover);  /* @deprecated since 2.1.0 */
--shadow-air: var(--shadow-hover);  /* @deprecated since 2.1.0 */
--radius-md:  var(--radius);         /* @deprecated since 2.1.0 */
```

**В dark-теме** тени переопределены в `tokens.css` через
переопределение `--shadow-*` переменных (см. раздел 8.1).

### 5.4 Исключение для оптических микро-подгонок

Строгое правило кратности 4px/8px (раздел 5.1) имеет **одно исключение**.

Если для идеального визуального центрирования иконки относительно текста
или компенсации толщины штриха SVG требуется отступ в `1px`, `2px` или
`3px`, это допускается. Такие значения должны быть снабжены комментарием
в CSS, чтобы следующий разработчик понимал причину отклонения:

```css
.header-icon-btn {
  padding: 2px;  /* optical alignment — компенсация толщины рамки */
}

.main-nav-link {
  gap: 5px;      /* visual centering — иконка bi-person-vcard */
}
```

**Критерии допустимости микро-подгонки:**
- Значение от `1px` до `3px` (включительно).
- Без комментария `/* optical alignment */` или `/* visual centering */`
  правило считается нарушением и блокируется CI (если такой guardrail
  будет добавлен в будущем).
- Для значений `4px` и выше всегда используется токен `--space-*`.

**Не допускается** использовать микро-подгонки как регулярный инструмент
раскладки — это исключение для пиксельных деталей, а не замена токенов.

---

## 6. Компоненты

### 6.1 Кнопки

| Вариант | Фон | Текст | Когда |
|---|---|---|---|
| `btn-primary` | `var(--accent)` | `var(--color-on-accent)` | Основное действие |
| `btn-secondary` | прозрачный, `border: 1px solid var(--border)` | `var(--text-primary)` | Альтернативное |
| `btn-outline` | прозрачный, `border: 2px solid var(--border-strong)` | `var(--text-primary)` | Приглушённое |

Базовый класс `.btn` задаёт геометрию (padding, min-height 44px,
border-radius: var(--radius-sm), font, transition). Модификаторы
меняют только фон/цвет/границу.

```css
.btn {
  display: inline-flex; align-items: center; justify-content: center; gap: 10px;
  min-height: var(--target); padding: 12px 22px;
  font-family: var(--font-main); font-size: 0.95rem; font-weight: 600;
  border: 1px solid transparent; border-radius: var(--radius-sm);
  cursor: pointer; white-space: nowrap;
  transition: transform var(--t-fast), background-color var(--t-fast),
              border-color var(--t-fast), box-shadow var(--t-fast), color var(--t-fast);
}

.btn-primary {
  background: var(--accent); color: var(--color-on-accent);
  box-shadow: 0 10px 24px -10px var(--accent-ring);
}
```

Подробно о hover/active/focus — см. раздел «CSS: архитектура и код-стайл»
в конце документа: там же описан UNIFIED INTERACTIONS блок, который
унифицирует эффекты для всех интерактивных элементов.

### 6.2 Карточки

```css
.card {
  /* Используем var(--bg-secondary), а не --bg-primary — карточки должны
     визуально отделяться от основного фона страницы. var(--bg-secondary)
     создаёт необходимую глубину и контраст, что подтверждено аудитом
     как лучшее решение (см. git log: audit(design)). */
  background: var(--bg-secondary);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: var(--space-6);
  box-shadow: var(--shadow-sm);
  transition: transform var(--t-base), border-color var(--t-base),
              box-shadow var(--t-base);
}

.card:hover {
  /* Декоративный акцент реализован через .card::before
     (цветная полоса слева), а border-color усиливается до
     --border-strong. var(--accent) не задаётся напрямую на границу,
     чтобы не конфликтовать с акцентными кнопками в карточке. */
  transform: translateY(-6px);
  border-color: var(--border-strong);
  box-shadow: var(--shadow-hover);
}
```

Структура карточки:
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

### 6.3 Навигация (шапка)

- Sticky (`position: sticky; top: 0`).
- Логотип слева, навигация по центру/справа.
- Переключатель тем, режим доступности, иконка «куб» (вход в 3D) —
  правый верхний угол.
- Мобильная версия: гамбургер-меню.
- При скролле — лёгкая тень.

### 6.4 Переключатель тем

Три состояния: `light` / `dark` / `high-contrast`. В правом верхнем углу,
всегда видим.

```
[ ☀ ] [ 🌙 ] [ ♿ ]
```

Активное состояние выделяется `--accent` (через `aria-pressed="true"`).
Клик → смена `data-theme` на `<html>` + запись в cookie/localStorage.

> ⚠️ Тема `vi` (visually impaired) переименована в `high-contrast`.
> JS (`theme.js:16`) и HTML (`header.njk`, `a11y-panel.njk`) используют
> только `high-contrast`. Однако в `a11y.css` осталось 9 правил
> `[data-theme="vi"]` (строки 41, 102, 110, 116, 117, 251, 252, 253, 254) —
> это legacy-селекторы, которые **никогда не срабатывают**, т.к. JS не
> выставляет `data-theme="vi"`. Запланированы к удалению в issue P2
> (после проверки, что все необходимые правила уже есть в
> `[data-theme="high-contrast"]`).

### 6.5 Панель доступности

- **A- / A / A+** — регулировка `--font-scale` (1.0 / 1.5 / 2.0).
- **Без изображений** — `[data-images="off"] img:not([role="img"]) { display: none; }`.
- **Обычный шрифт** — сброс к базовому sans-serif.
- **Сбросить всё** — возврат к настройкам по умолчанию.

### 6.6 Футер

2–4 колонки на desktop, 1 на mobile. Основные ссылки, контакты,
копирайт. Ссылка на политику конфиденциальности. Не перегружать.

---

## 7. Автоматический контроль качества (CI Guardrails)

Все PR проходят автоматическую проверку через
`.github/workflows/css-guardrails.yml`. Workflow запускается на
`pull_request` и `push` в `main` при изменении файлов в `src/styles/`.

### 7.1 Что проверяется

| Проверка | Файл | Что блокирует / предупреждает |
|---|---|---|
| **Размер CSS-бандла** | `src/styles/*.css` | Регресс > +5% от baseline в `.github/css-baseline.json` блокирует мерж. Обновление baseline — отдельным PR с обоснованием. |
| **`:root` в `components.css`** | `components.css` | Блокирует (error) — токены объявляются только в `tokens.css`. |
| **`[data-theme="X"] { ... }`** (без компонента) | `components.css` | Блокирует (error) — темы переопределяются только в `tokens.css`. |
| **Hex/rgb в `components.css`** | `components.css` | Предупреждает (warning) — текущий долг 37 hex. Используйте `var(--token)`. |
| **Утилиты отступов** (`.mt-*`, `.mb-*`, `.pt-*`, `.pb-*`) | `layout.css` | Блокирует (error) — отступы задаются внутри компонентов через `margin-block` / `padding-inline`. |
| **Локальный `:focus-visible`** (кроме исключений) | `components.css` | Блокирует (error). Разрешён только для `.btn-primary`, `.home-carousel__*`, `[data-theme="high-contrast"] :focus-visible`. |
| **Deprecated-алиасы** (`--color-bg`, `--color-text` и т.д.) | все 4 CSS | Предупреждает (warning) — замены на новые имена (см. раздел 2.2). |

### 7.2 Стратегия guardrails

**Блокируем НОВЫЕ нарушения, не существующий долг.** Это означает:

- Если в PR появляется новый `:root` в `components.css` — мерж блокируется.
- Если в PR появляется новый hex в `components.css` — warning
  (текущие 37 hex оставлены как долг, новый guardrail для них введётся
  после полного перехода на токены — см. issue P2).
- Если PR увеличивает CSS-бандл на 6% — мерж блокируется, автор
  должен либо обосновать рост и обновить baseline в этом же PR,
  либо оптимизировать код.

### 7.3 Локальная эмуляция

Перед push можно проверить код локально:

```bash
# Все 7 проверок из workflow:
grep -qE '^[[:space:]]*:root[[:space:]]*\{' src/styles/components.css && echo "FAIL: :root" || echo "OK: no :root"
grep -qE '^\[data-theme="[^"]+"\][[:space:]]*\{' src/styles/components.css && echo "FAIL: [data-theme]" || echo "OK: no top-level [data-theme]"
grep -nE '^\.(mt|mb|pt|pb)-[0-9]' src/styles/layout.css && echo "FAIL: utilities" || echo "OK: no utilities"
CURRENT=$(find src/styles -name '*.css' -exec cat {} + | wc -c)
BASELINE=$(jq -r '.bytes' .github/css-baseline.json)
MAX=$((BASELINE * 105 / 100))
echo "CSS size: $CURRENT (baseline $BASELINE, max $MAX)"
[ "$CURRENT" -gt "$MAX" ] && echo "FAIL: size" || echo "OK: size"
npm run build  # должно быть без ошибок
```

### 7.4 Обновление baseline

Если легитимный рост CSS-бандла (например, добавлен новый компонент
с полным набором токенов):

1. Запустите `find src/styles -name '*.css' -exec cat {} + | wc -c`
   и запишите новое значение.
2. Обновите `.github/css-baseline.json`:
   ```json
   {
     "bytes": <новое_значение>,
     "updated": "<дата ISO>",
     "source": "<причина обновления>",
     "comment": "...",
     "history": [...]
   }
   ```
3. В том же PR добавьте запись в `history` массив с описанием причины.
4. Commit message должен содержать `chore(baseline): обновление CSS baseline` —
   это позволит ревьюеру сразу увидеть характер изменения.

### 7.5 Что НЕ покрывает CI (на 2026-10-18)

| Проверка | Статус | Issue |
|---|---|---|
| Запрет хардкод `font-size` в `rem`/`px` | не внедрён | P2 |
| Запрет micro-paddings 1-3px без комментария `/* optical alignment */` | не внедрён | P3 (после устранения долга) |
| Проверка контраста через `axe-core` | не внедрена | P3 |
| Автоматический запуск Playwright a11y-smoke | не внедрён | P3 (скрипт `scripts/a11y-smoke.mjs` есть, нужен CI job) |

---

## 8. Доступность (a11y)

### 8.1 Базовые требования (WCAG 2.1 AA)

- **Контраст:** минимум 4.5:1 для текста, 3:1 для UI.
- **Кликабельные зоны:** минимум 44×44px.
- **Фокус:** видимый `outline`. Не убирать `outline: none` без замены.
- **Семантика:** `<button>`, `<nav>`, `<main>`, `<article>`,
  не `<div>` для всего.
- **Alt-текст:** обязателен для всех информативных изображений.
- **Skip-link:** «Перейти к контенту» в начале `<body>`.
- **Формы:** `<label>` для каждого поля, `aria-describedby` для ошибок.
- **Анимации:** уважать `prefers-reduced-motion`.

### 8.2 Режим для слабовидящих (high-contrast)

Соответствует **ГОСТ Р 52872-2019** и WCAG 2.1 AAA.

| Параметр | Значение |
|---|---|
| Фон | `#000000` (чистый чёрный) |
| Текст | `#FFFFFF` (чистый белый) |
| Акцент | `#FFFF00` (19.6:1 — AAA) |
| Вторичный акцент | `#00FFFF` |
| Радиусы | `0` (все `--radius-*` обнулены в `[data-theme="high-contrast"]`) |
| Тени | `none` (все `--shadow-*` обнулены) |
| Изображения | Отключаются кнопкой (`[data-images="off"]`) |
| Анимации | Принудительно `none` (`[data-animations="off"]`) |
| Кликабельные зоны | Минимум 56×56px (`--target: 56px`) |

**Не использовать в high-contrast режиме:** тени, прозрачность (`opacity < 1`),
градиенты, фоновые изображения, 3D-навигацию.

---

## 9. Технические решения

### 9.1 Как реализуются темы

**Атрибут на `<html>`:**
```html
<html data-theme="light">  <!-- или "dark" / "high-contrast" -->
```

CSS-переменные переключаются через селектор `[data-theme="..."]`.
Все компоненты используют только семантические токены —
никаких хардкод-цветов.

**Принцип:** тёмная и high-contrast темы реализуются **только** через
переопределение токенов в `tokens.css`. Селекторы вида
`[data-theme="dark"] .card { background: #222 }` в `components.css`
**запрещены** (см. раздел «CSS: архитектура и код-стайл» в конце
документа и CI-guardrails в `.github/workflows/css-guardrails.yml`).

### 9.2 Хранение выбора: Cookie + localStorage

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

### 9.3 Inline-скрипт в `<head>` (защита от FOUC)

**Критично:** тема должна установиться **до** первого рендера,
иначе будет «мигание» (FOUC). Скрипт вставляется **до** любых
CSS-подключений в `<head>`. Размер — меньше 300 байт.

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

### 9.4 Приоритет тем

- Light / Dark — по системной теме (`prefers-color-scheme`).
- VI — **никогда** не включается автоматически, только вручную.

---

## 10. Чек-лист перед коммитом

- [ ] Все новые цвета — через семантические токены, не хардкод.
- [ ] Контраст проверен в WebAIM Contrast Checker.
- [ ] Компонент протестирован во всех трёх темах.
- [ ] Фокус виден с клавиатуры (Tab).
- [ ] Кликабельные зоны ≥ 44×44px.
- [ ] `prefers-reduced-motion` уважается.
- [ ] Нет FOUC при загрузке (проверить в incognito).
- [ ] Cookie и localStorage синхронизированы.
- [ ] 3D-навигация не блокирует линейный доступ к контенту.
- [ ] Структурный альтернативный вид работает с клавиатуры.

---

## 11. CSS: архитектура и код-стайл

### 11.1 Карта файлов и зоны ответственности (SRP)

| Файл | Отвечает за | Что НЕ должно быть |
|---|---|---|
| `tokens.css` | CSS-переменные, `:root`, `[data-theme="dark"]`, `[data-theme="high-contrast"]` | селекторы компонентов |
| `typography.css` | базовые стили `body`, `h1–h6`, `p`, `a`, `code` | стили конкретных компонентов |
| `layout.css` | сетки, контейнеры, `.site-header` / `.site-footer` на уровне раскладки | отступы конкретных компонентов |
| `a11y.css` | глобальный `:focus-visible`, `.skip-link`, `prefers-reduced-motion`, скроллбары | цвета компонентов |
| `components.css` | всё, что относится к конкретным UI-компонентам | `:root`, `[data-theme]`, hex, утилиты |

### 11.2 Правила

1. **Токены — единственный источник значений.** Hex/rgb в `components.css` запрещены. Если значения нет — добавьте токен в `tokens.css`, а не хардкодьте.

   **Допустимые hex-исключения в `components.css`** (37 вхождений, существующий долг — фиксируется в issue P2):
   - `#fff` — текст на залитых кнопках (`.skip-link:focus`, `.btn-primary`, `.theme-btn[aria-pressed="true"]`, `.eyebrow::before` и т.д.). Эквивалентен `var(--color-on-accent)`.
   - `#000` / `#fff` — `[data-theme="high-contrast"]` переопределения (`.site-header`, `.btn-primary`, `.btn-outline`, `.btn-secondary`, `.card:hover`, `.site-footer`, `.offcanvas`, `.oc-side-panel`, `.oc-split-row`, `.oc-sub-list a`, `.oc-footer__email`, `.oc-panel-open-link`). High-contrast тема использует чистый чёрный/белый — это намеренно отличается от токенов `--bg-primary` / `--text-primary` (которые в high-contrast дают жёлтый/голубой).
   - `#000` / `#555` — `@media print` (принудительная чёрно-белая печать).

   CI guardrail для hex сейчас работает как `::warning::` (не блокирует мерж). После замены всех 37 hex на `var(--color-on-accent)` / явные токены для high-contrast — переключить на `::error::`.
2. **Тёмная тема — через токены.** Не пишите `[data-theme="dark"] .card { background: #222 }`. Переопределите `--bg-primary` в `tokens.css` — компонент подхватит автоматически.
3. **Фокус — только в `a11y.css`.** Любой локальный `:focus-visible` в компоненте — нарушение. Исключение: `.btn-primary` (усиливает hover-состояние, не дублирует outline) и `.home-carousel__*` (позиционирование фокуса на стрелках).
4. **Утилиты запрещены.** `.mt-2` и подобные — антипаттерн. Отступы задаются в компоненте через `margin-block` / `padding-inline` (логические свойства для RTL-совместимости).
5. **Vendor-префиксы — только с обоснованием.** Допустимы (нет стандартной альтернативы или Safari < 18 требует):
   - `-webkit-font-smoothing` / `-moz-osx-font-smoothing` — нет стандарта, активен во всех WebKit/Blink
   - `-webkit-backdrop-filter` — Safari < 18 (до 2024)
   - `-webkit-background-clip: text` — gradient text требует webkit-префикса до сих пор
   - `-webkit-mask` — SVG-маски, Safari
   - `::-webkit-scrollbar` — нестандартный, единственный способ стилизовать скроллбар в Chrome/Edge

   Всё остальное — удаляется. `-webkit-text-size-adjust` и `-webkit-overflow-scrolling` уже удалены (заменены стандартными свойствами или вообще убраны как устаревшие).
6. **Deprecated-алиасы — с датой удаления.** Каждый алиас обратной совместимости (`--color-surface` → `--bg-primary`) помечается комментарием `/* @deprecated since 2.1.0 — use --bg-primary */` и удаляется не позже чем через один релизный цикл. Список актуальных deprecated-алиасов — в разделе 2.2.

### 11.3 UNIFIED INTERACTIONS блок

В конце `components.css` определён унифицированный блок `UNIFIED INTERACTIONS`, который задаёт единое поведение hover/focus/active для 11 интерактивных классов:

```
.logo, .main-nav-link, .header-icon-btn, .theme-btn, .burger,
.rubrics-toggle, .footer-resource, .footer-social-link,
.btn-secondary, .btn-outline, .btn-primary
```

| Свойство | Hover | Active |
|---|---|---|
| `color` | `var(--accent)` | (сохраняется) |
| `background-color` | `var(--accent-soft)` | (сохраняется) |
| `border-color` | `color-mix(in srgb, var(--accent) 20%, transparent)` | (сохраняется) |
| `transform` | `translateY(-2px)` (lift) | `translateY(0)` (press down) |

`.btn-primary` — особый случай: меняет `background-color` на `--accent-hover`, `color` на `--color-on-accent`, получает усиленный `box-shadow: 0 8px 16px -4px var(--accent-ring)`. Persistent state (`[aria-current="page"]`, `[aria-pressed="true"]`) — без `transform`, только цвет/фон/граница.

### 11.4 CI-guardrails

Нарушения правил 1–4 блокируются workflow `.github/workflows/css-guardrails.yml`:

| Проверка | Файл | Что блокирует |
|---|---|---|
| Запрет `:root` | `components.css` | новые объявления токенов вне `tokens.css` |
| Запрет `[data-theme=...]` | `components.css` | дублирование тем вне `tokens.css` |
| Запрет hex/rgb | `components.css` | хардкод-цвета |
| Запрет утилит | `layout.css` | возврат `.mt-*`, `.mb-*`, `.pt-*`, `.pb-*` |
| Локальный `:focus-visible` | `components.css` | дублирование фокуса (кроме `.btn-primary`, `.home-carousel__*`) |
| Deprecated-алиасы | все 4 файла | `::warning::` (не блокирует) |
| Bundle size | все src/styles/*.css | регресс > +5% от baseline |

Baseline CSS-бандла зафиксирован в `.github/css-baseline.json`.

---

*Последнее обновление: 2026-10-18*
```

