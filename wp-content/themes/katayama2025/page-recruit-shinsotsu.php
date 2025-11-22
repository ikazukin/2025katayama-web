<?php
/**
 * Template Name: 新卒採用
 * Template Post Type: page
 *
 * 新卒採用ページ専用テンプレート
 * Issue #13 - 新卒採用ページ - ページテンプレート作成
 */

get_header();
?>

<!-- パンくずリスト -->
<?php katayama_breadcrumbs(); ?>

<main id="recruit-shinsotsu" class="min-h-screen">
    <?php while (have_posts()): the_post(); ?>

        <!-- Hero Section -->
        <?php
        $hero_bg = get_field('hero_background');
        $bg_class = $hero_bg ? 'bg-gray-900' : 'bg-gradient-to-br from-blue-600 to-blue-800';
        ?>
        <section class="hero-section relative h-[60vh] md:h-[70vh] flex items-center justify-center <?php echo $bg_class; ?> text-white overflow-hidden">
            <?php if ($hero_bg): ?>
                <div class="absolute inset-0 z-0">
                    <img
                        src="<?php echo esc_url($hero_bg['url']); ?>"
                        alt="<?php echo esc_attr($hero_bg['alt'] ?: '新卒採用ヒーロー画像'); ?>"
                        class="w-full h-full object-cover opacity-70"
                    >
                    <!-- 暗めのオーバーレイでテキストを読みやすく -->
                    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/30 to-black/50"></div>
                </div>
            <?php endif; ?>

            <div class="container mx-auto px-4 relative z-10 text-center fade-in-up">
                <?php $hero_catchcopy = get_field('hero_catchcopy'); ?>
                <?php if ($hero_catchcopy): ?>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        <?php echo esc_html($hero_catchcopy); ?>
                    </h1>
                <?php endif; ?>

                <?php $hero_subtitle = get_field('hero_subtitle'); ?>
                <?php if ($hero_subtitle): ?>
                    <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                        <?php echo nl2br(esc_html($hero_subtitle)); ?>
                    </p>
                <?php endif; ?>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#entry-form" class="inline-block bg-katayama-blue hover:bg-orange-600 text-white px-8 py-4 rounded-full font-semibold transition-all hover:scale-105 shadow-lg">
                        エントリーする
                    </a>
                    <a href="#recruit" class="inline-block bg-white hover:bg-gray-100 text-blue-600 px-8 py-4 rounded-full font-semibold transition-all hover:scale-105 shadow-lg">
                        募集要項を見る
                    </a>
                </div>
            </div>
        </section>

        <!-- ABOUT Section -->
        <?php get_template_part('template-parts/recruit/about'); ?>

        <!-- BUSINESS Section -->
        <?php get_template_part('template-parts/recruit/business'); ?>

        <!-- WORK Section -->
        <?php get_template_part('template-parts/recruit/work'); ?>

        <!-- INTERVIEW Section -->
        <?php get_template_part('template-parts/recruit/interview'); ?>

        <!-- BENEFITS Section -->
        <?php get_template_part('template-parts/recruit/benefits'); ?>

        <!-- FAQ Section -->
        <?php get_template_part('template-parts/recruit/faq'); ?>

        <!-- RECRUIT Section (募集要項) -->
        <?php get_template_part('template-parts/recruit/job-list'); ?>

        <!-- ENTRY FORM Section -->
        <?php get_template_part('template-parts/recruit/entry-form'); ?>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
