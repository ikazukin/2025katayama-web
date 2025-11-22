<?php
/**
 * Template Part: Features Section
 * 特徴セクション
 */

$page_id = get_option('page_on_front');
if (!$page_id) return;

// カスタマイザーまたはACFからデータ取得
$features = [];

// カスタマイザーから取得を試みる
$has_customizer_data = false;
for ($i = 1; $i <= 3; $i++) {
    $feature_title = get_theme_mod("feature_{$i}_title");
    if (!empty($feature_title)) {
        $has_customizer_data = true;
        $icon_id = get_theme_mod("feature_{$i}_icon");
        $icon_url = $icon_id ? wp_get_attachment_url($icon_id) : '';

        $features[] = [
            'icon' => $icon_url ? ['url' => $icon_url] : null,
            'title' => $feature_title,
            'description' => get_theme_mod("feature_{$i}_description", ''),
        ];
    }
}

// カスタマイザーにデータがなければACFから取得
if (!$has_customizer_data) {
    $acf_features = get_field('features_list', $page_id);
    if ($acf_features) {
        $features = $acf_features;
    }
}

if (empty($features)) return;
?>

<section class="features-section animate-on-scroll py-16 md:py-24" style="display: none;">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">40年の歩みが築いた、確かな信頼と技術。</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                神奈川・東京で培った実績と品質管理体制、<br class="hidden md:block">
                そして人と地域のつながりが、私たちの誇りです。
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($features as $index => $feature): ?>
                <div class="feature-card card-hover bg-white/90 backdrop-blur-sm p-8 shadow-lg transition-all duration-300 flex flex-col min-h-[280px]">
                    <?php if ($feature['icon']): ?>
                        <div class="mb-6 flex-shrink-0">
                            <img
                                src="<?php echo esc_url($feature['icon']['url']); ?>"
                                alt="<?php echo esc_attr($feature['title']); ?>"
                                class="w-16 h-16 mx-auto object-contain"
                                loading="lazy"
                                width="64"
                                height="64"
                            >
                        </div>
                    <?php endif; ?>

                    <h3 class="text-xl font-bold mb-4 text-center flex-shrink-0">
                        <?php echo esc_html($feature['title']); ?>
                    </h3>

                    <p class="text-gray-600 text-center leading-relaxed flex-grow">
                        <?php echo nl2br(esc_html($feature['description'])); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
