/**
 * Works Frontend JavaScript
 * カルーセルギャラリーとビフォーアフター比較のフロントエンド実装
 */

import Swiper from 'swiper';
import { Navigation, Pagination, Thumbs, Autoplay } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/thumbs';

/**
 * カルーセルギャラリーの初期化
 */
function initGalleryCarousels() {
  const carousels = document.querySelectorAll('.wp-block-katayama-gallery-carousel');

  carousels.forEach((carousel) => {
    const container = carousel.querySelector('.carousel-container');
    const thumbsContainer = carousel.querySelector('.carousel-thumbs');
    const autoplay = carousel.dataset.autoplay === 'true';
    const speed = parseInt(carousel.dataset.speed) || 3000;
    const showThumbnails = carousel.dataset.thumbnails === 'true';

    let thumbsSwiper = null;

    // サムネイルSwiperの初期化
    if (showThumbnails && thumbsContainer) {
      thumbsSwiper = new Swiper(thumbsContainer, {
        spaceBetween: 10,
        slidesPerView: 'auto',
        freeMode: true,
        watchSlidesProgress: true,
      });
    }

    // メインSwiperの初期化
    const mainSwiper = new Swiper(container, {
      modules: [Navigation, Pagination, Thumbs, Autoplay],
      spaceBetween: 0,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      thumbs: thumbsSwiper ? {
        swiper: thumbsSwiper,
      } : undefined,
      autoplay: autoplay ? {
        delay: speed,
        disableOnInteraction: false,
      } : false,
      loop: true,
      lazy: true,
    });

    console.log('✅ Gallery carousel initialized');
  });
}

/**
 * ビフォーアフター比較の初期化
 */
function initBeforeAfterComparisons() {
  const comparisons = document.querySelectorAll('.wp-block-katayama-before-after .image-compare');

  comparisons.forEach((comparison) => {
    const imageAfter = comparison.querySelector('.image-after');
    const sliderHandle = comparison.querySelector('.slider-handle');
    const startPosition = parseInt(comparison.dataset.startPosition) || 50;

    let isDragging = false;

    // 初期位置を設定
    updateSliderPosition(startPosition);

    // スライダーの位置を更新
    function updateSliderPosition(percentage) {
      const clampedPercentage = Math.max(0, Math.min(100, percentage));

      // スライダーの位置
      sliderHandle.style.left = `${clampedPercentage}%`;

      // After画像のクリップパス
      imageAfter.style.clipPath = `polygon(${clampedPercentage}% 0, 100% 0, 100% 100%, ${clampedPercentage}% 100%)`;
    }

    // マウス/タッチイベントからパーセンテージを計算
    function calculatePercentage(event) {
      const rect = comparison.getBoundingClientRect();
      const x = (event.type.includes('touch') ? event.touches[0].clientX : event.clientX) - rect.left;
      return (x / rect.width) * 100;
    }

    // ドラッグ開始
    function startDrag(event) {
      isDragging = true;
      comparison.style.cursor = 'grabbing';
      event.preventDefault();
    }

    // ドラッグ中
    function onDrag(event) {
      if (!isDragging) return;

      const percentage = calculatePercentage(event);
      updateSliderPosition(percentage);
    }

    // ドラッグ終了
    function endDrag() {
      isDragging = false;
      comparison.style.cursor = '';
    }

    // マウスイベント
    sliderHandle.addEventListener('mousedown', startDrag);
    document.addEventListener('mousemove', onDrag);
    document.addEventListener('mouseup', endDrag);

    // タッチイベント
    sliderHandle.addEventListener('touchstart', startDrag, { passive: false });
    document.addEventListener('touchmove', onDrag, { passive: false });
    document.addEventListener('touchend', endDrag);

    // 全体クリックで移動
    comparison.addEventListener('click', (event) => {
      if (event.target === sliderHandle || sliderHandle.contains(event.target)) {
        return;
      }
      const percentage = calculatePercentage(event);
      updateSliderPosition(percentage);
    });

    console.log('✅ Before-After comparison initialized');
  });
}

// DOM読み込み後に初期化
document.addEventListener('DOMContentLoaded', () => {
  initGalleryCarousels();
  initBeforeAfterComparisons();
});
