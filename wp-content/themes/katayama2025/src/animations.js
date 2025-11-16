/**
 * GSAP Animations for Katayama 2025 Theme
 *
 * Modern UI × Motion Design
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

// ScrollTriggerプラグインを登録
gsap.registerPlugin(ScrollTrigger);

/**
 * Hero Animation
 * 動画背景に合わせてキャッチコピーがフェードイン
 */
export function initHeroAnimation() {
  const heroTitle = document.querySelector('.hero-title');
  const heroSubtitle = document.querySelector('.hero-subtitle');
  const heroCta = document.querySelector('.hero-cta');

  if (heroTitle) {
    gsap.from(heroTitle, {
      opacity: 0,
      y: -30,
      duration: 1.5,
      delay: 0.5,
      ease: 'power2.out',
    });
  }

  if (heroSubtitle) {
    gsap.from(heroSubtitle, {
      opacity: 0,
      y: 30,
      duration: 1.5,
      delay: 1,
      ease: 'power2.out',
    });
  }

  if (heroCta) {
    gsap.from(heroCta, {
      opacity: 0,
      scale: 0.9,
      duration: 1,
      delay: 1.5,
      ease: 'back.out(1.7)',
    });
  }
}

/**
 * Entrance Motion（スクロールイン）
 * 各セクションをスクロール時にフェード＋Y軸スライド
 */
export function initEntranceMotion() {
  const sections = document.querySelectorAll('.animate-on-scroll');

  console.log('Found sections:', sections.length);

  sections.forEach((section, index) => {
    console.log(`Animating section ${index}:`, section);

    gsap.from(section, {
      y: 50,
      opacity: 0,
      duration: 1,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: section,
        start: 'top 80%',
        toggleActions: 'play none none none',
        markers: true, // デバッグ用
        onEnter: () => console.log(`Section ${index} entered`),
      },
    });
  });
}

/**
 * Card Hover Animation
 * カード要素にマウスホバー時の動きを追加
 */
export function initCardHoverAnimation() {
  const cards = document.querySelectorAll('.card-hover');

  cards.forEach((card) => {
    card.addEventListener('mouseenter', () => {
      gsap.to(card, {
        y: -8,
        duration: 0.3,
        ease: 'power2.out',
      });
    });

    card.addEventListener('mouseleave', () => {
      gsap.to(card, {
        y: 0,
        duration: 0.3,
        ease: 'power2.out',
      });
    });
  });
}

/**
 * すべてのアニメーションを初期化
 */
export function initAllAnimations() {
  // Hero Animation（トップページのみ）
  if (document.querySelector('.hero-title')) {
    initHeroAnimation();
  }

  // Entrance Motion（全ページ）
  initEntranceMotion();

  // Card Hover Animation（全ページ）
  initCardHoverAnimation();

  console.log('✨ GSAP Animations initialized');
}
