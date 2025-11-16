<?php
/**
 * Template for displaying single interview posts
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();

        $dept = get_post_meta(get_the_ID(), 'dept', true);
        $position = get_post_meta(get_the_ID(), 'position', true);
        $join_year = get_post_meta(get_the_ID(), 'join_year', true);
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('interview-single'); ?>>
            <!-- Hero Section with Photo -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto">
                        <p class="text-sm uppercase tracking-wider mb-4">社員インタビュー</p>
                        <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php the_title(); ?></h1>

                        <?php if ($dept || $position || $join_year) : ?>
                            <div class="flex flex-wrap gap-4 text-lg">
                                <?php if ($dept) : ?>
                                    <span class="bg-white/20 px-4 py-2 rounded-full"><?php echo esc_html($dept); ?></span>
                                <?php endif; ?>
                                <?php if ($position) : ?>
                                    <span class="bg-white/20 px-4 py-2 rounded-full"><?php echo esc_html($position); ?></span>
                                <?php endif; ?>
                                <?php if ($join_year) : ?>
                                    <span class="bg-white/20 px-4 py-2 rounded-full">入社<?php echo esc_html($join_year); ?>年</span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="container mx-auto px-4 py-12">
                <div class="max-w-4xl mx-auto">
                    <div class="grid md:grid-cols-3 gap-8 mb-12">
                        <!-- Photo -->
                        <div class="md:col-span-1">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="sticky top-8">
                                    <?php the_post_thumbnail('large', ['class' => 'w-full rounded-lg shadow-lg']); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Interview Content -->
                        <div class="md:col-span-2">
                            <div class="prose prose-lg max-w-none">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Back to List -->
                    <div class="text-center mt-12 pt-8 border-t border-gray-200">
                        <a href="<?php echo home_url('/recruit/interview/'); ?>" class="inline-block bg-katayama-orange hover:bg-orange-600 text-white px-8 py-3 rounded-full font-semibold transition-colors">
                            ← 社員インタビュー一覧に戻る
                        </a>
                    </div>

                    <!-- Other Interviews -->
                    <?php
                    $other_interviews = new WP_Query([
                        'post_type' => 'interviews',
                        'posts_per_page' => 3,
                        'post__not_in' => [get_the_ID()],
                        'orderby' => 'rand',
                        'post_status' => 'publish',
                    ]);

                    if ($other_interviews->have_posts()) :
                    ?>
                        <div class="mt-16">
                            <h2 class="text-3xl font-bold mb-8 text-center">他の社員インタビュー</h2>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <?php while ($other_interviews->have_posts()) : $other_interviews->the_post(); ?>
                                    <a href="<?php the_permalink(); ?>" class="group block bg-white rounded-lg shadow hover:shadow-xl transition-shadow duration-300">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="aspect-w-3 aspect-h-4 overflow-hidden rounded-t-lg">
                                                <?php the_post_thumbnail('medium', ['class' => 'w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="p-4">
                                            <h3 class="font-bold text-lg mb-1"><?php the_title(); ?></h3>
                                            <?php
                                            $other_dept = get_post_meta(get_the_ID(), 'dept', true);
                                            if ($other_dept) :
                                            ?>
                                                <p class="text-sm text-gray-600"><?php echo esc_html($other_dept); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </article>
    <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
