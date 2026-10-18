/* ============================================================
 * theme.js — Управление темами оформления (light / dark / high-contrast)
 * Источник: design-reference/index.html (строки 251-282)
 * Создано: 2026-10-10 (Этап B интеграции)
 *
 * Хранение: localStorage 'bardakov-theme'
 * Приоритет: localStorage > prefers-color-scheme > light
 *
 * Тема ставится на <html> (document.documentElement), а НЕ на <body>:
 *   - CSS-токены [data-theme="dark"] и [data-theme="high-contrast"]
 *     объявлены в tokens.css на уровне :root (=== html)
 *   - если ставить на body, токены --bg-primary / --menu-paper
 *     не пересчитываются и шапка остаётся светлой
 *
 * FOUC-защита (inline-скрипт в base.njk) тоже ставит на <html>,
 * чтобы тема применялась ДО первого рендера.
 * ============================================================ */

(function () {
  "use strict";

  const KEY = 'bardakov-theme';
  const allowed = ['light', 'dark', 'high-contrast'];
  const root = document.documentElement;

  function apply(theme) {
    if (!allowed.includes(theme)) theme = 'light';
    // Ставим на <html>, не на <body> — см. комментарий в шапке файла.
    root.setAttribute('data-theme', theme);
    // Синхронизируем aria-pressed кнопок с активной темой.
    document.querySelectorAll('.theme-btn').forEach(btn => {
      btn.setAttribute('aria-pressed', btn.dataset.theme === theme ? 'true' : 'false');
    });
  }

  function init() {
    // Считываем текущую тему с <html> (FOUC-скрипт уже выставил её
    // на загрузке) — используем именно этот источник, а не ещё одну
    // попытку localStorage / matchMedia, чтобы избежать рассинхрона.
    const current = root.getAttribute('data-theme');
    if (current && allowed.includes(current)) {
      // Синхронизируем aria-pressed с фактической темой на <html>.
      document.querySelectorAll('.theme-btn').forEach(btn => {
        btn.setAttribute('aria-pressed', btn.dataset.theme === current ? 'true' : 'false');
      });
    } else {
      // Фолбэк: если FOUC-скрипт не отработал (например, JS отключён
      // до DOMContentLoaded), применяем тему здесь.
      let saved = null;
      try { saved = localStorage.getItem(KEY); } catch (e) {}
      if (saved && allowed.includes(saved)) {
        apply(saved);
      } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        apply('dark');
      } else {
        apply('light');
      }
    }

    // Слушаем изменения системной темы (только если нет сохранённого выбора).
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
      let saved = null;
      try { saved = localStorage.getItem(KEY); } catch (err) {}
      if (!saved) {
        apply(e.matches ? 'dark' : 'light');
      }
    });

    // Клик по кнопке переключателя тем.
    document.querySelectorAll('.theme-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const theme = btn.dataset.theme;
        apply(theme);
        try { localStorage.setItem(KEY, theme); } catch (e) {}
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Публичный API (для a11y-panel и возможных внешних скриптов).
  window.BardakovTheme = {
    apply: apply,
    get: () => root.getAttribute('data-theme') || 'light'
  };
})();
