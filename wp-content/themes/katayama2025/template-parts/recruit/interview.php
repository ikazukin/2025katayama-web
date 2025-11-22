<?php
/**
 * Template Part: INTERVIEW Section (社員インタビュー)
 * 新卒採用ページ - 社員インタビューセクション
 */

$interviews = get_field('interviews');

if (!$interviews) return;
?>

<section id="interview" class="interview-section py-16 md:py-24 bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-sm font-semibold text-katayama-blue uppercase tracking-wide mb-4">
                INTERVIEW
            </h2>
            <h3 class="text-3xl md:text-4xl font-bold mb-6">
                社員インタビュー
            </h3>
            <p class="text-gray-700 max-w-2xl mx-auto">
                実際に働いている先輩社員の声をご紹介します
            </p>
        </div>

        <div class="space-y-16">
            <?php foreach ($interviews as $index => $interview): ?>
                <div class="bg-white shadow-xl overflow-hidden fade-in-up" style="animation-delay: <?php echo esc_attr($index * 0.1); ?>s;">
                    <!-- プロフィール -->
                    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-8">
                        <div class="flex flex-col md:flex-row items-center gap-6">
                            <?php if (!empty($interview['photo'])): ?>
                                <div class="flex-shrink-0">
                                    <img
                                        src="<?php echo esc_url($interview['photo']['url']); ?>"
                                        alt="<?php echo esc_attr($interview['name']); ?>"
                                        class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg"
                                    >
                                </div>
                            <?php endif; ?>

                            <div class="text-center md:text-left">
                                <h4 class="text-2xl font-bold mb-2">
                                    <?php echo esc_html($interview['name']); ?>
                                </h4>
                                <div class="text-blue-100">
                                    <?php if (!empty($interview['year'])): ?>
                                        <span><?php echo esc_html($interview['year']); ?>年入社</span>
                                    <?php endif; ?>
                                    <?php if (!empty($interview['position'])): ?>
                                        <span class="ml-4"><?php echo esc_html($interview['position']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Q&A -->
                    <?php if (!empty($interview['qa'])): ?>
                        <div class="p-8 space-y-6">
                            <?php foreach ($interview['qa'] as $qa_index => $qa): ?>
                                <div class="border-l-4 border-katayama-blue pl-6">
                                    <h5 class="text-lg font-semibold text-gray-900 mb-3">
                                        Q. <?php echo esc_html($qa['question']); ?>
                                    </h5>
                                    <div class="text-gray-700 prose max-w-none">
                                        <?php echo wp_kses_post($qa['answer']); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- 社員インタビュー詳細ページへのリンク -->
        <div class="text-center mt-12 fade-in-up">
            <a
                href="/recruit/interview"
                class="inline-block bg-white hover:bg-gray-100 text-blue-600 px-8 py-4 rounded-full font-semibold transition-all hover:scale-105 shadow-lg"
            >
                もっと詳しく社員の声を聞く →
            </a>
        </div>
    </div>
</section>
