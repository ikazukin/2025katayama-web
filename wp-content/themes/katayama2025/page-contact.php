<?php
/**
 * Template Name: Contact Page (お問い合わせページ)
 * Template for displaying contact page with LINE integration
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
            <div class="container mx-auto px-4 py-12">
                <!-- ページタイトル -->
                <h1 class="text-4xl md:text-5xl font-bold text-center mb-8">
                    <?php the_title(); ?>
                </h1>

                <?php
                // LINE公式アカウント情報を取得
                $line_url = get_field('contact_line_url');
                $line_qr = get_field('contact_line_qr');

                if ($line_url || $line_qr): ?>
                <!-- LINE公式アカウントセクション -->
                <section class="line-section bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-8 md:p-12 mb-12">
                    <div class="max-w-3xl mx-auto">
                        <div class="text-center mb-8">
                            <div class="inline-block bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                                LINE公式アカウント
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                                LINEで簡単お問い合わせ
                            </h2>
                            <p class="text-lg text-gray-700">
                                お気軽にご相談ください。営業時間外でもメッセージを送信いただけます。
                            </p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8 items-center">
                            <!-- QRコード -->
                            <?php if ($line_qr): ?>
                            <div class="flex flex-col items-center">
                                <div class="bg-white p-6 rounded-xl shadow-lg">
                                    <img
                                        src="<?php echo esc_url($line_qr['url']); ?>"
                                        alt="LINE QRコード"
                                        class="w-64 h-64 object-contain"
                                    >
                                </div>
                                <p class="mt-4 text-sm text-gray-600 text-center">
                                    スマホでQRコードを読み取ってください
                                </p>
                            </div>
                            <?php endif; ?>

                            <!-- 友だち追加ボタン -->
                            <div class="flex flex-col items-center justify-center">
                                <?php if ($line_url): ?>
                                <a
                                    href="<?php echo esc_url($line_url); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white font-bold text-lg px-8 py-4 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 mb-4"
                                >
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                                    </svg>
                                    <span>友だち追加</span>
                                </a>
                                <?php endif; ?>

                                <div class="text-center space-y-2">
                                    <p class="text-sm text-gray-600">
                                        📱 スマートフォンからは<br class="md:hidden">こちらをタップ
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        💻 PCの場合はQRコードを<br class="md:hidden">読み取ってください
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- LINE追加のメリット -->
                        <div class="mt-8 grid md:grid-cols-3 gap-4 text-center">
                            <div class="bg-white/70 rounded-lg p-4">
                                <div class="text-2xl mb-2">⏰</div>
                                <h3 class="font-semibold text-sm mb-1">24時間受付</h3>
                                <p class="text-xs text-gray-600">営業時間外でもOK</p>
                            </div>
                            <div class="bg-white/70 rounded-lg p-4">
                                <div class="text-2xl mb-2">💬</div>
                                <h3 class="font-semibold text-sm mb-1">気軽に相談</h3>
                                <p class="text-xs text-gray-600">チャット形式で簡単</p>
                            </div>
                            <div class="bg-white/70 rounded-lg p-4">
                                <div class="text-2xl mb-2">📸</div>
                                <h3 class="font-semibold text-sm mb-1">写真送信可能</h3>
                                <p class="text-xs text-gray-600">現場の様子を共有</p>
                            </div>
                        </div>
                    </div>
                </section>
                <?php endif; ?>

                <!-- お問い合わせフォーム -->
                <div class="entry-content prose prose-lg max-w-none mt-12">
                    <?php the_content(); ?>
                </div>

            </div>
        </article>
    <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
