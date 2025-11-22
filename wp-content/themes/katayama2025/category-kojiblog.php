<?php
/**
 * Template for Kojiblog Category Archive
 * Issue 07 — 工事部ブログ（カテゴリ統一 + アイキャッチ制御）
 */

get_header();
?>

<main class="category-kojiblog">
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

    <!-- 工事部ブログ一覧 -->
    <section class="kojiblog-archive py-12 md:py-16">
        <div class="container mx-auto px-4">
            <?php if (have_posts()): ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    <?php while (have_posts()): the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                            <a href="<?php the_permalink(); ?>" class="block group fade-in-up">
                                <!-- アイキャッチ画像（必須） -->
                                <?php if (has_post_thumbnail()): ?>
                                    <div class="aspect-square overflow-hidden mb-3 bg-gray-100">
                                        <?php
                                        the_post_thumbnail('medium', [
                                            'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500',
                                            'loading' => 'lazy'
                                        ]);
                                        ?>
                                    </div>
                                <?php else: ?>
                                    <div class="aspect-square bg-gray-200 mb-3 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                <?php endif; ?>

                                <!-- 日付 -->
                                <time
                                    datetime="<?php echo get_the_date('c'); ?>"
                                    class="text-sm text-gray-500 block mb-2"
                                >
                                    <?php echo get_the_date('Y.m.d'); ?>
                                </time>

                                <!-- タイトル -->
                                <h2 class="font-semibold text-base line-clamp-2 group-hover:text-katayama-blue transition-colors leading-tight">
                                    <?php the_title(); ?>
                                </h2>

                                <!-- 抜粋（任意） -->
                                <?php if (has_excerpt()): ?>
                                    <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                        <?php echo get_the_excerpt(); ?>
                                    </p>
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
                    <p class="text-gray-500 text-lg">工事部ブログがまだありません。</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
