/**
 * 沿革ページ - スクロール連動アニメーション & 画像カルーセル
 * 現在見ている年を強調表示 + Swiperカルーセル初期化
 */

import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

document.addEventListener('DOMContentLoaded', () => {
  // 年の強調表示
  initYearHighlight();

  // Swiperカルーセル初期化
  initEventCarousels();

  // パララックス効果
  initParallax();
});

// 年の強調表示（IntersectionObserver）
function initYearHighlight() {
  const yearGroups = document.querySelectorAll('.timeline-rebita__year-group');

  if (!yearGroups.length) return;

  // IntersectionObserver のオプション
  const observerOptions = {
    root: null,
    rootMargin: '-20% 0px -60% 0px',
    threshold: 0
  };

  // Observer のコールバック
  const observerCallback = (entries) => {
    entries.forEach(entry => {
      const yearLabel = entry.target.querySelector('.timeline-rebita__year-label');

      if (entry.isIntersecting) {
        // 現在表示されている年を強調
        yearLabel.classList.add('is-active');
      } else {
        // 非表示になったら強調解除
        yearLabel.classList.remove('is-active');
      }
    });
  };

  // Observer の作成
  const observer = new IntersectionObserver(observerCallback, observerOptions);

  // 各年グループを監視
  yearGroups.forEach(group => {
    observer.observe(group);
  });
}

// 画像カルーセル初期化（Swiper）
function initEventCarousels() {
  const carousels = document.querySelectorAll('.event-carousel');

  if (!carousels.length) return;

  carousels.forEach((carousel) => {
    new Swiper(carousel, {
      modules: [Navigation, Pagination, Autoplay],
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      pagination: {
        el: carousel.querySelector('.swiper-pagination'),
        clickable: true,
      },
      navigation: {
        nextEl: carousel.querySelector('.swiper-button-next'),
        prevEl: carousel.querySelector('.swiper-button-prev'),
      },
      speed: 600,
      effect: 'slide',
    });
  });
}

// パララックス効果（軽いスクロール連動）
function initParallax() {
  const yearLabels = document.querySelectorAll('.timeline-rebita__year-label');
  const heroSection = document.querySelector('.history-hero');

  if (!yearLabels.length) return;

  let ticking = false;

  function updateParallax() {
    const scrollY = window.scrollY;

    // Heroセクションのパララックス
    if (heroSection) {
      const heroOffset = scrollY * 0.3;
      heroSection.style.transform = `translateY(${heroOffset}px)`;
    }

    // 年ラベルの軽いパララックス
    yearLabels.forEach((label) => {
      const rect = label.getBoundingClientRect();
      const elementTop = rect.top + scrollY;
      const offsetY = (scrollY - elementTop) * 0.05;

      if (rect.top < window.innerHeight && rect.bottom > 0) {
        label.style.transform = `translateY(${offsetY}px)`;
      }
    });

    ticking = false;
  }

  function requestTick() {
    if (!ticking) {
      requestAnimationFrame(updateParallax);
      ticking = true;
    }
  }

  window.addEventListener('scroll', requestTick, { passive: true });
  updateParallax();
}
