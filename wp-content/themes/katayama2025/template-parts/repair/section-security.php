<?php
/**
 * Template Part: Security Section
 * 防犯対策セクション
 */

$page_id = get_the_ID();

// ACFから取得（デフォルト値あり）
$security_title = get_field('security_title', $page_id) ?: '工事中も安心の防犯対策';
$security_description = get_field('security_description', $page_id) ?: '大規模修繕工事では足場を設置するため、防犯面での不安がございます。カタヤマでは、お住まいの皆様に安心していただけるよう、万全の防犯対策を実施しています。';
$security_measures = get_field('security_measures', $page_id);

// デフォルトの防犯対策項目
if (empty($security_measures)) {
    $security_measures = [
        [
            'title' => '補助ロックの無償貸出',
            'description' => '工事期間中、全戸に窓用の補助ロックを無償で貸し出します。',
            'icon' => '🔒',
        ],
        [
            'title' => '足場シート養生',
            'description' => '足場全体を防炎シートで覆い、外部からの侵入を防ぎます。',
            'icon' => '🛡️',
        ],
        [
            'title' => '定期巡回',
            'description' => '夜間・休日も含め、定期的に現場を巡回し、不審者の侵入を防ぎます。',
            'icon' => '👮',
        ],
        [
            'title' => '防犯カメラ設置',
            'description' => '現場に防犯カメラを設置し、24時間体制で監視します。',
            'icon' => '📹',
        ],
    ];
}
?>

<section class="security-section animate-on-scroll py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- セクションヘッダー -->
        <div class="text-center mb-16 fade-in-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-katayama-blue">
                <?php echo esc_html($security_title); ?>
            </h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                <?php echo nl2br(esc_html($security_description)); ?>
            </p>
        </div>

        <!-- 防犯対策カードグリッド -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
            <?php foreach ($security_measures as $index => $measure): ?>
                <div class="security-card bg-white rounded-lg p-6 text-center hover:shadow-xl transition-all duration-300 border-2 border-gray-100 hover:border-katayama-blue fade-in-up" style="transition-delay: <?php echo (0.2 + $index * 0.1); ?>s;">
                    <!-- アイコン -->
                    <div class="text-5xl mb-4">
                        <?php echo isset($measure['icon']) ? $measure['icon'] : '🔐'; ?>
                    </div>

                    <!-- タイトル -->
                    <h3 class="text-lg font-bold mb-3 text-katayama-blue">
                        <?php echo esc_html($measure['title']); ?>
                    </h3>

                    <!-- 説明 -->
                    <p class="text-gray-600 text-sm leading-relaxed">
                        <?php echo nl2br(esc_html($measure['description'])); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
