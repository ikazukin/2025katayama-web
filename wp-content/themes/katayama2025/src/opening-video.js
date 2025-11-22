/**
 * オープニング動画アニメーション
 * トップページ初回訪問時のみ動画を表示してフェードアウト
 */

import gsap from 'gsap';

class OpeningVideo {
  constructor() {
    this.overlay = document.getElementById('opening-overlay');
    this.video = document.getElementById('opening-video');

    // 初回訪問チェック
    this.hasVisited = sessionStorage.getItem('katayama_visited');

    if (!this.overlay || !this.video) return;

    this.init();
  }

  init() {
    // 既に訪問済みの場合は何もしない
    if (this.hasVisited) {
      this.overlay.remove();
      return;
    }

    // オーバーレイを表示
    this.overlay.style.display = 'flex';

    // ページスクロールを無効化
    document.body.style.overflow = 'hidden';

    // 動画アニメーション開始
    this.startAnimation();
  }

  startAnimation() {
    // 動画を再生
    this.video.play().catch(err => {
      console.log('Video autoplay prevented:', err);
      // 動画再生が失敗した場合はすぐに終了
      this.cleanup();
    });

    // 4秒後にフェードアウト開始
    setTimeout(() => {
      const timeline = gsap.timeline({
        onComplete: () => this.cleanup()
      });

      // オーバーレイ全体をフェードアウト
      timeline.to(this.overlay, {
        opacity: 0,
        duration: 0.8,
        ease: 'power2.inOut',
      });
    }, 4000); // 4秒待機
  }

  cleanup() {
    // 動画を停止
    if (this.video) {
      this.video.pause();
      this.video.currentTime = 0;
    }

    // スクロールを再有効化
    document.body.style.overflow = '';

    // オーバーレイを削除
    this.overlay?.remove();

    // セッションストレージに記録
    sessionStorage.setItem('katayama_visited', 'true');

    // ヒーローアニメーション開始のカスタムイベントを発火
    const event = new CustomEvent('openingVideoComplete');
    document.dispatchEvent(event);

    console.log('Opening video animation completed');
  }
}

// DOMContentLoaded後に初期化
document.addEventListener('DOMContentLoaded', () => {
  new OpeningVideo();
});

export default OpeningVideo;
