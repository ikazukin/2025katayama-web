<?php
/**
 * Template Part: Recruit Section
 * 採用情報セクション
 */

$page_id = get_option('page_on_front');
if (!$page_id) return;

$title = get_field('recruit_title', $page_id);
$text = get_field('recruit_text', $page_id);
$image1 = get_field('recruit_image_1', $page_id);
$image2 = get_field('recruit_image_2', $page_id);
$cta_text = get_field('recruit_cta_text', $page_id);
$cta_link = get_field('recruit_cta_link', $page_id);

if (!$title && !$text) return;
?>

<section class="recruit-section py-16 md:py-24 bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- テキストエリア -->
            <div class="order-2 lg:order-1 fade-in-up">
                <?php if ($title): ?>
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($text): ?>
                    <div class="text-gray-700 leading-relaxed mb-8 prose max-w-none">
                        <?php echo wp_kses_post($text); ?>
                    </div>
                <?php endif; ?>

                <?php if ($cta_link && $cta_text): ?>
                    <a
                        href="<?php echo esc_url($cta_link); ?>"
                        class="inline-block bg-katayama-orange hover:bg-orange-600 text-white px-8 py-4 rounded-full font-semibold transition-all hover:scale-105 shadow-lg"
                    >
                        <?php echo esc_html($cta_text); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- 画像エリア -->
            <div class="order-1 lg:order-2">
                <div class="grid grid-cols-2 gap-4">
                    <?php if ($image1): ?>
                        <div class="fade-in-up" style="animation-delay: 0.1s;">
                            <img
                                src="<?php echo esc_url($image1['url']); ?>"
                                alt="<?php echo esc_attr($image1['alt'] ?: '採用情報画像1'); ?>"
                                class="w-full h-64 md:h-80 object-cover rounded-lg shadow-xl"
                                loading="lazy"
                            >
                        </div>
                    <?php endif; ?>

                    <?php if ($image2): ?>
                        <div class="mt-8 fade-in-up" style="animation-delay: 0.2s;">
                            <img
                                src="<?php echo esc_url($image2['url']); ?>"
                                alt="<?php echo esc_attr($image2['alt'] ?: '採用情報画像2'); ?>"
                                class="w-full h-64 md:h-80 object-cover rounded-lg shadow-xl"
                                loading="lazy"
                            >
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
