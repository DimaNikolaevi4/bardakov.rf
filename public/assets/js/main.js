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
      const maxScroll = Math.max(
        0,
        document.documentElement.scrollHeight - window.innerHeight,
      );
      const threshold = Math.min(400, maxScroll / 2);
      btn.classList.toggle('is-visible', window.scrollY > threshold);
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll, { passive: true });
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

  // 6. Модальное окно поиска (открытие/закрытие/фокус-трап)
  function initSearchModal() {
    var searchToggle = document.getElementById('headerSearchToggle');
    var searchModal  = document.getElementById('searchModal');
    var searchModalOverlay = document.getElementById('searchModalOverlay');
    var searchModalInput   = document.getElementById('searchModalInput');
    var offcanvasSearchToggle = document.getElementById('offcanvasSearchToggle');

    if (!searchToggle || !searchModal) return;

    var previouslyFocused = null;

    function openSearchModal() {
      previouslyFocused = document.activeElement;
      searchModal.classList.add('is-open');
      searchModal.setAttribute('aria-hidden', 'false');
      searchModal.removeAttribute('inert');
      searchToggle.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
      setTimeout(function () { if (searchModalInput) searchModalInput.focus(); }, 100);
    }

    function closeSearchModal() {
      searchModal.classList.remove('is-open');
      searchModal.setAttribute('aria-hidden', 'true');
      searchModal.setAttribute('inert', '');
      searchToggle.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
      if (previouslyFocused) {
        previouslyFocused.focus();
        previouslyFocused = null;
      }
    }

    // Клик по кнопке поиска в шапке
    searchToggle.addEventListener('click', function () {
      if (searchModal.classList.contains('is-open')) {
        closeSearchModal();
      } else {
        openSearchModal();
      }
    });

    // Клик по кнопке поиска в offcanvas
    if (offcanvasSearchToggle) {
      offcanvasSearchToggle.addEventListener('click', function () {
        // Закрываем offcanvas если открыт
        var offcanvasEl = document.getElementById('offcanvasRubrics');
        if (offcanvasEl && offcanvasEl.classList.contains('is-open')) {
          offcanvasEl.classList.remove('is-open');
          offcanvasEl.setAttribute('aria-hidden', 'true');
          var backdrop = document.getElementById('offcanvasBackdrop');
          if (backdrop) backdrop.classList.remove('is-open');
          document.body.style.overflow = '';
        }
        setTimeout(openSearchModal, 150);
      });
    }

    // Клик по overlay
    if (searchModalOverlay) {
      searchModalOverlay.addEventListener('click', closeSearchModal);
    }

    // Кнопки закрытия (data-action="close-search")
    searchModal.querySelectorAll('[data-action="close-search"]').forEach(function(btn) {
      btn.addEventListener('click', closeSearchModal);
    });

    // Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && searchModal.classList.contains('is-open')) {
        closeSearchModal();
      }
    });

    // Фокус-трап внутри модала
    searchModal.addEventListener('keydown', function (e) {
      if (e.key !== 'Tab') return;
      var focusable = searchModal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
      if (focusable.length === 0) return;
      var first = focusable[0];
      var last  = focusable[focusable.length - 1];
      if (e.shiftKey) {
        if (document.activeElement === first) { e.preventDefault(); last.focus(); }
      } else {
        if (document.activeElement === last) { e.preventDefault(); first.focus(); }
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
    initSearchModal();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
