# Анализ дизайн-макета от пользователя (design-reference/)

> **Источник:** `design-reference/index.html` + `design-reference/style.css`
> **Дата анализа:** 2026-10-10
> **Статус:** Принят как референс для нового дизайна (Этап 3 — ревизия)

---

## 🎨 Общая концепция

Дизайн назван **«Золотой день / Ночное небо»** — это двухрежимная палитра с тёплым кремовым фоном в светлой теме и глубоким тёмно-синим в тёмной. Главная фишка — **фон с рукописными физическими формулами** (Caveat font), что идеально подходит для сайта преподавателя технических дисциплин.

### 3 темы оформления
1. **Light** — «Золотой день» (кремовый фон, индиго-акцент)
2. **Dark** — «Ночное небо» (глубокий тёмно-синий, светящийся акцент)
3. **High-contrast** — для слабовидящих (чёрный фон, жёлтый текст, увеличенные кликабельные зоны)

---

## 📦 Разбор на блоки

### Блок 1. Дизайн-токены (CSS variables)

**Файл:** `style.css`, строки 4–97

| Токен | Light | Dark | High-contrast |
|---|---|---|---|
| `--bg-primary` | `#FFFFF5` (кремовый) | `#050A1F` (ночное небо) | `#000000` |
| `--bg-secondary` | `#E5E1DC` | `#0F172A` | `#000000` |
| `--bg-subtle` | `#FEF9E7` | `#1E293B` | `#0A0A0A` |
| `--text-primary` | `#0F172A` | `#F8FAFC` | `#FFFF00` |
| `--text-secondary` | `#475569` | `#94A3B8` | `#FFFFFF` |
| `--accent` | `#4338CA` (индиго) | `#818CF8` (светлее) | `#00FFFF` |
| `--highlight` | `#CA8A04` (золото) | `#FACC15` (жёлтый) | `#FFFF00` |
| `--border` | `#D4CFC7` | `#2A3555` | `#FFFFFF` |
| `--radius` | `16px` | `16px` | `0px` (без скруглений) |
| `--target` | `44px` | `44px` | `56px` (увеличенные зоны) |

**Шрифты:**
- `--font-main: "Inter"` — основной
- `--font-serif: "Merriweather"` — цитаты
- `--font-hand: "Caveat"` — рукописные формулы на фоне

**Контейнер:** `--container: 1160px`

---

### Блок 2. Фон с физическими формулами

**Файл:** `style.css`, строки 130–165

Уникальная фишка: SVG-паттерн с формулами физики, написанными рукописным шрифтом **Caveat**:

| Формулы (11 штук) | Символы (4) | Графические элементы |
|---|---|---|
| `U = I · R` | `Ω` (Ом) | Резисторы (зигзаги) |
| `P = I² · R` | `Φ` (магнитный поток) | Конденсаторы |
| `Q = I² · R · t` | `ρ` (удельное сопротивление) | Источники ЭДС |
| `Φ = B · S` | `α` (угол) | Катушки |
| `A = U · I · t` | | |
| `R = ρ · l / S` | | |
| `P = U · I` | | |
| `F = B·I·L·sinα` | | |
| `I = U / R` | | |
| `L = Φ / I` | | |
| `C = q / U` | | |

**Поведение в темах:**
- **Light:** opacity 0.10–0.13 (едва заметно, как карандаш на бумаге)
- **Dark:** opacity 0.26–0.33 (заметно, как мел на доске)
- **High-contrast:** полностью отключено

---

### Блок 3. HEADER (sticky)

**Файл:** `style.css`, строки 206–280 + `index.html`, строки 24–74

```
┌──────────────────────────────────────────────────────────┐
│ [БД] Бардаков Д. Н.        Обо мне  Обучение  ...    ☀🌙👁 ☰ │
│      Персональный сайт                                    │
└──────────────────────────────────────────────────────────┘
```

**Особенности:**
- Sticky (`position: sticky; top: 0`)
- Полупрозрачный фон с `backdrop-filter: blur(14px)` (эффект матового стекла)
- `background: color-mix(in srgb, var(--bg-secondary) 85%, transparent)`
- Тень `is-scrolled` при прокрутке >6px
- Минимальная высота 68px
- Логотип-монограмма «БД» в градиентном квадрате

**Логотип:**
```html
<a href="/" class="logo">
  <span class="logo-mark">БД</span>  <!-- 38×38px, gradient background -->
  <span class="logo-text">
    <strong>Бардаков Д. Н.</strong>
    <span>Персональный сайт</span>
  </span>
</a>
```

**Theme-switcher:** 3 SVG-иконки (солнце/луна/глаз) с `aria-pressed`

**Бургер-меню (мобильное):** SVG с тремя линиями, открывает overlay

---

### Блок 4. HERO

**Файл:** `style.css`, строки 300–380 + `index.html`, строки 80–125

```
┌────────────────────────────────────────────────────────┐
│                                                        │
│  Персональный сайт преподавателя                       │
│                                                        │
│  Бардаков                          ┌─────────────────┐ │
│  Дмитрий Николаевич                │   SVG с 3D      │ │
│                                    │  многогранником  │ │
│  Преподаватель технических         │   (кристалл     │ │
│  дисциплин высшей категории        │    знаний)      │ │
│  ГБПОУ РО «СИТ»                    │                 │ │
│                                    │  + формулы      │ │
│  «Образование — это не наполнение  │  + точки        │ │
│   сосуда, а зажигание огня.»       │  + круги        │ │
│                                    └─────────────────┘ │
│  [Обо мне]  [Связаться]                                │
│                                                        │
└────────────────────────────────────────────────────────┘
```

**Особенности:**
- Grid-раскладка `1fr 1fr` (контент слева, визуал справа)
- H1: «Бардаков» + `<span class="accent">Дмитрий Николаевич</span>` (акцентный цвет)
- Цитата в `<blockquote class="hero-quote">` — шрифт Merriweather italic
- 2 кнопки: primary (gradient) + outline
- SVG-иллюстрация: 3D-многогранник с линиями, точками и кругами

**SVG-визуал (hero-visual):**
- `viewBox="0 0 400 400"`
- 2 градиента (linearGradient)
- 3D-фигура из 2 параллелограммов (имитация объёмного многогранника)
- Координатная сетка с диагоналями
- 4 точки-акцента по углам
- Пунктирный круг

---

### Блок 5. Сетка карточек (Sections grid)

**Файл:** `style.css`, строки 380–480 + `index.html`, строки 128–170

```
┌──────────────┐ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐
│   [иконка]   │ │   [иконка]   │ │   [иконка]   │ │   [иконка]   │
│  Обо мне     │ │  Обучение    │ │ Абитуриенту  │ │  Воспитание  │
│  описание    │ │  описание    │ │  описание    │ │  описание    │
│  Подробнее → │ │  Подробнее → │ │  Подробнее → │ │  Подробнее → │
└──────────────┘ └──────────────┘ └──────────────┘ └──────────────┘
```

**Особенности:**
- `grid-template-columns: repeat(auto-fit, minmax(260px, 1fr))` — адаптивная сетка
- Карточки с классом `.reveal` — плавное появление через IntersectionObserver
- **Эффект фонарика:** `mousemove` устанавливает `--mx` и `--my`, glow следует за курсором
- Hover: подъём + тень + border accent

**Карточка:**
```css
.card {
  background: var(--bg-subtle);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 28px;
  position: relative;
  transition: transform var(--t-base), box-shadow var(--t-base),
              border-color var(--t-base);
}
.card:hover {
  transform: translateY(-4px);
  border-color: var(--accent);
  box-shadow: var(--shadow-hover);
}
/* Фонарик */
.card::before {
  background: radial-gradient(
    400px circle at var(--mx) var(--my),
    var(--card-glow), transparent 40%
  );
  opacity: 0;
  transition: opacity var(--t-base);
}
.card:hover::before { opacity: 1; }
```

**Иконки карточек:** inline SVG (24×24px), stroke-width 1.8

---

### Блок 6. FOOTER

**Файл:** `style.css`, строки 480–580 + `index.html`, строки 174–246

```
┌────────────────────────────────────────────────────────┐
│  О сайте          │  Навигация       │  Контакты       │
│  Персональный     │  Обо мне        │  📍 Сальск      │
│  сайт...          │  Обучение       │  ✉ Email        │
│                   │  Абитуриенту    │  🕐 Пн-Пт       │
│                   │  Воспитание     │                 │
│                   │  Поиск          │                 │
├────────────────────────────────────────────────────────┤
│              ОФИЦИАЛЬНЫЕ РЕСУРСЫ                        │
│  [Правит.] [Президент] [Минпрос] [Рособрнадзор]        │
│  [Правит.РО] [Минобр.РО]                                │
├────────────────────────────────────────────────────────┤
│  © 2026 Бардаков.рф          Карта сайта               │
└────────────────────────────────────────────────────────┘
```

**Структура:**
- 3-колоночный grid (бренд + навигация + контакты)
- Блок «Официальные ресурсы» с 6 ссылками + SVG-иконками
- Footer-bottom: копирайт + sitemap

**Иконки гос-ресурсов:** inline SVG (20×20px), stroke-width 1.8

---

### Блок 7. Кнопки

**Файл:** `style.css`, строки 280–300

```css
.btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 12px 24px;
  min-height: var(--target); /* 44px */
  font-weight: 600;
  border-radius: var(--radius-sm);
  transition: all var(--t-fast);
}
.btn-primary {
  background: linear-gradient(135deg, var(--accent), var(--accent-hover));
  color: #fff;
  box-shadow: var(--shadow-sm);
}
.btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: var(--shadow);
}
.btn-outline {
  background: transparent;
  border: 1.5px solid var(--border-strong);
  color: var(--text-primary);
}
.btn-outline:hover {
  border-color: var(--accent);
  color: var(--accent);
}
```

---

### Блок 8. JavaScript-интерактив

**Файл:** `index.html`, строки 249–340

5 функций:

1. **Theme-switcher** (строки 251–282)
   - localStorage `bardakov-theme`
   - `prefers-color-scheme` fallback
   - `aria-pressed` на активной кнопке

2. **Sticky header shadow** (строки 285–293)
   - `scrollY > 6` → `is-scrolled` класс

3. **Reveal animations** (строки 296–306)
   - `IntersectionObserver` с `threshold: 0.12`
   - `rootMargin: '0px 0px -60px 0px'`
   - `.reveal` → `.is-visible`

4. **Card glow effect** (строки 309–317)
   - `mousemove` → `--mx`, `--my` CSS variables
   - Радиальный градиент следует за курсором

5. **Mobile menu** (строки 320–339)
   - `is-open` класс на overlay
   - `aria-hidden` / `aria-expanded`
   - `body.style.overflow = 'hidden'` при открытом меню

---

## 🎯 Что перенять в новый проект

### Обязательно
1. **Цветовая палитра «Золотой день / Ночное небо»** — заменить текущие токены
2. **Шрифты:** Inter + Merriweather + Caveat (вместо Manrope)
3. **Фон с формулами** — уникальная фишка, отличительная черта преподавателя физики/электротехники
4. **Hero с SVG-многогранником** — «Кристалл знаний» из DESIGN.md
5. **Эффект фонарика на карточках** — современный, но дозированный
6. **Reveal animations** через IntersectionObserver
7. **Sticky header с blur** (backdrop-filter)
8. **Логотип-монограмма «БД»** в градиентном квадрате

### Опционально
- 6 гос-ссылок вместо 12 (упрощение footer)
- Меньше радиус (16px вместо 20px)

### Не переносить
- Bootstrap Icons (заменить на inline SVG из макета)
- Текущие избыточные компоненты (section-divider wave, badge variants)

---

## 📐 Структура блоков для переноса

| # | Блок | Куда перенести | Приоритет |
|---|---|---|---|
| 1 | Токены (палитра + шрифты) | `src/styles/tokens.css` | высокий |
| 2 | Фон с формулами | `src/styles/background.css` (новый) | высокий |
| 3 | Базовые стили + skip-link | `src/styles/base.css` | высокий |
| 4 | Header | `src/_includes/components/header.njk` | высокий |
| 5 | Hero | `src/_includes/components/hero.njk` (новый) | высокий |
| 6 | Карточки с glow | `src/_includes/components/card.njk` | высокий |
| 7 | Footer | `src/_includes/components/footer.njk` | высокий |
| 8 | Кнопки | `src/_includes/components/button.njk` | высокий |
| 9 | Mobile menu overlay | `src/_includes/components/mobile-menu.njk` (новый) | средний |
| 10 | JS: theme + scroll + reveal + glow | `src/assets/js/main.js` | высокий |
| 11 | Шрифты Inter + Merriweather + Caveat | `src/assets/fonts/` | высокий |

---

## 🚀 План интеграции

1. **Скачать шрифты** Inter, Merriweather, Caveat (self-hosted, woff2, cyrillic)
2. **Обновить `tokens.css`** — заменить палитру на «Золотой день / Ночное небо»
3. **Создать `background.css`** — SVG-паттерн с формулами
4. **Переписать `header.njk`** — монограмма «БД», inline SVG иконки, blur фон
5. **Создать `hero.njk`** — компонент с SVG-многогранником
6. **Переписать `card.njk`** — добавить glow-эффект, reveal-анимацию
7. **Переписать `footer.njk`** — 3 колонки + 6 гос-ссылок
8. **Обновить `main.js`** — добавить IntersectionObserver + card glow
9. **Удалить Bootstrap Icons** — заменить на inline SVG

---

*Документ создан: 2026-10-10*
