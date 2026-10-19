/* ============================================================
 * home-carousel.js — 3D Flip карусель с blob-формой + динамический текст
 *
 * Гибрид: 3D flip из 7dc6b76a + динамический текст из 4d88098d
 *
 * Особенности:
 * - 3D flip переход (1.2s, centered rotation с perspective)
 * - Blob-форма с анимацией морфинга
 * - Динамическая смена текста в левом блоке при переключении слайда
 * - Stagger-анимация появления текста (каскад 100мс)
 * - Автопрокрутка 8 секунд, задержка 3 секунды перед стартом
 * - Пауза при наведении мыши
 * ============================================================ */

(function () {
  "use strict";

  // Данные для динамической смены текста в hero-секции
  const heroSlideData = [
    {
      eyebrow: "Персональный сайт преподавателя",
      h1: "Бардаков<br>Дмитрий<br>Николаевич",
      desc: "Преподаватель технических дисциплин<br>ГБПОУ РО «СИТ», г. Сальск",
      quote: "«Образование — это не наполнение сосуда, а зажигание огня.»",
      cite: "Педагогическое кредо",
      buttons:
        '<a href="/obo-mne/" class="btn btn-primary">' +
        '<i class="bi bi-person-circle" aria-hidden="true"></i> ' +
        "<span>Обо мне</span></a>" +
        '<a href="mailto:info@бардаков.рф" class="btn btn-secondary">' +
        '<i class="bi bi-envelope" aria-hidden="true"></i> ' +
        "<span>Связаться</span></a>",
    },
    {
      eyebrow: "Воспитание",
      h1: "Воспитательная<br>работа",
      desc: "Для родителей, советы студентам, разговоры о важном и нормативные документы",
      quote: "«Воспитание — это не назидание, а помощь в становлении личности.»",
      cite: "Принцип работы",
      buttons:
        '<a href="/vospitanie/" class="btn btn-primary">' +
        '<i class="bi bi-heart-pulse" aria-hidden="true"></i> ' +
        "<span>Для родителей</span></a>" +
        '<a href="/vospitanie/prakticheskie-sovety-studentam/" class="btn btn-secondary">' +
        '<i class="bi bi-people" aria-hidden="true"></i> ' +
        "<span>Студентам</span></a>",
    },
    {
      eyebrow: "Обучение",
      h1: "Методические<br>материалы",
      desc: "Лекции, практические работы, КИП и КСК, электромонтёр, ПМ.02",
      quote: "«Знания — это инструмент, который остаётся с тобой навсегда.»",
      cite: "Подход к обучению",
      buttons:
        '<a href="/obuchenie/" class="btn btn-primary">' +
        '<i class="bi bi-journal-bookmark" aria-hidden="true"></i> ' +
        "<span>Материалы</span></a>" +
        '<a href="/obuchenie/kip/prakticheskie-kip/" class="btn btn-secondary">' +
        '<i class="bi bi-laptop" aria-hidden="true"></i> ' +
        "<span>Практика</span></a>",
    },
  ];

  class Carousel3D {
    constructor(carousel) {
      this.carousel = carousel;
      this.slides = Array.from(carousel.querySelectorAll(".home-carousel__slide"));
      this.dots = Array.from(carousel.querySelectorAll(".home-carousel__dot"));
      this.prevBtn = carousel.querySelector("[data-carousel-previous]");
      this.nextBtn = carousel.querySelector("[data-carousel-next]");

      this.currentIndex = 0;
      this.totalSlides = this.slides.length;
      this.autoPlay = null;
      this.autoPlayDelay = 8000;      // 8 секунд между слайдами
      this.initialDelay = 3000;        // 3 секунды перед первым автозапуском
      this.isAnimating = false;

      // Проверяем, на главной ли мы странице (есть ли hero-текст для обновления)
      this.hasHeroText = !!document.getElementById("hero-eyebrow");

      this.init();
    }

    init() {
      // Обработчики кнопок навигации
      if (this.prevBtn) {
        this.prevBtn.addEventListener("click", () => {
          this.handleInteraction();
          this.goToSlide(this.currentIndex - 1, "backward");
        });
      }

      if (this.nextBtn) {
        this.nextBtn.addEventListener("click", () => {
          this.handleInteraction();
          this.goToSlide(this.currentIndex + 1, "forward");
        });
      }

      // Обработчики точек пагинации
      this.dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
          if (index === this.currentIndex) return;
          this.handleInteraction();
          // Определяем направление по кратчайшему пути
          const diff = index - this.currentIndex;
          const direction = diff > 0 ? "forward" : "backward";
          this.goToSlide(index, direction);
        });
      });

      // Пауза при наведении мыши
      this.carousel.addEventListener("mouseenter", () => this.stopAutoPlay());
      this.carousel.addEventListener("mouseleave", () => this.startAutoPlay());

      // Пауза при потере видимости (вкладка неактивна)
      document.addEventListener("visibilitychange", () => {
        if (document.hidden) {
          this.stopAutoPlay();
        } else {
          this.startAutoPlay();
        }
      });

      // Уважение prefers-reduced-motion
      if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        return; // не запускаем автопрокрутку
      }

      // Запуск автопрокрутки с задержкой
      setTimeout(() => this.startAutoPlay(), this.initialDelay);
    }

    handleInteraction() {
      this.stopAutoPlay();
      clearTimeout(this._restartTimer);
      this._restartTimer = setTimeout(
        () => this.startAutoPlay(),
        this.autoPlayDelay + 2000
      );
    }

    startAutoPlay() {
      this.stopAutoPlay();
      if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
      this.autoPlay = setInterval(() => {
        this.goToSlide(this.currentIndex + 1, "forward");
      }, this.autoPlayDelay);
    }

    stopAutoPlay() {
      if (this.autoPlay) {
        clearInterval(this.autoPlay);
        this.autoPlay = null;
      }
    }

    goToSlide(index, direction) {
      if (this.isAnimating) return;
      if (index < 0) index = this.totalSlides - 1;
      if (index >= this.totalSlides) index = 0;
      if (index === this.currentIndex) return;

      this.isAnimating = true;
      const goingForward = direction === "forward";
      const goingBackward = direction === "backward";

      // Шаг 1: Предварительно позиционируем входящий слайд
      // на правильной стартовой позиции БЕЗ анимации.
      // Для forward: входящий слайд стартует слева (is-next = translateX(-100%))
      // Для backward: входящий слайд стартует справа (is-prev = translateX(100%))
      const incomingSlide = this.slides[index];
      const startPosClass = goingForward ? "is-next" : "is-prev";

      // Убираем transition временно (через setProperty с important,
      // т.к. CSS имеет transition-property: ... !important)
      incomingSlide.style.setProperty("transition", "none", "important");
      incomingSlide.classList.remove("is-active", "is-prev", "is-next", "is-turning-in", "is-turning-out");
      incomingSlide.classList.add(startPosClass);

      // Принудительный reflow — браузер применит стартовую позицию
      void incomingSlide.offsetHeight;

      // Возвращаем transition (убираем inline important, CSS !important снова работает)
      incomingSlide.style.removeProperty("transition");

      // Шаг 2: В следующем кадре меняем классы → запускаем анимацию
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
        this.slides.forEach((slide, i) => {
          slide.classList.remove("is-active", "is-prev", "is-next", "is-turning-in", "is-turning-out");

          if (i === index) {
            slide.classList.add("is-active");
            slide.setAttribute("aria-hidden", "false");
          } else {
            slide.setAttribute("aria-hidden", "true");
            const prevIndex = (index - 1 + this.totalSlides) % this.totalSlides;
            const nextIndex = (index + 1) % this.totalSlides;
            if (i === prevIndex) {
              // prevIndex = слайд ПЕРЕД новым активным
              // forward: этот слайд только что был активным → уходит вправо (is-prev)
              // backward: этот слайд будет следующим → ждёт слева (is-next)
              slide.classList.add(goingForward ? "is-prev" : "is-next");
            } else if (i === nextIndex) {
              // nextIndex = слайд ПОСЛЕ нового активного
              // forward: этот слайд будет следующим → ждёт слева (is-next)
              // backward: этот слайд только что был активным → уходит влево (is-next)
              //           (НЕ is-prev, т.к. is-prev = вправо, а нам нужно влево!)
              slide.classList.add(goingForward ? "is-next" : "is-next");
            }
          }
        });

        // Обновляем точки пагинации
        this.dots.forEach((dot, i) => {
          dot.setAttribute("aria-current", i === index ? "true" : "false");
        });

        this.currentIndex = index;

        // Обновляем текст в hero-секции (если на главной странице)
        if (this.hasHeroText) {
          this.updateHeroText(index);
        }

        // Разблокировка через 0.9с
        setTimeout(() => {
          this.isAnimating = false;
        }, 900);
        });
      });
    }

    updateHeroText(index) {
      const data = heroSlideData[index];
      if (!data) return;

      const textItems = document.querySelectorAll(
        ".page-showcase__copy > .eyebrow, " +
          ".page-showcase__copy > h1, " +
          ".page-showcase__copy > .page-scaffold__description, " +
          ".page-showcase__copy > .page-showcase__quote, " +
          ".page-showcase__copy > .page-showcase__actions"
      );

      // Скрываем все элементы
      textItems.forEach((item) => item.classList.remove("visible"));

      // Меняем содержимое через 300мс
      setTimeout(() => {
        const eyebrow = document.getElementById("hero-eyebrow");
        const h1 = document.getElementById("hero-h1");
        const desc = document.getElementById("hero-desc");
        const quoteText = document.getElementById("hero-quote-text");
        const quoteCite = document.getElementById("hero-quote-cite");
        const actions = document.getElementById("hero-actions");

        if (eyebrow) eyebrow.textContent = data.eyebrow;
        if (h1) h1.innerHTML = data.h1;
        if (desc) desc.innerHTML = data.desc;
        if (quoteText) quoteText.textContent = data.quote;
        if (quoteCite) quoteCite.textContent = data.cite;
        if (actions) actions.innerHTML = data.buttons;

        // Stagger-анимация (каскад 100мс)
        textItems.forEach((item, i) => {
          setTimeout(() => {
            item.classList.add("visible");
          }, i * 100);
        });
      }, 300);
    }
  }

  // Инициализация всех каруселей на странице
  function initCarousels() {
    document.querySelectorAll("[data-home-carousel]").forEach((carousel) => {
      if (!carousel._carouselInstance) {
        carousel._carouselInstance = new Carousel3D(carousel);
      }
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initCarousels);
  } else {
    initCarousels();
  }
})();
