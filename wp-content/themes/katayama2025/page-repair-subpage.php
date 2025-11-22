<?php
/**
 * Template Name: 大規模修繕サブページ
 * Template for Large Scale Renovation Subpages
 *
 * 大規模修繕ページの子ページ用テンプレート
 */

get_header();
?>

<main id="primary" class="site-main repair-subpage">
    <?php
    while (have_posts()) :
        the_post();
        $page_id = get_the_ID();

        // ページタイトルと説明
        $page_title = get_the_title();
        $page_description = get_field('page_description', $page_id);
        ?>

        <!-- パンくずリスト -->
        <div class="breadcrumb-section bg-gray-50 py-3 border-b border-gray-200">
            <div class="container mx-auto px-4">
                <nav class="text-sm text-gray-600">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-katayama-blue">ホーム</a>
                    <span class="mx-2">/</span>
                    <?php
                    $parent = get_post_parent();
                    if ($parent):
                    ?>
                        <a href="<?php echo esc_url(get_permalink($parent)); ?>" class="hover:text-katayama-blue">
                            <?php echo esc_html($parent->post_title); ?>
                        </a>
                        <span class="mx-2">/</span>
                    <?php endif; ?>
                    <span class="text-gray-800 font-semibold"><?php echo esc_html($page_title); ?></span>
                </nav>
            </div>
        </div>

        <!-- サブページナビゲーション -->
        <?php get_template_part('template-parts/repair/subpage-navigation'); ?>

        <!-- ページヘッダー -->
        <section class="page-header bg-gradient-to-br from-katayama-blue to-blue-900 text-white py-16 md:py-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 fade-in-up">
                    <?php echo esc_html($page_title); ?>
                </h1>
                <?php if ($page_description): ?>
                    <p class="text-xl max-w-3xl mx-auto fade-in-up" style="transition-delay: 0.2s;">
                        <?php echo esc_html($page_description); ?>
                    </p>
                <?php endif; ?>
            </div>
        </section>

        <!-- メインコンテンツ -->
        <section class="content-section py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <?php
                    // ACF フレキシブルコンテンツがある場合
                    if (have_rows('content_sections', $page_id)):
                        while (have_rows('content_sections', $page_id)): the_row();
                            $layout = get_row_layout();

                            if ($layout === 'text_section'):
                                // テキストセクション
                                $section_title = get_sub_field('section_title');
                                $section_content = get_sub_field('section_content');
                                ?>
                                <div class="content-block mb-12 fade-in-up">
                                    <?php if ($section_title): ?>
                                        <h2 class="text-3xl font-bold mb-6 text-katayama-blue">
                                            <?php echo esc_html($section_title); ?>
                                        </h2>
                                    <?php endif; ?>
                                    <div class="prose prose-lg max-w-none">
                                        <?php echo wp_kses_post($section_content); ?>
                                    </div>
                                </div>
                                <?php

                            elseif ($layout === 'image_text_section'):
                                // 画像+テキストセクション
                                $section_title = get_sub_field('section_title');
                                $section_image = get_sub_field('section_image');
                                $section_content = get_sub_field('section_content');
                                $image_position = get_sub_field('image_position') ?: 'left';
                                ?>
                                <div class="content-block mb-12 fade-in-up">
                                    <?php if ($section_title): ?>
                                        <h2 class="text-3xl font-bold mb-8 text-katayama-blue">
                                            <?php echo esc_html($section_title); ?>
                                        </h2>
                                    <?php endif; ?>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center <?php echo $image_position === 'right' ? 'md:grid-flow-dense' : ''; ?>">
                                        <div class="<?php echo $image_position === 'right' ? 'md:col-start-2' : ''; ?>">
                                            <?php if ($section_image): ?>
                                                <img
                                                    src="<?php echo esc_url($section_image['url']); ?>"
                                                    alt="<?php echo esc_attr($section_title); ?>"
                                                    class="rounded-lg shadow-lg w-full h-auto"
                                                    loading="lazy"
                                                >
                                            <?php endif; ?>
                                        </div>
                                        <div class="<?php echo $image_position === 'right' ? 'md:col-start-1 md:row-start-1' : ''; ?>">
                                            <div class="prose prose-lg">
                                                <?php echo wp_kses_post($section_content); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php

                            elseif ($layout === 'list_section'):
                                // リストセクション
                                $section_title = get_sub_field('section_title');
                                $list_items = get_sub_field('list_items');
                                ?>
                                <div class="content-block mb-12 fade-in-up">
                                    <?php if ($section_title): ?>
                                        <h2 class="text-3xl font-bold mb-8 text-katayama-blue">
                                            <?php echo esc_html($section_title); ?>
                                        </h2>
                                    <?php endif; ?>
                                    <?php if ($list_items): ?>
                                        <div class="space-y-6">
                                            <?php foreach ($list_items as $index => $item): ?>
                                                <div class="flex items-start border-l-4 border-katayama-blue pl-6 py-2">
                                                    <div class="flex-shrink-0 w-8 h-8 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold mr-4">
                                                        <?php echo ($index + 1); ?>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-xl font-bold mb-2">
                                                            <?php echo esc_html($item['item_title']); ?>
                                                        </h3>
                                                        <p class="text-gray-600">
                                                            <?php echo esc_html($item['item_description']); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php
                            endif;

                        endwhile;
                    else:
                        // ACFフィールドがない場合は通常のコンテンツを表示
                        ?>
                        <div class="prose prose-lg max-w-none">
                            <?php the_content(); ?>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <!-- お問い合わせCTA -->
        <section class="cta-section py-16 bg-gray-50 text-center">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-katayama-blue">ご相談・お見積りはこちら</h2>
                <p class="text-lg mb-8 text-gray-600 max-w-2xl mx-auto">
                    大規模修繕工事に関するご質問やお見積りは、お気軽にお問い合わせください。
                </p>
                <a
                    href="<?php echo esc_url(home_url('/contact/')); ?>"
                    class="inline-block bg-katayama-blue text-white px-10 py-4 text-lg font-bold rounded-lg hover:bg-katayama-blue-dark transition-all duration-300 shadow-lg hover:shadow-xl"
                >
                    お問い合わせはこちら →
                </a>
            </div>
        </section>

    <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
