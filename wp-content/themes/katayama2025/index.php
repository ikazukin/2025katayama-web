<?php get_header(); ?>

<main class="site-main py-16">
    <div class="container mx-auto px-4">
        <?php if (have_posts()): ?>
            <div class="posts-grid space-y-8">
                <?php while (have_posts()): the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-lg overflow-hidden'); ?>>
                        <?php if (has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large', ['class' => 'w-full h-64 object-cover']); ?>
                            </a>
                        <?php endif; ?>

                        <div class="p-6">
                            <h2 class="text-2xl font-bold mb-2">
                                <a href="<?php the_permalink(); ?>" class="hover:text-katayama-blue transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <div class="text-gray-500 text-sm mb-4">
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date('Y.m.d'); ?>
                                </time>
                            </div>

                            <div class="text-gray-700">
                                <?php the_excerpt(); ?>
                            </div>

                            <a href="<?php the_permalink(); ?>" class="inline-block mt-4 text-katayama-blue hover:underline">
                                続きを読む →
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="mt-12">
                <?php
                the_posts_pagination([
                    'mid_size' => 2,
                    'prev_text' => '← 前へ',
                    'next_text' => '次へ →',
                ]);
                ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500 text-center">投稿がありません。</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
