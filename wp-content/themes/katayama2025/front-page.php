<?php
/**
 * Template Name: フロントページ
 */
get_header();
?>

<main id="front-page">
    <?php
    // 各セクションをインクルード（Issue #24 - セクション順序変更）
    get_template_part('template-parts/hero');              // 1. ヒーロー
    get_template_part('template-parts/services');          // 2. 事業分岐
    get_template_part('template-parts/features');          // 3. 信頼セクション
    get_template_part('template-parts/works');             // 4. 施工実績
    get_template_part('template-parts/news');              // 5. お知らせ
    get_template_part('template-parts/kojiblog');          // 6. 工事部ブログ
    get_template_part('template-parts/company-intro');     // 7. カタヤマについて
    get_template_part('template-parts/recruit');           // 8. リクルートティーザー
    ?>
</main>

<?php get_footer(); ?>
