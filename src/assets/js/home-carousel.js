/* ============================================================
 * home-carousel.js — 3D Flip карусель с blob-формой и оверлеями
 *
 * Особенности:
 * - 3D flip переход (1.2s, centered rotation с perspective)
 * - Автопрокрутка 8 секунд между слайдами
 * - Задержка 3 секунды перед первым автозапуском
 * - Пауза при наведении мыши и клике
 * - Обновление aria-hidden для доступности
 *
 * Источник: docs/DESIGN.md §6 + креативный дизайн
 * Создано: 2026-10-18 (blob + 3D flip + overlays)
 * ============================================================ */

(function () {
  "use strict";

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
      this.isAnimating = false;        // блокировка двойных кликов во время перехода

      this.init();
    }

    init() {
      // Обработчики кнопок навигации
      if (this.prevBtn) {
        this.prevBtn.addEventListener("click", () => {
          this.handleInteraction();
          this.goToSlide(this.currentIndex - 1);
        });
      }

      if (this.nextBtn) {
        this.nextBtn.addEventListener("click", () => {
          this.handleInteraction();
          this.goToSlide(this.currentIndex + 1);
        });
      }

      // Обработчики точек пагинации
      this.dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
          if (index === this.currentIndex) return;
          this.handleInteraction();
          this.goToSlide(index);
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
      // Перезапуск автопрокрутки через 10 секунд после последнего взаимодействия
      clearTimeout(this._restartTimer);
      this._restartTimer = setTimeout(() => this.startAutoPlay(), this.autoPlayDelay + 2000);
    }

    startAutoPlay() {
      this.stopAutoPlay();
      if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
      this.autoPlay = setInterval(() => {
        this.goToSlide(this.currentIndex + 1);
      }, this.autoPlayDelay);
    }

    stopAutoPlay() {
      if (this.autoPlay) {
        clearInterval(this.autoPlay);
        this.autoPlay = null;
      }
    }

    goToSlide(index) {
      if (this.isAnimating) return;
      if (index < 0) index = this.totalSlides - 1;
      if (index >= this.totalSlides) index = 0;
      if (index === this.currentIndex) return;

      this.isAnimating = true;

      // Определяем направление (вперёд/назад) для правильного flip
      const direction = index > this.currentIndex ||
        (this.currentIndex === this.totalSlides - 1 && index === 0)
        ? "forward"
        : "backward";

      // Обновляем классы слайдов
      this.slides.forEach((slide, i) => {
        slide.classList.remove("is-active", "is-prev", "is-next", "is-turning-in", "is-turning-out");

        if (i === index) {
          slide.classList.add("is-active");
          slide.setAttribute("aria-hidden", "false");
        } else {
          slide.setAttribute("aria-hidden", "true");
          // prev/next для боковых слайдов
          const prevIndex = (index - 1 + this.totalSlides) % this.totalSlides;
          const nextIndex = (index + 1) % this.totalSlides;
          if (i === prevIndex) slide.classList.add("is-prev");
          else if (i === nextIndex) slide.classList.add("is-next");
        }

        // Убираем inert после завершения анимации
        if (i === index) {
          slide.removeAttribute("inert");
        } else {
          // Оставляем неактивные слайды без inert для плавности 3D-анимации
          // (inert мешает CSS transition)
        }
      });

      // Обновляем точки пагинации
      this.dots.forEach((dot, i) => {
        dot.setAttribute("aria-current", i === index ? "true" : "false");
      });

      this.currentIndex = index;

      // Разблокировка через 1.3с (чуть больше чем 1.2s transition)
      setTimeout(() => {
        this.isAnimating = false;
      }, 1300);
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

  // Запуск после DOM ready
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initCarousels);
  } else {
    initCarousels();
  }
})();
