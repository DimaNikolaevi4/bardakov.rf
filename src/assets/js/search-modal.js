/**
 * Модальный поиск с мгновенными результатами
 * Загружает /search-index.json и строит Lunr-индекс на клиенте
 */
(function () {
  'use strict';

  // Состояние
  var searchIndex = null;
  var searchDocuments = [];
  var isLoading = false;
  var isLoaded = false;
  var hasRussianStemmer = false;

  // Элементы DOM
  var modalInput     = document.getElementById('searchModalInput');
  var resultsDiv     = document.getElementById('searchModalResults');
  var resultsInfo    = document.getElementById('searchModalResultsInfo');
  var resultsList    = document.getElementById('searchModalResultsList');
  var rubricSelect   = document.getElementById('searchRubricSelect');
  var searchModal    = document.getElementById('searchModal');
  var searchTriggers = [
    document.getElementById('headerSearchToggle'),
    document.getElementById('offcanvasSearchToggle')
  ].filter(Boolean);
  var searchReturnFocus = null;

  if (!modalInput || !resultsDiv) return;

  // Debounce timer
  var debounceTimer = null;

  // ─── Ожидание Lunr.js ───
  function waitForLunr(timeoutMs) {
    timeoutMs = timeoutMs || 8000;
    return new Promise(function (resolve, reject) {
      if (typeof window.lunr === 'function') return resolve();
      var start = Date.now();
      var tick = function () {
        if (typeof window.lunr === 'function') return resolve();
        if (Date.now() - start > timeoutMs) return reject(new Error('lunr.js не загружен'));
        setTimeout(tick, 50);
      };
      tick();
    });
  }

  // ─── Загрузка индекса ───
  function loadSearchIndex() {
    if (isLoaded) return Promise.resolve();
    if (isLoading) {
      return new Promise(function (resolve) {
        var check = function () {
          if (isLoaded) return resolve();
          setTimeout(check, 50);
        };
        check();
      });
    }
    isLoading = true;

    return waitForLunr().then(function () {
      return fetch('/search-index.json', { cache: 'no-cache' });
    }).then(function (response) {
      if (!response.ok) throw new Error('Не удалось загрузить индекс: ' + response.status);
      return response.json();
    }).then(function (data) {
      searchDocuments = data.documents || [];

      hasRussianStemmer = typeof window.lunr.ru === 'function';

      searchIndex = lunr(function () {
        if (hasRussianStemmer) {
          this.use(lunr.ru);
        }
        this.ref('id');
        this.field('title', { boost: 10 });
        this.field('excerpt', { boost: 5 });
        this.field('category');
        this.field('rubric');
        this.field('tags', { boost: 3 });

        searchDocuments.forEach(function (doc) {
          this.add({
            id: doc.id,
            title: doc.title || '',
            excerpt: doc.excerpt || '',
            category: doc.category || '',
            rubric: doc.rubric || '',
            tags: Array.isArray(doc.tags) ? doc.tags.join(' ') : (doc.tags || '')
          });
        }, this);
      });

      isLoaded = true;
      console.log('[search-modal] Index loaded:', searchDocuments.length, 'docs');
    }).catch(function (error) {
      console.error('[search-modal] Error:', error);
    }).then(function () {
      isLoading = false;
    });
  }

  // ─── Экранирование HTML ───
  function escapeHtml(text) {
    if (!text) return '';
    var div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  // ─── Форматирование даты ───
  function formatDate(dateStr) {
    if (!dateStr) return '';
    try {
      var date = new Date(dateStr);
      return date.toLocaleDateString('ru-RU', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
      });
    } catch (e) {
      return dateStr;
    }
  }

  // ─── Получить название рубрики по коду ───
  function getRubricTitle(code) {
    if (!code) return '';
    var rubricsScript = document.getElementById('rubricsData');
    if (!rubricsScript) return code;
    try {
      var rubrics = JSON.parse(rubricsScript.textContent) || [];
      for (var i = 0; i < rubrics.length; i++) {
        if (rubrics[i].code === code) return rubrics[i].title;
        if (rubrics[i].children) {
          for (var j = 0; j < rubrics[i].children.length; j++) {
            if (rubrics[i].children[j].code === code) return rubrics[i].children[j].title;
            if (rubrics[i].children[j].children) {
              for (var k = 0; k < rubrics[i].children[j].children.length; k++) {
                if (rubrics[i].children[j].children[k].code === code) return rubrics[i].children[j].children[k].title;
              }
            }
          }
        }
      }
    } catch (e) {}
    return code;
  }

  // ─── Выполнение поиска ───
  function performSearch(query) {
    if (!searchIndex || !query || query.trim().length < 2) return [];

    try {
      var cleanQuery = query
        .toLowerCase()
        .replace(/[^\p{L}\p{N}\s]/gu, ' ')
        .trim()
        .split(/\s+/)
        .filter(function (word) { return word.length > 1; })
        .map(function (word) { return hasRussianStemmer ? word : word + '*'; })
        .join(' ');

      if (!cleanQuery) return [];

      var results = searchIndex.search(cleanQuery);

      return results.map(function (result) {
        var doc = searchDocuments.find(function (d) { return d.id === result.ref; });
        return doc ? { doc: doc, score: result.score } : null;
      }).filter(Boolean).slice(0, 10);

    } catch (error) {
      console.error('[search-modal] Search error:', error);
      return [];
    }
  }

  // ─── Рендер результатов ───
  function renderResults(results, query) {
    if (!resultsInfo || !resultsList) return;

    if (results.length === 0) {
      resultsInfo.innerHTML = 'По запросу «<strong>' + escapeHtml(query) + '</strong>» ничего не найдено';
      resultsList.innerHTML = '';
      resultsDiv.style.display = 'block';
      return;
    }

    resultsInfo.innerHTML = 'Найдено: <strong>' + results.length + '</strong>' +
      (results.length >= 10 ? ' (показаны первые 10)' : '');

    resultsList.innerHTML = results.map(function (item) {
      var doc = item.doc;
      var rubricHtml = doc.rubric && doc.rubric !== '0'
        ? '<span class="search-modal__result-rubric">' + escapeHtml(getRubricTitle(doc.rubric)) + '</span>'
        : '';
      var dateHtml = doc.date
        ? '<time datetime="' + escapeHtml(doc.date) + '">' + formatDate(doc.date) + '</time>'
        : '';

      return '<li class="search-modal__result-item">' +
        '<a href="' + escapeHtml(doc.url) + '" class="search-modal__result-title">' + escapeHtml(doc.title) + '</a>' +
        '<div class="search-modal__result-meta">' + dateHtml + rubricHtml + '</div>' +
        '<p class="search-modal__result-excerpt">' + escapeHtml(doc.excerpt) + '</p>' +
        '</li>';
    }).join('');

    resultsDiv.style.display = 'block';
  }

  // ─── Скрыть результаты ───
  function hideResults() {
    if (resultsDiv) resultsDiv.style.display = 'none';
  }

  // ─── Обработчик ввода ───
  modalInput.addEventListener('input', function () {
    var query = modalInput.value.trim();

    clearTimeout(debounceTimer);

    if (query.length < 2) {
      hideResults();
      return;
    }

    debounceTimer = setTimeout(function () {
      loadSearchIndex().then(function () {
        var results = performSearch(query);
        renderResults(results, query);
      });
    }, 300);
  });

  // ─── Навигация по рубрикам ───
  if (rubricSelect) {
    rubricSelect.addEventListener('change', function () {
      var url = rubricSelect.value;
      if (url) {
        window.location.href = url;
      }
    });
  }

  function setSearchExpanded(isExpanded) {
    searchTriggers.forEach(function (trigger) {
      trigger.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
    });
  }

  function getVisibleOffcanvasToggle() {
    return Array.prototype.find.call(
      document.querySelectorAll('[aria-controls="offcanvasRubrics"]'),
      function (button) {
        return !button.closest('#offcanvasRubrics') && button.getClientRects().length;
      }
    );
  }

  function openSearchModal(trigger) {
    if (!searchModal || searchModal.classList.contains('is-open')) return;

    var a11yPanel = document.getElementById('a11yPanel');
    if (a11yPanel && a11yPanel.getAttribute('aria-hidden') === 'false' &&
        window.BardakovA11y && window.BardakovA11y.close) {
      window.BardakovA11y.close(false);
    }

    if (window.BardakovOffcanvas && window.BardakovOffcanvas.isOpen()) {
      window.BardakovOffcanvas.close();
    }

    searchReturnFocus = trigger && trigger.closest('#offcanvasRubrics')
      ? getVisibleOffcanvasToggle() || document.getElementById('headerSearchToggle')
      : trigger || document.getElementById('headerSearchToggle');

    searchModal.inert = false;
    searchModal.setAttribute('aria-hidden', 'false');
    searchModal.classList.add('is-open');
    setSearchExpanded(true);
    document.body.classList.add('no-scroll');
    document.addEventListener('keydown', onSearchModalKeydown);

    window.requestAnimationFrame(function () {
      if (searchModal.classList.contains('is-open')) modalInput.focus();
    });
  }

  function closeSearchModal(restoreFocus) {
    if (!searchModal || !searchModal.classList.contains('is-open')) return;

    if (restoreFocus !== false && searchReturnFocus && searchReturnFocus.isConnected) {
      searchReturnFocus.focus();
    }
    searchModal.classList.remove('is-open');
    searchModal.setAttribute('aria-hidden', 'true');
    searchModal.inert = true;
    setSearchExpanded(false);
    document.body.classList.remove('no-scroll');
    document.removeEventListener('keydown', onSearchModalKeydown);
    searchReturnFocus = null;
  }

  function onSearchModalKeydown(event) {
    if (event.key === 'Escape') {
      event.preventDefault();
      closeSearchModal();
      return;
    }
    if (event.key !== 'Tab') return;

    var focusable = Array.prototype.filter.call(
      searchModal.querySelectorAll(
        'a[href], button:not([disabled]), input:not([disabled]), select:not([disabled]), textarea:not([disabled]), [tabindex]:not([tabindex="-1"])'
      ),
      function (element) {
        return element.getClientRects().length > 0;
      }
    );

    if (!focusable.length) {
      event.preventDefault();
      return;
    }
    if (event.shiftKey && document.activeElement === focusable[0]) {
      event.preventDefault();
      focusable[focusable.length - 1].focus();
    } else if (!event.shiftKey && document.activeElement === focusable[focusable.length - 1]) {
      event.preventDefault();
      focusable[0].focus();
    }
  }

  searchTriggers.forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      openSearchModal(trigger);
    });
  });

  if (searchModal) {
    searchModal.querySelectorAll('[data-action="close-search"]').forEach(function (button) {
      button.addEventListener('click', function () {
        closeSearchModal();
      });
    });
  }

  window.BardakovSearch = {
    open: openSearchModal,
    close: closeSearchModal,
    isOpen: function () {
      return Boolean(searchModal && searchModal.classList.contains('is-open'));
    }
  };

  // ─── Сброс при закрытии модала ───
  if (searchModal) {
    var observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (m) {
        if (m.attributeName === 'class') {
          if (!searchModal.classList.contains('is-open')) {
            // Модал закрылся — очищаем
            if (modalInput) modalInput.value = '';
            hideResults();
            if (rubricSelect) rubricSelect.selectedIndex = 0;
          }
        }
      });
    });
    observer.observe(searchModal, { attributes: true });
  }
})();
