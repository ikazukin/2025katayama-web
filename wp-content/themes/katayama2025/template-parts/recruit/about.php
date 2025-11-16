<?php
/**
 * Template Part: ABOUT Section (企業紹介)
 * 新卒採用ページ - 企業紹介セクション
 */

$slogan = get_field('about_slogan');
$message = get_field('about_message');
$image = get_field('about_image');

if (!$slogan && !$message) return;
?>

<section id="about" class="about-section py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- テキストエリア -->
            <div class="fade-in-up">
                <h2 class="text-sm font-semibold text-katayama-orange uppercase tracking-wide mb-4">
                    ABOUT
                </h2>

                <?php if ($slogan): ?>
                    <h3 class="text-3xl md:text-4xl font-bold mb-6 leading-tight">
                        <?php echo esc_html($slogan); ?>
                    </h3>
                <?php endif; ?>

                <?php if ($message): ?>
                    <div class="text-gray-700 leading-relaxed prose max-w-none">
                        <?php echo wp_kses_post($message); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- 画像エリア -->
            <?php if ($image): ?>
                <div class="order-first lg:order-last fade-in-up" style="animation-delay: 0.2s;">
                    <img
                        src="<?php echo esc_url($image['url']); ?>"
                        alt="<?php echo esc_attr($image['alt'] ?: '企業イメージ'); ?>"
                        class="w-full h-[400px] md:h-[500px] object-cover rounded-lg shadow-xl"
                        loading="lazy"
                        width="<?php echo esc_attr($image['width']); ?>"
                        height="<?php echo esc_attr($image['height']); ?>"
                    >
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
