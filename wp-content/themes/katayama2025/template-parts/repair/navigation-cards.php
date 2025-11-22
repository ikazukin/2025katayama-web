<?php
/**
 * Template Part: Repair Navigation Cards
 * 大規模修繕サブページへのナビゲーションカード
 */

// ナビゲーションカードデータ
$nav_cards = [
    [
        'title' => '大規模修繕の目的',
        'description' => 'なぜ大規模修繕が必要なのか、その意義と重要性をご説明します。',
        'link' => home_url('/repair/purpose/'),
        'icon' => '🎯',
    ],
    [
        'title' => '工事前の流れ',
        'description' => '工事開始前の準備、説明会、スケジュール確認などの流れをご案内します。',
        'link' => home_url('/repair/before-construction/'),
        'icon' => '📋',
    ],
    [
        'title' => '工事時の流れ',
        'description' => '実際の工事期間中の作業内容、安全対策、進捗管理についてご説明します。',
        'link' => home_url('/repair/under-construction/'),
        'icon' => '🏗️',
    ],
    [
        'title' => '業者選定方法',
        'description' => '信頼できる修繕業者の選び方、確認すべきポイントをご紹介します。',
        'link' => home_url('/repair/choose/'),
        'icon' => '✓',
    ],
];
?>

<section class="repair-navigation-section py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- セクションヘッダー -->
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-katayama-blue">大規模修繕をもっと知る</h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                カタヤマの大規模修繕工事について、さらに詳しい情報をご覧いただけます。
            </p>
        </div>

        <!-- ナビゲーションカードグリッド -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
            <?php foreach ($nav_cards as $index => $card): ?>
                <a
                    href="<?php echo esc_url($card['link']); ?>"
                    class="repair-nav-card group bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 p-8 border-2 border-transparent hover:border-katayama-blue fade-in-up"
                    style="transition-delay: <?php echo (0.2 + $index * 0.1); ?>s;"
                >
                    <!-- アイコン -->
                    <div class="text-5xl mb-4 transform group-hover:scale-110 transition-transform duration-300">
                        <?php echo $card['icon']; ?>
                    </div>

                    <!-- タイトル -->
                    <h3 class="text-xl md:text-2xl font-bold mb-3 text-katayama-blue group-hover:text-katayama-blue-dark">
                        <?php echo esc_html($card['title']); ?>
                    </h3>

                    <!-- 説明 -->
                    <p class="text-gray-600 leading-relaxed mb-4">
                        <?php echo esc_html($card['description']); ?>
                    </p>

                    <!-- 矢印アイコン -->
                    <div class="flex items-center text-katayama-blue font-semibold group-hover:translate-x-2 transition-transform duration-300">
                        <span class="mr-2">詳しく見る</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
