<?php
/**
 * Template Name: 工事前の流れ
 * 大規模修繕工事前の流れページ
 */

get_header();
?>

<main id="primary" class="site-main repair-subpage before-construction-page">
    <!-- パンくずリスト -->
    <div class="breadcrumb-section bg-gray-50 py-3 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="text-sm text-gray-600">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-katayama-blue">ホーム</a>
                <span class="mx-2">/</span>
                <a href="<?php echo esc_url(home_url('/repair/')); ?>" class="hover:text-katayama-blue">大規模修繕工事</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-semibold">工事前の流れ</span>
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
                    <a href="<?php echo esc_url(home_url('/repair/purpose/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">大規模修繕の目的</a>
                    <span class="bg-katayama-blue text-white px-4 py-2 rounded font-semibold">工事前の流れ</span>
                    <a href="<?php echo esc_url(home_url('/repair/under-construction/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">工事時の流れ</a>
                    <a href="<?php echo esc_url(home_url('/repair/choose/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">業者選定方法</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ページヘッダー -->
    <section class="page-header bg-gradient-to-br from-katayama-blue to-blue-900 text-white py-16 md:py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 fade-in-up">工事前の流れ</h1>
            <p class="text-xl max-w-3xl mx-auto fade-in-up" style="transition-delay: 0.2s;">
                工事開始前の準備、説明会、スケジュール確認などの流れをご案内します
            </p>
        </div>
    </section>

    <!-- メインコンテンツ -->
    <section class="content-section py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">

                <!-- 導入文 -->
                <div class="content-block mb-16 fade-in-up text-center">
                    <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto">
                        大規模修繕工事を円滑に進めるためには、工事前の準備が非常に重要です。<br>
                        カタヤマでは、入念な事前調査から居住者説明会まで、丁寧にサポートいたします。
                    </p>
                </div>

                <!-- フローステップ -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-12 text-katayama-blue text-center">工事前の8ステップ</h2>

                    <div class="space-y-8">
                        <!-- STEP 1 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-20 h-20 bg-katayama-blue text-white rounded-full flex flex-col items-center justify-center font-bold mr-6">
                                <span class="text-xs">STEP</span>
                                <span class="text-2xl">1</span>
                            </div>
                            <div class="flex-1 bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-2xl font-bold mb-3 text-katayama-blue">お問い合わせ・ご相談</h3>
                                <p class="text-gray-700 leading-relaxed mb-3">
                                    まずはお気軽にお問い合わせください。電話、メール、お問い合わせフォームから受け付けております。
                                </p>
                                <p class="text-sm text-gray-600">
                                    ※この段階では費用は一切かかりません
                                </p>
                            </div>
                        </div>

                        <!-- STEP 2 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-20 h-20 bg-katayama-blue text-white rounded-full flex flex-col items-center justify-center font-bold mr-6">
                                <span class="text-xs">STEP</span>
                                <span class="text-2xl">2</span>
                            </div>
                            <div class="flex-1 bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-2xl font-bold mb-3 text-katayama-blue">現地調査・建物診断</h3>
                                <p class="text-gray-700 leading-relaxed mb-3">
                                    専門スタッフが現地を訪問し、建物の劣化状況を詳細に調査します。外壁のひび割れ、鉄部の錆、防水層の状態などを確認します。
                                </p>
                                <ul class="list-disc list-inside text-gray-600 space-y-1">
                                    <li>外壁の打診調査（浮き・剥離の確認）</li>
                                    <li>コンクリートの中性化試験</li>
                                    <li>防水層の劣化状況確認</li>
                                    <li>鉄部の錆・腐食確認</li>
                                </ul>
                            </div>
                        </div>

                        <!-- STEP 3 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-20 h-20 bg-katayama-blue text-white rounded-full flex flex-col items-center justify-center font-bold mr-6">
                                <span class="text-xs">STEP</span>
                                <span class="text-2xl">3</span>
                            </div>
                            <div class="flex-1 bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-2xl font-bold mb-3 text-katayama-blue">修繕計画の立案</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    調査結果をもとに、最適な修繕計画を立案します。優先順位や工事範囲、工法などを検討し、長期的な視点で建物を守るプランをご提案します。
                                </p>
                            </div>
                        </div>

                        <!-- STEP 4 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-20 h-20 bg-katayama-blue text-white rounded-full flex flex-col items-center justify-center font-bold mr-6">
                                <span class="text-xs">STEP</span>
                                <span class="text-2xl">4</span>
                            </div>
                            <div class="flex-1 bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-2xl font-bold mb-3 text-katayama-blue">お見積りのご提示</h3>
                                <p class="text-gray-700 leading-relaxed mb-3">
                                    修繕計画に基づいた詳細なお見積りをご提示します。工事内容、使用材料、工期、費用の内訳を明確にご説明いたします。
                                </p>
                                <p class="text-sm text-gray-600">
                                    ※お見積りは無料です。ご納得いただけるまで何度でもご相談ください
                                </p>
                            </div>
                        </div>

                        <!-- STEP 5 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-20 h-20 bg-katayama-blue text-white rounded-full flex flex-col items-center justify-center font-bold mr-6">
                                <span class="text-xs">STEP</span>
                                <span class="text-2xl">5</span>
                            </div>
                            <div class="flex-1 bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-2xl font-bold mb-3 text-katayama-blue">ご契約</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    内容にご納得いただけましたら、正式にご契約となります。契約書の内容を丁寧にご説明し、ご不明な点がないか確認させていただきます。
                                </p>
                            </div>
                        </div>

                        <!-- STEP 6 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-20 h-20 bg-katayama-blue text-white rounded-full flex flex-col items-center justify-center font-bold mr-6">
                                <span class="text-xs">STEP</span>
                                <span class="text-2xl">6</span>
                            </div>
                            <div class="flex-1 bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-2xl font-bold mb-3 text-katayama-blue">居住者説明会の開催</h3>
                                <p class="text-gray-700 leading-relaxed mb-3">
                                    工事開始前に、居住者の皆様に向けた説明会を開催します。工事内容、スケジュール、日常生活への影響などを詳しくご説明します。
                                </p>
                                <ul class="list-disc list-inside text-gray-600 space-y-1">
                                    <li>工事内容と工期の説明</li>
                                    <li>騒音・振動が発生する時間帯</li>
                                    <li>ベランダ使用制限について</li>
                                    <li>駐車場・駐輪場の利用について</li>
                                    <li>緊急連絡先のご案内</li>
                                </ul>
                            </div>
                        </div>

                        <!-- STEP 7 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-20 h-20 bg-katayama-blue text-white rounded-full flex flex-col items-center justify-center font-bold mr-6">
                                <span class="text-xs">STEP</span>
                                <span class="text-2xl">7</span>
                            </div>
                            <div class="flex-1 bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-2xl font-bold mb-3 text-katayama-blue">近隣へのご挨拶</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    工事開始前に、近隣の皆様へご挨拶に伺います。工事期間中のご理解とご協力をお願いし、円滑な工事進行を目指します。
                                </p>
                            </div>
                        </div>

                        <!-- STEP 8 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-20 h-20 bg-katayama-blue text-white rounded-full flex flex-col items-center justify-center font-bold mr-6">
                                <span class="text-xs">STEP</span>
                                <span class="text-2xl">8</span>
                            </div>
                            <div class="flex-1 bg-gray-50 p-6 rounded-lg">
                                <h3 class="text-2xl font-bold mb-3 text-katayama-blue">仮設工事・準備</h3>
                                <p class="text-gray-700 leading-relaxed mb-3">
                                    足場の組立、養生シートの設置、仮設トイレ・事務所の設置など、本格的な工事に向けた準備を行います。
                                </p>
                                <p class="text-sm text-gray-600">
                                    ※この段階から、いよいよ本格的な工事がスタートします
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- カタヤマの安心ポイント -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-8 text-katayama-blue">カタヤマの安心ポイント</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 p-6 rounded-lg text-center">
                            <div class="text-5xl mb-4">📋</div>
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue">詳細な診断報告書</h3>
                            <p class="text-gray-600 text-sm">
                                調査結果を写真付きの詳細な報告書にまとめ、建物の現状を分かりやすくご説明します。
                            </p>
                        </div>
                        <div class="bg-blue-50 p-6 rounded-lg text-center">
                            <div class="text-5xl mb-4">💬</div>
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue">丁寧な説明</h3>
                            <p class="text-gray-600 text-sm">
                                専門用語を避け、分かりやすい言葉で工事内容をご説明。ご不明点があれば何度でもお答えします。
                            </p>
                        </div>
                        <div class="bg-blue-50 p-6 rounded-lg text-center">
                            <div class="text-5xl mb-4">📞</div>
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue">迅速な対応</h3>
                            <p class="text-gray-600 text-sm">
                                お問い合わせから現地調査、お見積り提示まで、スピーディーに対応いたします。
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- お問い合わせCTA -->
    <section class="cta-section py-16 bg-gray-50 text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-katayama-blue">まずは無料相談から</h2>
            <p class="text-lg mb-8 text-gray-600 max-w-2xl mx-auto">
                現地調査・お見積りは無料です。お気軽にお問い合わせください。
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
