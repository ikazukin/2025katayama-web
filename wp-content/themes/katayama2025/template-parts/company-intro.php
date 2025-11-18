<?php
/**
 * Template Part: Company Introduction Section
 * カタヤマについてセクション（Issue #24）
 */

$page_id = get_option('page_on_front');
if (!$page_id) return;

// ACFからデータ取得
$company_title = get_field('company_intro_title', $page_id) ?: '40年の歩み、これからの挑戦。';
$company_link = get_field('company_intro_link', $page_id) ?: '/company/';
$company_philosophy = get_field('company_philosophy', $page_id);
$company_stats = get_field('company_stats', $page_id);

// 社是のデフォルト値
if (empty($company_philosophy)) {
    $company_philosophy = [
        ['emoji' => '🤝', 'title' => '約束', 'description' => "お客様との約束を守り、\n確かな品質をお届けします。"],
        ['emoji' => '🙏', 'title' => '感謝', 'description' => "地域の皆様、協力会社への\n感謝の心を忘れません。"],
        ['emoji' => '✨', 'title' => '夢', 'description' => "未来に向けて挑戦し続け、\n新しい価値を創造します。"],
    ];
}

// 実績サマリーのデフォルト値
$stats_years = $company_stats['years'] ?? '40年';
$stats_projects = $company_stats['projects'] ?? '1,200棟';
$stats_iso = $company_stats['iso'] ?? 'ISO認証';
$stats_iso_detail = $company_stats['iso_detail'] ?? '9001・14001';
$stats_area = $company_stats['area'] ?? '神奈川・東京';
?>

<section class="company-intro-section animate-on-scroll py-16 md:py-24 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="container mx-auto px-4">
        <!-- セクションヘッダー -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4"><?php echo esc_html($company_title); ?></h2>
        </div>

        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <?php foreach ($company_philosophy as $philosophy): ?>
                    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
                        <div class="text-4xl mb-4"><?php echo esc_html($philosophy['emoji']); ?></div>
                        <h3 class="text-xl font-bold mb-3 text-katayama-blue"><?php echo esc_html($philosophy['title']); ?></h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            <?php echo nl2br(esc_html($philosophy['description'])); ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- 実績サマリー -->
            <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div>
                        <div class="text-3xl font-bold text-katayama-blue mb-2"><?php echo esc_html($stats_years); ?></div>
                        <div class="text-sm text-gray-600">創業から</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-katayama-blue mb-2"><?php echo esc_html($stats_projects); ?></div>
                        <div class="text-sm text-gray-600">累計施工実績</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-katayama-blue mb-2"><?php echo esc_html($stats_iso); ?></div>
                        <div class="text-sm text-gray-600"><?php echo esc_html($stats_iso_detail); ?></div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-katayama-blue mb-2"><?php echo esc_html($stats_area); ?></div>
                        <div class="text-sm text-gray-600">施工エリア</div>
                    </div>
                </div>
            </div>

            <!-- CTAボタン -->
            <div class="text-center">
                <a
                    href="<?php echo esc_url($company_link); ?>"
                    class="inline-block bg-katayama-blue hover:bg-white text-white hover:text-katayama-blue border-2 border-katayama-blue px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 shadow-lg hover:shadow-xl"
                >
                    会社紹介を見る →
                </a>
            </div>
        </div>
    </div>
</section>
