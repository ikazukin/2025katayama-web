import './style.css';
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';
import { initAllAnimations } from './animations.js';
import './works-frontend.js';

// DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
  // GSAP Animations（新規）
  initAllAnimations();

  // ライトボックス
  initLightbox();

  // スムーススクロール
  initSmoothScroll();

  // ページトップボタン
  initPageTopButton();

  // フッターアコーディオン
  initFooterAccordion();

  // 動画オートプレイ対応
  initVideoAutoplay();

  // Worksフィルター - Issue 21
  initWorksFilter();
});

// スクロールアニメーション
function initScrollAnimations() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  const animateElements = document.querySelectorAll('.fade-in-up, .fade-in, .scale-in');
  animateElements.forEach(el => observer.observe(el));
}

// ライトボックス
function initLightbox() {
  const lightbox = GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
    autoplayVideos: false
  });
}

// スムーススクロール
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;

      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        e.preventDefault();
        targetElement.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
}

// ページトップボタン
function initPageTopButton() {
  const pageTopButton = document.getElementById('page-top');
  if (!pageTopButton) return;

  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      pageTopButton.classList.add('show');
    } else {
      pageTopButton.classList.remove('show');
    }
  });

  pageTopButton.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
}

// フッターアコーディオン
function initFooterAccordion() {
  const triggers = document.querySelectorAll('.accordion-trigger');

  triggers.forEach(trigger => {
    trigger.addEventListener('click', () => {
      const targetId = trigger.dataset.target;
      const content = document.getElementById(targetId);
      const icon = trigger.querySelector('svg');

      if (!content || !icon) return;

      content.classList.toggle('hidden');
      icon.classList.toggle('rotate-180');
    });
  });
}

// 動画オートプレイ対応 (iOS対策)
function initVideoAutoplay() {
  const videos = document.querySelectorAll('video[autoplay]');
  videos.forEach(video => {
    video.play().catch(err => {
      console.log('Autoplay prevented:', err);
      // フォールバック: poster画像を表示
    });
  });
}

// Worksフィルター - Issue 21
function initWorksFilter() {
  const categorySelect = document.getElementById('work_category');
  const yearSelect = document.getElementById('work_year');

  // カテゴリ選択時に自動送信（オプション）
  if (categorySelect) {
    categorySelect.addEventListener('change', (e) => {
      // オプション: 自動送信したい場合はコメントを外す
      // e.target.form.submit();
    });
  }

  // 年度選択時に自動送信（オプション）
  if (yearSelect) {
    yearSelect.addEventListener('change', (e) => {
      // オプション: 自動送信したい場合はコメントを外す
      // e.target.form.submit();
    });
  }
}

// Lazy loading for images
if ('IntersectionObserver' in window) {
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        if (img.dataset.src) {
          img.src = img.dataset.src;
          img.classList.add('loaded');
          observer.unobserve(img);
        }
      }
    });
  });

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('img[data-src]').forEach(img => {
      imageObserver.observe(img);
    });
  });
}
