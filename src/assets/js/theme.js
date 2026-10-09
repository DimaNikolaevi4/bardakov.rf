/* ============================================================
 * theme.js — Управление темами оформления (light / dark / vi)
 * Источник: old/DESIGN.md §8
 * Создано: 2026-10-09 (Этап 3.3)
 *
 * Хранение:
 * - Cookie `theme` (для SSR в будущем)
 * - localStorage `theme` (для мгновенного доступа)
 *
 * Приоритет при загрузке (выполняется в base.njk inline):
 * 1. Cookie
 * 2. localStorage
 * 3. prefers-color-scheme (только для light/dark)
 * 4. По умолчанию: light
 *
 * VI-тема никогда не включается автоматически.
 * ============================================================ */

(function () {
  "use strict";

  const THEMES = ["light", "dark", "vi"];
  const STORAGE_KEY = "theme";
  const COOKIE_MAX_AGE = 31536000; // 1 год

  /**
   * Записывает тему в cookie и localStorage
   */
  function setTheme(theme) {
    if (!THEMES.includes(theme)) {
      console.warn(`Неизвестная тема: ${theme}. Доступные: ${THEMES.join(", ")}`);
      return;
    }
    document.documentElement.dataset.theme = theme;
    document.cookie = `${STORAGE_KEY}=${theme}; max-age=${COOKIE_MAX_AGE}; path=/; SameSite=Lax`;
    try {
      localStorage.setItem(STORAGE_KEY, theme);
    } catch (e) {
      // localStorage может быть недоступен (приватный режим)
    }

    // Обновляем aria-pressed у кнопок переключателя
    document.querySelectorAll(".theme-btn").forEach((btn) => {
      const isActive = btn.dataset.theme === theme;
      btn.setAttribute("aria-pressed", isActive);
    });

    // Событие для других модулей (a11y-panel, pagefind)
    document.dispatchEvent(
      new CustomEvent("themechange", {
        detail: { theme },
      })
    );
  }

  /**
   * Получает текущую тему
   */
  function getTheme() {
    return document.documentElement.dataset.theme || "light";
  }

  /**
   * Инициализация переключателей темы
   */
  function initThemeSwitchers() {
    const buttons = document.querySelectorAll(".theme-btn");
    buttons.forEach((btn) => {
      btn.addEventListener("click", () => {
        setTheme(btn.dataset.theme);
      });
    });
  }

  // Инициализация после загрузки DOM
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initThemeSwitchers);
  } else {
    initThemeSwitchers();
  }

  // Экспорт для использования в других модулях
  window.BardakovTheme = {
    set: setTheme,
    get: getTheme,
  };
})();
