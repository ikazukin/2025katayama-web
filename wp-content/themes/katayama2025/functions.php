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

// 沿革ページ用CSS
function katayama_enqueue_history_styles() {
    if (is_page_template('page-history.php')) {
        wp_enqueue_style(
            'katayama-history',
            get_template_directory_uri() . '/assets/css/history.css',
            [],
            '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'katayama_enqueue_history_styles');

// ACF JSON 保存先・読み込み先
add_filter('acf/settings/save_json', function() {
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

// カスタム投稿タイプ: 施工実績 (works) - Issue 05
function register_works_cpt() {
    // 親CPT: works（現場単位）
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
        'menu_position' => 5,
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

    // 子CPT: works_gallery（画像1枚単位 - Instagram型）
    register_post_type('works_gallery', [
        'labels' => [
            'name' => '施工実績ギャラリー',
            'singular_name' => 'ギャラリー画像',
            'add_new' => '画像を追加',
            'add_new_item' => '新しい画像を追加',
            'edit_item' => 'ギャラリー画像を編集',
            'view_item' => 'ギャラリー画像を表示',
            'all_items' => 'すべてのギャラリー画像',
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => 'edit.php?post_type=works',
        'show_in_rest' => true,
        'supports' => ['title', 'thumbnail', 'page-attributes'],
        'menu_icon' => 'dashicons-format-gallery',
        'capability_type' => 'post',
        'rewrite' => false,
    ]);
}
add_action('init', 'register_works_cpt');

// お客様の声 CPT
function register_testimonials_cpt() {
    register_post_type('testimonials', [
        'labels' => [
            'name' => 'お客様の声',
            'singular_name' => 'お客様の声',
            'add_new' => '新規追加',
            'add_new_item' => '新しいお客様の声を追加',
            'edit_item' => 'お客様の声を編集',
            'view_item' => 'お客様の声を表示',
            'all_items' => 'すべてのお客様の声',
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-format-quote',
        'rewrite' => ['slug' => 'testimonials'],
        'menu_position' => 6,
    ]);
}
add_action('init', 'register_testimonials_cpt');

// 社員インタビュー CPT
function register_interviews_cpt() {
    register_post_type('interviews', [
        'labels' => [
            'name' => '社員インタビュー',
            'singular_name' => '社員インタビュー',
            'add_new' => '新規追加',
            'add_new_item' => '新しい社員インタビューを追加',
            'edit_item' => '社員インタビューを編集',
            'view_item' => '社員インタビューを表示',
            'all_items' => 'すべての社員インタビュー',
        ],
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-groups',
        'rewrite' => ['slug' => 'interviews'],
        'menu_position' => 7,
    ]);
}
add_action('init', 'register_interviews_cpt');

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

// ============================================
// ACF Field Groups Registration
// ============================================

/**
 * ACF Field Group: Hero Section
 * Issue 02 - ヒーロー動画セクション（SEO最適化版）
 */
function register_acf_hero_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_hero_section',
            'title' => 'Hero Section',
            'fields' => [
                [
                    'key' => 'field_hero_tab',
                    'label' => 'Hero',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_hero_pc_video',
                    'label' => 'PC動画URL',
                    'name' => 'hero_pc_video',
                    'type' => 'file',
                    'instructions' => 'デスクトップ用の動画ファイル（MP4推奨）',
                    'return_format' => 'array',
                    'library' => 'all',
                    'mime_types' => 'mp4,webm',
                ],
                [
                    'key' => 'field_hero_sp_video',
                    'label' => 'SP動画URL',
                    'name' => 'hero_sp_video',
                    'type' => 'file',
                    'instructions' => 'モバイル用の動画ファイル（MP4推奨）',
                    'return_format' => 'array',
                    'library' => 'all',
                    'mime_types' => 'mp4,webm',
                ],
                [
                    'key' => 'field_hero_poster',
                    'label' => 'Poster画像（LCP用）',
                    'name' => 'hero_poster',
                    'type' => 'image',
                    'instructions' => '動画の最初のフレームとして表示される画像（LCP最適化のため必須）',
                    'required' => 1,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ],
                [
                    'key' => 'field_hero_title',
                    'label' => 'タイトル',
                    'name' => 'hero_title',
                    'type' => 'text',
                    'instructions' => 'メインキャッチコピー',
                    'default_value' => '',
                ],
                [
                    'key' => 'field_hero_subtitle',
                    'label' => 'サブタイトル',
                    'name' => 'hero_subtitle',
                    'type' => 'textarea',
                    'instructions' => 'サブキャッチコピー（改行可能）',
                    'rows' => 3,
                ],
                [
                    'key' => 'field_hero_cta_text',
                    'label' => 'CTAボタンテキスト',
                    'name' => 'hero_cta_text',
                    'type' => 'text',
                    'instructions' => 'ボタンに表示するテキスト',
                    'placeholder' => 'お問い合わせはこちら',
                ],
                [
                    'key' => 'field_hero_cta_link',
                    'label' => 'CTAボタンリンク',
                    'name' => 'hero_cta_link',
                    'type' => 'url',
                    'instructions' => 'ボタンのリンク先URL',
                    'placeholder' => 'https://example.com/contact',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }
}
add_action('acf/init', 'register_acf_hero_fields');

/**
 * ACF Field Group: Features Section
 * Issue 03 - 特徴セクション（ACFタブ化＋軽量化）
 */
function register_acf_features_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_features_section',
            'title' => 'Features Section',
            'fields' => [
                [
                    'key' => 'field_features_tab',
                    'label' => 'Features',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_features_list',
                    'label' => '特徴リスト',
                    'name' => 'features_list',
                    'type' => 'repeater',
                    'instructions' => 'カタヤマの強み・特徴を3件追加してください',
                    'min' => 3,
                    'max' => 3,
                    'layout' => 'block',
                    'button_label' => '特徴を追加',
                    'sub_fields' => [
                        [
                            'key' => 'field_feature_icon',
                            'label' => 'アイコン画像',
                            'name' => 'icon',
                            'type' => 'image',
                            'instructions' => 'アイコン画像（推奨サイズ: 64x64px）',
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                        ],
                        [
                            'key' => 'field_feature_title',
                            'label' => 'タイトル',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => '特徴のタイトル',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_feature_description',
                            'label' => '説明',
                            'name' => 'description',
                            'type' => 'textarea',
                            'instructions' => '特徴の説明文（改行可能）',
                            'rows' => 4,
                            'required' => 1,
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ],
                ],
            ],
            'menu_order' => 1,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }
}
add_action('acf/init', 'register_acf_features_fields');

/**
 * ACF Field Group: Services Section
 * Issue 24 - 事業分岐セクション（画像+テキストカード型）
 */
function register_acf_services_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_services_section',
            'title' => 'Services Section（事業分岐）',
            'fields' => [
                [
                    'key' => 'field_services_tab',
                    'label' => 'Services',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_services_section_title',
                    'label' => 'セクションタイトル',
                    'name' => 'services_section_title',
                    'type' => 'text',
                    'instructions' => 'セクションのタイトル',
                    'default_value' => 'カタヤマの主な事業領域',
                ],
                [
                    'key' => 'field_services_section_description',
                    'label' => 'セクション説明文',
                    'name' => 'services_section_description',
                    'type' => 'textarea',
                    'instructions' => 'セクションの説明文',
                    'rows' => 3,
                    'default_value' => '大規模修繕で培った技術と信頼をもとに、建物のライフサイクルをトータルに支える事業を展開しています。',
                ],
                [
                    'key' => 'field_services_cards',
                    'label' => '事業カードリスト',
                    'name' => 'services_cards',
                    'type' => 'repeater',
                    'instructions' => '事業カードを4件追加してください',
                    'min' => 4,
                    'max' => 4,
                    'layout' => 'block',
                    'button_label' => '事業カードを追加',
                    'sub_fields' => [
                        [
                            'key' => 'field_service_card_image',
                            'label' => '画像',
                            'name' => 'image',
                            'type' => 'image',
                            'instructions' => '事業イメージ画像（推奨サイズ: 600x400px）',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_service_card_title',
                            'label' => 'カード名',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => '事業名（例: 大規模修繕工事）',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_service_card_catchcopy',
                            'label' => 'キャッチコピー',
                            'name' => 'catchcopy',
                            'type' => 'text',
                            'instructions' => '事業のキャッチコピー（例: 建物の未来を守る、確かな技術）',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_service_card_description',
                            'label' => 'サブ説明',
                            'name' => 'description',
                            'type' => 'textarea',
                            'instructions' => '事業の説明文',
                            'rows' => 3,
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_service_card_cta_text',
                            'label' => 'CTAボタンテキスト',
                            'name' => 'cta_text',
                            'type' => 'text',
                            'instructions' => 'ボタンに表示するテキスト（例: 無料見積もり・相談）',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_service_card_cta_link',
                            'label' => 'CTAボタンリンク先',
                            'name' => 'cta_link',
                            'type' => 'url',
                            'instructions' => 'リンク先URL',
                            'required' => 1,
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ],
                ],
            ],
            'menu_order' => 2,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }
}
add_action('acf/init', 'register_acf_services_fields');

/**
 * ACF Field Group: Works (親投稿)
 * Issue 05 - 施工実績 CPT（Instagram型 子投稿構造に最適化）
 */
function register_acf_works_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_works',
            'title' => '施工実績 詳細情報',
            'fields' => [
                [
                    'key' => 'field_works_year',
                    'label' => '完成年',
                    'name' => 'works_year',
                    'type' => 'number',
                    'instructions' => '完成年を4桁で入力（例: 2024）',
                    'min' => 2000,
                    'max' => 2099,
                ],
                [
                    'key' => 'field_works_address',
                    'label' => '住所',
                    'name' => 'works_address',
                    'type' => 'text',
                    'instructions' => '工事現場の住所',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'works',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
        ]);
    }
}
add_action('acf/init', 'register_acf_works_fields');

/**
 * ACF Field Group: Works Gallery (子投稿)
 * Issue 05 - 施工実績 CPT（Instagram型 子投稿構造に最適化）
 */
function register_acf_works_gallery_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_works_gallery',
            'title' => 'ギャラリー画像設定',
            'fields' => [
                [
                    'key' => 'field_gallery_parent_work',
                    'label' => '親施工実績',
                    'name' => 'gallery_parent_work',
                    'type' => 'post_object',
                    'instructions' => 'この画像が属する施工実績を選択',
                    'required' => 1,
                    'post_type' => ['works'],
                    'return_format' => 'id',
                    'ui' => 1,
                ],
                [
                    'key' => 'field_gallery_image',
                    'label' => 'ギャラリー画像',
                    'name' => 'gallery_image',
                    'type' => 'image',
                    'instructions' => '施工実績の画像（1枚）',
                    'required' => 1,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ],
                [
                    'key' => 'field_gallery_caption',
                    'label' => 'キャプション',
                    'name' => 'gallery_caption',
                    'type' => 'textarea',
                    'instructions' => '画像の説明文（任意）',
                    'rows' => 3,
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'works_gallery',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
        ]);
    }
}
add_action('acf/init', 'register_acf_works_gallery_fields');

/**
 * ACF Field Group: Recruit Section
 * Issue 08 - 採用情報（ACFタブ化 + 専用パーツ化）
 */
function register_acf_recruit_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_recruit_section',
            'title' => 'Recruit Section',
            'fields' => [
                [
                    'key' => 'field_recruit_tab',
                    'label' => 'Recruit',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_recruit_title',
                    'label' => 'タイトル',
                    'name' => 'recruit_title',
                    'type' => 'text',
                    'instructions' => '採用情報セクションのタイトル',
                    'placeholder' => '例: 一緒に働きませんか？',
                ],
                [
                    'key' => 'field_recruit_text',
                    'label' => '本文',
                    'name' => 'recruit_text',
                    'type' => 'wysiwyg',
                    'instructions' => '採用メッセージ（HTML使用可能）',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                ],
                [
                    'key' => 'field_recruit_image_1',
                    'label' => '画像1',
                    'name' => 'recruit_image_1',
                    'type' => 'image',
                    'instructions' => '左側の画像',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ],
                [
                    'key' => 'field_recruit_image_2',
                    'label' => '画像2',
                    'name' => 'recruit_image_2',
                    'type' => 'image',
                    'instructions' => '右側の画像（少し下にずれて表示されます）',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ],
                [
                    'key' => 'field_recruit_btn1_text',
                    'label' => 'ボタン1：テキスト',
                    'name' => 'recruit_btn1_text',
                    'type' => 'text',
                    'instructions' => '新卒採用ボタンのテキスト',
                    'default_value' => '新卒採用情報',
                ],
                [
                    'key' => 'field_recruit_btn1_link',
                    'label' => 'ボタン1：リンク先',
                    'name' => 'recruit_btn1_link',
                    'type' => 'url',
                    'instructions' => '新卒採用ページのURL',
                    'default_value' => '/recruit/shinsotsu/',
                ],
                [
                    'key' => 'field_recruit_btn2_text',
                    'label' => 'ボタン2：テキスト',
                    'name' => 'recruit_btn2_text',
                    'type' => 'text',
                    'instructions' => '中途採用ボタンのテキスト',
                    'default_value' => '中途採用情報',
                ],
                [
                    'key' => 'field_recruit_btn2_link',
                    'label' => 'ボタン2：リンク先',
                    'name' => 'recruit_btn2_link',
                    'type' => 'url',
                    'instructions' => '中途採用ページのURL',
                    'default_value' => '/recruit/boshu/',
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ],
                ],
            ],
            'menu_order' => 3,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }
}
add_action('acf/init', 'register_acf_recruit_fields');

/**
 * ACF Field Group: Recruit Shinsotsu Page (新卒採用ページ)
 * Issue #14 - 新卒採用ページ - ACFフィールド作成
 */
function register_acf_recruit_shinsotsu_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_recruit_shinsotsu',
            'title' => '新卒採用ページ',
            'fields' => [
                // Hero Section
                [
                    'key' => 'field_shinsotsu_hero_tab',
                    'label' => 'Hero',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_shinsotsu_hero_catchcopy',
                    'label' => 'キャッチコピー',
                    'name' => 'hero_catchcopy',
                    'type' => 'text',
                    'instructions' => 'メインキャッチコピー',
                    'placeholder' => '例: 2026年度新卒採用',
                ],
                [
                    'key' => 'field_shinsotsu_hero_subtitle',
                    'label' => 'サブタイトル',
                    'name' => 'hero_subtitle',
                    'type' => 'textarea',
                    'instructions' => 'サブタイトル',
                    'rows' => 3,
                ],
                [
                    'key' => 'field_shinsotsu_hero_bg',
                    'label' => '背景画像',
                    'name' => 'hero_background',
                    'type' => 'image',
                    'instructions' => 'Hero背景画像',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ],

                // ABOUT Section
                [
                    'key' => 'field_shinsotsu_about_tab',
                    'label' => 'ABOUT',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_shinsotsu_about_slogan',
                    'label' => 'スローガン',
                    'name' => 'about_slogan',
                    'type' => 'text',
                    'instructions' => '企業スローガン',
                    'placeholder' => '例: 「住まい」のケアは、「住む人」のこころのケアです',
                ],
                [
                    'key' => 'field_shinsotsu_about_message',
                    'label' => '企業メッセージ',
                    'name' => 'about_message',
                    'type' => 'wysiwyg',
                    'instructions' => '企業メッセージ（HTML使用可能）',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                ],
                [
                    'key' => 'field_shinsotsu_about_image',
                    'label' => 'イメージ画像',
                    'name' => 'about_image',
                    'type' => 'image',
                    'instructions' => '企業イメージ画像',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ],

                // BUSINESS Section
                [
                    'key' => 'field_shinsotsu_business_tab',
                    'label' => 'BUSINESS',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_shinsotsu_business_motto',
                    'label' => 'モットー',
                    'name' => 'business_motto',
                    'type' => 'text',
                    'instructions' => '事業のモットー',
                    'placeholder' => '例: お住まいの皆様の立場に立った工事',
                ],
                [
                    'key' => 'field_shinsotsu_business_list',
                    'label' => '事業内容リスト',
                    'name' => 'business_list',
                    'type' => 'repeater',
                    'instructions' => '事業内容を追加してください',
                    'layout' => 'block',
                    'button_label' => '事業を追加',
                    'sub_fields' => [
                        [
                            'key' => 'field_business_name',
                            'label' => '事業名',
                            'name' => 'name',
                            'type' => 'text',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_business_description',
                            'label' => '説明',
                            'name' => 'description',
                            'type' => 'textarea',
                            'rows' => 4,
                        ],
                        [
                            'key' => 'field_business_icon',
                            'label' => 'アイコン画像',
                            'name' => 'icon',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                        ],
                    ],
                ],

                // WORK Section
                [
                    'key' => 'field_shinsotsu_work_tab',
                    'label' => 'WORK',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_shinsotsu_work_title',
                    'label' => 'セクションタイトル',
                    'name' => 'work_title',
                    'type' => 'text',
                    'instructions' => 'WORKセクションのタイトル',
                    'placeholder' => '例: マンション大規模修繕工事のエキスパート集団',
                ],
                [
                    'key' => 'field_shinsotsu_work_jobs',
                    'label' => '職種リスト',
                    'name' => 'work_jobs',
                    'type' => 'repeater',
                    'instructions' => '募集職種を追加してください',
                    'layout' => 'block',
                    'button_label' => '職種を追加',
                    'sub_fields' => [
                        [
                            'key' => 'field_job_name',
                            'label' => '職種名',
                            'name' => 'name',
                            'type' => 'text',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_job_description',
                            'label' => '業務内容',
                            'name' => 'description',
                            'type' => 'wysiwyg',
                            'toolbar' => 'basic',
                        ],
                        [
                            'key' => 'field_job_appeal',
                            'label' => 'やりがい',
                            'name' => 'appeal',
                            'type' => 'textarea',
                            'rows' => 4,
                        ],
                        [
                            'key' => 'field_job_image',
                            'label' => 'イメージ画像',
                            'name' => 'image',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                        ],
                    ],
                ],

                // INTERVIEW Section
                [
                    'key' => 'field_shinsotsu_interview_tab',
                    'label' => 'INTERVIEW',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_shinsotsu_interviews',
                    'label' => '社員インタビュー',
                    'name' => 'interviews',
                    'type' => 'repeater',
                    'instructions' => '社員インタビューを追加してください',
                    'layout' => 'block',
                    'button_label' => 'インタビューを追加',
                    'sub_fields' => [
                        [
                            'key' => 'field_interview_name',
                            'label' => '社員名',
                            'name' => 'name',
                            'type' => 'text',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_interview_year',
                            'label' => '入社年度',
                            'name' => 'year',
                            'type' => 'number',
                            'min' => 2000,
                            'max' => 2099,
                        ],
                        [
                            'key' => 'field_interview_position',
                            'label' => '職種',
                            'name' => 'position',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_interview_photo',
                            'label' => 'プロフィール写真',
                            'name' => 'photo',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'medium',
                        ],
                        [
                            'key' => 'field_interview_qa',
                            'label' => 'Q&A',
                            'name' => 'qa',
                            'type' => 'repeater',
                            'layout' => 'table',
                            'button_label' => 'Q&Aを追加',
                            'sub_fields' => [
                                [
                                    'key' => 'field_qa_question',
                                    'label' => '質問',
                                    'name' => 'question',
                                    'type' => 'text',
                                    'required' => 1,
                                ],
                                [
                                    'key' => 'field_qa_answer',
                                    'label' => '回答',
                                    'name' => 'answer',
                                    'type' => 'wysiwyg',
                                    'toolbar' => 'basic',
                                ],
                            ],
                        ],
                    ],
                ],

                // BENEFITS Section
                [
                    'key' => 'field_shinsotsu_benefits_tab',
                    'label' => 'BENEFITS',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_shinsotsu_benefits',
                    'label' => '福利厚生リスト',
                    'name' => 'benefits',
                    'type' => 'repeater',
                    'instructions' => '福利厚生を追加してください',
                    'layout' => 'block',
                    'button_label' => '福利厚生を追加',
                    'sub_fields' => [
                        [
                            'key' => 'field_benefit_title',
                            'label' => 'タイトル',
                            'name' => 'title',
                            'type' => 'text',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_benefit_description',
                            'label' => '説明文',
                            'name' => 'description',
                            'type' => 'wysiwyg',
                            'toolbar' => 'basic',
                        ],
                        [
                            'key' => 'field_benefit_icon',
                            'label' => 'アイコン画像',
                            'name' => 'icon',
                            'type' => 'image',
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                        ],
                    ],
                ],

                // FAQ Section
                [
                    'key' => 'field_shinsotsu_faq_tab',
                    'label' => 'FAQ',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_shinsotsu_faq',
                    'label' => 'よくある質問',
                    'name' => 'faq',
                    'type' => 'repeater',
                    'instructions' => 'よくある質問を追加してください',
                    'layout' => 'table',
                    'button_label' => '質問を追加',
                    'sub_fields' => [
                        [
                            'key' => 'field_faq_question',
                            'label' => '質問',
                            'name' => 'question',
                            'type' => 'text',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_faq_answer',
                            'label' => '回答',
                            'name' => 'answer',
                            'type' => 'wysiwyg',
                            'toolbar' => 'basic',
                        ],
                    ],
                ],

                // RECRUIT Section (募集要項)
                [
                    'key' => 'field_shinsotsu_recruit_tab',
                    'label' => 'RECRUIT',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_shinsotsu_recruit_jobs',
                    'label' => '募集職種リスト',
                    'name' => 'recruit_jobs',
                    'type' => 'repeater',
                    'instructions' => '募集職種を追加してください',
                    'layout' => 'block',
                    'button_label' => '募集職種を追加',
                    'sub_fields' => [
                        [
                            'key' => 'field_recruit_job_title',
                            'label' => '職種名',
                            'name' => 'title',
                            'type' => 'text',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_recruit_job_type',
                            'label' => '雇用形態',
                            'name' => 'type',
                            'type' => 'select',
                            'choices' => [
                                'shinsotsu' => '新卒',
                                'seishain' => '正社員',
                            ],
                        ],
                        [
                            'key' => 'field_recruit_job_salary',
                            'label' => '月給',
                            'name' => 'salary',
                            'type' => 'text',
                            'placeholder' => '例: 289,100円',
                        ],
                        [
                            'key' => 'field_recruit_job_location',
                            'label' => '勤務地',
                            'name' => 'location',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_recruit_job_count',
                            'label' => '募集人数',
                            'name' => 'count',
                            'type' => 'text',
                        ],
                        [
                            'key' => 'field_recruit_job_requirements',
                            'label' => '応募資格',
                            'name' => 'requirements',
                            'type' => 'wysiwyg',
                            'toolbar' => 'basic',
                        ],
                        [
                            'key' => 'field_recruit_job_details',
                            'label' => '詳細説明',
                            'name' => 'details',
                            'type' => 'wysiwyg',
                            'toolbar' => 'basic',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'page-recruit-shinsotsu.php',
                    ],
                ],
            ],
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }
}
add_action('acf/init', 'register_acf_recruit_shinsotsu_fields');

/**
 * ACF Field Group: Company Introduction Section
 * Issue #24 - カタヤマについてセクション
 */
function register_acf_company_intro_fields() {
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_company_intro',
            'title' => 'Company Introduction Section',
            'fields' => [
                [
                    'key' => 'field_company_intro_tab',
                    'label' => 'Company Intro',
                    'name' => '',
                    'type' => 'tab',
                    'placement' => 'top',
                ],
                [
                    'key' => 'field_company_intro_title',
                    'label' => 'セクションタイトル',
                    'name' => 'company_intro_title',
                    'type' => 'text',
                    'default_value' => '40年の歩み、これからの挑戦。',
                ],
                [
                    'key' => 'field_company_intro_link',
                    'label' => '会社紹介ページリンク',
                    'name' => 'company_intro_link',
                    'type' => 'url',
                    'default_value' => '/company/',
                ],
                [
                    'key' => 'field_company_philosophy',
                    'label' => '社是カード',
                    'name' => 'company_philosophy',
                    'type' => 'repeater',
                    'instructions' => '社是を3件追加してください',
                    'min' => 3,
                    'max' => 3,
                    'layout' => 'block',
                    'button_label' => '社是を追加',
                    'sub_fields' => [
                        [
                            'key' => 'field_philosophy_emoji',
                            'label' => '絵文字',
                            'name' => 'emoji',
                            'type' => 'text',
                            'instructions' => '絵文字（例: 🤝）',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_philosophy_title',
                            'label' => 'タイトル',
                            'name' => 'title',
                            'type' => 'text',
                            'instructions' => '社是のタイトル（例: 約束）',
                            'required' => 1,
                        ],
                        [
                            'key' => 'field_philosophy_description',
                            'label' => '説明文',
                            'name' => 'description',
                            'type' => 'textarea',
                            'instructions' => '社是の説明文',
                            'rows' => 3,
                            'required' => 1,
                        ],
                    ],
                ],
                [
                    'key' => 'field_company_stats',
                    'label' => '実績サマリー',
                    'name' => 'company_stats',
                    'type' => 'group',
                    'layout' => 'block',
                    'sub_fields' => [
                        [
                            'key' => 'field_stat_years',
                            'label' => '創業年数',
                            'name' => 'years',
                            'type' => 'text',
                            'default_value' => '40年',
                        ],
                        [
                            'key' => 'field_stat_projects',
                            'label' => '累計施工実績',
                            'name' => 'projects',
                            'type' => 'text',
                            'default_value' => '1,200棟',
                        ],
                        [
                            'key' => 'field_stat_iso',
                            'label' => 'ISO認証',
                            'name' => 'iso',
                            'type' => 'text',
                            'default_value' => 'ISO認証',
                        ],
                        [
                            'key' => 'field_stat_iso_detail',
                            'label' => 'ISO詳細',
                            'name' => 'iso_detail',
                            'type' => 'text',
                            'default_value' => '9001・14001',
                        ],
                        [
                            'key' => 'field_stat_area',
                            'label' => '施工エリア',
                            'name' => 'area',
                            'type' => 'text',
                            'default_value' => '神奈川・東京',
                        ],
                    ],
                ],
            ],
            'location' => [
                [
                    [
                        'param' => 'page_type',
                        'operator' => '==',
                        'value' => 'front_page',
                    ],
                ],
            ],
            'menu_order' => 4,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
        ]);
    }
}
add_action('acf/init', 'register_acf_company_intro_fields');

// ============================================
// WordPress Customizer API Integration
// Issue 18 - トップページのカスタマイザー統合
// ============================================

/**
 * カスタマイザーにトップページ設定を追加
 */
function katayama_customize_register($wp_customize) {
    // パネル：トップページ設定
    $wp_customize->add_panel('front_page_settings', [
        'title' => 'トップページ設定',
        'description' => 'トップページの各セクションを編集できます（リアルタイムプレビュー付き）',
        'priority' => 10,
    ]);

    // ============================================
    // Hero Section
    // ============================================
    $wp_customize->add_section('hero_section', [
        'title' => 'Hero Section（ヒーロー動画）',
        'panel' => 'front_page_settings',
        'priority' => 10,
    ]);

    // PC動画URL
    $wp_customize->add_setting('hero_pc_video', [
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_pc_video', [
        'label' => 'PC動画URL',
        'description' => 'デスクトップ用の動画ファイル（MP4推奨）',
        'section' => 'hero_section',
        'mime_type' => 'video',
    ]));

    // SP動画URL
    $wp_customize->add_setting('hero_sp_video', [
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_sp_video', [
        'label' => 'SP動画URL',
        'description' => 'モバイル用の動画ファイル（MP4推奨）',
        'section' => 'hero_section',
        'mime_type' => 'video',
    ]));

    // Poster画像
    $wp_customize->add_setting('hero_poster', [
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'hero_poster', [
        'label' => 'Poster画像（LCP用）',
        'description' => '動画の最初のフレームとして表示される画像（必須）',
        'section' => 'hero_section',
        'mime_type' => 'image',
    ]));

    // タイトル
    $wp_customize->add_setting('hero_title', [
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_title', [
        'label' => 'タイトル',
        'description' => 'メインキャッチコピー',
        'section' => 'hero_section',
        'type' => 'text',
    ]);

    // サブタイトル
    $wp_customize->add_setting('hero_subtitle', [
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('hero_subtitle', [
        'label' => 'サブタイトル',
        'description' => 'サブキャッチコピー（改行可能）',
        'section' => 'hero_section',
        'type' => 'textarea',
    ]);

    // CTAボタンテキスト
    $wp_customize->add_setting('hero_cta_text', [
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_cta_text', [
        'label' => 'CTAボタンテキスト',
        'description' => 'ボタンに表示するテキスト',
        'section' => 'hero_section',
        'type' => 'text',
    ]);

    // CTAボタンリンク
    $wp_customize->add_setting('hero_cta_link', [
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('hero_cta_link', [
        'label' => 'CTAボタンリンク',
        'description' => 'ボタンのリンク先URL',
        'section' => 'hero_section',
        'type' => 'url',
    ]);

    // ============================================
    // Features Section
    // ============================================
    $wp_customize->add_section('features_section', [
        'title' => 'Features Section（3つの強み）',
        'panel' => 'front_page_settings',
        'priority' => 20,
    ]);

    // 強み1-3のループで追加
    for ($i = 1; $i <= 3; $i++) {
        // アイコン画像
        $wp_customize->add_setting("feature_{$i}_icon", [
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'absint',
        ]);
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "feature_{$i}_icon", [
            'label' => "強み{$i}：アイコン画像",
            'description' => '推奨サイズ: 64x64px',
            'section' => 'features_section',
            'mime_type' => 'image',
        ]));

        // タイトル
        $wp_customize->add_setting("feature_{$i}_title", [
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("feature_{$i}_title", [
            'label' => "強み{$i}：タイトル",
            'section' => 'features_section',
            'type' => 'text',
        ]);

        // 説明
        $wp_customize->add_setting("feature_{$i}_description", [
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("feature_{$i}_description", [
            'label' => "強み{$i}：説明",
            'section' => 'features_section',
            'type' => 'textarea',
        ]);
    }

    // ============================================
    // Services Section
    // ============================================
    $wp_customize->add_section('services_section', [
        'title' => 'Services Section（事業内容）',
        'panel' => 'front_page_settings',
        'priority' => 30,
    ]);

    // 事業1-4のループで追加
    for ($i = 1; $i <= 4; $i++) {
        // バナー画像
        $wp_customize->add_setting("service_{$i}_image", [
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'absint',
        ]);
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, "service_{$i}_image", [
            'label' => "事業{$i}：バナー画像",
            'description' => '推奨サイズ: 800x600px（比率4:3）',
            'section' => 'services_section',
            'mime_type' => 'image',
        ]));

        // タイトル
        $wp_customize->add_setting("service_{$i}_title", [
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("service_{$i}_title", [
            'label' => "事業{$i}：タイトル",
            'section' => 'services_section',
            'type' => 'text',
        ]);

        // Altテキスト
        $wp_customize->add_setting("service_{$i}_alt", [
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("service_{$i}_alt", [
            'label' => "事業{$i}：Altテキスト（SEO用）",
            'description' => '空欄の場合はタイトルを使用',
            'section' => 'services_section',
            'type' => 'text',
        ]);

        // リンクURL
        $wp_customize->add_setting("service_{$i}_link", [
            'default' => '',
            'transport' => 'postMessage',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control("service_{$i}_link", [
            'label' => "事業{$i}：リンク先URL",
            'section' => 'services_section',
            'type' => 'url',
        ]);
    }

    // ============================================
    // Recruit Section
    // ============================================
    $wp_customize->add_section('recruit_section', [
        'title' => 'Recruit Section（採用情報）',
        'panel' => 'front_page_settings',
        'priority' => 40,
    ]);

    // タイトル
    $wp_customize->add_setting('recruit_title', [
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('recruit_title', [
        'label' => 'タイトル',
        'description' => '採用情報セクションのタイトル',
        'section' => 'recruit_section',
        'type' => 'text',
    ]);

    // 本文
    $wp_customize->add_setting('recruit_text', [
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('recruit_text', [
        'label' => '本文',
        'description' => '採用メッセージ（HTML使用可能）',
        'section' => 'recruit_section',
        'type' => 'textarea',
    ]);

    // 画像1
    $wp_customize->add_setting('recruit_image_1', [
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'recruit_image_1', [
        'label' => '画像1',
        'description' => '左側の画像',
        'section' => 'recruit_section',
        'mime_type' => 'image',
    ]));

    // 画像2
    $wp_customize->add_setting('recruit_image_2', [
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'recruit_image_2', [
        'label' => '画像2',
        'description' => '右側の画像（少し下にずれて表示）',
        'section' => 'recruit_section',
        'mime_type' => 'image',
    ]));

    // CTAボタンテキスト
    $wp_customize->add_setting('recruit_cta_text', [
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('recruit_cta_text', [
        'label' => 'CTAボタンテキスト',
        'description' => 'ボタンに表示するテキスト',
        'section' => 'recruit_section',
        'type' => 'text',
    ]);

    // CTAボタンリンク
    $wp_customize->add_setting('recruit_cta_link', [
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('recruit_cta_link', [
        'label' => 'CTAボタンリンク',
        'description' => 'ボタンのリンク先URL',
        'section' => 'recruit_section',
        'type' => 'url',
    ]);
}
add_action('customize_register', 'katayama_customize_register');

/**
 * カスタマイザープレビュー用JavaScriptの読み込み
 */
function katayama_customizer_preview_scripts() {
    wp_enqueue_script(
        'katayama-customizer-preview',
        get_template_directory_uri() . '/src/customizer-preview.js',
        ['jquery', 'customize-preview'],
        null,
        true
    );
}
add_action('customize_preview_init', 'katayama_customizer_preview_scripts');

// ============================================
// Gutenberg Blocks Registration
// Issue 18 - ブロックエディタ統合（簡易デモ）
// ============================================

/**
 * カスタムブロックカテゴリの追加
 */
function katayama_block_categories($categories) {
    return array_merge(
        $categories,
        [
            [
                'slug' => 'katayama-works',
                'title' => 'カタヤマ（施工実績専用）',
            ],
        ]
    );
}
add_filter('block_categories_all', 'katayama_block_categories');

/**
 * ブロック用アセットの読み込み
 */
function katayama_register_blocks() {
    $is_dev = defined('WP_DEBUG') && WP_DEBUG;

    // ブロックエディタ用のアセット
    if ($is_dev) {
        // 開発モード
        wp_enqueue_script(
            'katayama-blocks',
            'http://localhost:5173/src/blocks/index.js',
            ['wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n'],
            null,
            true
        );
    } else {
        // 本番モード
        $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);

            if (isset($manifest['src/blocks/index.js'])) {
                wp_enqueue_script(
                    'katayama-blocks',
                    get_template_directory_uri() . '/dist/' . $manifest['src/blocks/index.js']['file'],
                    ['wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n'],
                    null,
                    true
                );
            }
        }
    }

    // Hero Section ブロックの登録
    register_block_type('katayama/hero', [
        'api_version' => 2,
        'attributes' => [
            'title' => [
                'type' => 'string',
                'default' => '',
            ],
            'subtitle' => [
                'type' => 'string',
                'default' => '',
            ],
            'pcVideoId' => [
                'type' => 'number',
                'default' => 0,
            ],
            'pcVideoUrl' => [
                'type' => 'string',
                'default' => '',
            ],
            'spVideoId' => [
                'type' => 'number',
                'default' => 0,
            ],
            'spVideoUrl' => [
                'type' => 'string',
                'default' => '',
            ],
            'posterId' => [
                'type' => 'number',
                'default' => 0,
            ],
            'posterUrl' => [
                'type' => 'string',
                'default' => '',
            ],
            'ctaText' => [
                'type' => 'string',
                'default' => '',
            ],
            'ctaLink' => [
                'type' => 'string',
                'default' => '',
            ],
        ],
        'render_callback' => function($attributes) {
            ob_start();
            include get_template_directory() . '/template-parts/blocks/hero.php';
            return ob_get_clean();
        },
    ]);
}
add_action('init', 'katayama_register_blocks');

/**
 * ブロックエディタ用アセットのエンキュー
 */
function katayama_enqueue_block_editor_assets() {
    $is_dev = defined('WP_DEBUG') && WP_DEBUG;

    if ($is_dev) {
        // 開発モードではViteのモジュール型スクリプトを使用
        wp_enqueue_script(
            'katayama-blocks-editor',
            'http://localhost:5173/@vite/client',
            [],
            null,
            false
        );
        wp_script_add_data('katayama-blocks-editor', 'type', 'module');
    }
}
add_action('enqueue_block_editor_assets', 'katayama_enqueue_block_editor_assets');

/**
 * グローバルナビの初期設定
 * Issue #24 - リフォーム・パートナー募集を追加
 */
function katayama_setup_navigation_menu() {
    // すでにメニューが設定されている場合はスキップ
    $menu_name = 'primary';
    $locations = get_nav_menu_locations();

    if (!isset($locations[$menu_name])) {
        // メニューを作成
        $menu_id = wp_create_nav_menu('プライマリメニュー');

        if (!is_wp_error($menu_id)) {
            // メニュー項目を追加
            $menu_items = [
                ['title' => 'ホーム', 'url' => home_url('/'), 'order' => 1],
                ['title' => '会社紹介', 'url' => home_url('/company/'), 'order' => 2],
                ['title' => '大規模修繕', 'url' => home_url('/large-scale-renovation/'), 'order' => 3],
                ['title' => 'リフォーム', 'url' => home_url('/reform/'), 'order' => 4],
                ['title' => '施工実績', 'url' => home_url('/works/'), 'order' => 5],
                ['title' => '採用情報', 'url' => home_url('/recruit/'), 'order' => 6],
                ['title' => 'パートナー募集', 'url' => home_url('/partner/'), 'order' => 7],
                ['title' => 'お問い合わせ', 'url' => home_url('/contact/'), 'order' => 8],
            ];

            foreach ($menu_items as $item) {
                wp_update_nav_menu_item($menu_id, 0, [
                    'menu-item-title' => $item['title'],
                    'menu-item-url' => $item['url'],
                    'menu-item-status' => 'publish',
                    'menu-item-position' => $item['order'],
                ]);
            }

            // メニューを primary ロケーションに割り当て
            $locations[$menu_name] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }
}
// テーマ有効化時に1回だけ実行
add_action('after_switch_theme', 'katayama_setup_navigation_menu');

/**
 * 既存メニューに採用情報とパートナー募集を追加
 */
function katayama_add_recruit_partner_to_menu() {
    $locations = get_nav_menu_locations();

    if (!isset($locations['primary'])) {
        return;
    }

    $menu_id = $locations['primary'];
    $menu_items = wp_get_nav_menu_items($menu_id);

    if (!$menu_items) {
        return;
    }

    // 既に追加済みかチェック
    $has_recruit = false;
    $has_partner = false;

    foreach ($menu_items as $item) {
        if (strpos($item->url, '/recruit/') !== false) {
            $has_recruit = true;
        }
        if (strpos($item->url, '/partner/') !== false) {
            $has_partner = true;
        }
    }

    // 採用情報を追加
    if (!$has_recruit) {
        wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title' => '採用情報',
            'menu-item-url' => home_url('/recruit/'),
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
        ]);
    }

    // パートナー募集を追加
    if (!$has_partner) {
        wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title' => 'パートナー募集',
            'menu-item-url' => home_url('/partner/'),
            'menu-item-status' => 'publish',
            'menu-item-type' => 'custom',
        ]);
    }
}
// admin_initで実行（1回のみ実行するようにフラグを使用）
add_action('admin_init', function() {
    if (!get_option('katayama_menu_items_added')) {
        katayama_add_recruit_partner_to_menu();
        update_option('katayama_menu_items_added', true);
    }
});

/**
 * ACFフィールドにサンプルデータを挿入
 * Issue #24 - トップページ刷新
 */
function katayama_insert_sample_acf_data() {
    $front_page_id = get_option('page_on_front');

    if (!$front_page_id) {
        return;
    }

    // Services Section（事業分岐）のデータを挿入
    $services_cards = [
        [
            'image' => '',
            'title' => '大規模修繕工事',
            'catchcopy' => '建物の未来を守る、確かな技術',
            'description' => 'マンション・公共施設の外壁・防水・設備改修まで、豊富な実績で対応します。',
            'cta_text' => '無料見積もり・相談',
            'cta_link' => home_url('/large-scale-renovation/'),
        ],
        [
            'image' => '',
            'title' => 'リフォーム',
            'catchcopy' => '住まいに新しい価値を',
            'description' => '内装・外装リフォームから防水・外壁改修まで、快適で美しい空間を提供。',
            'cta_text' => '施工例を見る',
            'cta_link' => home_url('/works/'),
        ],
        [
            'image' => '',
            'title' => '採用情報',
            'catchcopy' => '地域で働き、未来をつくる',
            'description' => '若手からベテランまで活躍する現場。人を大切にする風土と成長機会。',
            'cta_text' => 'エントリー',
            'cta_link' => home_url('/recruit/'),
        ],
        [
            'image' => '',
            'title' => 'パートナー募集',
            'catchcopy' => '共に信頼を築く仲間へ',
            'description' => '安全・品質を共有し、地域とともに成長できる協力会社を募集しています。',
            'cta_text' => 'エントリーフォーム',
            'cta_link' => home_url('/partner/'),
        ],
    ];

    update_field('services_section_title', 'カタヤマの主な事業領域', $front_page_id);
    update_field('services_section_description', '大規模修繕で培った技術と信頼をもとに、建物のライフサイクルをトータルに支える事業を展開しています。', $front_page_id);
    update_field('services_cards', $services_cards, $front_page_id);

    // Features Section（信頼セクション）のデータを挿入
    $features_list = [
        [
            'icon' => '',
            'title' => '実績と規模で信頼を証明',
            'description' => "累計施工棟数1,200棟以上\n施工エリア：神奈川・東京全域\nISO9001・14001認証取得",
        ],
        [
            'icon' => '',
            'title' => '人と現場が生む品質',
            'description' => "ベテラン技術者×若手育成\n安全大会・社内研修の継続\n現場の声を大切にする風土",
        ],
        [
            'icon' => '',
            'title' => '地域と共に歩む40年',
            'description' => "地域金融機関との協力\n親和会・安全祈願祭など地域連携活動\n地域社会への貢献を重視",
        ],
    ];

    update_field('features_list', $features_list, $front_page_id);

    // Company Introduction Section（カタヤマについて）のデータを挿入
    update_field('company_intro_title', '40年の歩み、これからの挑戦。', $front_page_id);
    update_field('company_intro_link', home_url('/company/'), $front_page_id);

    // 社是カード
    $company_philosophy = [
        [
            'emoji' => '🤝',
            'title' => '約束',
            'description' => "お客様との約束を守り、\n確かな品質をお届けします。",
        ],
        [
            'emoji' => '🙏',
            'title' => '感謝',
            'description' => "地域の皆様、協力会社への\n感謝の心を忘れません。",
        ],
        [
            'emoji' => '✨',
            'title' => '夢',
            'description' => "未来に向けて挑戦し続け、\n新しい価値を創造します。",
        ],
    ];
    update_field('company_philosophy', $company_philosophy, $front_page_id);

    // 実績サマリー
    update_field('company_stats', [
        'years' => '40年',
        'projects' => '1,200棟',
        'iso' => 'ISO認証',
        'iso_detail' => '9001・14001',
        'area' => '神奈川・東京',
    ], $front_page_id);

    // Recruit Section（採用情報）のボタンデータを挿入
    update_field('recruit_btn1_text', '新卒採用情報', $front_page_id);
    update_field('recruit_btn1_link', home_url('/recruit/shinsotsu/'), $front_page_id);
    update_field('recruit_btn2_text', '中途採用情報', $front_page_id);
    update_field('recruit_btn2_link', home_url('/recruit/boshu/'), $front_page_id);
}
// テーマ有効化時に1回だけ実行
add_action('after_switch_theme', 'katayama_insert_sample_acf_data');

// 一時的な実行フック（データがまだ挿入されていない場合のみ実行）
function katayama_maybe_insert_sample_data() {
    $front_page_id = get_option('page_on_front');

    if (!$front_page_id) {
        return;
    }

    // データが既に存在するかチェック
    $existing_data = get_field('services_cards', $front_page_id);

    if (empty($existing_data)) {
        katayama_insert_sample_acf_data();
        // 管理画面に通知を表示
        add_action('admin_notices', function() {
            echo '<div class="notice notice-success is-dismissible">';
            echo '<p><strong>✅ ACFフィールドにサンプルデータを挿入しました！</strong></p>';
            echo '<p>固定ページ → フロントページ編集で、画像をアップロードしてください。</p>';
            echo '</div>';
        });
    }
}
add_action('admin_init', 'katayama_maybe_insert_sample_data');

/**
 * パンくずリスト生成関数
 * Issue #16 - ナビゲーション連携
 */
function katayama_breadcrumbs() {
    global $post;

    if (is_front_page()) {
        return; // トップページでは表示しない
    }

    echo '<nav class="breadcrumbs py-4 text-sm bg-gray-50" aria-label="パンくずリスト">';
    echo '<div class="container mx-auto px-4">';
    echo '<ol class="flex flex-wrap items-center gap-2 text-gray-600" vocab="https://schema.org/" typeof="BreadcrumbList">';

    // ホーム
    echo '<li property="itemListElement" typeof="ListItem">';
    echo '<a property="item" typeof="WebPage" href="' . home_url('/') . '" class="hover:text-blue-600">';
    echo '<span property="name">ホーム</span></a>';
    echo '<meta property="position" content="1">';
    echo '</li>';

    $position = 2;

    if (is_page()) {
        // 親ページがある場合
        if ($post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();

            while ($parent_id) {
                $page = get_post($parent_id);
                $breadcrumbs[] = array(
                    'title' => get_the_title($page->ID),
                    'url' => get_permalink($page->ID)
                );
                $parent_id = $page->post_parent;
            }

            $breadcrumbs = array_reverse($breadcrumbs);

            foreach ($breadcrumbs as $breadcrumb) {
                echo '<li class="before:content-[\'›\'] before:mx-2 before:text-gray-400" property="itemListElement" typeof="ListItem">';
                echo '<a property="item" typeof="WebPage" href="' . esc_url($breadcrumb['url']) . '" class="hover:text-blue-600">';
                echo '<span property="name">' . esc_html($breadcrumb['title']) . '</span></a>';
                echo '<meta property="position" content="' . $position . '">';
                echo '</li>';
                $position++;
            }
        }

        // 現在のページ
        echo '<li class="before:content-[\'›\'] before:mx-2 before:text-gray-400" property="itemListElement" typeof="ListItem">';
        echo '<span property="name" class="text-gray-900 font-semibold">' . get_the_title() . '</span>';
        echo '<meta property="position" content="' . $position . '">';
        echo '</li>';
    }

    echo '</ol>';
    echo '</div>';
    echo '</nav>';
}

/**
 * Works専用 Gutenbergカスタムブロックの登録
 * Issue #30 - @wordpress/scriptsでビルド
 */
function katayama_register_works_blocks_v2() {
    $theme_dir = get_template_directory();

    // gallery-carouselブロック
    register_block_type( $theme_dir . '/blocks/gallery-carousel' );

    // before-afterブロック
    register_block_type( $theme_dir . '/blocks/before-after' );
}
add_action( 'init', 'katayama_register_works_blocks_v2' );

/**
 * 旧Vite版の登録処理（無効化）
 * Issue #26, #28 - Vite版は動作しないため無効化
 */
/*
function katayama_register_works_blocks() {
    // works投稿タイプの編集画面でのみブロックを読み込む
    $current_screen = get_current_screen();
    $post_type = '';

    if ($current_screen) {
        $post_type = $current_screen->post_type;
    } elseif (isset($_GET['post_type'])) {
        $post_type = sanitize_text_field($_GET['post_type']);
    } elseif (isset($_GET['post'])) {
        $post_type = get_post_type($_GET['post']);
    }

    // works投稿タイプの場合のみブロックを読み込む
    if ($post_type !== 'works') {
        return;
    }

    $is_dev = defined('WP_DEBUG') && WP_DEBUG;

    if ($is_dev) {
        // 開発モード
        wp_enqueue_script(
            'katayama-works-blocks',
            'http://localhost:5173/src/blocks/works-blocks.js',
            ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'],
            null,
            true
        );
    } else {
        // 本番モード
        $manifest_path = get_template_directory() . '/dist/.vite/manifest.json';

        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);

            if (isset($manifest['src/blocks/works-blocks.js'])) {
                $works_blocks = $manifest['src/blocks/works-blocks.js'];

                // JavaScript
                wp_enqueue_script(
                    'katayama-works-blocks',
                    get_template_directory_uri() . '/dist/' . $works_blocks['file'],
                    ['wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'],
                    null,
                    true
                );

                // CSS
                if (isset($works_blocks['css'])) {
                    foreach ($works_blocks['css'] as $index => $css_file) {
                        wp_enqueue_style(
                            'katayama-works-blocks-style-' . $index,
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
add_action('enqueue_block_editor_assets', 'katayama_register_works_blocks');
*/
