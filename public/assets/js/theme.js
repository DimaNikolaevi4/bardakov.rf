/* ============================================================
 * theme.js — Управление темами оформления (light / dark / high-contrast)
 * Источник: design-reference/index.html (строки 251-282)
 * Создано: 2026-10-10 (Этап B интеграции)
 *
 * Хранение: localStorage 'bardakov-theme'
 * Приоритет: localStorage > prefers-color-scheme > light
 *
 * ВАЖНО: тема хранится на body[data-theme], а НЕ на html[data-theme]
 * ============================================================ */

(function () {
  "use strict";

  const KEY = 'bardakov-theme';
  const allowed = ['light', 'dark', 'high-contrast'];

  function apply(theme) {
    if (!allowed.includes(theme)) theme = 'light';
    document.body.setAttribute('data-theme', theme);
    document.querySelectorAll('.theme-btn').forEach(btn => {
      btn.setAttribute('aria-pressed', btn.dataset.theme === theme ? 'true' : 'false');
    });
  }

  function init() {
    let saved = null;
    try { saved = localStorage.getItem(KEY); } catch (e) {}
    if (saved && allowed.includes(saved)) {
      apply(saved);
    } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
      apply('dark');
    } else {
      apply('light');
    }

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

  window.BardakovTheme = {
    apply: apply,
    get: () => document.body.getAttribute('data-theme') || 'light'
  };
})();
