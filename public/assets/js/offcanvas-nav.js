/*
  Модуль: мобильное / десктопное offcanvas-меню «Разделы сайта»
  ──────────────────────────────────────────────────────────────
  Подключение:
    • Загружается из base.njk (`<script defer src="/bardakov.rf/assets/js/offcanvas-nav.js">`)
      после разметки и управляет меню без стороннего JS-зависимого слоя.
    • Разметка живёт в components/header.njk (контейнеры `#offcanvasRubrics`,
      `#ocPanel1`, `#ocPanel2`, `#ocPanel3` и `<script id="rubricsData">`).
    • Источник данных — `_data/rubrics.yaml` ключ `main_rubrics`, выводится в
      `header.njk` стр. 301 как JSON: `{{ rubrics.main_rubrics | dump | safe }}`.

  Архитектура — три каскадные панели (1-й / 2-й / 3-й уровень иерархии):
    • Панель 1 (`#ocPanel1`) — корневой Bootstrap Offcanvas со списком L1-рубрик.
    • Панель 2 (`#ocPanel2`) — выезжает поверх, заполняется JS из L2-children
      выбранной L1-рубрики (`buildLevel2Items`).
    • Панель 3 (`#ocPanel3`) — выезжает поверх Панели 2, L3-children
      (`buildLevel3Items`).

  Ключевые поведения:
    • Self-gating: ранний выход при отсутствии `#rubricsData` (на страницах без
      offcanvas скрипт безопасно ничего не делает).
    • Авто-выделение текущего раздела при открытии (`autoHighlight`): по
      `window.location.pathname` находит активные L1/L2
      и сразу разворачивает соответствующие панели в `silent`-режиме (без
      переноса фокуса; вместо этого `scrollActiveIntoView` подкручивает к active).
    • Управление фокусом (`focusFirstIn`) — при открытии панели фокус уходит
      на первый интерактивный элемент (a11y-keyboard nav).
    • Escape: закрывает самую глубокую открытую панель (3 → 2 → весь offcanvas).
    • Анти-спам hover-открытия на десктопе (220 мс задержки через `hoverTimer`),
      медиа-query `(hover: hover) and (pointer: fine)` — на тач-устройствах
      hover-логика не активируется.
    • Закрытие всего стека (`closeAll`) при клике на любую конечную ссылку
      (класс `.oc-dismiss-all`) или на «Открыть весь раздел».

  Утилиты:
    • `esc(s)` — HTML-escape для безопасной вставки названий рубрик в `innerHTML`.
    • `pluralRu(n, ['раздел','раздела','разделов'])` — плюрализация счётчика.
    • `isActive(href)` — текущая страница попадает в href L1/L2/L3.

  ARIA-разметка управляется JS:
    • `aria-expanded` на L1-кнопках (`.oc-split-row__toggle[data-rubric-index]`).
    • `aria-expanded` на L2-«chevron»-кнопках (`.oc-open-l3`).
    • `aria-hidden` на `#ocPanel2` / `#ocPanel3` (false при открытии).
    • `aria-current="page"` на ссылках, совпадающих с текущим URL.

  Зависимости: Bootstrap Icons для оформления; меню работает на нативном JS.
  IIFE-обёртка изолирует все функции/переменные от глобального scope.
*/
(function () {
  'use strict';

  var rubricsEl = document.getElementById('rubricsData');
  if (!rubricsEl) return;

  var RUBRICS = JSON.parse(rubricsEl.textContent);
  var currentPath = window.location.pathname;

  var offcanvasEl    = document.getElementById('offcanvasRubrics');
  var backdropEl     = document.getElementById('offcanvasBackdrop');
  var offcanvasToggle = document.getElementById('offcanvasToggle');
  var burgerBtn      = document.getElementById('burgerBtn');
  var ocPanel2       = document.getElementById('ocPanel2');
  var ocPanel3       = document.getElementById('ocPanel3');
  var ocSubList      = document.getElementById('ocSubList');
  var ocSubSubList   = document.getElementById('ocSubSubList');
  var ocCloseBtn2    = document.getElementById('ocCloseBtn2');
  var ocCloseBtn3    = document.getElementById('ocCloseBtn3');
  var ocPanel2Title  = document.getElementById('ocPanel2Title');
  var ocPanel3Title  = document.getElementById('ocPanel3Title');
  var ocPanel2Breadcrumb = document.getElementById('ocPanel2Breadcrumb');
  var ocPanel3Breadcrumb = document.getElementById('ocPanel3Breadcrumb');
  var ocPanel2Count  = document.getElementById('ocPanel2Count');
  var ocPanel3Count  = document.getElementById('ocPanel3Count');
  var ocPanel2OpenLink = document.getElementById('ocPanel2OpenLink');
  var ocPanel3OpenLink = document.getElementById('ocPanel3OpenLink');
  var ocPanel2Scroll = document.getElementById('ocPanel2Scroll');

  var hoverTimer = null;
  var currentL1Toggle = null;
  var currentParentRubric = null;
  var returnFocusTo = null;

  [offcanvasEl, ocPanel2, ocPanel3].forEach(function (panel) {
    if (!panel) return;
    panel.setAttribute('aria-hidden', 'true');
    panel.inert = true;
  });
  if (backdropEl) backdropEl.setAttribute('aria-hidden', 'true');

  function setPanelState(panel, open) {
    if (!panel) return;
    panel.classList.toggle('is-open', open);
    panel.setAttribute('aria-hidden', open ? 'false' : 'true');
    panel.inert = !open;
  }

  function activePanel() {
    if (ocPanel3 && ocPanel3.classList.contains('is-open')) return ocPanel3;
    if (ocPanel2 && ocPanel2.classList.contains('is-open')) return ocPanel2;
    return offcanvasEl;
  }

  function openMenu(trigger) {
    if (!offcanvasEl || offcanvasEl.classList.contains('is-open')) return;
    returnFocusTo = trigger || document.activeElement;
    setPanelState(offcanvasEl, true);
    document.body.classList.add('menu-open');
    if (backdropEl) {
      backdropEl.classList.add('is-open');
      backdropEl.setAttribute('aria-hidden', 'false');
    }
    [offcanvasToggle, burgerBtn].forEach(function (button) {
      if (button) button.setAttribute('aria-expanded', 'true');
    });
    autoHighlight();
    focusFirstIn(activePanel());
  }

  function closeMenu() {
    if (!offcanvasEl) return;
    closePanel3();
    closePanel2();
    setPanelState(offcanvasEl, false);
    document.body.classList.remove('menu-open');
    if (backdropEl) {
      backdropEl.classList.remove('is-open');
      backdropEl.setAttribute('aria-hidden', 'true');
    }
    [offcanvasToggle, burgerBtn].forEach(function (button) {
      if (button) button.setAttribute('aria-expanded', 'false');
    });
    if (returnFocusTo && typeof returnFocusTo.focus === 'function') {
      returnFocusTo.focus();
    }
    returnFocusTo = null;
  }

  function esc(str) {
    return String(str)
      .replace(/&/g, '&amp;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;');
  }

  function pluralRu(n, forms) {
    var mod10 = n % 10, mod100 = n % 100;
    if (mod10 === 1 && mod100 !== 11) return n + '\u00a0' + forms[0];
    if (mod10 >= 2 && mod10 <= 4 && (mod100 < 10 || mod100 >= 20)) return n + '\u00a0' + forms[1];
    return n + '\u00a0' + forms[2];
  }

  function isActive(href) {
    return currentPath === href || currentPath.startsWith(href);
  }

  function focusFirstIn(panel) {
    var focusable = panel.querySelectorAll(
      'a[href], button:not([disabled]), input:not([disabled]), [tabindex]:not([tabindex="-1"])'
    );
    if (focusable.length) {
      setTimeout(function () { focusable[0].focus(); }, 50);
    }
  }

  function scrollActiveIntoView(listEl) {
    var active = listEl.querySelector('.active');
    if (active) {
      setTimeout(function () {
        active.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
      }, 120);
    }
  }

  function buildLevel2Items(children, parentSlug) {
    return children.map(function (child) {
      var href = child.url
        ? ('/' + String(child.url).replace(/^\/+|\/+$/g, '') + '/')
        : '/' + parentSlug + '/' + child.slug + '/';
      var active = isActive(href);
      var activeAttr = active ? ' class="oc-split-row__link oc-dismiss-all active" aria-current="page"' : ' class="oc-split-row__link oc-dismiss-all"';
      var activeLeafAttr = active ? ' class="oc-split-row__link oc-split-row__link--leaf oc-dismiss-all active" aria-current="page"' : ' class="oc-split-row__link oc-split-row__link--leaf oc-dismiss-all"';

      if (child.children && child.children.length) {
        return '<li class="oc-sub-item' + (active ? ' is-active' : '') + '">'
          + '<div class="oc-split-row' + (active ? ' is-active' : '') + '" data-l3-href="' + esc(href) + '" data-l3-json="' + esc(JSON.stringify(child)) + '">'
          + '<a href="' + esc(href) + '"' + activeAttr + '>' + esc(child.title) + '</a>'
          + '<button class="oc-split-row__toggle oc-open-l3" type="button"'
          + ' aria-label="Открыть подразделы: ' + esc(child.title) + '"'
          + ' aria-expanded="false">'
          + '<i class="bi bi-chevron-right" aria-hidden="true"></i>'
          + '</button>'
          + '</div>'
          + '</li>';
      }
      return '<li class="oc-sub-item' + (active ? ' is-active' : '') + '">'
        + '<a href="' + esc(href) + '"' + activeLeafAttr + '>' + esc(child.title) + '</a>'
        + '</li>';
    }).join('');
  }

  function buildLevel3Items(children, parentHref) {
    return children.map(function (gc) {
      var href = gc.url
        ? ('/' + String(gc.url).replace(/^\/+|\/+$/g, '') + '/')
        : parentHref + gc.slug + '/';
      var active = isActive(href);
      var activeAttr = active
        ? ' class="oc-split-row__link oc-split-row__link--leaf oc-dismiss-all active" aria-current="page"'
        : ' class="oc-split-row__link oc-split-row__link--leaf oc-dismiss-all"';
      return '<li class="oc-sub-item' + (active ? ' is-active' : '') + '">'
        + '<a href="' + esc(href) + '"' + activeAttr + '>' + esc(gc.title) + '</a>'
        + '</li>';
    }).join('');
  }

  function openPanel2(rubric, toggleBtn, silent) {
    closePanel3();
    currentParentRubric = rubric;

    if (ocPanel2Breadcrumb) ocPanel2Breadcrumb.textContent = 'Разделы сайта /';
    if (ocPanel2Title)      ocPanel2Title.textContent      = rubric.title;
    if (ocPanel2Count && rubric.children) {
      ocPanel2Count.textContent = pluralRu(rubric.children.length, ['раздел', 'раздела', 'разделов']);
    }
    if (ocPanel2OpenLink) ocPanel2OpenLink.href = '/' + rubric.slug + '/';
    if (ocSubList) ocSubList.innerHTML = buildLevel2Items(rubric.children, rubric.slug);

    ocSubList.querySelectorAll('.oc-open-l3').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var row   = btn.closest('.oc-split-row');
        var child = JSON.parse(row.dataset.l3Json);
        var href  = row.dataset.l3Href;
        openPanel3(child, href, btn, rubric);
      });
    });

    ocSubList.querySelectorAll('.oc-dismiss-all').forEach(function (el) {
      el.addEventListener('click', closeAll);
    });

    if (ocPanel2OpenLink) ocPanel2OpenLink.onclick = closeAll;

    var l2isPointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    if (l2isPointer) {
      ocSubList.querySelectorAll('.oc-split-row').forEach(function (row) {
        row.addEventListener('mouseenter', function () {
          var child = JSON.parse(row.dataset.l3Json || 'null');
          var href  = row.dataset.l3Href;
          if (child && child.children) {
            hoverTimer = setTimeout(function () {
              openPanel3(child, href, row.querySelector('.oc-open-l3'), rubric, true);
            }, 220);
          }
        });
        row.addEventListener('mouseleave', function () { clearTimeout(hoverTimer); });
      });
    }

    if (currentL1Toggle && currentL1Toggle !== toggleBtn) {
      currentL1Toggle.setAttribute('aria-expanded', 'false');
    }
    currentL1Toggle = toggleBtn || null;
    if (currentL1Toggle) currentL1Toggle.setAttribute('aria-expanded', 'true');

    setPanelState(ocPanel2, true);
    if (ocPanel2Scroll) ocPanel2Scroll.scrollTop = 0;

    if (!silent) {
      focusFirstIn(ocPanel2);
    } else {
      scrollActiveIntoView(ocSubList);
    }
  }

  function closePanel2(restoreFocus) {
    closePanel3();
    setPanelState(ocPanel2, false);
    var focusTarget = currentL1Toggle;
    if (currentL1Toggle) {
      currentL1Toggle.setAttribute('aria-expanded', 'false');
      currentL1Toggle = null;
    }
    currentParentRubric = null;
    if (restoreFocus && focusTarget) focusTarget.focus();
  }

  function openPanel3(child, parentHref, toggleBtn, parentRubric, silent) {
    var parent = parentRubric || currentParentRubric;

    if (ocPanel3Breadcrumb) {
      ocPanel3Breadcrumb.textContent = (parent ? parent.title + ' /' : 'Разделы сайта /');
    }
    if (ocPanel3Title) ocPanel3Title.textContent = child.title;
    if (ocPanel3Count && child.children) {
      ocPanel3Count.textContent = pluralRu(child.children.length, ['раздел', 'раздела', 'разделов']);
    }
    if (ocPanel3OpenLink) ocPanel3OpenLink.href = parentHref;
    if (ocSubSubList) {
      ocSubSubList.innerHTML = buildLevel3Items(child.children, parentHref);
      ocSubSubList.querySelectorAll('.oc-dismiss-all').forEach(function (el) {
        el.addEventListener('click', closeAll);
      });
    }
    if (ocPanel3OpenLink) ocPanel3OpenLink.onclick = closeAll;

    if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'true');

    setPanelState(ocPanel3, true);
    var p3scroll = ocPanel3.querySelector('.oc-panel__scroll');
    if (p3scroll) p3scroll.scrollTop = 0;

    if (!silent) {
      focusFirstIn(ocPanel3);
    } else {
      scrollActiveIntoView(ocSubSubList);
    }
  }

  function closePanel3(restoreFocus) {
    var focusTarget = ocSubList
      ? ocSubList.querySelector('.oc-open-l3[aria-expanded="true"]')
      : null;
    setPanelState(ocPanel3, false);
    if (ocSubList) {
      ocSubList.querySelectorAll('.oc-open-l3[aria-expanded="true"]').forEach(function (btn) {
        btn.setAttribute('aria-expanded', 'false');
      });
    }
    if (restoreFocus && focusTarget) focusTarget.focus();
  }

  function closeAll() {
    closeMenu();
  }

  // ─── Автовыделение: определяем текущую позицию в иерархии ───
  function autoHighlight() {
    for (var i = 0; i < RUBRICS.length; i++) {
      var rubric = RUBRICS[i];
      var l1href = '/' + rubric.slug + '/';
      if (!currentPath.startsWith(l1href)) continue;
      if (!rubric.children || !rubric.children.length) continue;

      var toggleBtn = document.querySelector('.oc-split-row__toggle[data-rubric-index="' + i + '"]');
      openPanel2(rubric, toggleBtn, true /* silent */);

      // Проверяем 2-й уровень
      for (var j = 0; j < rubric.children.length; j++) {
        var child = rubric.children[j];
        var l2href = child.url
          ? ('/' + String(child.url).replace(/^\/+|\/+$/g, '') + '/')
          : l1href + child.slug + '/';
        if (!currentPath.startsWith(l2href)) continue;
        if (!child.children || !child.children.length) break;

        // Нашли активный L2 — открываем панель 3
        var l2toggle = ocSubList
          ? ocSubList.querySelectorAll('.oc-open-l3')[j] || null
          : null;
        openPanel3(child, l2href, l2toggle, rubric, true /* silent */);
        break;
      }
      break;
    }
  }

  // ─── Привязка кнопок L1 ───
  document.querySelectorAll('.oc-split-row__toggle[data-rubric-index]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var idx    = parseInt(this.dataset.rubricIndex, 10);
      var rubric = RUBRICS[idx];
      if (rubric && rubric.children) openPanel2(rubric, btn);
    });
  });

  document.querySelectorAll('#ocPanel1 .oc-dismiss-all').forEach(function (el) {
    el.addEventListener('click', closeAll);
  });

  if (ocCloseBtn2) ocCloseBtn2.addEventListener('click', function () { closePanel2(true); });
  if (ocCloseBtn3) ocCloseBtn3.addEventListener('click', function () { closePanel3(true); });
  var ocBackBtn2 = document.getElementById('ocBackBtn2');
  var ocBackBtn3 = document.getElementById('ocBackBtn3');
  if (ocBackBtn2) ocBackBtn2.addEventListener('click', function () { closePanel2(true); });
  if (ocBackBtn3) ocBackBtn3.addEventListener('click', function () { closePanel3(true); });

  [offcanvasToggle, burgerBtn].forEach(function (button) {
    if (!button) return;
    button.setAttribute('aria-expanded', 'false');
    button.addEventListener('click', function () {
      if (offcanvasEl.classList.contains('is-open')) closeMenu();
      else openMenu(button);
    });
  });
  if (backdropEl) backdropEl.addEventListener('click', closeMenu);
  if (offcanvasEl) {
    offcanvasEl.addEventListener('click', function (event) {
      if (event.target.closest('[data-dismiss="offcanvas"]')) closeMenu();
    });
  }

  // ─── Escape закрывает самую глубокую панель ───
  document.addEventListener('keydown', function (e) {
    if (!offcanvasEl || !offcanvasEl.classList.contains('is-open')) return;
    if (e.key === 'Escape') {
      e.preventDefault();
      e.stopPropagation();
      if (ocPanel3.classList.contains('is-open')) {
        closePanel3(true);
      } else if (ocPanel2.classList.contains('is-open')) {
        closePanel2(true);
      } else {
        closeMenu();
      }
      return;
    }
    if (e.key === 'Tab') {
      var panels = [offcanvasEl, ocPanel2, ocPanel3].filter(function (panel) {
        return panel && !panel.inert;
      });
      var focusables = [];
      panels.forEach(function (panel) {
        Array.prototype.forEach.call(panel.querySelectorAll(
          'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
        ), function (element) {
          if (element.getClientRects().length) focusables.push(element);
        });
      });
      if (!focusables.length) {
        e.preventDefault();
        offcanvasEl.focus();
      } else if (e.shiftKey && document.activeElement === focusables[0]) {
        e.preventDefault();
        focusables[focusables.length - 1].focus();
      } else if (!e.shiftKey && document.activeElement === focusables[focusables.length - 1]) {
        e.preventDefault();
        focusables[0].focus();
      }
    }
  });

  // ─── Hover-открытие на десктопе ───
  var isPointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
  if (isPointer) {
    document.querySelectorAll('.oc-split-row[data-rubric-index]').forEach(function (row) {
      row.addEventListener('mouseenter', function () {
        var idx    = parseInt(this.dataset.rubricIndex, 10);
        var rubric = RUBRICS[idx];
        var toggle = row.querySelector('.oc-split-row__toggle');
        if (rubric && rubric.children) {
          hoverTimer = setTimeout(function () { openPanel2(rubric, toggle, true); }, 220);
        }
      });
      row.addEventListener('mouseleave', function () { clearTimeout(hoverTimer); });
    });
  }

  window.BardakovOffcanvas = {
    close: closeMenu,
    isOpen: function () {
      return Boolean(offcanvasEl && offcanvasEl.classList.contains('is-open'));
    }
  };
})();
