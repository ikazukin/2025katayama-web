<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Preconnect for Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header fixed top-0 left-0 right-0 z-50 bg-white shadow-sm transition-all duration-300">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <!-- ロゴ -->
            <div class="site-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <span class="text-2xl font-bold text-katayama-blue">
                            <?php bloginfo('name'); ?>
                        </span>
                    <?php endif; ?>
                </a>
            </div>

            <!-- デスクトップメニュー -->
            <nav class="hidden md:block">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex space-x-8',
                    'fallback_cb' => false,
                ]);
                ?>
            </nav>

            <!-- モバイルメニューボタン -->
            <button id="mobile-menu-toggle" class="md:hidden p-2" aria-label="メニューを開く">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- モバイルメニュー -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <nav class="container mx-auto px-4 py-4">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'space-y-4',
                'fallback_cb' => false,
            ]);
            ?>
        </nav>
    </div>
</header>

<!-- メインコンテンツのスペーサー -->
<div class="h-20"></div>

<script>
// モバイルメニュートグル
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('mobile-menu-toggle');
    const menu = document.getElementById('mobile-menu');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    }

    // スクロール時にヘッダーに背景を追加
    const header = document.querySelector('.site-header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    }
});
</script>
