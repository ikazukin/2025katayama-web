<?php
/**
 * Template Part: ENTRY FORM Section (エントリーフォーム)
 * 新卒採用ページ - エントリーフォームセクション
 *
 * NOTE: Contact Form 7 が必要です (Issue #15で実装予定)
 * 一時的にプレースホルダーを表示します
 */
?>

<section id="entry-form" class="entry-form-section py-16 md:py-24 bg-gradient-to-br from-blue-50 to-blue-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 fade-in-up">
            <h2 class="text-sm font-semibold text-katayama-blue uppercase tracking-wide mb-4">
                ENTRY
            </h2>
            <h3 class="text-3xl md:text-4xl font-bold mb-6">
                エントリーフォーム
            </h3>
            <p class="text-gray-700 max-w-2xl mx-auto">
                下記フォームよりエントリーいただけます。<br>
                ご不明な点がございましたら、お気軽にお問い合わせください。
            </p>
        </div>

        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-xl p-8 md:p-12 fade-in-up">
            <?php
            // Contact Form 7 ショートコード
            // Issue #15で実装完了
            if (function_exists('wpcf7_contact_form')) {
                echo do_shortcode('[contact-form-7 id="35" title="新卒採用エントリーフォーム"]');
            } else {
                // Contact Form 7 がインストールされていない場合のフォールバック
                ?>
                <div class="text-center p-12 bg-yellow-50 rounded-lg border-2 border-yellow-200">
                    <svg class="w-16 h-16 mx-auto mb-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <h4 class="text-xl font-bold mb-2 text-gray-900">エントリーフォーム準備中</h4>
                    <p class="text-gray-700 mb-4">
                        Contact Form 7 プラグインがインストールされていません。<br>
                        プラグインをインストールしてください。
                    </p>
                </div>
                <?php
            }
            ?>

            <!-- フォームの下部情報 -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h5 class="font-semibold mb-4">お問い合わせ先</h5>
                <div class="space-y-2 text-gray-700">
                    <p>
                        <strong>株式会社カタヤマ 採用担当</strong>
                    </p>
                    <p>
                        〒242-0002<br>
                        神奈川県大和市つきみ野2-1-9
                    </p>
                    <p>
                        TEL: <a href="tel:0120-29-6506" class="text-blue-600 hover:underline">0120-29-6506</a>
                    </p>
                    <p>
                        営業時間: 平日 8:30〜17:30
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
