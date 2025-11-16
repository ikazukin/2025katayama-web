<?php
/**
 * Template Part: Hero Section
 * ヒーロー動画セクション
 */

// ACFフィールドからデータ取得（フロントページ用）
$page_id = get_option('page_on_front');
if (!$page_id) return;

$pc_video = get_field('hero_pc_video', $page_id);
$sp_video = get_field('hero_sp_video', $page_id);
$poster = get_field('hero_poster', $page_id);
$title = get_field('hero_title', $page_id);
$subtitle = get_field('hero_subtitle', $page_id);
$cta_text = get_field('hero_cta_text', $page_id);
$cta_link = get_field('hero_cta_link', $page_id);

// データがない場合はデフォルト表示
if (!$title) {
    $title = get_bloginfo('name');
    $subtitle = get_bloginfo('description');
}
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
                <?php if ($poster): ?>poster="<?php echo esc_url($poster['url']); ?>"<?php endif; ?>
            >
                <source src="<?php echo esc_url($pc_video['url']); ?>" type="video/mp4">
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
                <?php if ($poster): ?>poster="<?php echo esc_url($poster['url']); ?>"<?php endif; ?>
            >
                <source src="<?php echo esc_url($sp_video['url']); ?>" type="video/mp4">
            </video>
        <?php elseif ($poster): ?>
            <!-- SPで動画がない場合はposter画像を表示 -->
            <img
                src="<?php echo esc_url($poster['url']); ?>"
                alt="<?php echo esc_attr($title); ?>"
                class="w-full h-full object-cover md:hidden"
            >
        <?php endif; ?>

        <!-- オーバーレイ -->
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- コンテンツ -->
    <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
        <div class="max-w-4xl fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                <?php echo esc_html($title); ?>
            </h1>

            <?php if ($subtitle): ?>
                <p class="text-xl md:text-2xl mb-8">
                    <?php echo nl2br(esc_html($subtitle)); ?>
                </p>
            <?php endif; ?>

            <?php if ($cta_link && $cta_text): ?>
                <a
                    href="<?php echo esc_url($cta_link); ?>"
                    class="inline-block bg-katayama-orange hover:bg-orange-600 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all hover:scale-105 shadow-lg"
                >
                    <?php echo esc_html($cta_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
