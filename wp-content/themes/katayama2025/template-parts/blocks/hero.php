<?php
/**
 * Hero Section Block - Render Template
 * Issue 18 - ブロックエディタ版
 */

$title = $attributes['title'] ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$pc_video_url = $attributes['pcVideoUrl'] ?? '';
$sp_video_url = $attributes['spVideoUrl'] ?? '';
$poster_url = $attributes['posterUrl'] ?? '';
$cta_text = $attributes['ctaText'] ?? '';
$cta_link = $attributes['ctaLink'] ?? '';
?>

<section class="hero-section relative h-screen overflow-hidden">
    <!-- 動画背景 -->
    <div class="absolute inset-0 z-0">
        <?php if ($pc_video_url): ?>
            <video
                class="w-full h-full object-cover hidden md:block"
                playsinline
                muted
                autoplay
                loop
                preload="none"
                <?php if ($poster_url): ?>
                    poster="<?php echo esc_url($poster_url); ?>"
                <?php endif; ?>
                aria-label="<?php echo esc_attr($title); ?> 背景動画"
            >
                <source src="<?php echo esc_url($pc_video_url); ?>" type="video/mp4">
                <?php if ($poster_url): ?>
                    <img
                        src="<?php echo esc_url($poster_url); ?>"
                        alt="<?php echo esc_attr($title); ?>"
                        class="w-full h-full object-cover"
                        fetchpriority="high"
                    >
                <?php endif; ?>
            </video>
        <?php endif; ?>

        <?php if ($sp_video_url): ?>
            <video
                class="w-full h-full object-cover md:hidden"
                playsinline
                muted
                autoplay
                loop
                preload="none"
                <?php if ($poster_url): ?>
                    poster="<?php echo esc_url($poster_url); ?>"
                <?php endif; ?>
                aria-label="<?php echo esc_attr($title); ?> 背景動画（モバイル）"
            >
                <source src="<?php echo esc_url($sp_video_url); ?>" type="video/mp4">
                <?php if ($poster_url): ?>
                    <img
                        src="<?php echo esc_url($poster_url); ?>"
                        alt="<?php echo esc_attr($title); ?>"
                        class="w-full h-full object-cover"
                        fetchpriority="high"
                    >
                <?php endif; ?>
            </video>
        <?php elseif ($poster_url): ?>
            <!-- SPで動画がない場合はposter画像を表示 -->
            <img
                src="<?php echo esc_url($poster_url); ?>"
                alt="<?php echo esc_attr($title); ?>"
                class="w-full h-full object-cover md:hidden"
                fetchpriority="high"
            >
        <?php endif; ?>

        <!-- オーバーレイ -->
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <!-- コンテンツ -->
    <div class="relative z-10 h-full flex items-center justify-center text-center text-white px-4">
        <div class="max-w-4xl fade-in-up">
            <?php if ($title): ?>
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                    <?php echo esc_html($title); ?>
                </h1>
            <?php endif; ?>

            <?php if ($subtitle): ?>
                <p class="text-xl md:text-2xl mb-8">
                    <?php echo nl2br(esc_html($subtitle)); ?>
                </p>
            <?php endif; ?>

            <?php if ($cta_link && $cta_text): ?>
                <a
                    href="<?php echo esc_url($cta_link); ?>"
                    class="inline-block bg-katayama-blue hover:bg-orange-600 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all hover:scale-105 shadow-lg"
                >
                    <?php echo esc_html($cta_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
