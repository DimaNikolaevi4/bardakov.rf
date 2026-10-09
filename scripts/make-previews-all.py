#!/usr/bin/env python3
"""
Создаёт 3 автономных preview HTML файла: light, dark, vi тема.
С принудительной установкой темы через data-атрибут.

Создано: 2026-10-09 (Этап 3.4)
"""

import re
import sys
from pathlib import Path

# Импортируем функции из make-preview.py
sys.path.insert(0, str(Path(__file__).resolve().parent))
from make_preview import (
    read_file, inline_css, inline_js, inline_images, inline_css_url_references
)

REPO_ROOT = Path(__file__).resolve().parent.parent
PUBLIC_DIR = REPO_ROOT / "public"
DOWNLOAD_DIR = REPO_ROOT / "download"


def create_preview(theme: str):
    """Создаёт preview HTML для указанной темы."""
    print(f"\n🎨 Создание preview для темы: {theme}")

    index_html = read_file(PUBLIC_DIR / "index.html")
    if not index_html:
        print("❌ Не найден public/index.html")
        return

    # Inline CSS, JS, images, url()
    html = inline_css(index_html)
    html = inline_js(html)
    html = inline_images(html)

    def replace_url_in_style(match):
        css = match.group(1)
        return f"<style>{inline_css_url_references(css)}</style>"

    html = re.sub(r"<style>(.*?)</style>", replace_url_in_style, html, flags=re.DOTALL)

    # Удаляем FOUC-скрипт и Metrika
    html = re.sub(
        r"<!-- FOUC protection.*?</script>",
        f"<!-- FOUC protection: forced to {theme} -->",
        html,
        flags=re.DOTALL,
    )
    html = re.sub(
        r"<!-- Yandex.Metrika.*?</noscript>",
        "<!-- Yandex.Metrika disabled for preview -->",
        html,
        flags=re.DOTALL,
    )

    # Принудительно устанавливаем тему
    # Заменяем <html lang="ru" data-theme="light"> на нужную тему
    html = re.sub(
        r'<html\s+([^>]*?)data-theme="[^"]*"([^>]*?)>',
        f'<html \\1data-theme="{theme}"\\2>',
        html,
    )

    # Добавляем inline-скрипт для блокировки переключения темы
    # (чтобы пользователь не мог переключить тему случайно)
    inject_script = f"""
<script>
// Принудительная тема для preview: {theme}
(function() {{
  document.documentElement.dataset.theme = '{theme}';
  // Блокируем переключение
  document.addEventListener('click', function(e) {{
    if (e.target.closest('.theme-btn')) {{
      e.preventDefault();
      e.stopPropagation();
      alert('Preview mode: тема заблокирована на {theme}. Скачайте full preview.html для интерактивного переключения.');
    }}
  }}, true);
}})();
</script>
"""
    html = html.replace("</body>", f"{inject_script}\n</body>")

    output_file = DOWNLOAD_DIR / f"preview-{theme}.html"
    output_file.write_text(html, encoding="utf-8")

    size_mb = output_file.stat().st_size / (1024 * 1024)
    print(f"   ✅ {output_file.name}: {size_mb:.2f} MB")


def main():
    print("=" * 60)
    print("Создание 3 preview файлов (light/dark/vi)")
    print("=" * 60)

    DOWNLOAD_DIR.mkdir(parents=True, exist_ok=True)

    for theme in ["light", "dark", "vi"]:
        create_preview(theme)

    print(f"\n📁 Все файлы в: {DOWNLOAD_DIR}")
    print(f"   - preview-light.html (светлая тема)")
    print(f"   - preview-dark.html (тёмная тема)")
    print(f"   - preview-vi.html (версия для слабовидящих)")
    print(f"   - preview-bardakov.rf.html (интерактивная, с переключением тем)")


if __name__ == "__main__":
    main()
