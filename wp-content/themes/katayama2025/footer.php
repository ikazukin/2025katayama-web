<footer class="footer bg-gray-900 text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
        <!-- デスクトップ: 3カラム -->
        <div class="hidden md:grid md:grid-cols-3 gap-12 mb-12">
            <!-- 会社関連 -->
            <div class="footer-column">
                <h3 class="text-xl font-bold mb-6 border-b-2 border-katayama-blue pb-2">
                    会社情報
                </h3>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer-company',
                    'container' => 'nav',
                    'menu_class' => 'space-y-3',
                    'fallback_cb' => false,
                ]);
                ?>
            </div>

            <!-- 事業関連 -->
            <div class="footer-column">
                <h3 class="text-xl font-bold mb-6 border-b-2 border-katayama-blue pb-2">
                    事業内容
                </h3>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer-services',
                    'container' => 'nav',
                    'menu_class' => 'space-y-3',
                    'fallback_cb' => false,
                ]);
                ?>
            </div>

            <!-- 採用・問い合わせ -->
            <div class="footer-column">
                <h3 class="text-xl font-bold mb-6 border-b-2 border-katayama-blue pb-2">
                    採用・お問い合わせ
                </h3>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer-contact',
                    'container' => 'nav',
                    'menu_class' => 'space-y-3',
                    'fallback_cb' => false,
                ]);
                ?>

                <!-- 連絡先 -->
                <div class="mt-8 space-y-4">
                    <a href="tel:0120-XXX-XXX" class="flex items-center gap-2 hover:text-katayama-blue transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        <span class="font-semibold">0120-XXX-XXX</span>
                    </a>

                    <a href="mailto:info@example.com" class="flex items-center gap-2 hover:text-katayama-blue transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        <span>お問い合わせ</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- モバイル: アコーディオン -->
        <div class="md:hidden space-y-4 mb-12">
            <!-- 会社関連 -->
            <div class="footer-accordion border-b border-gray-700">
                <button class="accordion-trigger w-full text-left py-4 flex justify-between items-center font-bold" data-target="company">
                    <span>会社情報</span>
                    <svg class="w-5 h-5 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="accordion-content hidden pb-4" id="company">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-company',
                        'container' => 'nav',
                        'menu_class' => 'space-y-3',
                        'fallback_cb' => false,
                    ]);
                    ?>
                </div>
            </div>

            <!-- 事業関連 -->
            <div class="footer-accordion border-b border-gray-700">
                <button class="accordion-trigger w-full text-left py-4 flex justify-between items-center font-bold" data-target="services">
                    <span>事業内容</span>
                    <svg class="w-5 h-5 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="accordion-content hidden pb-4" id="services">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-services',
                        'container' => 'nav',
                        'menu_class' => 'space-y-3',
                        'fallback_cb' => false,
                    ]);
                    ?>
                </div>
            </div>

            <!-- 採用・問い合わせ -->
            <div class="footer-accordion border-b border-gray-700">
                <button class="accordion-trigger w-full text-left py-4 flex justify-between items-center font-bold" data-target="contact">
                    <span>採用・お問い合わせ</span>
                    <svg class="w-5 h-5 transform transition-transform" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div class="accordion-content hidden pb-4" id="contact">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-contact',
                        'container' => 'nav',
                        'menu_class' => 'space-y-3',
                        'fallback_cb' => false,
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <!-- コピーライト -->
        <div class="border-t border-gray-700 pt-8 text-center text-gray-400">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<!-- ページトップボタン -->
<button id="page-top" class="fixed bottom-8 right-8 w-12 h-12 bg-katayama-blue rounded-full shadow-lg hover:shadow-xl transition-all opacity-0 invisible" aria-label="ページトップへ戻る">
    <svg class="w-6 h-6 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
    </svg>
</button>

<?php wp_footer(); ?>
</body>
</html>
