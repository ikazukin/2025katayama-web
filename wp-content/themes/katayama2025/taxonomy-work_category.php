<?php
/**
 * Template for Work Category Archive (カテゴリ別施工実績)
 * Issue #21 - 施工実績一覧・検索機能の実装
 */

get_header();

$term = get_queried_object();
$selected_year = isset($_GET['work_year']) ? sanitize_text_field($_GET['work_year']) : '';
$search_keyword = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

// クエリ引数
$args = [
    'post_type' => 'works',
    'posts_per_page' => 12,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    'orderby' => 'date',
    'order' => 'DESC',
    'tax_query' => [
        [
            'taxonomy' => 'work_category',
            'field' => 'term_id',
            'terms' => $term->term_id,
        ]
    ]
];

// 年度フィルター
if ($selected_year) {
    $args['meta_query'] = [
        [
            'key' => 'works_year',
            'value' => $selected_year,
            'compare' => '='
        ]
    ];
}

// キーワード検索
if ($search_keyword) {
    $args['s'] = $search_keyword;
}

$works_query = new WP_Query($args);
?>

<main class="taxonomy-work-category">
    <!-- ページヘッダー -->
    <section class="page-header py-12 md:py-20 bg-gradient-to-r from-katayama-blue to-blue-600 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-4">
                    <a href="<?php echo get_post_type_archive_link('works'); ?>" class="inline-flex items-center gap-2 text-white/80 hover:text-white transition-colors text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        施工実績一覧
                    </a>
                </div>
                <h1 class="text-3xl md:text-5xl font-bold mb-4"><?php echo esc_html($term->name); ?></h1>
                <?php if ($term->description): ?>
                    <p class="text-lg md:text-xl opacity-90"><?php echo esc_html($term->description); ?></p>
                <?php else: ?>
                    <p class="text-lg md:text-xl opacity-90"><?php echo esc_html($term->name); ?>の施工実績をご覧ください</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 検索フィルター（カテゴリ固定） -->
    <section class="works-filter py-8 bg-gray-50 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <form method="get" action="<?php echo esc_url(get_term_link($term)); ?>" class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- 年度フィルター -->
                    <div>
                        <label for="work_year" class="block text-sm font-medium text-gray-700 mb-2">完成年度</label>
                        <select name="work_year" id="work_year" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-katayama-blue focus:border-transparent">
                            <option value="">すべての年度</option>
                            <?php
                            // 年度リストを動的に生成
                            global $wpdb;
                            $years = $wpdb->get_col($wpdb->prepare(
                                "SELECT DISTINCT meta_value
                                FROM {$wpdb->postmeta} pm
                                INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID
                                INNER JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
                                WHERE pm.meta_key = 'works_year'
                                AND pm.meta_value != ''
                                AND p.post_type = 'works'
                                AND p.post_status = 'publish'
                                AND tr.term_taxonomy_id = %d
                                ORDER BY pm.meta_value DESC",
                                $term->term_taxonomy_id
                            ));

                            foreach ($years as $year):
                            ?>
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
                        <button type="submit" class="w-full bg-katayama-blue text-white px-6 py-2 rounded-lg hover:bg-katayama-orange transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            検索
                        </button>
                    </div>
                </div>

                <!-- フィルタークリア -->
                <?php if ($selected_year || $search_keyword): ?>
                    <div class="mt-4 text-center">
                        <a href="<?php echo esc_url(get_term_link($term)); ?>" class="inline-flex items-center gap-2 text-gray-600 hover:text-katayama-blue transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            フィルターをクリア
                        </a>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </section>

    <!-- 実績一覧 -->
    <section class="works-list py-12 md:py-16">
        <div class="container mx-auto px-4">
            <?php if ($works_query->have_posts()): ?>
                <!-- 検索結果表示 -->
                <div class="mb-8 text-gray-600">
                    <p class="text-lg">
                        <?php
                        $total = $works_query->found_posts;
                        echo "全 <strong class=\"text-katayama-blue text-xl\">{$total}</strong> 件の実績";
                        if ($selected_year || $search_keyword) {
                            echo ' が見つかりました';
                        }
                        ?>
                    </p>
                </div>

                <!-- グリッド表示 -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php while ($works_query->have_posts()): $works_query->the_post(); ?>
                        <article class="works-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group">
                            <!-- サムネイル -->
                            <a href="<?php the_permalink(); ?>" class="block relative overflow-hidden aspect-[4/3]">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('large', [
                                        'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500',
                                        'loading' => 'lazy'
                                    ]); ?>
                                <?php else: ?>
                                    <!-- デフォルト画像 -->
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>

                                <!-- カテゴリバッジ -->
                                <div class="absolute top-4 left-4">
                                    <span class="inline-block bg-katayama-blue text-white px-3 py-1 rounded-full text-sm font-medium">
                                        <?php echo esc_html($term->name); ?>
                                    </span>
                                </div>
                            </a>

                            <!-- コンテンツ -->
                            <div class="p-6">
                                <h2 class="text-xl font-bold mb-3 line-clamp-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-katayama-orange transition-colors">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>

                                <div class="space-y-2 text-sm text-gray-600">
                                    <?php
                                    $year = get_field('works_year');
                                    $address = get_field('works_address');
                                    ?>

                                    <?php if ($year): ?>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span><?php echo esc_html($year); ?>年</span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($address): ?>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span class="line-clamp-1"><?php echo esc_html($address); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-4">
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-katayama-blue hover:text-katayama-orange transition-colors font-medium">
                                        詳細を見る
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- ページネーション -->
                <?php if ($works_query->max_num_pages > 1): ?>
                    <div class="pagination mt-12 flex justify-center">
                        <?php
                        echo paginate_links([
                            'total' => $works_query->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>',
                            'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
                            'type' => 'list',
                            'add_args' => [
                                'work_year' => $selected_year,
                                's' => $search_keyword,
                            ]
                        ]);
                        ?>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <!-- 実績が見つからない場合 -->
                <div class="text-center py-16">
                    <div class="mb-6">
                        <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-4 text-gray-600">実績が見つかりませんでした</h2>
                    <p class="text-gray-500 mb-8">条件を変更して再度検索してください</p>
                    <a href="<?php echo esc_url(get_term_link($term)); ?>" class="inline-block bg-katayama-blue text-white px-6 py-3 rounded-lg hover:bg-katayama-orange transition-colors">
                        <?php echo esc_html($term->name); ?>の実績をすべて見る
                    </a>
                </div>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>

<?php
get_footer();
