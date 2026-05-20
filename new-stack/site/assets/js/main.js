/* ============================================
   бардаков.рф — Главный скрипт
   Стек: HTML + Bootstrap 5 (CDN) + Pagefind
   ============================================ */

document.addEventListener('DOMContentLoaded', function () {

  /* -------------------------------------------
     1. JS-include: загрузка header и footer
     ------------------------------------------- */
  function loadComponent(placeholderId, componentUrl) {
    const placeholder = document.getElementById(placeholderId);
    if (!placeholder) return;

    fetch(componentUrl)
      .then(function (response) {
        if (!response.ok) throw new Error('Не удалось загрузить ' + componentUrl);
        return response.text();
      })
      .then(function (html) {
        placeholder.innerHTML = html;
        placeholder.dispatchEvent(new CustomEvent('componentLoaded', { bubbles: true }));
      })
      .catch(function (error) {
        console.error(error);
        placeholder.innerHTML = '<p style="color:red;text-align:center;padding:1rem;">Ошибка загрузки компонента</p>';
      });
  }

  // Загрузка шапки и подвала
  loadComponent('header-placeholder', '/assets/components/header.html');
  loadComponent('footer-placeholder', '/assets/components/footer.html');

  /* -------------------------------------------
     2. Подсветка текущего пункта меню
     ------------------------------------------- */
  document.addEventListener('componentLoaded', function (e) {
    if (e.target.id !== 'header-placeholder') return;

    const currentPath = window.location.pathname;
    const navLinks = e.target.querySelectorAll('.nav-link');

    navLinks.forEach(function (link) {
      const href = link.getAttribute('href');
      if (!href) return;

      // Точное совпадение или начало пути
      if (currentPath === href || (href !== '/' && currentPath.startsWith(href))) {
        link.classList.add('active');
      }
    });

    // Инициализация поиска после загрузки шапки
    initSearchLink();
  });

  /* -------------------------------------------
     3. Поиск — переход на страницу поиска
     ------------------------------------------- */
  function initSearchLink() {
    const searchBtns = document.querySelectorAll('.btn-search');
    searchBtns.forEach(function (btn) {
      btn.addEventListener('click', function () {
        window.location.href = '/search/';
      });
    });
  }

  /* -------------------------------------------
     4. Pagefind — поиск (подключается на /search/)
     ------------------------------------------- */
  // Pagefind автоматически инициализируется на странице /search/index.html
  // после запуска npx pagefind (индексация HTML-файлов)

  /* -------------------------------------------
     5. Версия для слабовидящих (простая)
     ------------------------------------------- */
  const a11yBtn = document.getElementById('a11y-toggle');
  if (a11yBtn) {
    a11yBtn.addEventListener('click', function () {
      document.body.classList.toggle('high-contrast');
      document.body.classList.toggle('large-font');
      localStorage.setItem('a11y-mode',
        document.body.classList.contains('high-contrast') ? 'on' : 'off'
      );
    });
  }

  // Восстановление настроек
  if (localStorage.getItem('a11y-mode') === 'on') {
    document.body.classList.add('high-contrast', 'large-font');
  }

  /* -------------------------------------------
     6. Плавная прокрутка к якорям
     ------------------------------------------- */
  document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  /* -------------------------------------------
     7. Кнопка «Наверх»
     ------------------------------------------- */
  const scrollBtn = document.createElement('button');
  scrollBtn.innerHTML = '&#9650;';
  scrollBtn.className = 'btn-scroll-top';
  scrollBtn.title = 'Наверх';
  scrollBtn.setAttribute('aria-label', 'Наверх');
  document.body.appendChild(scrollBtn);

  window.addEventListener('scroll', function () {
    if (window.scrollY > 400) {
      scrollBtn.classList.add('visible');
    } else {
      scrollBtn.classList.remove('visible');
    }
  });

  scrollBtn.addEventListener('click', function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

});
