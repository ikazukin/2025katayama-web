<?php
/**
 * Template Name: 大規模修繕ページ
 * Template for Repair/Large Scale Renovation Page
 *
 * スラッグ: repair
 */

get_header();
?>

<main id="primary" class="site-main repair-page">
    <?php
    while (have_posts()) :
        the_post();
        $page_id = get_the_ID();

        // ヒーローセクション用の設定
        $hero_title = get_field('hero_title', $page_id) ?: '大規模修繕工事';
        $hero_subtitle = get_field('hero_subtitle', $page_id) ?: '建物の価値を守り、安心・快適な住環境を提供します';
        $hero_image = get_field('hero_image', $page_id);
        ?>

        <!-- パンくずリスト -->
        <div class="breadcrumb-section bg-gray-50 py-3 border-b border-gray-200">
            <div class="container mx-auto px-4">
                <nav class="text-sm text-gray-600">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-katayama-blue">ホーム</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-800 font-semibold">大規模修繕工事</span>
                </nav>
            </div>
        </div>

        <!-- サブページナビゲーション -->
        <nav class="subpage-navigation bg-gray-100 border-b border-gray-200 py-3 sticky top-20 z-40">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <span class="text-katayama-blue font-semibold text-lg">大規模修繕工事</span>
                    <div class="flex flex-wrap gap-2">
                        <a href="<?php echo esc_url(home_url('/repair/purpose/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">大規模修繕の目的</a>
                        <a href="<?php echo esc_url(home_url('/repair/before-construction/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">工事前の流れ</a>
                        <a href="<?php echo esc_url(home_url('/repair/under-construction/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">工事時の流れ</a>
                        <a href="<?php echo esc_url(home_url('/repair/choose/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">業者選定方法</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- ヒーローセクション -->
        <section class="hero-section relative h-[60vh] min-h-[500px] flex items-center justify-center overflow-hidden">
            <!-- 背景画像 -->
            <?php if (!empty($hero_image)): ?>
                <div class="absolute inset-0 z-0">
                    <img
                        src="<?php echo esc_url($hero_image['url']); ?>"
                        alt="<?php echo esc_attr($hero_title); ?>"
                        class="w-full h-full object-cover"
                        loading="eager"
                    >
                    <div class="absolute inset-0 bg-black/50"></div>
                </div>
            <?php else: ?>
                <div class="absolute inset-0 z-0 bg-gradient-to-br from-katayama-blue to-blue-900"></div>
            <?php endif; ?>

            <!-- コンテンツ -->
            <div class="relative z-10 container mx-auto px-4 text-center text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 fade-in-up">
                    <?php echo esc_html($hero_title); ?>
                </h1>
                <p class="text-xl md:text-2xl max-w-3xl mx-auto fade-in-up" style="transition-delay: 0.2s;">
                    <?php echo esc_html($hero_subtitle); ?>
                </p>
            </div>
        </section>

        <!-- 本文コンテンツ（必要に応じて） -->
        <?php if (get_the_content()): ?>
        <section class="content-section py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="prose prose-lg max-w-4xl mx-auto">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- カタヤマの技術セクション -->
        <?php get_template_part('template-parts/repair/section-technology'); ?>

        <!-- 安全対策セクション -->
        <?php get_template_part('template-parts/repair/section-safety'); ?>

        <!-- 防犯対策セクション -->
        <?php get_template_part('template-parts/repair/section-security'); ?>

        <!-- ナビゲーションカード（サブページへ） -->
        <?php get_template_part('template-parts/repair/navigation-cards'); ?>

        <!-- お問い合わせCTA -->
        <section class="cta-section py-16 md:py-24 bg-katayama-blue text-white text-center">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">大規模修繕工事のご相談はこちら</h2>
                <p class="text-lg mb-8 max-w-2xl mx-auto">
                    お見積りやご相談は無料です。お気軽にお問い合わせください。
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                    <a
                        href="<?php echo esc_url(home_url('/contact/')); ?>"
                        class="inline-block bg-white text-katayama-blue px-10 py-4 text-lg font-bold rounded-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl"
                    >
                        お問い合わせはこちら →
                    </a>
                    <a
                        href="<?php echo esc_url(home_url('/estimate/')); ?>"
                        class="inline-block bg-transparent text-white border-2 border-white px-10 py-4 text-lg font-bold rounded-lg hover:bg-white hover:text-katayama-blue transition-all duration-300 shadow-lg hover:shadow-xl"
                    >
                        概算見積もりシミュレーター →
                    </a>
                </div>
            </div>
        </section>

    <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
