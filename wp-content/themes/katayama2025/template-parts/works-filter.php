<?php
/**
 * Template Part: Works Filter (施工実績検索フィルター)
 * Issue #21 - 施工実績一覧・検索機能の実装
 */

// フィルターパラメータ取得
$selected_category = isset($_GET['work_category']) ? sanitize_text_field($_GET['work_category']) : '';
$selected_year = isset($_GET['work_year']) ? sanitize_text_field($_GET['work_year']) : '';
$search_keyword = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

// カテゴリ一覧を取得
$categories = get_terms([
    'taxonomy' => 'work_category',
    'hide_empty' => true,
    'orderby' => 'count',
    'order' => 'DESC',
]);

// 年度一覧を取得
global $wpdb;
$years = $wpdb->get_col(
    "SELECT DISTINCT meta_value
    FROM {$wpdb->postmeta}
    WHERE meta_key = 'works_year'
    AND meta_value != ''
    ORDER BY meta_value DESC"
);
?>

<section class="works-filter py-8 bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <form method="get" action="<?php echo esc_url(get_post_type_archive_link('works')); ?>" class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- カテゴリフィルター -->
                <div>
                    <label for="work_category" class="block text-sm font-medium text-gray-700 mb-2">工事種別</label>
                    <select name="work_category" id="work_category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-katayama-blue focus:border-transparent">
                        <option value="">すべての種別</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo esc_attr($category->slug); ?>" <?php selected($selected_category, $category->slug); ?>>
                                <?php echo esc_html($category->name); ?> (<?php echo $category->count; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- 年度フィルター -->
                <div>
                    <label for="work_year" class="block text-sm font-medium text-gray-700 mb-2">完成年度</label>
                    <select name="work_year" id="work_year" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-katayama-blue focus:border-transparent">
                        <option value="">すべての年度</option>
                        <?php foreach ($years as $year): ?>
                            <option value="<?php echo esc_attr($year); ?>" <?php selected($selected_year, $year); ?>>
                                <?php echo esc_html($year); ?>年
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- キーワード検索 -->
                <div>
                    <label for="s" class="block text-sm font-medium text-gray-700 mb-2">キーワード検索</label>
                    <input
                        type="text"
                        name="s"
                        id="s"
                        value="<?php echo esc_attr($search_keyword); ?>"
                        placeholder="物件名や住所で検索"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-katayama-blue focus:border-transparent"
                    >
                </div>

                <!-- 検索ボタン -->
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-katayama-blue text-white px-6 py-2 rounded-lg hover:bg-katayama-blue transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        検索
                    </button>
                </div>
            </div>

            <!-- フィルタークリア -->
            <?php if ($selected_category || $selected_year || $search_keyword): ?>
                <div class="mt-4 text-center">
                    <a href="<?php echo esc_url(get_post_type_archive_link('works')); ?>" class="inline-flex items-center gap-2 text-gray-600 hover:text-katayama-blue transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        フィルターをクリア
                    </a>
                </div>
            <?php endif; ?>
        </form>

        <!-- カテゴリクイックリンク -->
        <div class="mt-6 flex flex-wrap gap-3 justify-center">
            <a
                href="<?php echo esc_url(get_post_type_archive_link('works')); ?>"
                class="px-4 py-2 rounded-full text-sm font-medium transition-colors <?php echo empty($selected_category) ? 'bg-katayama-blue text-white' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300'; ?>"
            >
                すべて
            </a>
            <?php foreach ($categories as $category): ?>
                <a
                    href="<?php echo esc_url(get_term_link($category)); ?>"
                    class="px-4 py-2 rounded-full text-sm font-medium transition-colors <?php echo $selected_category === $category->slug ? 'bg-katayama-blue text-white' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-300'; ?>"
                >
                    <?php echo esc_html($category->name); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
