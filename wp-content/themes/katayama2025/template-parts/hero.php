<?php
/**
 * Template Part: Hero Section
 * ヒーロー動画セクション
 */

// データ取得（カスタマイザー優先、次にACF、最後にデフォルト）
$page_id = get_option('page_on_front');
if (!$page_id) return;

// ヘルパー関数：カスタマイザーまたはACFから値を取得
function get_customizer_or_acf($customizer_key, $acf_key, $page_id, $default = '') {
    // カスタマイザーの値を優先
    $customizer_value = get_theme_mod($customizer_key);
    if (!empty($customizer_value)) {
        return $customizer_value;
    }

    // ACFの値をフォールバック
    $acf_value = get_field($acf_key, $page_id);
    if (!empty($acf_value)) {
        return $acf_value;
    }

    return $default;
}

// メディアID取得用のヘルパー関数（ACF形式の配列で返す）
function get_media_from_customizer_or_acf($customizer_key, $acf_key, $page_id) {
    // カスタマイザーから取得（attachment ID）
    $media_id = get_theme_mod($customizer_key);
    if (!empty($media_id)) {
        $url = wp_get_attachment_url($media_id);
        if ($url) {
            return ['url' => $url];
        }
    }

    // ACFから取得（配列形式）
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
$title = get_customizer_or_acf('hero_title', 'hero_title', $page_id, get_bloginfo('name'));
$subtitle = get_customizer_or_acf('hero_subtitle', 'hero_subtitle', $page_id, get_bloginfo('description'));
$cta_text = get_customizer_or_acf('hero_cta_text', 'hero_cta_text', $page_id);
$cta_link = get_customizer_or_acf('hero_cta_link', 'hero_cta_link', $page_id);
?>

<section class="hero-section relative h-screen overflow-hidden">
    <!-- 動画背景 -->
    <div class="absolute inset-0 z-0">
        <?php if ($pc_video): ?>
            <video
                class="w-full h-full object-cover hidden md:block"
                playsinline
                muted
                autoplay
                loop
                preload="none"
                <?php if ($poster): ?>
                    poster="<?php echo esc_url($poster['url']); ?>"
                <?php endif; ?>
                aria-label="<?php echo esc_attr($title); ?> 背景動画"
            >
                <source src="<?php echo esc_url($pc_video['url']); ?>" type="video/mp4">
                <!-- iOS autoplay対策: 動画が再生できない場合はposter画像を表示 -->
                <?php if ($poster): ?>
                    <img
                        src="<?php echo esc_url($poster['url']); ?>"
                        alt="<?php echo esc_attr($title); ?>"
                        class="w-full h-full object-cover"
                        fetchpriority="high"
                    >
                <?php endif; ?>
            </video>
        <?php endif; ?>

        <?php if ($sp_video): ?>
            <video
                class="w-full h-full object-cover md:hidden"
                playsinline
                muted
                autoplay
                loop
                preload="none"
                <?php if ($poster): ?>
                    poster="<?php echo esc_url($poster['url']); ?>"
                <?php endif; ?>
                aria-label="<?php echo esc_attr($title); ?> 背景動画（モバイル）"
            >
                <source src="<?php echo esc_url($sp_video['url']); ?>" type="video/mp4">
                <!-- iOS autoplay対策: 動画が再生できない場合はposter画像を表示 -->
                <?php if ($poster): ?>
                    <img
                        src="<?php echo esc_url($poster['url']); ?>"
                        alt="<?php echo esc_attr($title); ?>"
                        class="w-full h-full object-cover"
                        fetchpriority="high"
                    >
                <?php endif; ?>
            </video>
        <?php elseif ($poster): ?>
            <!-- SPで動画がない場合はposter画像を表示 -->
            <img
                src="<?php echo esc_url($poster['url']); ?>"
                <?php if (isset($poster['sizes'])): ?>
                    srcset="<?php echo esc_attr($poster['sizes']['medium']); ?> 300w,
                            <?php echo esc_attr($poster['sizes']['large']); ?> 1024w,
                            <?php echo esc_attr($poster['url']); ?> <?php echo esc_attr($poster['width']); ?>w"
                    sizes="100vw"
                <?php endif; ?>
                alt="<?php echo esc_attr($title); ?>"
                class="w-full h-full object-cover md:hidden"
                fetchpriority="high"
                width="<?php echo esc_attr($poster['width']); ?>"
                height="<?php echo esc_attr($poster['height']); ?>"
            >
        <?php endif; ?>

        <!-- オーバーレイ -->
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- コンテンツ -->
    <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
        <div class="max-w-4xl">
            <h1 class="hero-title text-4xl md:text-6xl font-bold mb-4">
                <?php echo esc_html($title); ?>
            </h1>

            <?php if ($subtitle): ?>
                <p class="hero-subtitle text-xl md:text-2xl mb-8">
                    <?php echo nl2br(esc_html($subtitle)); ?>
                </p>
            <?php endif; ?>

            <?php if ($cta_link && $cta_text): ?>
                <a
                    href="<?php echo esc_url($cta_link); ?>"
                    class="hero-cta inline-block bg-katayama-blue hover:bg-white text-white hover:text-katayama-blue border-2 border-katayama-blue px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl"
                >
                    <?php echo esc_html($cta_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
