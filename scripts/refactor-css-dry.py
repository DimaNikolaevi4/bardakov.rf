#!/usr/bin/env python3
"""
Рефакторинг components.css — DRY для интерактивных элементов шапки.
Удаляет разрозненные :hover/:focus-visible/.active правила и
заменяет их двумя унифицированными блоками (light + dark).
"""

import re
from pathlib import Path

CSS_PATH = Path(__file__).resolve().parent.parent / "src" / "styles" / "components.css"

# Читаем файл
content = CSS_PATH.read_text(encoding="utf-8")
content = content.replace("\r\n", "\n")
original = content

# === УДАЛЕНИЕ СТАРЫХ ПРАВИЛ ===

# 1. .logo:hover (строки ~241-244)
content = re.sub(
    r'\.logo:hover \{\s*color: var\(--accent\);\s*background: var\(--accent-soft\);\s*\}\s*',
    '/* .logo:hover — moved to unified header-interactive block */\n',
    content, count=1)

# 2. .logo:focus-visible (строки ~245-248)
content = re.sub(
    r'\.logo:focus-visible \{\s*outline: 2px solid var\(--accent-ring\);\s*outline-offset: 2px;\s*\}\s*',
    '/* .logo:focus-visible — moved to unified block */\n',
    content, count=1)

# 3. [data-theme="dark"] .logo:hover/focus-visible — КОНФЛИКТУЮЩИЕ (удаляем!)
content = re.sub(
    r'\[data-theme="dark"\] \.logo:hover,\s*\n\[data-theme="dark"\] \.logo:focus-visible \{[^}]*\}\s*'
    r'\[data-theme="dark"\] \.logo:hover \.logo-mark,\s*\n\[data-theme="dark"\] \.logo:focus-visible \.logo-mark \{[^}]*\}\s*',
    '/* [data-theme="dark"] .logo hover/focus — REMOVED: conflicts with unified rules */\n',
    content, count=1)

# 4. .theme-btn:hover (compact) — строка ~302
content = re.sub(
    r'\.theme-btn:hover \{ color: var\(--text-primary\); \}\s*',
    '/* .theme-btn:hover — moved to unified block */\n',
    content, count=1)

# 5. .oc-split-row__link:hover (compact) — ~1751
content = re.sub(
    r'\.oc-split-row__link:hover \{\s*background-color: var\(--accent-soft\);\s*\}\s*',
    '/* .oc-split-row__link:hover — moved to unified block */\n',
    content, count=1)

# 6. .oc-split-row__link.active (compact) — ~1754
content = re.sub(
    r'\.oc-split-row__link\.active \{\s*color: var\(--accent\);\s*background-color: var\(--accent-soft\);\s*\}\s*',
    '/* .oc-split-row__link.active — moved to unified block */\n',
    content, count=1)

# 7. .oc-split-row__toggle:hover (compact) — ~1776
content = re.sub(
    r'\.oc-split-row__toggle:hover \{\s*color: var\(--accent\);\s*background-color: var\(--accent-soft\);\s*\}\s*',
    '/* .oc-split-row__toggle:hover — moved to unified block */\n',
    content, count=1)

# 8. .oc-panel-open-link:hover (compact) — ~1904
content = re.sub(
    r'\.oc-panel-open-link:hover \{\s*background-color: var\(--accent-soft\);\s*\}\s*',
    '/* .oc-panel-open-link:hover — moved to unified block */\n',
    content, count=1)

# 9. .oc-sub-list a:hover (compact) — ~1924
content = re.sub(
    r'\.oc-sub-list a:hover \{\s*background-color: var\(--accent-soft\);\s*color: var\(--accent\);\s*\}\s*',
    '/* .oc-sub-list a:hover — moved to unified block */\n',
    content, count=1)

# 10. .close-btn:hover (compact) — ~2230
content = re.sub(
    r'\.close-btn:hover \{\s*background-color: var\(--accent-soft\);\s*color: var\(--accent\);\s*\}\s*',
    '/* .close-btn:hover — moved to unified block */\n',
    content, count=1)

# 11. .close-btn:focus-visible (compact) — ~2234
content = re.sub(
    r'\.close-btn:focus-visible \{\s*outline: 3px solid var\(--accent-ring\);\s*outline-offset: 2px;\s*\}\s*',
    '/* .close-btn:focus-visible — moved to unified block */\n',
    content, count=1)

# 12. .main-nav a.main-nav-link:hover, [aria-current] (compact) — ~2268
content = re.sub(
    r'\.main-nav a\.main-nav-link:hover,\s*\n\.main-nav a\.main-nav-link\[aria-current="page"\] \{\s*'
    r'color: var\(--accent\);\s*background: var\(--accent-soft\);\s*\}\s*',
    '/* .main-nav-link:hover/[aria-current] — moved to unified block */\n',
    content, count=1)

# 13. .header-icon-btn:hover, [aria-expanded] (compact) — ~2306
content = re.sub(
    r'\.header-icon-btn:hover,\s*\n\.header-icon-btn\[aria-expanded="true"\] \{\s*'
    r'color: var\(--accent\);\s*background: var\(--accent-soft\);\s*'
    r'border-color: color-mix\(in srgb, var\(--accent\) 20%, transparent\);\s*\}\s*',
    '/* .header-icon-btn:hover/[aria-expanded] — moved to unified block */\n',
    content, count=1)

# 14. .theme-btn[aria-pressed="true"] (compact) — ~2323
content = re.sub(
    r'\.theme-btn\[aria-pressed="true"\] \{ color: var\(--bg-primary\); \}\s*',
    '/* .theme-btn[aria-pressed] — moved to unified block */\n',
    content, count=1)

# 15. .rubrics-toggle:hover — ~2480
content = re.sub(
    r'\.rubrics-toggle:hover \{ border-color: var\(--accent\); \}\s*',
    '/* .rubrics-toggle:hover — moved to unified block */\n',
    content, count=1)

# 16. Duplicate main-nav-link:hover (expanded) — ~2432
content = re.sub(
    r'\.main-nav a\.main-nav-link:hover,\s*\n\.main-nav a\.main-nav-link\[aria-current="page"\] \{\s*'
    r'color: var\(--accent\);\s*background: var\(--menu-wash\);\s*\}\s*',
    '/* .main-nav-link:hover (expanded) — moved to unified block */\n',
    content, count=1)

# 17. Duplicate header-icon-btn:hover (expanded) — ~2454
content = re.sub(
    r'\.header-icon-btn:hover,\s*\n\.header-icon-btn\[aria-expanded="true"\] \{\s*'
    r'color: var\(--accent\);\s*background: var\(--menu-wash\);\s*'
    r'border-color: color-mix\(in srgb, var\(--accent\) 24%, transparent\);\s*\}\s*',
    '/* .header-icon-btn:hover (expanded) — moved to unified block */\n',
    content, count=1)

# 18. Duplicate theme-btn[aria-pressed] (expanded) — ~2466
content = re.sub(
    r'\.theme-btn\[aria-pressed="true"\] \{\s*'
    r'color: var\(--bg-primary\);\s*background: var\(--accent\);\s*box-shadow: none;\s*\}\s*',
    '/* .theme-btn[aria-pressed] (expanded) — moved to unified block */\n',
    content, count=1)

# 19. .oc-split-row__link:hover (expanded) — ~2596
content = re.sub(
    r'\.oc-split-row__link:hover \{ background: transparent; \}\s*',
    '/* .oc-split-row__link:hover (expanded) — moved to unified block */\n',
    content, count=1)

# 20. .oc-split-row__link.active (expanded) — ~2597
content = re.sub(
    r'\.oc-split-row__link\.active \{\s*color: var\(--accent\);\s*background: transparent;\s*\}\s*',
    '/* .oc-split-row__link.active (expanded) — moved to unified block */\n',
    content, count=1)

# 21. .oc-sub-list a:hover, .active (expanded) — ~2667
content = re.sub(
    r'\.oc-sub-list a:hover,\s*\n\.oc-sub-list a\.active \{\s*'
    r'border-color: color-mix\(in srgb, var\(--accent\) 25%, transparent\);\s*'
    r'color: var\(--accent\);\s*background: var\(--menu-wash\);\s*\}\s*',
    '/* .oc-sub-list a:hover/.active (expanded) — moved to unified block */\n',
    content, count=1)

# === ДОБАВЛЕНИЕ УНИФИЦИРОВАННЫХ БЛОКОВ ===
# Вставляем перед [data-theme="dark"] .site-header

unified_block = """
/* ═══════════════════════════════════════════════════════════
   УНИФИЦИРОВАННЫЕ ПРАВИЛА ИНТЕРАКТИВНЫХ ЭЛЕМЕНТОВ ШАПКИ (DRY)
   Единое поведение hover/focus/active для всех кнопок и ссылок
   ═══════════════════════════════════════════════════════════ */

/* Светлая тема (по умолчанию) */
.logo:hover,
.logo:focus-visible,
.main-nav-link:hover,
.main-nav-link[aria-current="page"],
.header-icon-btn:hover,
.header-icon-btn[aria-expanded="true"],
.theme-btn:hover,
.theme-btn[aria-pressed="true"],
.burger:hover,
.rubrics-toggle:hover,
.close-btn:hover,
.close-btn:focus-visible,
.oc-split-row__link:hover,
.oc-split-row__link.active,
.oc-split-row__toggle:hover,
.oc-sub-list a:hover,
.oc-sub-list a.active,
.oc-panel-open-link:hover {
  color: var(--accent);
  background-color: var(--accent-soft);
  border-color: color-mix(in srgb, var(--accent) 20%, transparent);
}

/* Focus-visible — outline для доступности */
.logo:focus-visible,
.close-btn:focus-visible,
.header-icon-btn:focus-visible,
.theme-btn:focus-visible,
.main-nav-link:focus-visible,
.oc-split-row__link:focus-visible,
.oc-split-row__toggle:focus-visible,
.oc-sub-list a:focus-visible,
.oc-panel-open-link:focus-visible {
  outline: 2px solid var(--accent-ring);
  outline-offset: 2px;
}

/* Тёмная тема — те же правила, токены меняются автоматически */
[data-theme="dark"] .logo:hover,
[data-theme="dark"] .logo:focus-visible,
[data-theme="dark"] .main-nav-link:hover,
[data-theme="dark"] .main-nav-link[aria-current="page"],
[data-theme="dark"] .header-icon-btn:hover,
[data-theme="dark"] .header-icon-btn[aria-expanded="true"],
[data-theme="dark"] .theme-btn:hover,
[data-theme="dark"] .theme-btn[aria-pressed="true"],
[data-theme="dark"] .burger:hover,
[data-theme="dark"] .rubrics-toggle:hover,
[data-theme="dark"] .close-btn:hover,
[data-theme="dark"] .close-btn:focus-visible,
[data-theme="dark"] .oc-split-row__link:hover,
[data-theme="dark"] .oc-split-row__link.active,
[data-theme="dark"] .oc-split-row__toggle:hover,
[data-theme="dark"] .oc-sub-list a:hover,
[data-theme="dark"] .oc-sub-list a.active,
[data-theme="dark"] .oc-panel-open-link:hover {
  color: var(--accent);
  background-color: var(--accent-soft);
  border-color: color-mix(in srgb, var(--accent) 20%, transparent);
}

[data-theme="dark"] .logo:focus-visible,
[data-theme="dark"] .close-btn:focus-visible,
[data-theme="dark"] .header-icon-btn:focus-visible,
[data-theme="dark"] .theme-btn:focus-visible,
[data-theme="dark"] .main-nav-link:focus-visible {
  outline: 2px solid var(--accent-ring);
  outline-offset: 2px;
}

/* ═══════════════════════════════════════════════════════════ */

"""

# Вставляем перед первым [data-theme="dark"] .site-header
insert_point = content.find('[data-theme="dark"] .site-header')
if insert_point > 0:
    content = content[:insert_point] + unified_block + content[insert_point:]
else:
    # Если не нашли — добавляем в конец
    content += "\n" + unified_block

# Записываем
CSS_PATH.write_text(content, encoding="utf-8")

# Подсчёт изменений
removed_count = original.count(':hover') + original.count(':focus-visible') + original.count('.active') + original.count('[aria-pressed')
new_count = content.count(':hover') + content.count(':focus-visible') + content.count('.active') + content.count('[aria-pressed')
comment_count = content.count('moved to unified block')

print(f"✅ Рефакторинг завершён")
print(f"   Размер файла: {len(original)} → {len(content)} символов")
print(f"   Удалено старых правил: {comment_count}")
print(f"   Добавлен унифицированный блок: ~50 строк")
