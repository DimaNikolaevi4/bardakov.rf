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
  const turnDuration = 1000;

  let activeIndex = 0;
  let timerId;
  let turnTimerId;
  let isAnimating = false;
  let currentTurn;
  let manuallyPaused = reducedMotion.matches;
  let hovered = false;
  let focused = false;
  let resumeWhileHovered = false;
  let resumeWhileFocused = false;

  function normalizeIndex(index) {
    return (index + slides.length) % slides.length;
  }

  function updateAccessibleSlide(index) {
    slides.forEach((slide, slideIndex) => {
      const isActive = slideIndex === index;
      slide.classList.toggle("is-active", isActive);
      slide.setAttribute("aria-hidden", String(!isActive));
      slide.inert = !isActive;
    });

    dots.forEach((dot, dotIndex) => {
      dot.setAttribute("aria-current", String(dotIndex === index));
    });
  }

  function updateDots(index) {
    dots.forEach((dot, dotIndex) => {
      dot.setAttribute("aria-current", String(dotIndex === index));
    });
  }

  function finishPageTurn() {
    if (!currentTurn) return;

    window.clearTimeout(turnTimerId);
    const { outgoing, incoming } = currentTurn;
    outgoing.classList.remove("is-turning-out", "is-turning-forward", "is-turning-backward");
    incoming.classList.remove("is-turning-in");
    incoming.classList.add("is-active");
    currentTurn = undefined;
    isAnimating = false;
    updateAccessibleSlide(activeIndex);
  }

  function showSlide(index, direction = "forward") {
    if (slides.length < 2 || isAnimating) return;

    const nextIndex = normalizeIndex(index);
    if (nextIndex === activeIndex) return;

    const outgoing = slides[activeIndex];
    const incoming = slides[nextIndex];
    activeIndex = nextIndex;
    updateDots(activeIndex);

    if (reducedMotion.matches) {
      updateAccessibleSlide(activeIndex);
      return;
    }

    isAnimating = true;
    outgoing.classList.remove("is-active");
    outgoing.classList.add(
      "is-turning-out",
      direction === "forward" ? "is-turning-forward" : "is-turning-backward",
    );
    outgoing.setAttribute("aria-hidden", "true");
    outgoing.inert = true;

    incoming.classList.add("is-turning-in");

    currentTurn = { outgoing, incoming };
    turnTimerId = window.setTimeout(finishPageTurn, turnDuration);
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
    pauseIcon.toggleAttribute("hidden", manuallyPaused);
    playIcon.toggleAttribute("hidden", !manuallyPaused);
  }

  function stopTimer() {
    window.clearInterval(timerId);
    timerId = undefined;
  }

  function syncTimer() {
    stopTimer();

    const pausedByHover = hovered && !resumeWhileHovered;
    const pausedByFocus = focused && !resumeWhileFocused;

    if (!manuallyPaused && !pausedByHover && !pausedByFocus && !document.hidden) {
      timerId = window.setInterval(() => showSlide(activeIndex + 1), interval);
    }
  }

  function navigateTo(index, direction) {
    const nextIndex = normalizeIndex(index);
    const forwardDistance = normalizeIndex(nextIndex - activeIndex);
    const turnDirection =
      direction || (forwardDistance <= slides.length / 2 ? "forward" : "backward");

    manuallyPaused = true;
    resumeWhileHovered = false;
    resumeWhileFocused = false;
    showSlide(nextIndex, turnDirection);
    updateToggle();
    syncTimer();
  }

  previousButton.addEventListener("click", () => navigateTo(activeIndex - 1, "backward"));
  nextButton.addEventListener("click", () => navigateTo(activeIndex + 1, "forward"));

  dots.forEach((dot, index) => {
    dot.addEventListener("click", () => navigateTo(index));
  });

  toggleButton.addEventListener("click", () => {
    manuallyPaused = !manuallyPaused;
    resumeWhileHovered = !manuallyPaused && hovered;
    resumeWhileFocused = !manuallyPaused && focused;
    updateToggle();
    syncTimer();
  });

  carousel.addEventListener("mouseenter", () => {
    hovered = true;
    syncTimer();
  });

  carousel.addEventListener("mouseleave", () => {
    hovered = false;
    resumeWhileHovered = false;
    syncTimer();
  });

  carousel.addEventListener("focusin", () => {
    focused = true;
    resumeWhileFocused = false;
    syncTimer();
  });

  carousel.addEventListener("focusout", (event) => {
    if (!carousel.contains(event.relatedTarget)) {
      focused = false;
      resumeWhileFocused = false;
      syncTimer();
    }
  });

  carousel.addEventListener("keydown", (event) => {
    if (event.key === "ArrowLeft") {
      event.preventDefault();
      navigateTo(activeIndex - 1, "backward");
    } else if (event.key === "ArrowRight") {
      event.preventDefault();
      navigateTo(activeIndex + 1, "forward");
    }
  });

  document.addEventListener("visibilitychange", syncTimer);

  reducedMotion.addEventListener("change", (event) => {
    if (event.matches) {
      manuallyPaused = true;
      resumeWhileHovered = false;
      resumeWhileFocused = false;
      finishPageTurn();
    }

    updateToggle();
    syncTimer();
  });

  updateToggle();
  syncTimer();
}
