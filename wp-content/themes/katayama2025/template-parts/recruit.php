<?php
/**
 * Template Part: Recruit Section
 * 採用情報セクション
 */

$page_id = get_option('page_on_front');
if (!$page_id) return;

// カスタマイザーまたはACFからデータ取得
function get_recruit_data($customizer_key, $acf_key, $page_id, $default = '') {
    $customizer_value = get_theme_mod($customizer_key);
    return !empty($customizer_value) ? $customizer_value : (get_field($acf_key, $page_id) ?: $default);
}

function get_recruit_image($customizer_key, $acf_key, $page_id) {
    $image_id = get_theme_mod($customizer_key);
    if (!empty($image_id)) {
        $url = wp_get_attachment_url($image_id);
        $meta = wp_get_attachment_metadata($image_id);
        return $url ? [
            'url' => $url,
            'width' => $meta['width'] ?? 400,
            'height' => $meta['height'] ?? 600,
            'alt' => get_post_meta($image_id, '_wp_attachment_image_alt', true),
        ] : null;
    }

    return get_field($acf_key, $page_id);
}

$title = get_recruit_data('recruit_title', 'recruit_title', $page_id);
$text = get_recruit_data('recruit_text', 'recruit_text', $page_id);
$image1 = get_recruit_image('recruit_image_1', 'recruit_image_1', $page_id);
$image2 = get_recruit_image('recruit_image_2', 'recruit_image_2', $page_id);
$btn1_text = get_recruit_data('recruit_btn1_text', 'recruit_btn1_text', $page_id, '新卒採用情報');
$btn1_link = get_recruit_data('recruit_btn1_link', 'recruit_btn1_link', $page_id, '/recruit/shinsotsu/');
$btn2_text = get_recruit_data('recruit_btn2_text', 'recruit_btn2_text', $page_id, '中途採用情報');
$btn2_link = get_recruit_data('recruit_btn2_link', 'recruit_btn2_link', $page_id, '/recruit/boshu/');

if (!$title && !$text) return;
?>

<section class="recruit-section animate-on-scroll py-16 md:py-24">
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

                <!-- 2ボタン対応（新卒/中途） - Issue #24: CTAボタン統一 -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a
                        href="<?php echo esc_url($btn1_link); ?>"
                        class="inline-block bg-katayama-blue hover:bg-white text-white hover:text-katayama-blue border-2 border-katayama-blue px-8 py-4 rounded-full font-semibold transition-all duration-300 shadow-lg hover:shadow-xl text-center"
                    >
                        <?php echo esc_html($btn1_text); ?>
                    </a>
                    <a
                        href="<?php echo esc_url($btn2_link); ?>"
                        class="inline-block bg-white hover:bg-katayama-blue text-katayama-blue hover:text-white border-2 border-katayama-blue px-8 py-4 rounded-full font-semibold transition-all duration-300 shadow-lg hover:shadow-xl text-center"
                    >
                        <?php echo esc_html($btn2_text); ?>
                    </a>
                </div>
            </div>

            <!-- 画像エリア -->
            <div class="order-1 lg:order-2">
                <div class="grid grid-cols-2 gap-4">
                    <?php if ($image1): ?>
                        <div class="fade-in-up" style="animation-delay: 0.1s;">
                            <img
                                src="<?php echo esc_url($image1['url']); ?>"
                                alt="<?php echo esc_attr($image1['alt'] ?: '採用情報画像1'); ?>"
                                class="w-full h-64 md:h-80 object-cover shadow-xl"
                                loading="lazy"
                                width="<?php echo esc_attr($image1['width']); ?>"
                                height="<?php echo esc_attr($image1['height']); ?>"
                            >
                        </div>
                    <?php endif; ?>

                    <?php if ($image2): ?>
                        <div class="mt-8 fade-in-up" style="animation-delay: 0.2s;">
                            <img
                                src="<?php echo esc_url($image2['url']); ?>"
                                alt="<?php echo esc_attr($image2['alt'] ?: '採用情報画像2'); ?>"
                                class="w-full h-64 md:h-80 object-cover shadow-xl"
                                loading="lazy"
                                width="<?php echo esc_attr($image2['width']); ?>"
                                height="<?php echo esc_attr($image2['height']); ?>"
                            >
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
