/* ============================================================
 * a11y.js — Управление панелью доступности
 * Источник: old/DESIGN.md §6.5
 * Создано: 2026-10-09 (Этап 3.3)
 *
 * Функции:
 * 1. Открытие/закрытие панели (кнопка в шапке)
 * 2. Размер шрифта (A-/A/A+) — через --font-scale
 * 3. Отключение изображений (data-images="off")
 * 4. Системный шрифт (data-font="system")
 * 5. Отключение анимаций (data-animations="off")
 * 6. Сброс всех настроек
 *
 * Хранение: localStorage
 * ============================================================ */

(function () {
  "use strict";

  const STORAGE = {
    FONT_SCALE: "a11y-font-scale",
    IMAGES: "a11y-images",
    FONT: "a11y-font",
    ANIMATIONS: "a11y-animations",
  };

  /**
   * Открывает панель доступности
   */
  function openA11yPanel() {
    const panel = document.getElementById("a11yPanel");
    const backdrop = document.getElementById("a11yBackdrop");
    const toggleBtn = document.getElementById("a11y-toggle");

    if (!panel) return;

    panel.setAttribute("aria-hidden", "false");
    if (backdrop) backdrop.setAttribute("aria-hidden", "false");
    if (toggleBtn) toggleBtn.setAttribute("aria-expanded", "true");

    document.body.classList.add("no-scroll");

    // Фокус на первой интерактивной кнопке
    const firstFocusable = panel.querySelector("button, input, a, [tabindex]");
    if (firstFocusable) {
      setTimeout(() => firstFocusable.focus(), 100);
    }

    // Закрытие по Escape
    document.addEventListener("keydown", escapeCloseHandler);

    // Фокус-ловушка
    panel.addEventListener("keydown", focusTrap);
  }

  /**
   * Закрывает панель доступности
   */
  function closeA11yPanel() {
    const panel = document.getElementById("a11yPanel");
    const backdrop = document.getElementById("a11yBackdrop");
    const toggleBtn = document.getElementById("a11y-toggle");

    if (!panel) return;

    panel.setAttribute("aria-hidden", "true");
    if (backdrop) backdrop.setAttribute("aria-hidden", "true");
    if (toggleBtn) {
      toggleBtn.setAttribute("aria-expanded", "false");
      toggleBtn.focus();
    }

    document.body.classList.remove("no-scroll");
    document.removeEventListener("keydown", escapeCloseHandler);
    panel.removeEventListener("keydown", focusTrap);
  }

  function escapeCloseHandler(e) {
    if (e.key === "Escape") {
      closeA11yPanel();
    }
  }

  /**
   * Фокус-ловушка внутри панели
   */
  function focusTrap(e) {
    if (e.key !== "Tab") return;

    const panel = e.currentTarget;
    const focusable = panel.querySelectorAll(
      'button, input, a, [tabindex]:not([tabindex="-1"])'
    );
    if (focusable.length === 0) return;

    const first = focusable[0];
    const last = focusable[focusable.length - 1];

    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault();
      last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault();
      first.focus();
    }
  }

  /**
   * Установка размера шрифта
   */
  function setFontScale(scale) {
    document.documentElement.style.setProperty("--font-scale", scale);
    try {
      localStorage.setItem(STORAGE.FONT_SCALE, scale);
    } catch (e) {}

    // Обновляем aria-pressed
    document.querySelectorAll(".a11y-font-btn").forEach((btn) => {
      btn.setAttribute(
        "aria-pressed",
        btn.dataset.fontScale === String(scale)
      );
    });
  }

  /**
   * Переключение изображений
   */
  function toggleImages(off) {
    if (off) {
      document.documentElement.dataset.images = "off";
      try {
        localStorage.setItem(STORAGE.IMAGES, "off");
      } catch (e) {}
    } else {
      delete document.documentElement.dataset.images;
      try {
        localStorage.removeItem(STORAGE.IMAGES);
      } catch (e) {}
    }
  }

  /**
   * Системный шрифт
   */
  function toggleSystemFont(on) {
    if (on) {
      document.documentElement.dataset.font = "system";
      try {
        localStorage.setItem(STORAGE.FONT, "system");
      } catch (e) {}
    } else {
      delete document.documentElement.dataset.font;
      try {
        localStorage.removeItem(STORAGE.FONT);
      } catch (e) {}
    }
  }

  /**
   * Анимации
   */
  function toggleAnimations(off) {
    if (off) {
      document.documentElement.dataset.animations = "off";
      try {
        localStorage.setItem(STORAGE.ANIMATIONS, "off");
      } catch (e) {}
    } else {
      delete document.documentElement.dataset.animations;
      try {
        localStorage.removeItem(STORAGE.ANIMATIONS);
      } catch (e) {}
    }
  }

  /**
   * Сброс всех настроек
   */
  function resetAll() {
    setFontScale(1);
    toggleImages(false);
    toggleSystemFont(false);
    toggleAnimations(false);

    // Снимаем все чекбоксы
    document.querySelectorAll('.a11y-panel input[type="checkbox"]').forEach(
      (cb) => {
        cb.checked = false;
      }
    );

    // Возвращаем тему на light
    if (window.BardakovTheme) {
      window.BardakovTheme.set("light");
    }
  }

  /**
   * Восстанавливает настройки из localStorage при загрузке
   */
  function restoreSettings() {
    try {
      const fontScale = localStorage.getItem(STORAGE.FONT_SCALE);
      if (fontScale) setFontScale(parseFloat(fontScale));

      if (localStorage.getItem(STORAGE.IMAGES) === "off") {
        document.getElementById("a11yNoImages").checked = true;
        document.documentElement.dataset.images = "off";
      }

      if (localStorage.getItem(STORAGE.FONT) === "system") {
        document.getElementById("a11ySystemFont").checked = true;
        document.documentElement.dataset.font = "system";
      }

      if (localStorage.getItem(STORAGE.ANIMATIONS) === "off") {
        document.getElementById("a11yNoAnimations").checked = true;
        document.documentElement.dataset.animations = "off";
      }
    } catch (e) {
      // localStorage недоступен
    }
  }

  /**
   * Инициализация
   */
  function init() {
    restoreSettings();

    // Кнопка открытия панели
    const openBtn = document.getElementById("a11y-toggle");
    if (openBtn) {
      openBtn.addEventListener("click", () => {
        const isExpanded = openBtn.getAttribute("aria-expanded") === "true";
        if (isExpanded) {
          closeA11yPanel();
        } else {
          openA11yPanel();
        }
      });
    }

    // Кнопки закрытия (любая с data-action="close-a11y")
    document.querySelectorAll('[data-action="close-a11y"]').forEach((btn) => {
      btn.addEventListener("click", closeA11yPanel);
    });

    // Backdrop
    const backdrop = document.getElementById("a11yBackdrop");
    if (backdrop) {
      backdrop.addEventListener("click", closeA11yPanel);
    }

    // Кнопки размера шрифта
    document.querySelectorAll(".a11y-font-btn").forEach((btn) => {
      btn.addEventListener("click", () => {
        setFontScale(parseFloat(btn.dataset.fontScale));
      });
    });

    // Чекбоксы
    const noImagesCb = document.getElementById("a11yNoImages");
    if (noImagesCb) {
      noImagesCb.addEventListener("change", () => toggleImages(noImagesCb.checked));
    }

    const systemFontCb = document.getElementById("a11ySystemFont");
    if (systemFontCb) {
      systemFontCb.addEventListener("change", () => toggleSystemFont(systemFontCb.checked));
    }

    const noAnimCb = document.getElementById("a11yNoAnimations");
    if (noAnimCb) {
      noAnimCb.addEventListener("change", () => toggleAnimations(noAnimCb.checked));
    }

    // Кнопка сброса
    document.querySelectorAll('[data-action="reset-a11y"]').forEach((btn) => {
      btn.addEventListener("click", resetAll);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }

  // Экспорт
  window.BardakovA11y = {
    open: openA11yPanel,
    close: closeA11yPanel,
    setFontScale,
    toggleImages,
    toggleAnimations,
    toggleSystemFont,
    reset: resetAll,
  };
})();
