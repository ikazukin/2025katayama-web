<?php
/**
 * Template for single Works (施工実績)
 * Issue 05 - Instagram型ギャラリー表示
 */

get_header();
?>

<main class="single-works">
    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- ヘッダー情報 -->
            <header class="works-header py-12 md:py-20 bg-gray-50">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto">
                        <h1 class="text-3xl md:text-5xl font-bold mb-6">
                            <?php the_title(); ?>
                        </h1>

                        <div class="works-meta flex flex-wrap gap-4 text-gray-600">
                            <?php
                            $year = get_field('works_year');
                            $address = get_field('works_address');
                            $categories = get_the_terms(get_the_ID(), 'work_category');
                            ?>

                            <?php if ($year): ?>
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <?php echo esc_html($year); ?>年
                                </span>
                            <?php endif; ?>

                            <?php if ($address): ?>
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <?php echo esc_html($address); ?>
                                </span>
                            <?php endif; ?>

                            <?php if ($categories && !is_wp_error($categories)): ?>
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </header>

            <!-- 本文 -->
            <?php if (get_the_content()): ?>
                <section class="works-content py-12 md:py-16">
                    <div class="container mx-auto px-4">
                        <div class="max-w-4xl mx-auto prose prose-lg">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <!-- ギャラリー（Instagram型） -->
            <?php
            // 親worksに紐づく子works_galleryを取得
            $gallery_items = new WP_Query([
                'post_type' => 'works_gallery',
                'posts_per_page' => -1,
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'meta_query' => [
                    [
                        'key' => 'gallery_parent_work',
                        'value' => get_the_ID(),
                        'compare' => '='
                    ]
                ]
            ]);
            ?>

            <?php if ($gallery_items->have_posts()): ?>
                <section class="works-gallery py-12 md:py-16 bg-gray-50">
                    <div class="container mx-auto px-4">
                        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-center">施工写真</h2>

                        <!-- CSS Masonry Grid -->
                        <div class="masonry-grid">
                            <?php while ($gallery_items->have_posts()): $gallery_items->the_post(); ?>
                                <?php
                                $image = get_field('gallery_image');
                                $caption = get_field('gallery_caption');
                                ?>

                                <?php if ($image): ?>
                                    <div class="masonry-item fade-in-up">
                                        <a
                                            href="<?php echo esc_url($image['url']); ?>"
                                            class="glightbox group block relative overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300"
                                            data-gallery="works-gallery"
                                            data-glightbox="description: <?php echo esc_attr($caption ?: get_the_title()); ?>"
                                        >
                                            <img
                                                src="<?php echo esc_url($image['sizes']['large'] ?: $image['url']); ?>"
                                                alt="<?php echo esc_attr($caption ?: get_the_title()); ?>"
                                                class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500"
                                                loading="lazy"
                                                width="<?php echo esc_attr($image['width']); ?>"
                                                height="<?php echo esc_attr($image['height']); ?>"
                                            >

                                            <!-- ホバー時のオーバーレイ -->
                                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

            <!-- 一覧に戻る -->
            <div class="works-back py-8">
                <div class="container mx-auto px-4 text-center">
                    <a href="<?php echo get_post_type_archive_link('works'); ?>" class="inline-flex items-center gap-2 text-katayama-blue hover:text-katayama-blue transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        施工実績一覧に戻る
                    </a>
                </div>
            </div>

        </article>

    <?php endwhile; ?>
</main>

<?php
get_footer();
