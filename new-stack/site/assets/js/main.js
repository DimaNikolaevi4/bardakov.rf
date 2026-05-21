/* ============================================
   бардаков.рф — Главный скрипт
   Стек: HTML + Bootstrap 5 + Swiper + AOS
   ============================================ */

/* ============================================
   Тёмная / светлая тема — применяется до рендера
   ============================================ */
(function () {
  if (localStorage.getItem('dark-theme') === 'on') {
    document.documentElement.classList.add('dark-theme');
  }
})();

/* Глобальная функция переключения темы */
function toggleDarkTheme() {
  var isDark = document.documentElement.classList.toggle('dark-theme');
  localStorage.setItem('dark-theme', isDark ? 'on' : 'off');
  updateThemeButton(isDark);
}

function updateThemeButton(isDark) {
  var btn = document.getElementById('theme-toggle');
  if (!btn) return;
  var icon = btn.querySelector('i');
  if (!icon) return;
  if (isDark) {
    icon.className = 'bi bi-sun-fill';
    btn.title = 'Светлая тема';
    btn.setAttribute('aria-label', 'Светлая тема');
  } else {
    icon.className = 'bi bi-moon-fill';
    btn.title = 'Тёмная тема';
    btn.setAttribute('aria-label', 'Тёмная тема');
  }
}

document.addEventListener('DOMContentLoaded', function () {

  /* -------------------------------------------
     1. JS-include: загрузка header и footer
     ------------------------------------------- */
  function loadComponent(placeholderId, componentUrl) {
    const placeholder = document.getElementById(placeholderId);
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
      .catch(function (err) {
        console.error(err);
      });
  }

  loadComponent('header-placeholder', '/assets/components/header.html');
  loadComponent('footer-placeholder', '/assets/components/footer.html');

  /* -------------------------------------------
     2. Подсветка текущего пункта меню
     ------------------------------------------- */
  document.addEventListener('componentLoaded', function (e) {
    if (e.target.id !== 'header-placeholder') return;
    const currentPath = window.location.pathname;
    e.target.querySelectorAll('.nav-link').forEach(function (link) {
      const href = link.getAttribute('href');
      if (!href) return;
      if (currentPath === href || (href !== '/' && currentPath.startsWith(href))) {
        link.classList.add('active');
      }
    });
    initSearchLink();

    // Кнопка переключения тёмной темы
    var themeBtn = document.getElementById('theme-toggle');
    if (themeBtn) {
      updateThemeButton(document.documentElement.classList.contains('dark-theme'));
      themeBtn.addEventListener('click', toggleDarkTheme);
    }

    // Версия для слабовидящих — кнопка в шапке
    const a11yBtn = document.getElementById('a11y-toggle');
    if (a11yBtn) {
      a11yBtn.addEventListener('click', function () {
        document.body.classList.toggle('high-contrast');
        document.body.classList.toggle('large-font');
        localStorage.setItem('a11y-mode',
          document.body.classList.contains('high-contrast') ? 'on' : 'off');
      });
    }
  });

  if (localStorage.getItem('a11y-mode') === 'on') {
    document.body.classList.add('high-contrast', 'large-font');
  }

  /* -------------------------------------------
     3. Поиск
     ------------------------------------------- */
  function initSearchLink() {
    document.querySelectorAll('.btn-search').forEach(function (btn) {
      btn.addEventListener('click', function () {
        window.location.href = '/search/';
      });
    });
  }

  /* -------------------------------------------
     4. AOS — анимации при прокрутке
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
     5. Swiper — Hero Slider
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
     6. Swiper — Gallery
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
        576: { slidesPerView: 1.8, spaceBetween: 20 },
        768: { slidesPerView: 2.4, spaceBetween: 24 },
        992: { slidesPerView: 3,   spaceBetween: 28 },
        1200: { slidesPerView: 3.5, spaceBetween: 30 },
      },
    });
  }

  /* -------------------------------------------
     7. Анимированные счётчики (stats-bar)
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
     8. Плавная прокрутка к якорям
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
     9. Кнопка «Наверх»
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
