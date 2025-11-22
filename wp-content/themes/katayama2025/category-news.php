<?php
/**
 * Template for News Category Archive
 * Issue 06 - News（最適化：軽量リスト表示+トップ件数調整）
 */

get_header();
?>

<main class="category-news">
    <!-- ページヘッダー -->
    <header class="page-header py-12 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-5xl font-bold text-center">
                <?php single_cat_title(); ?>
            </h1>
            <?php if (category_description()): ?>
                <div class="mt-4 text-center text-gray-600 max-w-2xl mx-auto">
                    <?php echo category_description(); ?>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <!-- お知らせ一覧 -->
    <section class="news-archive py-12 md:py-16">
        <div class="container mx-auto px-4">
            <?php if (have_posts()): ?>
                <div class="max-w-4xl mx-auto space-y-4">
                    <?php while (have_posts()): the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('news-item'); ?>>
                            <a
                                href="<?php the_permalink(); ?>"
                                class="block bg-white p-6 hover:shadow-lg transition-all duration-300 fade-in-up"
                            >
                                <div class="flex flex-col md:flex-row md:items-center gap-4">
                                    <!-- 日付 -->
                                    <time
                                        datetime="<?php echo get_the_date('c'); ?>"
                                        class="text-gray-500 text-sm font-medium whitespace-nowrap"
                                    >
                                        <?php echo get_the_date('Y.m.d'); ?>
                                    </time>

                                    <!-- タイトル -->
                                    <h2 class="text-lg font-semibold hover:text-katayama-blue transition-colors flex-1">
                                        <?php the_title(); ?>
                                    </h2>

                                    <!-- 矢印アイコン -->
                                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>

                                <!-- 抜粋（任意） -->
                                <?php if (has_excerpt()): ?>
                                    <div class="mt-3 text-gray-600 text-sm md:ml-24">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- ページネーション -->
                <?php if (paginate_links()): ?>
                    <nav class="pagination mt-12" aria-label="ページナビゲーション">
                        <div class="flex justify-center gap-2">
                            <?php
                            echo paginate_links([
                                'prev_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>',
                                'next_text' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>',
                                'type' => 'list',
                                'before_page_number' => '<span class="sr-only">ページ </span>',
                            ]);
                            ?>
                        </div>
                    </nav>
                <?php endif; ?>

            <?php else: ?>
                <!-- 投稿なし -->
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg">お知らせがまだありません。</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
