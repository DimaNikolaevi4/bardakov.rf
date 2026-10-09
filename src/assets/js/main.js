/* ============================================================
 * main.js — Основные интерактивы сайта
 * Создано: 2026-10-09 (Этап 3.3)
 * ============================================================ */

(function () {
  "use strict";

  /**
   * Sticky header: добавляет тень при скролле
   */
  function initStickyHeader() {
    const header = document.getElementById("site-header");
    if (!header) return;

    let lastScroll = 0;
    function onScroll() {
      const scroll = window.pageYOffset || document.documentElement.scrollTop;
      if (scroll > 8) {
        header.classList.add("is-scrolled");
      } else {
        header.classList.remove("is-scrolled");
      }
      lastScroll = scroll;
    }

    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  /**
   * Offcanvas mobile menu: открыть/закрыть
   */
  function initOffcanvas() {
    const offcanvas = document.getElementById("offcanvasNav");
    const backdrop = document.getElementById("offcanvasBackdrop");
    const openBtn = document.getElementById("offcanvas-toggle");

    if (!offcanvas || !openBtn) return;

    function open() {
      offcanvas.classList.add("is-open");
      offcanvas.setAttribute("aria-hidden", "false");
      if (backdrop) backdrop.classList.add("is-open");
      openBtn.setAttribute("aria-expanded", "true");
      document.body.classList.add("no-scroll");

      // Фокус на offcanvas
      setTimeout(() => offcanvas.focus(), 100);

      document.addEventListener("keydown", escapeHandler);
    }

    function close() {
      offcanvas.classList.remove("is-open");
      offcanvas.setAttribute("aria-hidden", "true");
      if (backdrop) backdrop.classList.remove("is-open");
      openBtn.setAttribute("aria-expanded", "false");
      document.body.classList.remove("no-scroll");
      openBtn.focus();

      document.removeEventListener("keydown", escapeHandler);
    }

    function escapeHandler(e) {
      if (e.key === "Escape") close();
    }

    openBtn.addEventListener("click", open);

    // Кнопки закрытия (data-dismiss="offcanvas")
    document.querySelectorAll('[data-dismiss="offcanvas"]').forEach((btn) => {
      btn.addEventListener("click", close);
    });

    if (backdrop) {
      backdrop.addEventListener("click", close);
    }

    // Подменю: при клике на .offcanvas-parent копируем подменю в side panel
    document.querySelectorAll(".offcanvas-parent").forEach((parentBtn) => {
      parentBtn.addEventListener("click", () => {
        const title = parentBtn.dataset.ocTitle;
        const target = parentBtn.dataset.ocTarget;
        if (!target) return;

        // Извлекаем подменю из data-атрибутов навигации
        const navItem = document.querySelector(
          `.main-nav-link[href]:nth-of-type(1)`
        );
        // TODO: реализовать подменю для оффканваса (упрощённая версия без side-panel)
        // Для прототипа просто переходим по первой ссылке подменю
      });
    });
  }

  /**
   * Search modal
   */
  function initSearchModal() {
    const modal = document.getElementById("searchModal");
    const openBtn = document.getElementById("search-btn");
    const input = document.getElementById("searchModalInput");

    if (!modal || !openBtn) return;

    function open() {
      modal.setAttribute("aria-hidden", "false");
      openBtn.setAttribute("aria-expanded", "true");
      document.body.classList.add("no-scroll");

      setTimeout(() => {
        if (input) input.focus();
      }, 100);

      document.addEventListener("keydown", escapeHandler);
    }

    function close() {
      modal.setAttribute("aria-hidden", "true");
      openBtn.setAttribute("aria-expanded", "false");
      document.body.classList.remove("no-scroll");
      openBtn.focus();
      document.removeEventListener("keydown", escapeHandler);
    }

    function escapeHandler(e) {
      if (e.key === "Escape") close();
    }

    openBtn.addEventListener("click", open);

    // Кнопки закрытия
    document.querySelectorAll('[data-action="close-search"]').forEach((btn) => {
      btn.addEventListener("click", close);
    });

    // Закрытие по Escape (даже если фокус внутри)
    modal.addEventListener("keydown", (e) => {
      if (e.key === "Escape") close();
    });
  }

  /**
   * Подсветка активного пункта меню
   */
  function initActiveNav() {
    const currentPath = window.location.pathname;
    document.querySelectorAll(".main-nav-link").forEach((link) => {
      const href = link.getAttribute("href");
      if (href && (href === currentPath || currentPath.startsWith(href))) {
        link.setAttribute("aria-current", "page");
      }
    });
  }

  /**
   * Инициализация
   */
  function init() {
    initStickyHeader();
    initOffcanvas();
    initSearchModal();
    initActiveNav();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
