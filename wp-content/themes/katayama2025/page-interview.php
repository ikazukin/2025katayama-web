<?php
/**
 * Template Name: 社員インタビューページ
 * Template for displaying interview posts
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
            <div class="container mx-auto px-4 py-12">
                <!-- Page Title and Description -->
                <div class="entry-content prose prose-lg max-w-none mb-12">
                    <?php the_content(); ?>
                </div>

                <!-- Interview Posts Grid -->
                <?php
                $interviews_query = new WP_Query([
                    'post_type' => 'interviews',
                    'posts_per_page' => -1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post_status' => 'publish',
                ]);

                if ($interviews_query->have_posts()) :
                ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                        <?php while ($interviews_query->have_posts()) : $interviews_query->the_post(); ?>
                            <div class="bg-white shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="aspect-w-3 aspect-h-4">
                                        <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-80 object-cover']); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="p-6">
                                    <h3 class="text-xl font-bold mb-2"><?php the_title(); ?></h3>

                                    <?php
                                    $dept = get_post_meta(get_the_ID(), 'dept', true);
                                    $position = get_post_meta(get_the_ID(), 'position', true);
                                    $join_year = get_post_meta(get_the_ID(), 'join_year', true);
                                    ?>

                                    <?php if ($dept || $position) : ?>
                                        <p class="text-gray-600 mb-2">
                                            <?php echo esc_html($dept); ?>
                                            <?php if ($dept && $position) echo ' / '; ?>
                                            <?php echo esc_html($position); ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if ($join_year) : ?>
                                        <p class="text-sm text-gray-500 mb-4">入社: <?php echo esc_html($join_year); ?>年</p>
                                    <?php endif; ?>

                                    <div class="text-gray-700 line-clamp-3">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="inline-block mt-4 text-katayama-blue hover:text-orange-600 font-semibold">
                                        詳しく見る →
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php
                    wp_reset_postdata();
                else :
                ?>
                    <p class="text-center text-gray-500 py-12">現在、社員インタビューは準備中です。</p>
                <?php endif; ?>
            </div>
        </article>
    <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
