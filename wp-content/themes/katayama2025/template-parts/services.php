<?php
/**
 * Template Part: Services Section
 * 事業分岐セクション（Issue #24）
 */

$page_id = get_option('page_on_front');
if (!$page_id) return;

// ACFからデータ取得
$section_title = get_field('services_section_title', $page_id) ?: 'Our Services';
$section_description = get_field('services_section_description', $page_id) ?: 'With expertise and trust built through large-scale renovation projects, we provide comprehensive solutions for building lifecycle management.';
$services_cards = get_field('services_cards', $page_id);

// 大規模修繕工事とリフォームのみをフィルタリング
if (!empty($services_cards)) {
    $services_cards = array_filter($services_cards, function($card) {
        $title = $card['title'] ?? '';
        return (stripos($title, '大規模修繕') !== false || stripos($title, 'リフォーム') !== false);
    });
    // 配列のキーを再インデックス
    $services_cards = array_values($services_cards);
}

if (empty($services_cards)) return;
?>

<section class="services-section animate-on-scroll py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
        <!-- セクションヘッダー -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo esc_html($section_title); ?></h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                <?php echo nl2br(esc_html($section_description)); ?>
            </p>
        </div>

        <!-- 2カードグリッド（PC: 横並び、スマホ: 縦） -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
            <?php foreach ($services_cards as $index => $card): ?>
                <div class="service-card card-hover bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl">
                    <!-- 画像 -->
                    <?php if ($card['image']): ?>
                        <div class="relative overflow-hidden aspect-[3/2]">
                            <img
                                src="<?php echo esc_url($card['image']['url']); ?>"
                                alt="<?php echo esc_attr($card['title']); ?>"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                loading="lazy"
                                width="<?php echo esc_attr($card['image']['width'] ?? 600); ?>"
                                height="<?php echo esc_attr($card['image']['height'] ?? 400); ?>"
                            >
                        </div>
                    <?php endif; ?>

                    <!-- コンテンツ -->
                    <div class="p-6">
                        <!-- カード名 -->
                        <h3 class="text-xl font-bold mb-2 text-gray-900">
                            <?php echo esc_html($card['title']); ?>
                        </h3>

                        <!-- キャッチコピー -->
                        <p class="text-sm text-katayama-blue font-semibold mb-3">
                            <?php echo esc_html($card['catchcopy']); ?>
                        </p>

                        <!-- 説明文 -->
                        <p class="text-gray-600 text-sm leading-relaxed mb-6">
                            <?php echo nl2br(esc_html($card['description'])); ?>
                        </p>

                        <!-- CTAボタン -->
                        <a
                            href="<?php echo esc_url($card['cta_link']); ?>"
                            class="inline-block bg-katayama-blue hover:bg-white text-white hover:text-katayama-blue border-2 border-katayama-blue px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 shadow-md hover:shadow-lg"
                        >
                            <?php echo esc_html($card['cta_text']); ?> →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
