<?php
/**
 * Katayama 2025 Theme Functions
 *
 * @package Katayama2025
 */

// テーマのセットアップ
function katayama_theme_setup() {
    // タイトルタグのサポート
    add_theme_support('title-tag');

    // アイキャッチ画像のサポート
    add_theme_support('post-thumbnails');

    // HTML5サポート
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);

    // カスタム画像サイズ
    add_image_size('service-banner', 800, 600, true);
    add_image_size('service-banner-sp', 750, 1000, true);
    add_image_size('works-thumbnail', 600, 400, true);

    // WebP対応
    add_filter('upload_mimes', function($mimes) {
        $mimes['webp'] = 'image/webp';
        return $mimes;
    });

    // メニュー位置の登録
    register_nav_menus([
        'primary' => 'プライマリメニュー',
        'footer-company' => '会社関連メニュー',
        'footer-services' => '事業関連メニュー',
        'footer-contact' => '採用・問い合わせメニュー',
    ]);
}
add_action('after_setup_theme', 'katayama_theme_setup');

// Viteアセットの読み込み
function katayama_enqueue_vite_assets() {
    $is_dev = defined('WP_DEBUG') && WP_DEBUG;

    if ($is_dev) {
        // 開発モード
        wp_enqueue_script('vite-client', 'http://localhost:5173/@vite/client', [], null, false);
        wp_enqueue_script('katayama-main', 'http://localhost:5173/src/main.js', [], null, true);
    } else {
        // 本番モード - manifest.json を読み込み
        $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';

        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);

            // JavaScript
            if (isset($manifest['src/main.js'])) {
                wp_enqueue_script(
                    'katayama-main',
                    get_template_directory_uri() . '/dist/' . $manifest['src/main.js']['file'],
                    [],
                    null,
                    true
                );

                // CSS files from main.js entry
                if (isset($manifest['src/main.js']['css'])) {
                    foreach ($manifest['src/main.js']['css'] as $index => $css_file) {
                        wp_enqueue_style(
                            'katayama-style-' . $index,
                            get_template_directory_uri() . '/dist/' . $css_file,
                            [],
                            null
                        );
                    }
                }
            }
        }
    }
}
add_action('wp_enqueue_scripts', 'katayama_enqueue_vite_assets');

// ACF JSON 保存先・読み込み先
add_filter('acf/settings/save_json', function($path) {
    return get_stylesheet_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
});

// 日付フォーマット統一
function katayama_custom_date_format($date) {
    return date('Y.m.d', strtotime($date));
}

// タイムゾーン設定
add_action('init', function() {
    date_default_timezone_set('Asia/Tokyo');
});

// 画像のlazy loading
function katayama_add_lazy_loading($content) {
    if (is_front_page() || is_singular()) {
        $content = preg_replace('/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content);
    }
    return $content;
}
add_filter('the_content', 'katayama_add_lazy_loading');

// 不要なCSS/JSを削除（パフォーマンス最適化）
function katayama_optimize_assets() {
    if (!is_admin()) {
        // ブロックエディタのCSS削除（クラシックエディタ使用時）
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('global-styles');

        // 絵文字スクリプト削除
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
}
add_action('wp_enqueue_scripts', 'katayama_optimize_assets', 100);

// カスタム投稿タイプ: 施工実績 (works)
function register_works_cpt() {
    register_post_type('works', [
        'labels' => [
            'name' => '施工実績',
            'singular_name' => '施工実績',
            'add_new' => '新規追加',
            'add_new_item' => '新しい施工実績を追加',
            'edit_item' => '施工実績を編集',
            'view_item' => '施工実績を表示',
            'all_items' => 'すべての施工実績',
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-hammer',
        'rewrite' => ['slug' => 'works'],
    ]);

    // タクソノミー: 工事種別
    register_taxonomy('work_category', 'works', [
        'labels' => [
            'name' => '工事種別',
            'singular_name' => '工事種別',
        ],
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => ['slug' => 'work-category'],
    ]);
}
add_action('init', 'register_works_cpt');

// アイキャッチ必須化（工事部ブログ）
function require_featured_image_for_kojiblog($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (get_post_type($post_id) !== 'post') return;

    $categories = get_the_category($post_id);
    $is_kojiblog = false;

    foreach ($categories as $category) {
        if ($category->slug === 'kojiblog') {
            $is_kojiblog = true;
            break;
        }
    }

    if ($is_kojiblog && !has_post_thumbnail($post_id)) {
        wp_update_post([
            'ID' => $post_id,
            'post_status' => 'draft'
        ]);

        add_filter('redirect_post_location', function($location) {
            return add_query_arg('message', 'no_thumbnail', $location);
        });
    }
}
add_action('save_post', 'require_featured_image_for_kojiblog');

// エラーメッセージ表示
function show_thumbnail_error_message() {
    if (isset($_GET['message']) && $_GET['message'] === 'no_thumbnail') {
        echo '<div class="error"><p><strong>エラー:</strong> 工事部ブログにはアイキャッチ画像が必須です。</p></div>';
    }
}
add_action('admin_notices', 'show_thumbnail_error_message');

// 編集画面にリマインダーを表示
function add_thumbnail_reminder() {
    global $post;
    if ($post && in_category('kojiblog', $post)) {
        echo '<div class="notice notice-warning"><p><strong>注意:</strong> このカテゴリではアイキャッチ画像が必須です。</p></div>';
    }
}
add_action('edit_form_after_title', 'add_thumbnail_reminder');

// セキュリティヘッダー
function katayama_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', 'katayama_security_headers');
