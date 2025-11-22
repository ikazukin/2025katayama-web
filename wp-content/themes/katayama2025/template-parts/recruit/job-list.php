<?php
/**
 * Template Part: RECRUIT Section (募集要項)
 * 新卒採用ページ - 募集要項セクション
 */

$recruit_jobs = get_field('recruit_jobs');

if (!$recruit_jobs) return;
?>

<section id="recruit" class="recruit-section py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-sm font-semibold text-katayama-blue uppercase tracking-wide mb-4">
                RECRUIT
            </h2>
            <h3 class="text-3xl md:text-4xl font-bold mb-6">
                募集要項
            </h3>
        </div>

        <div class="max-w-5xl mx-auto space-y-8">
            <?php foreach ($recruit_jobs as $index => $job): ?>
                <div class="bg-gray-50 shadow-md overflow-hidden fade-in-up" style="animation-delay: <?php echo esc_attr($index * 0.1); ?>s;">
                    <!-- ヘッダー -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h4 class="text-2xl font-bold mb-2">
                                    <?php echo esc_html($job['title']); ?>
                                </h4>
                                <?php if (!empty($job['type'])): ?>
                                    <span class="inline-block bg-white/20 px-4 py-1 rounded-full text-sm">
                                        <?php
                                        $type_labels = [
                                            'shinsotsu' => '新卒',
                                            'seishain' => '正社員'
                                        ];
                                        echo esc_html($type_labels[$job['type']] ?? $job['type']);
                                        ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($job['salary'])): ?>
                                <div class="text-right">
                                    <div class="text-sm text-blue-100">月給</div>
                                    <div class="text-2xl font-bold"><?php echo esc_html($job['salary']); ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- 詳細 -->
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php if (!empty($job['location'])): ?>
                                <div>
                                    <h5 class="text-sm font-semibold text-gray-500 uppercase mb-2">勤務地</h5>
                                    <p class="text-gray-900"><?php echo esc_html($job['location']); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($job['count'])): ?>
                                <div>
                                    <h5 class="text-sm font-semibold text-gray-500 uppercase mb-2">募集人数</h5>
                                    <p class="text-gray-900"><?php echo esc_html($job['count']); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($job['requirements'])): ?>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-500 uppercase mb-2">応募資格</h5>
                                <div class="text-gray-700 prose max-w-none">
                                    <?php echo wp_kses_post($job['requirements']); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($job['details'])): ?>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-500 uppercase mb-2">詳細</h5>
                                <div class="text-gray-700 prose max-w-none">
                                    <?php echo wp_kses_post($job['details']); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- エントリーボタン -->
        <div class="text-center mt-12 fade-in-up">
            <a
                href="#entry-form"
                class="inline-block bg-katayama-blue hover:bg-orange-600 text-white px-12 py-5 rounded-full font-bold text-lg transition-all hover:scale-105 shadow-xl"
            >
                エントリーはこちら →
            </a>
        </div>
    </div>
</section>
