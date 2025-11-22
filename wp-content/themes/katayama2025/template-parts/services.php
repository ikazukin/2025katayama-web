<?php
/**
 * Template Part: Services Section
 * 事業分岐セクション（Issue #24）
 */

$page_id = get_option('page_on_front');

// ヘルパー関数：カスタマイザー → ACF → デフォルトの順で取得
function get_services_value($customizer_key, $acf_key, $page_id, $default = '') {
    $customizer_value = get_theme_mod($customizer_key);
    if (!empty($customizer_value)) {
        return $customizer_value;
    }
    if ($page_id) {
        $acf_value = get_field($acf_key, $page_id);
        if (!empty($acf_value)) {
            return $acf_value;
        }
    }
    return $default;
}

// メディア取得用ヘルパー関数
function get_services_media($customizer_key, $acf_key, $page_id) {
    $media_id = get_theme_mod($customizer_key);
    if (!empty($media_id)) {
        $url = wp_get_attachment_url($media_id);
        if ($url) {
            $meta = wp_get_attachment_metadata($media_id);
            return [
                'url' => $url,
                'width' => $meta['width'] ?? 600,
                'height' => $meta['height'] ?? 400,
            ];
        }
    }
    if ($page_id) {
        return get_field($acf_key, $page_id);
    }
    return null;
}

// セクションタイトルと説明
$section_title = get_services_value('services_section_title', 'services_section_title', $page_id, 'カタヤマの主な事業領域');
$section_description = get_services_value('services_section_description', 'services_section_description', $page_id, '大規模修繕で培った技術と信頼をもとに、
建物のライフサイクルをトータルに支える事業を展開しています。');

// カードデータを構築（カスタマイザー優先）
$services_cards = [];

// カード1（大規模修繕）
$card1_title = get_services_value('services_card_1_title', null, null, '');
if (!empty($card1_title)) {
    // カスタマイザーにデータがある
    $services_cards[] = [
        'title' => $card1_title,
        'catchcopy' => get_services_value('services_card_1_catchcopy', null, null, ''),
        'description' => get_services_value('services_card_1_description', null, null, ''),
        'image' => get_services_media('services_card_1_image', null, null),
        'video' => get_services_media('services_card_1_video', null, null),
        'cta_text' => get_services_value('services_card_1_cta_text', null, null, '詳しく見る'),
        'cta_link' => get_services_value('services_card_1_cta_link', null, null, '#'),
        'cta_text_2' => get_services_value('services_card_1_cta_text_2', null, null, ''),
        'cta_link_2' => get_services_value('services_card_1_cta_link_2', null, null, ''),
    ];
}

// カード2（リフォーム）
$card2_title = get_services_value('services_card_2_title', null, null, '');
if (!empty($card2_title)) {
    // カスタマイザーにデータがある
    $services_cards[] = [
        'title' => $card2_title,
        'catchcopy' => get_services_value('services_card_2_catchcopy', null, null, ''),
        'description' => get_services_value('services_card_2_description', null, null, ''),
        'image' => get_services_media('services_card_2_image', null, null),
        'video' => get_services_media('services_card_2_video', null, null),
        'cta_text' => get_services_value('services_card_2_cta_text', null, null, '詳しく見る'),
        'cta_link' => get_services_value('services_card_2_cta_link', null, null, '#'),
        'cta_text_2' => get_services_value('services_card_2_cta_text_2', null, null, ''),
        'cta_link_2' => get_services_value('services_card_2_cta_link_2', null, null, ''),
    ];
}

// カスタマイザーにデータがない場合、ACFからフォールバック
if (empty($services_cards) && $page_id) {
    $acf_cards = get_field('services_cards', $page_id);
    if (!empty($acf_cards)) {
        $services_cards = array_filter($acf_cards, function($card) {
            $title = $card['title'] ?? '';
            return (stripos($title, '大規模修繕') !== false || stripos($title, 'リフォーム') !== false);
        });
        $services_cards = array_values($services_cards);
    }
}

if (empty($services_cards)) return;
?>

<section class="services-section animate-on-scroll py-16 md:py-24">
    <div class="container mx-auto px-4">
        <!-- セクションヘッダー -->
        <div class="text-center mb-12 fade-in-up" style="transition-delay: 0s;">
            <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo esc_html($section_title); ?></h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                <?php echo nl2br(esc_html($section_description)); ?>
            </p>
        </div>

        <!-- 2カードグリッド（PC: 横並び、スマホ: 縦） -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-7xl mx-auto">
            <?php foreach ($services_cards as $index => $card): ?>
                <div class="service-card-overlay relative overflow-hidden shadow-lg hover:shadow-2xl aspect-[4/3] fade-in-up" style="transition-delay: <?php echo (0.6 + $index * 0.4); ?>s;">
                    <!-- 背景動画または画像 -->
                    <?php if (!empty($card['video'])): ?>
                        <!-- 動画がある場合は動画を表示 -->
                        <video
                            autoplay
                            muted
                            loop
                            playsinline
                            class="absolute inset-0 w-full h-full object-cover"
                        >
                            <source src="<?php echo esc_url($card['video']['url']); ?>" type="video/mp4">
                        </video>
                    <?php elseif (!empty($card['image'])): ?>
                        <!-- 動画がない場合は画像を表示 -->
                        <img
                            src="<?php echo esc_url($card['image']['url']); ?>"
                            alt="<?php echo esc_attr($card['title']); ?>"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                            loading="lazy"
                            width="<?php echo esc_attr($card['image']['width'] ?? 600); ?>"
                            height="<?php echo esc_attr($card['image']['height'] ?? 400); ?>"
                        >
                    <?php endif; ?>

                    <!-- オーバーレイ（暗めの半透明） -->
                    <div class="absolute inset-0 bg-black/40"></div>

                    <!-- コンテンツ（画像の上に重ねる） -->
                    <div class="relative z-10 h-full flex flex-col justify-end p-8">
                        <!-- カード名 -->
                        <h3 class="text-2xl md:text-3xl font-bold mb-3 text-white">
                            <?php echo esc_html($card['title']); ?>
                        </h3>

                        <!-- キャッチコピー -->
                        <p class="text-sm md:text-base text-white/90 font-semibold mb-4">
                            <?php echo esc_html($card['catchcopy']); ?>
                        </p>

                        <!-- 説明文 -->
                        <p class="text-white/80 text-sm leading-relaxed mb-6">
                            <?php echo nl2br(esc_html($card['description'])); ?>
                        </p>

                        <!-- CTAボタン -->
                        <div class="flex flex-col gap-3">
                            <a
                                href="<?php echo esc_url($card['cta_link']); ?>"
                                class="inline-block bg-white hover:bg-katayama-blue text-katayama-blue hover:text-white border-2 border-white px-8 py-3 text-base font-semibold transition-all duration-300 shadow-lg hover:shadow-xl w-fit"
                            >
                                <?php echo esc_html($card['cta_text']); ?> →
                            </a>

                            <?php if (!empty($card['cta_text_2']) && !empty($card['cta_link_2'])): ?>
                            <a
                                href="<?php echo esc_url($card['cta_link_2']); ?>"
                                class="inline-block bg-katayama-blue hover:bg-white text-white hover:text-katayama-blue border-2 border-katayama-blue px-8 py-3 text-base font-semibold transition-all duration-300 shadow-lg hover:shadow-xl w-fit"
                            >
                                <?php echo esc_html($card['cta_text_2']); ?> →
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
