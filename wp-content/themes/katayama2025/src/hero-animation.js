/**
 * Hero Section Animation
 * 動画 → 一行目 → 二行目 → ヘッダー + 背景画像の順でフワーと表示
 * キャッチコピーを5秒ごとに切り替え
 */

import gsap from 'gsap';

function startHeroAnimation() {
  const heroVideo = document.querySelector('.hero-video-wrapper video, .hero-video-wrapper img');
  const copySet1 = document.querySelector('.hero-copy-set-1');
  const copySet2 = document.querySelector('.hero-copy-set-2');
  const copyLabelsSet1 = copySet1 ? copySet1.querySelectorAll('.copy-label') : [];
  const siteHeader = document.querySelector('.site-header');
  const backgroundImage = document.querySelector('.front-page-background');

  if (!heroVideo || copyLabelsSet1.length === 0) return;

  // 初期アニメーションタイムラインを作成
  const tl = gsap.timeline({
    defaults: {
      ease: 'power2.out',
      duration: 1
    }
  });

  // 1. 動画をフェードイン
  tl.to(heroVideo, {
    opacity: 1,
    duration: 0.8
  });

  // 2. 一行目をフワーと表示（0.1秒後）
  tl.to(copyLabelsSet1[0], {
    opacity: 1,
    y: 0,
    duration: 0.6
  }, '+=0.1');

  // 3. 二行目をフワーと表示（0.1秒後）
  if (copyLabelsSet1[1]) {
    tl.to(copyLabelsSet1[1], {
      opacity: 1,
      y: 0,
      duration: 0.6
    }, '+=0.1');
  }

  // 4. ヘッダーメニューと背景画像を同時にフェードイン（0.1秒後）
  if (siteHeader) {
    tl.to(siteHeader, {
      opacity: 1,
      y: 0,
      duration: 0.6
    }, '+=0.1');
  }

  // 背景画像も同じタイミングで表示（クラスを追加）
  if (backgroundImage) {
    tl.add(() => {
      backgroundImage.classList.add('is-visible');
    }, '-=0.8'); // ヘッダーと同時
  }

  // 初期アニメーション完了後、キャッチコピーの切り替えを開始
  if (copySet2) {
    console.log('Copy set 2 found:', copySet2);

    // セット2のラベルも初期化
    const copyLabelsSet2 = copySet2.querySelectorAll('.copy-label');
    console.log('Copy labels set 2:', copyLabelsSet2);

    copyLabelsSet2.forEach(label => {
      gsap.set(label, { opacity: 0, y: 30 });
    });

    // 初期アニメーション完了後に切り替え開始
    tl.call(() => {
      console.log('Starting catchphrase switch animation');

      // 切り替えタイムラインを作成（無限ループ）
      const switchTl = gsap.timeline({
        repeat: -1, // 無限ループ
        repeatDelay: 0
      });

      // セット1をフェードアウト（3秒待機後）
      switchTl.to(copyLabelsSet1, {
        opacity: 0,
        y: -30,
        duration: 0.8,
        stagger: 0.1,
        ease: 'power2.in',
        onStart: () => console.log('Fading out set 1')
      }, '+=3');

      // 少し間を空けてからセット2をフェードイン
      switchTl.to(copyLabelsSet2, {
        opacity: 1,
        y: 0,
        duration: 0.8,
        stagger: 0.1,
        ease: 'power2.out',
        onStart: () => console.log('Fading in set 2')
      }, '+=0.4');

      // セット2をフェードアウト（3秒待機後）
      switchTl.to(copyLabelsSet2, {
        opacity: 0,
        y: -30,
        duration: 0.8,
        stagger: 0.1,
        ease: 'power2.in',
        onStart: () => console.log('Fading out set 2')
      }, '+=3');

      // 少し間を空けてからセット1をフェードイン（元に戻る）
      switchTl.to(copyLabelsSet1, {
        opacity: 1,
        y: 0,
        duration: 0.8,
        stagger: 0.1,
        ease: 'power2.out',
        onStart: () => console.log('Fading in set 1')
      }, '+=0.4');
    }, null, '+=0.5');
  } else {
    console.log('Copy set 2 NOT found');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  // オープニング動画があるかチェック（初回訪問かどうか）
  const hasVisited = sessionStorage.getItem('katayama_visited');

  if (!hasVisited) {
    // 初回訪問：オープニング動画完了を待つ
    console.log('Waiting for opening video to complete...');
    document.addEventListener('openingVideoComplete', () => {
      console.log('Opening video complete, starting hero animation');
      startHeroAnimation();
    });
  } else {
    // 2回目以降の訪問：即座に開始
    console.log('Returning visitor, starting hero animation immediately');
    startHeroAnimation();
  }
});

export default {};
