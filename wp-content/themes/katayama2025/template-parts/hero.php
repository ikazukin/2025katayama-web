<?php
/**
 * Template Part: Hero Section
 * 動画の左側にキャッチコピーを軽く重ねる
 */

// データ取得（カスタマイザー優先、次にACF、最後にデフォルト）
$page_id = get_option('page_on_front');
if (!$page_id) return;

// ヘルパー関数：カスタマイザーまたはACFから値を取得
function get_customizer_or_acf($customizer_key, $acf_key, $page_id, $default = '') {
    $customizer_value = get_theme_mod($customizer_key);
    if (!empty($customizer_value)) {
        return $customizer_value;
    }
    $acf_value = get_field($acf_key, $page_id);
    if (!empty($acf_value)) {
        return $acf_value;
    }
    return $default;
}

// メディアID取得用のヘルパー関数
function get_media_from_customizer_or_acf($customizer_key, $acf_key, $page_id) {
    $media_id = get_theme_mod($customizer_key);
    if (!empty($media_id)) {
        $url = wp_get_attachment_url($media_id);
        if ($url) {
            return ['url' => $url];
        }
    }
    $acf_media = get_field($acf_key, $page_id);
    if (!empty($acf_media) && is_array($acf_media)) {
        return $acf_media;
    }
    return null;
}

// 動画・画像データ取得
$pc_video = get_media_from_customizer_or_acf('hero_pc_video', 'hero_pc_video', $page_id);
$sp_video = get_media_from_customizer_or_acf('hero_sp_video', 'hero_sp_video', $page_id);
$poster = get_media_from_customizer_or_acf('hero_poster', 'hero_poster', $page_id);

// テキストデータ取得
$title = get_customizer_or_acf('hero_title', 'hero_title', $page_id, "住まいをまもる\n暮らしをまもる");
$subtitle = get_customizer_or_acf('hero_subtitle', 'hero_subtitle', $page_id, '');

// タイトルを行ごとに分割
$title_lines = explode("\n", $title);
?>

<div class="hero">
    <div class="hero-video-wrapper">
        <!-- PC用動画 -->
        <?php if ($pc_video): ?>
            <video autoplay muted loop playsinline class="hidden md:block">
                <source src="<?php echo esc_url($pc_video['url']); ?>" type="video/mp4">
            </video>
        <?php elseif ($poster): ?>
            <img src="<?php echo esc_url($poster['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="hidden md:block">
        <?php endif; ?>

        <!-- モバイル用動画 -->
        <?php if ($sp_video): ?>
            <video autoplay muted loop playsinline class="md:hidden">
                <source src="<?php echo esc_url($sp_video['url']); ?>" type="video/mp4">
            </video>
        <?php elseif ($poster): ?>
            <img src="<?php echo esc_url($poster['url']); ?>" alt="<?php echo esc_attr($title); ?>" class="md:hidden">
        <?php endif; ?>

        <!-- キャッチコピー1セット目 -->
        <div class="hero-copy hero-copy-set-1">
            <?php foreach ($title_lines as $line): ?>
                <?php if (trim($line)): ?>
                    <span class="copy-label"><?php echo esc_html(trim($line)); ?></span>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- キャッチコピー2セット目 -->
        <div class="hero-copy hero-copy-set-2">
            <span class="copy-label">地域に根ざして40年</span>
            <span class="copy-label">積み重ねた信頼と安心</span>
        </div>
    </div>
</div>
