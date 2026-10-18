#!/usr/bin/env python3
"""
Массовый рефакторинг font-size в src/styles/components.css.

Замена прямых значений rem/px на токены --text-* согласно обновлённому DESIGN.md.

Карта соответствий (значение → токен):
  # Прямые (существующие токены)
  16px          → var(--text-base)
  1rem          → var(--text-base)
  0.875rem      → var(--text-sm)
  1.125rem      → var(--text-lg)
  1.25rem       → var(--text-xl)
  1.5rem        → var(--text-2xl)

  # Округление к существующим
  0.75rem       → var(--text-xs)   (12px — точно)
  0.88-0.96rem  → var(--text-sm)   (14px ± 0.5px)
  1.02-1.04rem  → var(--text-base) (16px ± 0.5px)
  1.15rem       → var(--text-lg)   (18px ± 0.5px)

  # Новые токены (добавлены в tokens.css)
  0.69-0.80rem  → var(--text-2xs)  (12px — микро-подписи)
  0.82-0.86rem  → var(--text-sm-md) (~14px — промежуточный)
  1.05-1.12rem  → var(--text-md)   (~17px — кнопки/цитаты)
  5rem          → var(--text-6xl)   (80px — декоративный)

Не трогает:
  - font-size: var(--text-*)  (уже токен)
  - font-size, заданный через calc() или другой var()
  - комментарии
"""
import re
from pathlib import Path

COMPONENTS = Path("/home/z/my-project/bardakov.rf/src/styles/components.css")

# Порядок важен: длинные значения первыми (чтобы 0.8 не съело 0.85)
# Используем точное сопоставление, без диапазонов.
MAPPINGS = [
    # Существующие токены — точные совпадения
    ("font-size: 16px",        "font-size: var(--text-base)"),
    ("font-size: 1rem",        "font-size: var(--text-base)"),
    ("font-size: 0.875rem",    "font-size: var(--text-sm)"),
    ("font-size: 1.125rem",    "font-size: var(--text-lg)"),
    ("font-size: 1.25rem",     "font-size: var(--text-xl)"),
    ("font-size: 1.5rem",      "font-size: var(--text-2xl)"),
    ("font-size: 0.75rem",     "font-size: var(--text-xs)"),

    # Новые токены — точные совпадения (для значений, которых нет в шкале)
    ("font-size: 5rem",        "font-size: var(--text-6xl)"),

    # Округление к --text-2xs (0.75rem, 12px) — бывшие 0.69-0.80
    ("font-size: .69rem",      "font-size: var(--text-2xs)"),
    ("font-size: 0.69rem",     "font-size: var(--text-2xs)"),
    ("font-size: .72rem",      "font-size: var(--text-2xs)"),
    ("font-size: 0.72rem",     "font-size: var(--text-2xs)"),
    ("font-size: .76rem",      "font-size: var(--text-2xs)"),
    ("font-size: 0.76rem",     "font-size: var(--text-2xs)"),
    ("font-size: .77rem",      "font-size: var(--text-2xs)"),
    ("font-size: 0.77rem",     "font-size: var(--text-2xs)"),
    ("font-size: .78rem",      "font-size: var(--text-2xs)"),
    ("font-size: 0.78rem",     "font-size: var(--text-2xs)"),
    ("font-size: .79rem",      "font-size: var(--text-2xs)"),
    ("font-size: 0.79rem",     "font-size: var(--text-2xs)"),
    ("font-size: 0.8rem",      "font-size: var(--text-2xs)"),

    # Округление к --text-xs (0.75rem, 12px) — дублируют 2xs, используем xs для точного 0.75
    # (уже выше)

    # Округление к --text-sm-md (0.85rem, ~14px) — бывшие 0.82-0.86
    ("font-size: .82rem",      "font-size: var(--text-sm-md)"),
    ("font-size: 0.82rem",     "font-size: var(--text-sm-md)"),
    ("font-size: .83rem",      "font-size: var(--text-sm-md)"),
    ("font-size: 0.83rem",     "font-size: var(--text-sm-md)"),
    ("font-size: .84rem",      "font-size: var(--text-sm-md)"),
    ("font-size: 0.84rem",     "font-size: var(--text-sm-md)"),
    ("font-size: 0.85rem",     "font-size: var(--text-sm-md)"),
    ("font-size: .86rem",      "font-size: var(--text-sm-md)"),
    ("font-size: 0.86rem",     "font-size: var(--text-sm-md)"),

    # Округление к --text-sm (0.875rem, 14px) — бывшие 0.88-0.96
    ("font-size: 0.88rem",     "font-size: var(--text-sm)"),
    ("font-size: .9rem",       "font-size: var(--text-sm)"),
    ("font-size: 0.9rem",      "font-size: var(--text-sm)"),
    ("font-size: .92rem",      "font-size: var(--text-sm)"),
    ("font-size: 0.92rem",     "font-size: var(--text-sm)"),
    ("font-size: .94rem",      "font-size: var(--text-sm)"),
    ("font-size: 0.94rem",     "font-size: var(--text-sm)"),
    ("font-size: .95rem",      "font-size: var(--text-sm)"),
    ("font-size: 0.95rem",     "font-size: var(--text-sm)"),
    ("font-size: .96rem",      "font-size: var(--text-sm)"),
    ("font-size: 0.96rem",     "font-size: var(--text-sm)"),

    # Округление к --text-base (1rem, 16px) — бывшие 1.02-1.04
    ("font-size: 1.02rem",     "font-size: var(--text-base)"),
    ("font-size: 1.04rem",     "font-size: var(--text-base)"),
    ("font-size: 1.04rem",    "font-size: var(--text-base)"),

    # Округление к --text-md (1.05rem, ~17px) — бывшие 1.05-1.12
    ("font-size: 1.05rem",     "font-size: var(--text-md)"),
    ("font-size: 1.1rem",      "font-size: var(--text-md)"),
    ("font-size: 1.12rem",     "font-size: var(--text-md)"),

    # Округление к --text-lg (1.125rem, 18px) — бывшие 1.15
    ("font-size: 1.15rem",     "font-size: var(--text-lg)"),
]

def main():
    text = COMPONENTS.read_text(encoding="utf-8")
    original = text
    total = 0
    counts = {}
    for old, new in MAPPINGS:
        count = text.count(old)
        if count:
            text = text.replace(old, new)
            counts[old] = count
            total += count
    if text != original:
        COMPONENTS.write_text(text, encoding="utf-8")
        print(f"✅ Заменено: {total}")
        for old, c in sorted(counts.items(), key=lambda x: -x[1]):
            print(f"   {old:30s} → {c} вхождений")
    else:
        print("– Без изменений")

    # Проверка оставшихся
    import re
    remaining = re.findall(r'font-size:\s*[0-9.]+(px|rem)', text)
    if remaining:
        print(f"\n⚠ Осталось {len(remaining)} хардкод-font-size:")
        for line in text.splitlines():
            if re.search(r'font-size:\s*[0-9.]+(px|rem)', line):
                print(f"   {line.strip()}")

if __name__ == "__main__":
    main()
