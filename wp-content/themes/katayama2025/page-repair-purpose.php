<?php
/**
 * Template Name: 大規模修繕の目的
 * 大規模修繕工事の目的ページ
 */

get_header();
?>

<main id="primary" class="site-main repair-subpage purpose-page">
    <!-- パンくずリスト -->
    <div class="breadcrumb-section bg-gray-50 py-3 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="text-sm text-gray-600">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-katayama-blue">ホーム</a>
                <span class="mx-2">/</span>
                <a href="<?php echo esc_url(home_url('/repair/')); ?>" class="hover:text-katayama-blue">大規模修繕工事</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-semibold">大規模修繕の目的</span>
            </nav>
        </div>
    </div>

    <!-- サブページナビゲーション -->
    <nav class="subpage-navigation bg-gray-100 border-b border-gray-200 py-3 sticky top-20 z-40">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <a href="<?php echo esc_url(home_url('/repair/')); ?>" class="text-katayama-blue hover:text-katayama-blue-dark font-semibold flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    大規模修繕工事
                </a>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-katayama-blue text-white px-4 py-2 rounded font-semibold">大規模修繕の目的</span>
                    <a href="<?php echo esc_url(home_url('/repair/before-construction/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">工事前の流れ</a>
                    <a href="<?php echo esc_url(home_url('/repair/under-construction/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">工事時の流れ</a>
                    <a href="<?php echo esc_url(home_url('/repair/choose/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">業者選定方法</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ページヘッダー -->
    <section class="page-header bg-gradient-to-br from-katayama-blue to-blue-900 text-white py-16 md:py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 fade-in-up">大規模修繕の目的</h1>
            <p class="text-xl max-w-3xl mx-auto fade-in-up" style="transition-delay: 0.2s;">
                なぜ大規模修繕が必要なのか、その意義と重要性をご説明します
            </p>
        </div>
    </section>

    <!-- メインコンテンツ -->
    <section class="content-section py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">

                <!-- セクション1: マンションの劣化 -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-6 text-katayama-blue">鉄筋マンション、頑丈そうにみえるけど…</h2>
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            「入居時に50年は耐久保障」と聞いていたマンション。しかし、時間とともに、ゆっくりと劣化が進行しています。
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            コンクリートは経年とともにひび割れが発生し、そこから雨水が浸入します。鉄筋が錆びると膨張し、さらにコンクリートを破壊する悪循環に陥ります。
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            外壁の塗装も紫外線や風雨にさらされ、防水機能が低下していきます。これらの劣化を放置すると、建物の寿命を大幅に縮めてしまいます。
                        </p>
                    </div>
                </div>

                <!-- セクション2: 長期修繕計画 -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-6 text-katayama-blue">長期修繕計画の重要性</h2>
                    <div class="bg-blue-50 border-l-4 border-katayama-blue p-6 mb-6">
                        <p class="text-gray-800 font-semibold mb-2">長期修繕計画とは？</p>
                        <p class="text-gray-700">
                            マンションの各部位がいつ頃劣化し、いつ修繕が必要になるかを予測し、計画的に修繕工事を実施するための計画です。
                        </p>
                    </div>
                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 leading-relaxed mb-4">
                            一般的に、大規模修繕工事は12〜15年周期で実施されます。これは、外壁塗装や防水工事などの主要な修繕項目の耐用年数を考慮した周期です。
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            計画的に修繕を行うことで、突発的な大規模な補修を避け、修繕費用を平準化し、建物の資産価値を維持することができます。
                        </p>
                    </div>
                </div>

                <!-- セクション3: 大規模修繕の目的 -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-8 text-katayama-blue">大規模修繕工事の3つの目的</h2>
                    <div class="space-y-6">
                        <div class="flex items-start border-l-4 border-katayama-blue pl-6 py-2">
                            <div class="flex-shrink-0 w-12 h-12 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-xl mr-4">1</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">建物の機能・性能の回復</h3>
                                <p class="text-gray-600">
                                    経年劣化により低下した防水性能や断熱性能などを、新築時の状態に近づけます。
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start border-l-4 border-katayama-blue pl-6 py-2">
                            <div class="flex-shrink-0 w-12 h-12 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-xl mr-4">2</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">建物の資産価値の維持・向上</h3>
                                <p class="text-gray-600">
                                    適切な時期に適切な修繕を行うことで、マンションの資産価値を維持し、場合によっては向上させることができます。
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start border-l-4 border-katayama-blue pl-6 py-2">
                            <div class="flex-shrink-0 w-12 h-12 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-xl mr-4">3</div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">居住者の安全・快適性の確保</h3>
                                <p class="text-gray-600">
                                    外壁の剥落防止や防水性能の回復により、居住者の安全と快適な住環境を守ります。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- セクション4: カタヤマの強み -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-6 text-katayama-blue">カタヤマが大規模修繕で選ばれる理由</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue">40年の実績</h3>
                            <p class="text-gray-600">創業以来、神奈川・東京エリアで1,200棟以上の大規模修繕工事を手がけてきました。</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue">労災事故0件</h3>
                            <p class="text-gray-600">徹底した安全管理により、創業以来一度も労災事故を起こしていません。</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue">ISO認証取得</h3>
                            <p class="text-gray-600">ISO9001・14001を取得し、品質と環境に配慮した施工を実施しています。</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue">充実したアフターフォロー</h3>
                            <p class="text-gray-600">工事完了後も定期点検を実施し、長期的にサポートします。</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- お問い合わせCTA -->
    <section class="cta-section py-16 bg-gray-50 text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-katayama-blue">大規模修繕のご相談はこちら</h2>
            <p class="text-lg mb-8 text-gray-600 max-w-2xl mx-auto">
                お見積りやご相談は無料です。お気軽にお問い合わせください。
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                <a
                    href="<?php echo esc_url(home_url('/contact/')); ?>"
                    class="inline-block bg-katayama-blue text-white px-10 py-4 text-lg font-bold rounded-lg hover:bg-katayama-blue-dark transition-all duration-300 shadow-lg hover:shadow-xl"
                >
                    お問い合わせはこちら →
                </a>
                <a
                    href="<?php echo esc_url(home_url('/estimate/')); ?>"
                    class="inline-block bg-transparent text-katayama-blue border-2 border-katayama-blue px-10 py-4 text-lg font-bold rounded-lg hover:bg-katayama-blue hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl"
                >
                    概算見積もりシミュレーター →
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
