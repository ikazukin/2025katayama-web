<?php
/**
 * Template Part: Services Section
 * 事業内容バナー
 */

$page_id = get_option('page_on_front');
if (!$page_id) return;

// カスタマイザーまたはACFからデータ取得
$services = [];

// カスタマイザーから取得を試みる
$has_customizer_data = false;
for ($i = 1; $i <= 4; $i++) {
    $service_title = get_theme_mod("service_{$i}_title");
    if (!empty($service_title)) {
        $has_customizer_data = true;
        $image_id = get_theme_mod("service_{$i}_image");
        $image_url = $image_id ? wp_get_attachment_url($image_id) : '';
        $image_meta = $image_id ? wp_get_attachment_metadata($image_id) : null;

        $services[] = [
            'image' => $image_url ? [
                'url' => $image_url,
                'width' => $image_meta['width'] ?? 800,
                'height' => $image_meta['height'] ?? 600,
            ] : null,
            'title' => $service_title,
            'alt_text' => get_theme_mod("service_{$i}_alt", ''),
            'link' => get_theme_mod("service_{$i}_link", '#'),
        ];
    }
}

// カスタマイザーにデータがなければACFから取得
if (!$has_customizer_data) {
    $acf_services = get_field('services_list', $page_id);
    if ($acf_services) {
        $services = $acf_services;
    }
}

if (empty($services)) return;
?>

<section class="services-section animate-on-scroll py-16 md:py-24">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">事業内容</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($services as $index => $service): ?>
                <a
                    href="<?php echo esc_url($service['link']); ?>"
                    class="service-card card-hover group relative overflow-hidden rounded-lg shadow-lg transition-all duration-300 aspect-[4/3]"
                >
                    <?php if ($service['image']): ?>
                        <img
                            src="<?php echo esc_url($service['image']['url']); ?>"
                            alt="<?php echo esc_attr($service['alt_text'] ?: $service['title']); ?>"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            loading="lazy"
                            width="<?php echo esc_attr($service['image']['width']); ?>"
                            height="<?php echo esc_attr($service['image']['height']); ?>"
                        >
                    <?php endif; ?>

                    <!-- オーバーレイ -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent group-hover:from-black/90 transition-all duration-300"></div>

                    <!-- タイトル -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <h3 class="text-xl font-bold mb-2 group-hover:translate-y-[-4px] transition-transform duration-300">
                            <?php echo esc_html($service['title']); ?>
                        </h3>
                        <span class="text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            詳しく見る →
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
