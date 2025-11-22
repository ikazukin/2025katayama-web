<?php
/**
 * Template Part: BENEFITS Section (福利厚生)
 * 新卒採用ページ - 福利厚生セクション
 */

$benefits = get_field('benefits');

if (!$benefits) return;
?>

<section id="benefits" class="benefits-section py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-sm font-semibold text-katayama-blue uppercase tracking-wide mb-4">
                BENEFITS
            </h2>
            <h3 class="text-3xl md:text-4xl font-bold mb-6">
                福利厚生
            </h3>
            <p class="text-gray-700 max-w-2xl mx-auto">
                長く安心して働ける環境を整えています
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php foreach ($benefits as $index => $benefit): ?>
                <div class="text-center fade-in-up" style="animation-delay: <?php echo esc_attr($index * 0.1); ?>s;">
                    <?php if (!empty($benefit['icon'])): ?>
                        <div class="mb-4 flex justify-center">
                            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center">
                                <img
                                    src="<?php echo esc_url($benefit['icon']['url']); ?>"
                                    alt="<?php echo esc_attr($benefit['icon']['alt'] ?: $benefit['title']); ?>"
                                    class="w-12 h-12 object-contain"
                                >
                            </div>
                        </div>
                    <?php endif; ?>

                    <h4 class="text-xl font-bold mb-4">
                        <?php echo esc_html($benefit['title']); ?>
                    </h4>

                    <?php if (!empty($benefit['description'])): ?>
                        <div class="text-gray-700 text-sm leading-relaxed prose max-w-none prose-p:text-sm">
                            <?php echo wp_kses_post($benefit['description']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
