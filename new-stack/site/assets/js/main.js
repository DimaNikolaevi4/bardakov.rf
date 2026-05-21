/* ============================================
   бардаков.рф — Главный скрипт
   Стек: HTML + Bootstrap 5 + Swiper + AOS
   ============================================ */

/* ============================================
   Тёмная / светлая тема — применяется до рендера
   ============================================ */
(function () {
  var saved = localStorage.getItem('dark-theme');
  var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  if (saved === 'on' || (saved === null && prefersDark)) {
    document.documentElement.classList.add('dark-theme');
  }
  // Восстанавливаем a11y из localStorage
  try {
    var a11y = JSON.parse(localStorage.getItem('bardakov-a11y') || '{}');
    if (a11y.hc) document.documentElement.classList.add('a11y-hc');
    if (a11y.lf) document.documentElement.classList.add('a11y-lf');
    if (a11y.na) document.documentElement.classList.add('a11y-na');
  } catch (e) {}
})();

/* --- Переключение тёмной темы (глобальная функция) --- */
function toggleDarkTheme() {
  var isDark = document.documentElement.classList.toggle('dark-theme');
  localStorage.setItem('dark-theme', isDark ? 'on' : 'off');
  updateThemeButton(isDark);
}

function updateThemeButton(isDark) {
  ['theme-toggle', 'theme-toggle-mobile'].forEach(function (id) {
    var btn = document.getElementById(id);
    if (!btn) return;
    var icon = btn.querySelector('i');
    if (icon) icon.className = isDark ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
    btn.title = isDark ? 'Светлая тема' : 'Тёмная тема';
    btn.setAttribute('aria-label', isDark ? 'Светлая тема' : 'Тёмная тема');
  });
}

/* --- Панель доступности (глобальная функция) --- */
function toggleA11y() {
  var panel = document.getElementById('a11yPanel');
  if (!panel) return;
  if (panel.hidden) {
    panel.hidden = false;
    var btn = document.getElementById('a11y-toggle');
    if (btn) btn.setAttribute('aria-expanded', 'true');
    // фокус на первый чекбокс
    setTimeout(function () {
      var cb = panel.querySelector('input[type="checkbox"]');
      if (cb) cb.focus();
    }, 60);
  } else {
    panel.hidden = true;
    var btn = document.getElementById('a11y-toggle');
    if (btn) btn.setAttribute('aria-expanded', 'false');
  }
}

document.addEventListener('DOMContentLoaded', function () {

  /* -------------------------------------------
     1. JS-include: загрузка header и footer
     ------------------------------------------- */
  function loadComponent(placeholderId, componentUrl) {
    var placeholder = document.getElementById(placeholderId);
    if (!placeholder) return;
    fetch(componentUrl)
      .then(function (r) {
        if (!r.ok) throw new Error('Не удалось загрузить ' + componentUrl);
        return r.text();
      })
      .then(function (html) {
        placeholder.innerHTML = html;
        placeholder.dispatchEvent(new CustomEvent('componentLoaded', { bubbles: true }));
      })
      .catch(function (err) { console.error(err); });
  }

  loadComponent('header-placeholder', '/assets/components/header.html');
  loadComponent('footer-placeholder', '/assets/components/footer.html');

  /* -------------------------------------------
     2. Инициализация после загрузки header
     ------------------------------------------- */
  document.addEventListener('componentLoaded', function (e) {
    if (e.target.id !== 'header-placeholder') return;

    var currentPath = window.location.pathname;

    // --- Подсветка активных ссылок ---
    e.target.querySelectorAll('.main-nav__link, .oc-nav__link, .oc-nav__sub-link').forEach(function (link) {
      var href = link.getAttribute('href');
      if (!href) return;
      if (currentPath === href || (href !== '/' && currentPath.startsWith(href))) {
        link.classList.add('active');
      }
    });

    // --- Открываем подменю offcanvas если текущий раздел активен ---
    e.target.querySelectorAll('.oc-nav__group').forEach(function (group) {
      if (group.querySelector('.oc-nav__sub-link.active')) {
        var sub = group.querySelector('.oc-nav__sub');
        var toggle = group.querySelector('.oc-nav__toggle');
        if (sub) sub.hidden = false;
        if (toggle) toggle.setAttribute('aria-expanded', 'true');
      }
    });

    // --- Инициализация иконки темы ---
    updateThemeButton(document.documentElement.classList.contains('dark-theme'));

    // --- Compact-шапка при скролле ---
    initHeaderCompact();

    // --- Offcanvas подменю-аккордеон ---
    initOffcanvasNav();

    // --- Панель доступности ---
    initA11yPanel();

    // --- Поисковый модал ---
    initSearchModal();
  });

  /* -------------------------------------------
     3. Compact-шапка при скролле
     ------------------------------------------- */
  function initHeaderCompact() {
    var header = document.getElementById('header');
    if (!header) return;
    function update() {
      header.classList.toggle('header--compact', window.scrollY > 24);
    }
    update();
    window.addEventListener('scroll', update, { passive: true });
  }

  /* -------------------------------------------
     4. Offcanvas: аккордеон подменю
     ------------------------------------------- */
  function initOffcanvasNav() {
    var offcanvasEl = document.getElementById('offcanvasNav');
    if (!offcanvasEl) return;

    offcanvasEl.querySelectorAll('.oc-nav__toggle').forEach(function (toggle) {
      toggle.addEventListener('click', function () {
        var controlId = toggle.getAttribute('aria-controls');
        var sub = controlId ? document.getElementById(controlId) : null;
        if (!sub) return;
        var isOpen = !sub.hidden;
        sub.hidden = isOpen;
        toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
      });
    });

    // Поиск внутри offcanvas (мобильный) → открываем модал
    var mobileSearchBtn = document.getElementById('search-btn-mobile');
    if (mobileSearchBtn) {
      mobileSearchBtn.addEventListener('click', function () {
        // Закрываем offcanvas
        if (typeof bootstrap !== 'undefined') {
          var bsOc = bootstrap.Offcanvas.getInstance(offcanvasEl);
          if (bsOc) {
            offcanvasEl.addEventListener('hidden.bs.offcanvas', function once() {
              offcanvasEl.removeEventListener('hidden.bs.offcanvas', once);
              openSearchModal();
            });
            bsOc.hide();
            return;
          }
        }
        openSearchModal();
      });
    }
  }

  /* -------------------------------------------
     5. Панель доступности (a11y)
     ------------------------------------------- */
  function initA11yPanel() {
    var panel   = document.getElementById('a11yPanel');
    var toggle  = document.getElementById('a11y-toggle');
    var cbLF    = document.getElementById('a11yLargeFont');
    var cbHC    = document.getElementById('a11yHighContrast');
    var cbNA    = document.getElementById('a11yNoAnimations');
    var btnReset = document.getElementById('a11yReset');
    var btnClose = document.getElementById('a11yClose');

    if (!panel) return;

    var PREFS_KEY = 'bardakov-a11y';

    function loadPrefs() {
      try {
        var raw = localStorage.getItem(PREFS_KEY);
        if (raw) return JSON.parse(raw);
        // совместимость со старым ключом
        var old = localStorage.getItem('a11y-mode');
        return { hc: old === 'on', lf: old === 'on', na: false };
      } catch (e) { return { hc: false, lf: false, na: false }; }
    }

    function savePrefs(p) {
      try { localStorage.setItem(PREFS_KEY, JSON.stringify(p)); } catch (e) {}
    }

    function applyPrefs(p) {
      document.body.classList.toggle('high-contrast',  p.hc);
      document.body.classList.toggle('large-font',     p.lf);
      document.body.classList.toggle('no-animations',  p.na);
    }

    var prefs = loadPrefs();
    applyPrefs(prefs);

    function syncCheckboxes() {
      if (cbHC) cbHC.checked = prefs.hc;
      if (cbLF) cbLF.checked = prefs.lf;
      if (cbNA) cbNA.checked = prefs.na;
    }
    syncCheckboxes();

    var justOpened = false;

    function openPanel() {
      panel.hidden = false;
      if (toggle) toggle.setAttribute('aria-expanded', 'true');
      justOpened = true;
      setTimeout(function () { justOpened = false; }, 150);
      setTimeout(function () { if (cbLF) cbLF.focus(); }, 60);
    }

    function closePanel() {
      panel.hidden = true;
      if (toggle) toggle.setAttribute('aria-expanded', 'false');
    }

    // toggleA11y теперь делегирует сюда
    window.toggleA11y = function () {
      panel.hidden ? openPanel() : closePanel();
    };

    if (cbLF) cbLF.addEventListener('change', function () {
      prefs.lf = cbLF.checked; applyPrefs(prefs); savePrefs(prefs);
    });
    if (cbHC) cbHC.addEventListener('change', function () {
      prefs.hc = cbHC.checked; applyPrefs(prefs); savePrefs(prefs);
    });
    if (cbNA) cbNA.addEventListener('change', function () {
      prefs.na = cbNA.checked; applyPrefs(prefs); savePrefs(prefs);
    });

    if (btnReset) btnReset.addEventListener('click', function () {
      prefs = { hc: false, lf: false, na: false };
      applyPrefs(prefs); savePrefs(prefs); syncCheckboxes();
    });
    if (btnClose) btnClose.addEventListener('click', closePanel);

    document.addEventListener('keydown', function (ev) {
      if (ev.key === 'Escape' && !panel.hidden) closePanel();
    });
    document.addEventListener('click', function (ev) {
      if (!panel.hidden && !justOpened
          && !panel.contains(ev.target)
          && ev.target !== toggle) {
        closePanel();
      }
    });
  }

  /* -------------------------------------------
     6. Поисковый модал
     ------------------------------------------- */
  var _searchModal    = null;
  var _searchOverlay  = null;
  var _searchClose    = null;
  var _searchInput    = null;
  var _searchPrevFocus = null;

  function openSearchModal() {
    if (!_searchModal) {
      _searchModal   = document.getElementById('searchModal');
      _searchOverlay = document.getElementById('searchModalOverlay');
      _searchClose   = document.getElementById('searchModalClose');
      _searchInput   = document.getElementById('searchModalInput');
    }
    if (!_searchModal) return;
    _searchPrevFocus = document.activeElement;
    _searchModal.classList.add('is-open');
    _searchModal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    var btn = document.getElementById('search-btn');
    if (btn) btn.setAttribute('aria-expanded', 'true');
    setTimeout(function () { if (_searchInput) _searchInput.focus(); }, 100);
  }

  function closeSearchModal() {
    if (!_searchModal) return;
    _searchModal.classList.remove('is-open');
    _searchModal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    var btn = document.getElementById('search-btn');
    if (btn) btn.setAttribute('aria-expanded', 'false');
    if (_searchPrevFocus) { _searchPrevFocus.focus(); _searchPrevFocus = null; }
  }

  function initSearchModal() {
    var searchBtn = document.getElementById('search-btn');
    if (searchBtn) {
      searchBtn.addEventListener('click', function () {
        _searchModal && _searchModal.classList.contains('is-open')
          ? closeSearchModal() : openSearchModal();
      });
    }

    // Инициализируем ссылки на элементы
    _searchModal   = document.getElementById('searchModal');
    _searchOverlay = document.getElementById('searchModalOverlay');
    _searchClose   = document.getElementById('searchModalClose');
    _searchInput   = document.getElementById('searchModalInput');

    if (_searchOverlay) _searchOverlay.addEventListener('click', closeSearchModal);
    if (_searchClose)   _searchClose.addEventListener('click', closeSearchModal);

    document.addEventListener('keydown', function (ev) {
      if (ev.key === 'Escape' && _searchModal && _searchModal.classList.contains('is-open')) {
        closeSearchModal();
      }
    });
  }

  /* -------------------------------------------
     7. AOS — анимации при прокрутке
     ------------------------------------------- */
  if (typeof AOS !== 'undefined') {
    AOS.init({
      duration: 700,
      easing: 'ease-out-cubic',
      once: true,
      offset: 60,
    });
  }

  /* -------------------------------------------
     8. Swiper — Hero Slider
     ------------------------------------------- */
  if (typeof Swiper !== 'undefined' && document.querySelector('.hero-swiper')) {
    new Swiper('.hero-swiper', {
      loop: true,
      speed: 900,
      autoplay: {
        delay: 5500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      parallax: true,
      effect: 'slide',
      pagination: {
        el: '.hero-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.hero-next',
        prevEl: '.hero-prev',
      },
      on: {
        slideChangeTransitionStart: function () {
          document.querySelectorAll('.hero-slide-title, .hero-slide-subtitle, .hero-tag, .hero-btn')
            .forEach(function (el) {
              el.style.opacity = '0';
              el.style.transform = 'translateY(20px)';
            });
        },
        slideChangeTransitionEnd: function () {
          document.querySelectorAll('.swiper-slide-active .hero-slide-title, .swiper-slide-active .hero-slide-subtitle, .swiper-slide-active .hero-tag, .swiper-slide-active .hero-btn')
            .forEach(function (el, i) {
              setTimeout(function () {
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
              }, i * 120);
            });
        },
      },
    });
  }

  /* -------------------------------------------
     9. Swiper — Gallery
     ------------------------------------------- */
  if (typeof Swiper !== 'undefined' && document.querySelector('.gallery-swiper')) {
    new Swiper('.gallery-swiper', {
      loop: true,
      speed: 700,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      slidesPerView: 1.2,
      spaceBetween: 20,
      centeredSlides: true,
      pagination: {
        el: '.gallery-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.gallery-next',
        prevEl: '.gallery-prev',
      },
      breakpoints: {
        576:  { slidesPerView: 1.8, spaceBetween: 20 },
        768:  { slidesPerView: 2.4, spaceBetween: 24 },
        992:  { slidesPerView: 3,   spaceBetween: 28 },
        1200: { slidesPerView: 3.5, spaceBetween: 30 },
      },
    });
  }

  /* -------------------------------------------
     10. Анимированные счётчики (stats-bar)
     ------------------------------------------- */
  function animateCounter(el, target, duration) {
    var start = 0;
    var startTime = null;
    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      var progress = Math.min((timestamp - startTime) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(eased * target);
      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target;
      }
    }
    requestAnimationFrame(step);
  }

  var statsObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        document.querySelectorAll('.stat-number[data-count]').forEach(function (el) {
          var target = parseInt(el.getAttribute('data-count'), 10);
          animateCounter(el, target, 1800);
          el.removeAttribute('data-count');
        });
        statsObserver.disconnect();
      }
    });
  }, { threshold: 0.3 });

  var statsSection = document.getElementById('stats-section');
  if (statsSection) statsObserver.observe(statsSection);

  /* -------------------------------------------
     11. Плавная прокрутка к якорям
     ------------------------------------------- */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      var target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  /* -------------------------------------------
     12. Кнопка «Наверх»
     ------------------------------------------- */
  var scrollBtn = document.createElement('button');
  scrollBtn.innerHTML = '<i class="bi bi-chevron-up"></i>';
  scrollBtn.className = 'btn-scroll-top';
  scrollBtn.title = 'Наверх';
  scrollBtn.setAttribute('aria-label', 'Наверх');
  document.body.appendChild(scrollBtn);

  window.addEventListener('scroll', function () {
    scrollBtn.classList.toggle('visible', window.scrollY > 400);
  });

  scrollBtn.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

});
