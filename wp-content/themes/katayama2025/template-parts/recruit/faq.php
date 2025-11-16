<?php
/**
 * Template Part: FAQ Section (よくある質問)
 * 新卒採用ページ - よくある質問セクション
 */

$faq = get_field('faq');

if (!$faq) return;
?>

<section id="faq" class="faq-section py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-sm font-semibold text-katayama-orange uppercase tracking-wide mb-4">
                FAQ
            </h2>
            <h3 class="text-3xl md:text-4xl font-bold mb-6">
                よくある質問
            </h3>
        </div>

        <div class="max-w-4xl mx-auto space-y-4">
            <?php foreach ($faq as $index => $item): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden fade-in-up" style="animation-delay: <?php echo esc_attr($index * 0.05); ?>s;">
                    <!-- アコーディオンヘッダー -->
                    <button
                        class="faq-toggle w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition-colors"
                        aria-expanded="false"
                        data-index="<?php echo esc_attr($index); ?>"
                    >
                        <span class="font-semibold text-lg pr-4">
                            Q. <?php echo esc_html($item['question']); ?>
                        </span>
                        <svg class="faq-icon w-6 h-6 flex-shrink-0 text-katayama-orange transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- アコーディオンコンテンツ -->
                    <div class="faq-content hidden" data-index="<?php echo esc_attr($index); ?>">
                        <div class="p-6 pt-0 text-gray-700 prose max-w-none">
                            <?php echo wp_kses_post($item['answer']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
// FAQ アコーディオン
document.addEventListener('DOMContentLoaded', function() {
    const toggles = document.querySelectorAll('.faq-toggle');

    toggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const index = this.dataset.index;
            const content = document.querySelector(`.faq-content[data-index="${index}"]`);
            const icon = this.querySelector('.faq-icon');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            // トグル
            if (isExpanded) {
                content.classList.add('hidden');
                this.setAttribute('aria-expanded', 'false');
                icon.style.transform = 'rotate(0deg)';
            } else {
                content.classList.remove('hidden');
                this.setAttribute('aria-expanded', 'true');
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });
});
</script>
