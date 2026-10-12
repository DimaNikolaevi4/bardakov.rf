const carousel = document.querySelector("[data-home-carousel]");

if (carousel) {
  const slides = Array.from(carousel.querySelectorAll(".home-carousel__slide"));
  const dots = Array.from(carousel.querySelectorAll("[data-carousel-slide]"));
  const previousButton = carousel.querySelector("[data-carousel-previous]");
  const nextButton = carousel.querySelector("[data-carousel-next]");
  const toggleButton = carousel.querySelector("[data-carousel-toggle]");
  const pauseIcon = carousel.querySelector("[data-carousel-pause-icon]");
  const playIcon = carousel.querySelector("[data-carousel-play-icon]");
  const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)");
  const interval = Number(carousel.dataset.autoplayInterval) || 8000;

  let activeIndex = 0;
  let timerId;
  let manuallyPaused = reducedMotion.matches;
  let hovered = false;
  let focused = false;

  function showSlide(index) {
    activeIndex = (index + slides.length) % slides.length;

    slides.forEach((slide, slideIndex) => {
      const isActive = slideIndex === activeIndex;
      slide.classList.toggle("is-active", isActive);
      slide.setAttribute("aria-hidden", String(!isActive));
      slide.inert = !isActive;
    });

    dots.forEach((dot, dotIndex) => {
      dot.setAttribute("aria-current", String(dotIndex === activeIndex));
    });
  }

  function updateToggle() {
    toggleButton.setAttribute("aria-pressed", String(manuallyPaused));
    toggleButton.setAttribute(
      "aria-label",
      manuallyPaused
        ? "Запустить автоматическую смену слайдов"
        : "Приостановить автоматическую смену слайдов",
    );
    carousel.setAttribute("aria-live", manuallyPaused ? "polite" : "off");
    pauseIcon.hidden = manuallyPaused;
    playIcon.hidden = !manuallyPaused;
  }

  function stopTimer() {
    window.clearInterval(timerId);
    timerId = undefined;
  }

  function syncTimer() {
    stopTimer();

    if (!manuallyPaused && !hovered && !focused && !document.hidden) {
      timerId = window.setInterval(() => showSlide(activeIndex + 1), interval);
    }
  }

  function navigateTo(index) {
    manuallyPaused = true;
    showSlide(index);
    updateToggle();
    syncTimer();
  }

  previousButton.addEventListener("click", () => navigateTo(activeIndex - 1));
  nextButton.addEventListener("click", () => navigateTo(activeIndex + 1));

  dots.forEach((dot, index) => {
    dot.addEventListener("click", () => navigateTo(index));
  });

  toggleButton.addEventListener("click", () => {
    manuallyPaused = !manuallyPaused;
    updateToggle();
    syncTimer();
  });

  carousel.addEventListener("mouseenter", () => {
    hovered = true;
    syncTimer();
  });

  carousel.addEventListener("mouseleave", () => {
    hovered = false;
    syncTimer();
  });

  carousel.addEventListener("focusin", () => {
    focused = true;
    syncTimer();
  });

  carousel.addEventListener("focusout", (event) => {
    if (!carousel.contains(event.relatedTarget)) {
      focused = false;
      syncTimer();
    }
  });

  carousel.addEventListener("keydown", (event) => {
    if (event.key === "ArrowLeft") {
      event.preventDefault();
      navigateTo(activeIndex - 1);
    } else if (event.key === "ArrowRight") {
      event.preventDefault();
      navigateTo(activeIndex + 1);
    }
  });

  document.addEventListener("visibilitychange", syncTimer);

  reducedMotion.addEventListener("change", (event) => {
    if (event.matches) {
      manuallyPaused = true;
    }

    updateToggle();
    syncTimer();
  });

  updateToggle();
  syncTimer();
}
