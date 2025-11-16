<?php
/**
 * Template Part: News Section
 * お知らせセクション
 */

$news_posts = new WP_Query([
    'category_name' => 'news',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC'
]);

if (!$news_posts->have_posts()) return;
?>

<section class="news-section py-16 md:py-24">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8 fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold">お知らせ</h2>
            <a href="<?php echo get_category_link(get_cat_ID('news')); ?>" class="text-katayama-blue hover:underline">
                一覧を見る →
            </a>
        </div>

        <div class="space-y-4">
            <?php while ($news_posts->have_posts()): $news_posts->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="block bg-white p-6 rounded-lg hover:shadow-lg transition-shadow fade-in-up">
                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                        <time class="text-gray-500 text-sm whitespace-nowrap">
                            <?php echo get_the_date('Y.m.d'); ?>
                        </time>
                        <h3 class="font-semibold hover:text-katayama-blue transition-colors flex-1">
                            <?php the_title(); ?>
                        </h3>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>
