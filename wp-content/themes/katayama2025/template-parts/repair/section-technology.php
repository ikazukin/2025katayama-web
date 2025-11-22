<?php
/**
 * Template Part: Technology Section
 * カタヤマの技術セクション
 */

$page_id = get_the_ID();

// ACFから取得（デフォルト値あり）
$tech_title = get_field('technology_title', $page_id) ?: 'カタヤマの技術';
$tech_subtitle = get_field('technology_subtitle', $page_id) ?: '40年の実績が証明する、確かな技術力';
$tech_description = get_field('technology_description', $page_id) ?: '長期修繕計画に基づいた適切な時期に、確かな技術で大規模修繕工事を行います。マンションの資産価値を守り、安心・快適な住環境を維持します。';
$tech_image = get_field('technology_image', $page_id);
$tech_points = get_field('technology_points', $page_id);

// デフォルトの技術ポイント
if (empty($tech_points)) {
    $tech_points = [
        [
            'title' => '徹底した診断調査',
            'description' => '建物の劣化状況を詳細に調査し、最適な修繕計画を立案します。',
        ],
        [
            'title' => '高品質な施工',
            'description' => '熟練の職人による、細部まで妥協のない丁寧な施工を実現します。',
        ],
        [
            'title' => '長期保証',
            'description' => '施工後も安心していただける、充実した保証体制を整えています。',
        ],
    ];
}
?>

<section class="technology-section animate-on-scroll py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- セクションヘッダー -->
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-katayama-blue">
                    <?php echo esc_html($tech_title); ?>
                </h2>
                <p class="text-2xl text-gray-700 font-semibold mb-6">
                    <?php echo esc_html($tech_subtitle); ?>
                </p>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    <?php echo nl2br(esc_html($tech_description)); ?>
                </p>
            </div>

            <!-- コンテンツグリッド -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- 画像 -->
                <div class="fade-in-up" style="transition-delay: 0.2s;">
                    <?php if (!empty($tech_image)): ?>
                        <img
                            src="<?php echo esc_url($tech_image['url']); ?>"
                            alt="<?php echo esc_attr($tech_title); ?>"
                            class="rounded-lg shadow-xl w-full h-auto"
                            loading="lazy"
                            width="<?php echo esc_attr($tech_image['width'] ?? 600); ?>"
                            height="<?php echo esc_attr($tech_image['height'] ?? 400); ?>"
                        >
                    <?php else: ?>
                        <div class="bg-gray-200 rounded-lg shadow-xl w-full aspect-[4/3] flex items-center justify-center">
                            <span class="text-gray-400 text-xl">画像を設定してください</span>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- 技術ポイント -->
                <div class="space-y-6 fade-in-up" style="transition-delay: 0.4s;">
                    <?php foreach ($tech_points as $index => $point): ?>
                        <div class="tech-point border-l-4 border-katayama-blue pl-6 py-2">
                            <h3 class="text-xl font-bold mb-2 text-gray-800">
                                <?php echo esc_html($point['title']); ?>
                            </h3>
                            <p class="text-gray-600 leading-relaxed">
                                <?php echo nl2br(esc_html($point['description'])); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
