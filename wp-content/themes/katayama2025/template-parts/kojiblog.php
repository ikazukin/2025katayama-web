<?php
/**
 * Template Part: Kojiblog Section
 * 工事部ブログセクション
 */

$blog_posts = new WP_Query([
    'category_name' => 'kojiblog',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC'
]);

if (!$blog_posts->have_posts()) return;
?>

<section class="kojiblog-section animate-on-scroll py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8 fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold">工事部ブログ</h2>
            <a href="<?php echo get_category_link(get_cat_ID('kojiblog')); ?>" class="text-katayama-blue hover:underline">
                一覧を見る →
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <?php while ($blog_posts->have_posts()): $blog_posts->the_post(); ?>
                <article class="blog-card fade-in-up">
                    <a href="<?php the_permalink(); ?>" class="block group">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="aspect-square overflow-hidden rounded-lg mb-3">
                                <?php the_post_thumbnail('medium', [
                                    'class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-300'
                                ]); ?>
                            </div>
                        <?php else: ?>
                            <div class="aspect-square bg-gray-200 rounded-lg mb-3 flex items-center justify-center">
                                <span class="text-gray-400 text-sm">No Image</span>
                            </div>
                        <?php endif; ?>

                        <time class="text-sm text-gray-500 block mb-2">
                            <?php echo get_the_date('Y.m.d'); ?>
                        </time>

                        <h3 class="font-semibold line-clamp-2 group-hover:text-katayama-blue transition-colors">
                            <?php the_title(); ?>
                        </h3>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>
