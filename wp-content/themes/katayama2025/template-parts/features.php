<?php
/**
 * Template Part: Features Section
 * 特徴セクション
 */

$page_id = get_option('page_on_front');
if (!$page_id) return;

$features = get_field('features_list', $page_id);
if (!$features) return;
?>

<section class="features-section py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">私たちの強み</h2>
            <p class="text-gray-600">カタヤマが選ばれる3つの理由</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php foreach ($features as $index => $feature): ?>
                <div class="feature-card bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow fade-in-up" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                    <?php if ($feature['icon']): ?>
                        <div class="mb-6">
                            <img
                                src="<?php echo esc_url($feature['icon']['url']); ?>"
                                alt="<?php echo esc_attr($feature['title']); ?>"
                                class="w-16 h-16 mx-auto object-contain"
                            >
                        </div>
                    <?php endif; ?>

                    <h3 class="text-xl font-bold mb-4 text-center">
                        <?php echo esc_html($feature['title']); ?>
                    </h3>

                    <p class="text-gray-600 text-center leading-relaxed">
                        <?php echo nl2br(esc_html($feature['description'])); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
