<?php
/**
 * Template Name: フロントページ
 */
get_header();

// オープニング動画オーバーレイ
get_template_part('template-parts/opening-video');

// 背景画像取得（カスタマイザー → ACF）
$page_id = get_option('page_on_front');
$background_image = null;

// カスタマイザーから取得
$bg_image_id = get_theme_mod('front_page_background_image');
if (!empty($bg_image_id)) {
    $bg_url = wp_get_attachment_url($bg_image_id);
    if ($bg_url) {
        $background_image = ['url' => $bg_url];
    }
}

// カスタマイザーにない場合はACFから取得
if (!$background_image && $page_id) {
    $background_image = get_field('front_page_background', $page_id);
}
?>

<?php if ($background_image): ?>
<!-- 固定背景画像 -->
<div class="front-page-background" style="background-image: url('<?php echo esc_url($background_image['url']); ?>');"></div>
<?php endif; ?>

<main id="front-page" class="relative">
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
