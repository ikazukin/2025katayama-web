<?php
/**
 * Template Name: フロントページ
 */
get_header();
?>

<main id="front-page">
    <?php
    // 各セクションをインクルード
    get_template_part('template-parts/hero');
    get_template_part('template-parts/features');
    get_template_part('template-parts/services');
    get_template_part('template-parts/works');
    get_template_part('template-parts/news');
    get_template_part('template-parts/kojiblog');
    get_template_part('template-parts/recruit');
    ?>
</main>

<?php get_footer(); ?>
