<?php
/**
 * オープニング動画表示
 * トップページ初回訪問時のみ表示される動画アニメーション
 */
$opening_video_url = get_template_directory_uri() . '/assets/videos/OpeningLogo.mp4';
?>

<div id="opening-overlay" class="opening-overlay" style="display: none;">
    <div class="opening-logo-container">
        <video id="opening-video" class="opening-video" muted playsinline>
            <source src="<?php echo esc_url($opening_video_url); ?>" type="video/mp4">
        </video>
    </div>
</div>
