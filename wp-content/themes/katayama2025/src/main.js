import './style.css';
import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';
import { initAllAnimations } from './animations.js';
import './works-frontend.js';
import './opening-video.js'; // オープニング動画制御
import './hero-animation.js'; // Heroアニメーション
import './history-scroll.js'; // 沿革ページスクロールアニメーション
import './estimate.js'; // 見積もりシミュレーター
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
  // GSAP Animations（新規）
  initAllAnimations();

  // スクロールアニメーション
  initScrollAnimations();

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

  // 施工実績カルーセル（スマホ版のみ）
  initWorksSwiper();
});

// スクロールアニメーション（フェードイン・フェードアウト）
function initScrollAnimations() {
  const observerOptions = {
    threshold: 0.15,
    rootMargin: '0px 0px -100px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        // 画面に入った時：フェードイン
        entry.target.classList.add('is-visible');
      } else {
        // 画面から出た時：フェードアウト
        entry.target.classList.remove('is-visible');
      }
    });
  }, observerOptions);

  // アニメーション対象の要素を取得
  const animateElements = document.querySelectorAll('.fade-in-up, .fade-in, .scale-in');
  animateElements.forEach(el => observer.observe(el));

  // セクション全体にもアニメーションを適用
  const sections = document.querySelectorAll('.animate-on-scroll');
  sections.forEach(section => {
    // セクション自体を監視
    observer.observe(section);

    // セクション内の子要素にもフェードインクラスを追加（まだない場合）
    const children = section.querySelectorAll(':scope > div > *');
    children.forEach((child, index) => {
      if (!child.classList.contains('fade-in-up') &&
          !child.classList.contains('fade-in') &&
          !child.classList.contains('scale-in')) {
        child.classList.add('fade-in-up');
        child.style.transitionDelay = `${index * 0.1}s`;
        observer.observe(child);
      }
    });
  });
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

// 施工実績カルーセル初期化（スマホ版のみ）
function initWorksSwiper() {
  const worksSwiper = document.querySelector('.works-swiper');
  if (!worksSwiper) return;

  // スマホ版（639px以下）のみSwiperを有効化
  let swiper = null;

  function checkWidth() {
    if (window.innerWidth <= 639) {
      if (!swiper) {
        swiper = new Swiper('.works-swiper', {
          modules: [Navigation, Pagination, Autoplay],
          slidesPerView: 1,
          spaceBetween: 20,
          loop: true,
          autoplay: {
            delay: 4000,
            disableOnInteraction: false,
          },
          pagination: {
            el: '.works-swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.works-swiper-button-next',
            prevEl: '.works-swiper-button-prev',
          },
        });
      }
    } else {
      // PC版・タブレット版ではSwiperを破棄
      if (swiper) {
        swiper.destroy(true, true);
        swiper = null;
      }
    }
  }

  // 初期化時とリサイズ時にチェック
  checkWidth();
  window.addEventListener('resize', checkWidth);
}
