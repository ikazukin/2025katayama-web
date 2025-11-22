<?php
/**
 * Template Name: 工事時の流れ
 * 大規模修繕工事中の流れページ
 */

get_header();
?>

<main id="primary" class="site-main repair-subpage under-construction-page">
    <!-- パンくずリスト -->
    <div class="breadcrumb-section bg-gray-50 py-3 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="text-sm text-gray-600">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-katayama-blue">ホーム</a>
                <span class="mx-2">/</span>
                <a href="<?php echo esc_url(home_url('/repair/')); ?>" class="hover:text-katayama-blue">大規模修繕工事</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-semibold">工事時の流れ</span>
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
                    <a href="<?php echo esc_url(home_url('/repair/before-construction/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">工事前の流れ</a>
                    <span class="bg-katayama-blue text-white px-4 py-2 rounded font-semibold">工事時の流れ</span>
                    <a href="<?php echo esc_url(home_url('/repair/choose/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">業者選定方法</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ページヘッダー -->
    <section class="page-header bg-gradient-to-br from-katayama-blue to-blue-900 text-white py-16 md:py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 fade-in-up">工事時の流れ</h1>
            <p class="text-xl max-w-3xl mx-auto fade-in-up" style="transition-delay: 0.2s;">
                実際の工事期間中の作業内容、安全対策、進捗管理についてご説明します
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
                        工事期間中は、居住者の皆様に安心して暮らしていただけるよう、<br>
                        安全管理と丁寧なコミュニケーションを最優先に工事を進めます。
                    </p>
                </div>

                <!-- 工事期間の目安 -->
                <div class="content-block mb-16 fade-in-up">
                    <div class="bg-blue-50 border-l-4 border-katayama-blue p-8 text-center">
                        <h2 class="text-2xl font-bold mb-4 text-katayama-blue">一般的な工事期間</h2>
                        <p class="text-5xl font-bold text-katayama-blue mb-2">3〜6ヶ月</p>
                        <p class="text-gray-600">
                            ※建物の規模や工事内容により異なります。詳しくはお見積り時にご説明いたします。
                        </p>
                    </div>
                </div>

                <!-- 主な工事内容 -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-12 text-katayama-blue text-center">主な工事内容</h2>

                    <div class="space-y-6">
                        <!-- 仮設工事 -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start">
                                <div class="text-4xl mr-4">🏗️</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-katayama-blue">仮設工事（約2週間）</h3>
                                    <p class="text-gray-700 mb-3">
                                        足場の組立、養生シートの設置、仮設トイレ・事務所の設置を行います。この期間中、多少の騒音が発生する場合があります。
                                    </p>
                                    <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
                                        <li>足場組立（外壁工事に必要）</li>
                                        <li>防音・防塵シート設置</li>
                                        <li>工事車両駐車スペース確保</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- 下地補修工事 -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start">
                                <div class="text-4xl mr-4">🔨</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-katayama-blue">下地補修工事（約1〜2ヶ月）</h3>
                                    <p class="text-gray-700 mb-3">
                                        コンクリートのひび割れ補修、浮き部分の除去・補修、鉄筋の錆び止め処理などを行います。建物を長持ちさせるための重要な工程です。
                                    </p>
                                    <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
                                        <li>ひび割れのUカットシーリング</li>
                                        <li>浮き部分の除去と充填</li>
                                        <li>鉄筋の錆び止め塗装</li>
                                        <li>爆裂部分の補修</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- 高圧洗浄 -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start">
                                <div class="text-4xl mr-4">💧</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-katayama-blue">高圧洗浄（約1週間）</h3>
                                    <p class="text-gray-700 mb-3">
                                        外壁全体を高圧洗浄機で洗浄し、汚れやコケ、旧塗膜を除去します。塗装の密着性を高めるための重要な作業です。
                                    </p>
                                    <p class="text-sm text-red-600 font-semibold">
                                        ※ベランダに水が飛散する可能性があります。洗濯物や植木鉢は事前に室内へ移動をお願いします
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- 外壁塗装工事 -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start">
                                <div class="text-4xl mr-4">🎨</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-katayama-blue">外壁塗装工事（約1〜2ヶ月）</h3>
                                    <p class="text-gray-700 mb-3">
                                        下塗り、中塗り、上塗りの3回塗りで、美観と防水性能を回復させます。使用する塗料は耐候性・耐久性に優れたものを選定します。
                                    </p>
                                    <ul class="list-disc list-inside text-gray-600 text-sm space-y-1">
                                        <li>下塗り（密着性向上）</li>
                                        <li>中塗り（塗膜厚の確保）</li>
                                        <li>上塗り（美観・保護）</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- 防水工事 -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start">
                                <div class="text-4xl mr-4">☔</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-katayama-blue">防水工事（約2〜4週間）</h3>
                                    <p class="text-gray-700 mb-3">
                                        屋上やベランダの防水層を新しくし、雨漏りを防ぎます。ウレタン防水、シート防水など、建物に最適な工法を選定します。
                                    </p>
                                    <p class="text-sm text-red-600 font-semibold">
                                        ※工事期間中、ベランダの使用が一時的に制限される場合があります
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- 鉄部塗装 -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start">
                                <div class="text-4xl mr-4">🪜</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-katayama-blue">鉄部塗装・シーリング工事</h3>
                                    <p class="text-gray-700 mb-3">
                                        階段手すり、ドア枠などの鉄部を錆止め塗装し、サッシ周りのシーリング材を打ち替えます。
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- 仮設解体 -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <div class="flex items-start">
                                <div class="text-4xl mr-4">✨</div>
                                <div>
                                    <h3 class="text-xl font-bold mb-2 text-katayama-blue">仮設解体・清掃（約1週間）</h3>
                                    <p class="text-gray-700 mb-3">
                                        足場を解体し、周辺を清掃します。完成検査を実施し、お引き渡しとなります。
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 工事中の安全・生活配慮 -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-8 text-katayama-blue">工事中の安全・生活への配慮</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border-2 border-katayama-blue p-6 rounded-lg">
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue flex items-center">
                                <span class="text-2xl mr-3">🛡️</span>
                                徹底した安全管理
                            </h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-2">
                                <li>毎朝の安全朝礼</li>
                                <li>危険箇所への注意喚起看板設置</li>
                                <li>子ども向けイラスト看板</li>
                                <li>作業エリアの明確な区分</li>
                            </ul>
                        </div>

                        <div class="border-2 border-katayama-blue p-6 rounded-lg">
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue flex items-center">
                                <span class="text-2xl mr-3">🔒</span>
                                防犯対策
                            </h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-2">
                                <li>補助ロックの無償貸出</li>
                                <li>足場シート養生</li>
                                <li>夜間・休日の定期巡回</li>
                                <li>防犯カメラ設置</li>
                            </ul>
                        </div>

                        <div class="border-2 border-katayama-blue p-6 rounded-lg">
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue flex items-center">
                                <span class="text-2xl mr-3">📢</span>
                                丁寧な情報提供
                            </h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-2">
                                <li>工事進捗の定期報告</li>
                                <li>作業予定の事前掲示</li>
                                <li>現場代理人が常駐</li>
                                <li>緊急連絡先の明示</li>
                            </ul>
                        </div>

                        <div class="border-2 border-katayama-blue p-6 rounded-lg">
                            <h3 class="text-xl font-bold mb-3 text-katayama-blue flex items-center">
                                <span class="text-2xl mr-3">🧹</span>
                                環境への配慮
                            </h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-2">
                                <li>騒音・振動の時間帯配慮</li>
                                <li>塗料の飛散防止</li>
                                <li>毎日の現場清掃</li>
                                <li>廃材の適切な処理</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- 居住者の皆様へのお願い -->
                <div class="content-block mb-16 fade-in-up">
                    <div class="bg-yellow-50 border-2 border-yellow-400 p-8 rounded-lg">
                        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">工事期間中、居住者の皆様へのお願い</h2>
                        <div class="space-y-3 text-gray-700">
                            <p class="flex items-start">
                                <span class="text-yellow-600 mr-3 font-bold">●</span>
                                <span>ベランダの使用制限期間は、洗濯物や植木鉢を室内へ移動してください</span>
                            </p>
                            <p class="flex items-start">
                                <span class="text-yellow-600 mr-3 font-bold">●</span>
                                <span>作業時間は原則、平日8:00〜17:00です（土日祝は休工）</span>
                            </p>
                            <p class="flex items-start">
                                <span class="text-yellow-600 mr-3 font-bold">●</span>
                                <span>騒音が発生する作業は事前に掲示板でお知らせします</span>
                            </p>
                            <p class="flex items-start">
                                <span class="text-yellow-600 mr-3 font-bold">●</span>
                                <span>工事に関するご質問やご要望は、現場代理人までお気軽にお声がけください</span>
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
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-katayama-blue">工事に関するご質問はこちら</h2>
            <p class="text-lg mb-8 text-gray-600 max-w-2xl mx-auto">
                工事内容や期間について、詳しくご説明いたします。
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
