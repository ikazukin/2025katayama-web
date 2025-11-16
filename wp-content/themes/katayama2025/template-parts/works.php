<?php
/**
 * Template Part: Works Section
 * 施工実績セクション
 */

$works_query = new WP_Query([
    'post_type' => 'works',
    'posts_per_page' => 6,
    'orderby' => 'date',
    'order' => 'DESC'
]);

if (!$works_query->have_posts()) return;
?>

<section class="works-section py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">施工実績</h2>
            <p class="text-gray-600">これまでの実績をご紹介します</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($works_query->have_posts()): $works_query->the_post(); ?>
                <article class="works-card bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow fade-in-up">
                    <a href="<?php the_permalink(); ?>" class="block">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="aspect-[4/3] overflow-hidden">
                                <?php the_post_thumbnail('works-thumbnail', [
                                    'class' => 'w-full h-full object-cover hover:scale-110 transition-transform duration-500'
                                ]); ?>
                            </div>
                        <?php else: ?>
                            <div class="aspect-[4/3] bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">No Image</span>
                            </div>
                        <?php endif; ?>

                        <div class="p-6">
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'work_category');
                            if ($terms && !is_wp_error($terms)):
                            ?>
                                <div class="mb-2">
                                    <?php foreach ($terms as $term): ?>
                                        <span class="inline-block bg-katayama-blue text-white text-xs px-2 py-1 rounded">
                                            <?php echo esc_html($term->name); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <h3 class="text-xl font-bold mb-2 hover:text-katayama-blue transition-colors">
                                <?php the_title(); ?>
                            </h3>

                            <?php
                            $year = get_field('completion_year');
                            $address = get_field('address');
                            if ($year || $address):
                            ?>
                                <div class="text-sm text-gray-600 space-y-1">
                                    <?php if ($year): ?>
                                        <div>完成年: <?php echo esc_html($year); ?>年</div>
                                    <?php endif; ?>
                                    <?php if ($address): ?>
                                        <div>場所: <?php echo esc_html($address); ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="text-center mt-12 fade-in-up">
            <a
                href="<?php echo get_post_type_archive_link('works'); ?>"
                class="inline-block bg-katayama-blue hover:bg-blue-800 text-white px-8 py-3 rounded-full font-semibold transition-all hover:scale-105"
            >
                すべての施工実績を見る
            </a>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>
