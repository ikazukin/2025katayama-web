<?php
/**
 * Template Part: Company Introduction Section
 * カタヤマについてセクション（Issue #24）
 */

$page_id = get_option('page_on_front');
if (!$page_id) return;

// ACFからデータ取得
$company_title = get_field('company_intro_title', $page_id) ?: 'カタヤマの信頼の証';
$company_link = get_field('company_intro_link', $page_id) ?: '/company/';
$company_stats = get_field('company_stats', $page_id);

// 実績サマリーのデフォルト値
$stats_years = $company_stats['years'] ?? '40年';
$stats_projects = $company_stats['projects'] ?? '1,200棟';
$stats_iso = $company_stats['iso'] ?? 'ISO認証';
$stats_iso_detail = $company_stats['iso_detail'] ?? '9001・14001';
$stats_area = $company_stats['area'] ?? '神奈川・東京';
?>

<section class="company-intro-section-rebita animate-on-scroll py-16 md:py-24">
    <div class="container mx-auto px-4">
        <!-- セクションヘッダー（Rebita風） -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 tracking-wide" style="color: #111;"><?php echo esc_html($company_title); ?></h2>
        </div>

        <div class="max-w-6xl mx-auto">
            <!-- 実績サマリー（Rebita風） -->
            <div class="company-stats-rebita" data-aos="fade-up" data-aos-delay="300">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="stat-item">
                        <div class="stat-number"><?php echo esc_html($stats_years); ?></div>
                        <div class="stat-label">創業から</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number"><?php echo esc_html($stats_projects); ?></div>
                        <div class="stat-label">累計施工実績</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number"><?php echo esc_html($stats_iso); ?></div>
                        <div class="stat-label"><?php echo esc_html($stats_iso_detail); ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number"><?php echo esc_html($stats_area); ?></div>
                        <div class="stat-label">施工エリア</div>
                    </div>
                </div>
            </div>

            <!-- CTAボタン（Rebita風） -->
            <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?php echo esc_url($company_link); ?>" class="company-cta-button">
                        会社紹介を見る →
                    </a>
                    <a href="/history/" class="company-cta-button company-cta-button--secondary">
                        カタヤマの歩みを見る →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
