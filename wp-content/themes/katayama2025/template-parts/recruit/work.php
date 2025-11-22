<?php
/**
 * Template Part: WORK Section (仕事内容)
 * 新卒採用ページ - 仕事内容セクション
 */

$title = get_field('work_title');
$jobs = get_field('work_jobs');

if (!$jobs) return;
?>

<section id="work" class="work-section py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-sm font-semibold text-katayama-blue uppercase tracking-wide mb-4">
                WORK
            </h2>

            <?php if ($title): ?>
                <h3 class="text-3xl md:text-4xl font-bold mb-6">
                    <?php echo esc_html($title); ?>
                </h3>
            <?php endif; ?>
        </div>

        <div class="space-y-12">
            <?php foreach ($jobs as $index => $job): ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center fade-in-up" style="animation-delay: <?php echo esc_attr($index * 0.1); ?>s;">
                    <!-- 画像エリア -->
                    <?php if (!empty($job['image'])): ?>
                        <div class="<?php echo ($index % 2 === 0) ? 'lg:order-1' : 'lg:order-2'; ?>">
                            <img
                                src="<?php echo esc_url($job['image']['url']); ?>"
                                alt="<?php echo esc_attr($job['image']['alt'] ?: $job['name']); ?>"
                                class="w-full h-[300px] md:h-[400px] object-cover shadow-lg"
                                loading="lazy"
                            >
                        </div>
                    <?php endif; ?>

                    <!-- テキストエリア -->
                    <div class="<?php echo ($index % 2 === 0) ? 'lg:order-2' : 'lg:order-1'; ?>">
                        <h4 class="text-2xl md:text-3xl font-bold mb-4">
                            <?php echo esc_html($job['name']); ?>
                        </h4>

                        <?php if (!empty($job['description'])): ?>
                            <div class="mb-6 text-gray-700 prose max-w-none">
                                <h5 class="text-lg font-semibold mb-2">業務内容</h5>
                                <?php echo wp_kses_post($job['description']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($job['appeal'])): ?>
                            <div class="bg-blue-50 p-6">
                                <h5 class="text-lg font-semibold mb-2 text-blue-900">やりがい</h5>
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                    <?php echo esc_html($job['appeal']); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($index < count($jobs) - 1): ?>
                    <hr class="border-gray-200">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
