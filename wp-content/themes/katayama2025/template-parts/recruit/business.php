<?php
/**
 * Template Part: BUSINESS Section (事業内容)
 * 新卒採用ページ - 事業内容セクション
 */

$motto = get_field('business_motto');
$business_list = get_field('business_list');

if (!$business_list) return;
?>

<section id="business" class="business-section py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-sm font-semibold text-katayama-blue uppercase tracking-wide mb-4">
                BUSINESS
            </h2>

            <?php if ($motto): ?>
                <h3 class="text-3xl md:text-4xl font-bold mb-6">
                    <?php echo esc_html($motto); ?>
                </h3>
            <?php endif; ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php foreach ($business_list as $index => $business): ?>
                <div class="bg-white p-8 shadow-md fade-in-up hover:shadow-xl transition-shadow" style="animation-delay: <?php echo esc_attr($index * 0.1); ?>s;">
                    <?php if (!empty($business['icon'])): ?>
                        <div class="mb-4">
                            <img
                                src="<?php echo esc_url($business['icon']['url']); ?>"
                                alt="<?php echo esc_attr($business['icon']['alt'] ?: $business['name']); ?>"
                                class="w-16 h-16 object-contain"
                            >
                        </div>
                    <?php endif; ?>

                    <h4 class="text-2xl font-bold mb-4">
                        <?php echo esc_html($business['name']); ?>
                    </h4>

                    <?php if (!empty($business['description'])): ?>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                            <?php echo esc_html($business['description']); ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
