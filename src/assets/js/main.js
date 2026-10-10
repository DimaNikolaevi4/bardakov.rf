/* ============================================================
 * main.js — Основные интерактивы сайта bardakov.rf
 * Источник: design-reference/index.html (строки 284-339) + cit-calck main.js
 * Создано: 2026-10-10 (Этап E интеграции)
 *
 * Функции:
 * 1. Sticky header: тень при скролле
 * 2. Reveal animations через IntersectionObserver
 * 3. Card glow effect (mousemove → radial-gradient)
 * 4. Scroll-to-top кнопка
 * 5. Подсветка активного пункта меню
 *
 * NOTE: Offcanvas и Search-modal вынесены в отдельные файлы
 *       (offcanvas-nav.js, search-modal.js)
 * ============================================================ */

(function () {
  "use strict";

  // 1. Тень шапки при скролле
  function initStickyHeader() {
    const header = document.querySelector('.site-header');
    if (!header) return;
    const onScroll = () => {
      header.classList.toggle('is-scrolled', window.scrollY > 6);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  // 2. Плавное появление карточек (reveal)
  function initReveal() {
    if (!('IntersectionObserver' in window)) return;
    const io = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('is-visible');
          io.unobserve(e.target);
        }
      });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });
    document.querySelectorAll('.reveal').forEach(el => io.observe(el));
  }

  // 3. Эффект фонарика на карточках
  function initCardGlow() {
    document.querySelectorAll('.card').forEach(card => {
      card.addEventListener('mousemove', (e) => {
        const r = card.getBoundingClientRect();
        card.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100) + '%');
        card.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100) + '%');
      });
    });
  }

  // 4. Scroll-to-top
  function initScrollTop() {
    const btn = document.getElementById('scrollTop');
    if (!btn) return;
    const onScroll = () => {
      btn.classList.toggle('is-visible', window.scrollY > 400);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  // 5. Подсветка активного пункта меню
  function initActiveNav() {
    const currentPath = window.location.pathname;
    document.querySelectorAll('.main-nav-link').forEach((link) => {
      const href = link.getAttribute('href');
      if (href && href !== '/' && currentPath.startsWith(href)) {
        link.setAttribute('aria-current', 'page');
      }
    });
  }

  // Init
  function init() {
    initStickyHeader();
    initReveal();
    initCardGlow();
    initScrollTop();
    initActiveNav();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
