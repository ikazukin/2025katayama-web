<?php
/**
 * Template Part: Safety Section
 * 安全対策セクション
 */

$page_id = get_the_ID();

// ACFから取得（デフォルト値あり）
$safety_title = get_field('safety_title', $page_id) ?: '創業以来、労災事故0件';
$safety_subtitle = get_field('safety_subtitle', $page_id) ?: 'カタヤマの安全への取り組み';
$safety_description = get_field('safety_description', $page_id) ?: '私たちは安全を最優先に考え、徹底した安全管理体制を構築しています。作業員の安全はもちろん、お住まいの皆様の安全も守ります。';
$safety_features = get_field('safety_features', $page_id);

// デフォルトの安全対策項目
if (empty($safety_features)) {
    $safety_features = [
        [
            'title' => '子どもの目線での安全対策',
            'description' => '子どもにも分かりやすいイラスト付き看板を設置し、危険エリアを明確に表示しています。',
            'icon' => '👶',
        ],
        [
            'title' => '徹底した安全教育',
            'description' => '全作業員に対して定期的な安全教育を実施。危険予知訓練も欠かしません。',
            'icon' => '📚',
        ],
        [
            'title' => '日々の安全確認',
            'description' => '作業開始前の安全確認、現場巡回、危険箇所の即時改善を徹底しています。',
            'icon' => '✓',
        ],
    ];
}
?>

<section class="safety-section animate-on-scroll py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
        <!-- セクションヘッダー -->
        <div class="text-center mb-16 fade-in-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-katayama-blue">
                <?php echo esc_html($safety_title); ?>
            </h2>
            <p class="text-2xl text-gray-700 font-semibold mb-4">
                <?php echo esc_html($safety_subtitle); ?>
            </p>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                <?php echo nl2br(esc_html($safety_description)); ?>
            </p>
        </div>

        <!-- 安全対策カードグリッド -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <?php foreach ($safety_features as $index => $feature): ?>
                <div class="safety-card bg-gray-50 rounded-lg p-8 text-center hover:shadow-lg transition-all duration-300 fade-in-up" style="transition-delay: <?php echo (0.2 + $index * 0.15); ?>s;">
                    <!-- アイコン -->
                    <div class="text-6xl mb-6">
                        <?php echo isset($feature['icon']) ? $feature['icon'] : '🛡️'; ?>
                    </div>

                    <!-- タイトル -->
                    <h3 class="text-xl font-bold mb-4 text-katayama-blue">
                        <?php echo esc_html($feature['title']); ?>
                    </h3>

                    <!-- 説明 -->
                    <p class="text-gray-600 leading-relaxed">
                        <?php echo nl2br(esc_html($feature['description'])); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
