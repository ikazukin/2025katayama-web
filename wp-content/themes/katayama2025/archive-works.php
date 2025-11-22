<?php
/**
 * Template for Works Archive (施工実績一覧)
 * Issue #21 - 施工実績一覧・検索機能の実装
 */

get_header();

// フィルターパラメータ取得
$selected_category = isset($_GET['work_category']) ? sanitize_text_field($_GET['work_category']) : '';
$selected_year = isset($_GET['work_year']) ? sanitize_text_field($_GET['work_year']) : '';
$search_keyword = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

// クエリ引数
$args = [
    'post_type' => 'works',
    'posts_per_page' => 12,
    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    'orderby' => 'date',
    'order' => 'DESC',
];

// カテゴリフィルター
if ($selected_category) {
    $args['tax_query'] = [
        [
            'taxonomy' => 'work_category',
            'field' => 'slug',
            'terms' => $selected_category,
        ]
    ];
}

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

<main class="archive-works">
    <!-- ページヘッダー -->
    <section class="page-header py-12 md:py-20 bg-gradient-to-r from-katayama-blue to-blue-600 text-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">施工実績</h1>
                <p class="text-lg md:text-xl opacity-90">マンション改修一筋40年の実績をご覧ください</p>
            </div>
        </div>
    </section>

    <!-- 検索フィルター -->
    <?php get_template_part('template-parts/works-filter'); ?>

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
                        if ($selected_category || $selected_year || $search_keyword) {
                            echo ' が見つかりました';
                        }
                        ?>
                    </p>
                </div>

                <!-- グリッド表示 -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php while ($works_query->have_posts()): $works_query->the_post(); ?>
                        <article class="works-card bg-white shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group">
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
                                <?php
                                $categories = get_the_terms(get_the_ID(), 'work_category');
                                if ($categories && !is_wp_error($categories)):
                                ?>
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-block bg-katayama-blue text-white px-3 py-1 rounded-full text-sm font-medium">
                                            <?php echo esc_html($categories[0]->name); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                            </a>

                            <!-- コンテンツ -->
                            <div class="p-6">
                                <h2 class="text-xl font-bold mb-3 line-clamp-2">
                                    <a href="<?php the_permalink(); ?>" class="hover:text-katayama-blue transition-colors">
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
                                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-katayama-blue hover:text-katayama-blue transition-colors font-medium">
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
                                'work_category' => $selected_category,
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
                    <a href="<?php echo get_post_type_archive_link('works'); ?>" class="inline-block bg-katayama-blue text-white px-6 py-3 rounded-lg hover:bg-katayama-blue transition-colors">
                        すべての実績を見る
                    </a>
                </div>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>

<?php
get_footer();
