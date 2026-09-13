/* ============================================
   бардаков.рф — Инициализация всех слайдеров
   ============================================ */

document.addEventListener('DOMContentLoaded', function () {

  /* -------------------------------------------
     1. Hero Слайдер (Swiper — flip effect)
     ------------------------------------------- */
  var slideshowEl = document.getElementById('slideshow-hero');
  if (slideshowEl) {
    var effect = slideshowEl.getAttribute('data-effect') || 'flip';
    var autoplay = slideshowEl.getAttribute('data-autoplay') === 'true';
    var loop = slideshowEl.getAttribute('data-loop') === 'true';
    var timeout = parseInt(slideshowEl.getAttribute('data-timeout')) || 8000;
    var speed = parseInt(slideshowEl.getAttribute('data-speed')) || 800;

    new Swiper(slideshowEl, {
      speed: speed,
      loop: loop,
      allowTouchMove: true,
      grabCursor: true,
      autoplay: autoplay ? { delay: timeout, disableOnInteraction: false } : false,
      direction: 'horizontal',
      pagination: {
        el: slideshowEl.querySelector('.swiper-pagination'),
        clickable: true
      },
      navigation: {
        nextEl: slideshowEl.querySelector('.swiper-button-next'),
        prevEl: slideshowEl.querySelector('.swiper-button-prev')
      },
      effect: effect,
      flipEffect: { rotate: 30, slideShadows: false },
      fadeEffect: { crossFade: true },
      coverflowEffect: { rotate: 30, slideShadows: false },
      cubeEffect: { slideShadows: false }
    });
  }

  /* -------------------------------------------
     2. QuickMenu (Swiper Thumbs)
     ------------------------------------------- */
  var thumbsEl = document.querySelector('.quickmenu-thumbs');
  var itemsEl = document.querySelector('.quickmenu-items');

  if (thumbsEl && itemsEl) {
    var thumbsSwiper = new Swiper(thumbsEl, {
      slidesPerView: 2,
      freeMode: true,
      watchSlidesVisibility: true,
      watchSlidesProgress: true
    });

    new Swiper(itemsEl, {
      spaceBetween: 20,
      thumbs: { swiper: thumbsSwiper },
      pagination: {
        el: itemsEl.querySelector('.swiper-pagination'),
        type: 'bullets',
        clickable: true
      }
    });
  }

  /* -------------------------------------------
     3. Видеоплеер
     ------------------------------------------- */
  var videoPoster = document.querySelector('.video-poster');
  var videoEl = document.getElementById('main-video');

  if (videoPoster && videoEl) {
    videoPoster.addEventListener('click', function () {
      videoPoster.classList.add('hidden');
      videoEl.classList.add('visible');
      videoEl.play();
    });

    videoEl.addEventListener('click', function () {
      if (videoEl.paused) {
        videoEl.play();
      } else {
        videoEl.pause();
      }
    });
  }

  /* -------------------------------------------
     4. Flipster — Достижения (Coverflow)
     ------------------------------------------- */
  if (typeof jQuery !== 'undefined' && jQuery.fn.flipster) {
    jQuery('#flipster-achievements').flipster({
      style: 'coverflow',
      start: 'center',
      fadeIn: 400,
      loop: false,
      autoplay: false,
      pauseOnHover: true,
      spacing: -0.2,
      click: true,
      keyboard: true,
      scrollwheel: false,
      touch: true,
      nav: false,
      buttons: true
    });

    /* -------------------------------------------
       5. Flipster — Цитаты (Flat)
       ------------------------------------------- */
    jQuery('#flipster-quotes').flipster({
      style: 'flat',
      start: 'center',
      fadeIn: 400,
      loop: false,
      autoplay: false,
      pauseOnHover: true,
      spacing: -0.2,
      click: true,
      keyboard: true,
      scrollwheel: false,
      touch: true,
      nav: false,
      buttons: true
    });
  }

  /* -------------------------------------------
     6. AOS — Анимации при прокрутке
     ------------------------------------------- */
  if (typeof AOS !== 'undefined') {
    AOS.init({
      duration: 1000,
      once: true,
      delay: 0,
      easing: 'ease',
      offset: 120
    });
  }

});
