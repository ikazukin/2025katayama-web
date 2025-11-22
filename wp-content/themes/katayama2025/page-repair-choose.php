<?php
/**
 * Template Name: 業者選定方法
 * 大規模修繕業者の選定方法ページ
 */

get_header();
?>

<main id="primary" class="site-main repair-subpage choose-page">
    <!-- パンくずリスト -->
    <div class="breadcrumb-section bg-gray-50 py-3 border-b border-gray-200">
        <div class="container mx-auto px-4">
            <nav class="text-sm text-gray-600">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-katayama-blue">ホーム</a>
                <span class="mx-2">/</span>
                <a href="<?php echo esc_url(home_url('/repair/')); ?>" class="hover:text-katayama-blue">大規模修繕工事</a>
                <span class="mx-2">/</span>
                <span class="text-gray-800 font-semibold">業者選定方法</span>
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
                    <a href="<?php echo esc_url(home_url('/repair/under-construction/')); ?>" class="bg-white text-gray-700 px-4 py-2 rounded hover:bg-gray-50 border border-gray-300">工事時の流れ</a>
                    <span class="bg-katayama-blue text-white px-4 py-2 rounded font-semibold">業者選定方法</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- ページヘッダー -->
    <section class="page-header bg-gradient-to-br from-katayama-blue to-blue-900 text-white py-16 md:py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 fade-in-up">業者選定方法</h1>
            <p class="text-xl max-w-3xl mx-auto fade-in-up" style="transition-delay: 0.2s;">
                信頼できる修繕業者の選び方、確認すべきポイントをご紹介します
            </p>
        </div>
    </section>

    <!-- メインコンテンツ -->
    <section class="content-section py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">

                <!-- 導入文 -->
                <div class="content-block mb-16 fade-in-up text-center">
                    <p class="text-lg text-gray-700 leading-relaxed max-w-3xl mx-auto mb-6">
                        大規模修繕工事は、建物の資産価値を守るための重要な工事です。<br>
                        信頼できる業者を選ぶことが、工事の成功を左右します。
                    </p>
                    <div class="bg-red-50 border-2 border-red-400 p-6 rounded-lg max-w-2xl mx-auto">
                        <p class="text-red-800 font-semibold">
                            ⚠️ 業者選びで失敗すると、手抜き工事や不当な追加請求、トラブルの原因となります
                        </p>
                    </div>
                </div>

                <!-- 確認すべき7つのポイント -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-12 text-katayama-blue text-center">信頼できる業者を見極める7つのポイント</h2>

                    <div class="space-y-6">
                        <!-- ポイント1 -->
                        <div class="border-2 border-katayama-blue rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-16 h-16 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-2xl mr-6">1</div>
                                <div>
                                    <h3 class="text-2xl font-bold mb-3 text-katayama-blue">実績と経験</h3>
                                    <p class="text-gray-700 mb-3">
                                        大規模修繕工事の実績が豊富な業者を選びましょう。施工実績数、施工年数、得意なマンション規模などを確認してください。
                                    </p>
                                    <div class="bg-blue-50 p-4 rounded">
                                        <p class="font-semibold text-katayama-blue mb-2">✓ カタヤマの実績</p>
                                        <ul class="text-sm text-gray-600 space-y-1">
                                            <li>• 創業40年、1,200棟以上の施工実績</li>
                                            <li>• 神奈川・東京エリア中心に展開</li>
                                            <li>• 小規模〜大規模マンションまで対応</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ポイント2 -->
                        <div class="border-2 border-katayama-blue rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-16 h-16 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-2xl mr-6">2</div>
                                <div>
                                    <h3 class="text-2xl font-bold mb-3 text-katayama-blue">有資格者の在籍</h3>
                                    <p class="text-gray-700 mb-3">
                                        一級建築士、一級施工管理技士などの有資格者が在籍しているか確認しましょう。専門知識を持つスタッフがいることで、適切な工事が期待できます。
                                    </p>
                                    <div class="bg-blue-50 p-4 rounded">
                                        <p class="font-semibold text-katayama-blue mb-2">✓ カタヤマの有資格者</p>
                                        <ul class="text-sm text-gray-600 space-y-1">
                                            <li>• 一級建築士</li>
                                            <li>• 一級建築施工管理技士</li>
                                            <li>• マンション改修施工管理技術者</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ポイント3 -->
                        <div class="border-2 border-katayama-blue rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-16 h-16 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-2xl mr-6">3</div>
                                <div>
                                    <h3 class="text-2xl font-bold mb-3 text-katayama-blue">ISO認証・建設業許可</h3>
                                    <p class="text-gray-700 mb-3">
                                        ISO9001（品質）、ISO14001（環境）などの認証取得や、国土交通大臣・都道府県知事の建設業許可を受けているか確認しましょう。
                                    </p>
                                    <div class="bg-blue-50 p-4 rounded">
                                        <p class="font-semibold text-katayama-blue mb-2">✓ カタヤマの認証</p>
                                        <ul class="text-sm text-gray-600 space-y-1">
                                            <li>• ISO9001認証取得（品質管理）</li>
                                            <li>• ISO14001認証取得（環境管理）</li>
                                            <li>• 建設業許可取得</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ポイント4 -->
                        <div class="border-2 border-katayama-blue rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-16 h-16 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-2xl mr-6">4</div>
                                <div>
                                    <h3 class="text-2xl font-bold mb-3 text-katayama-blue">詳細な見積書</h3>
                                    <p class="text-gray-700 mb-3">
                                        見積書の内容が詳細で、工事項目ごとの単価や数量が明記されているか確認しましょう。「一式」表記が多い見積書は要注意です。
                                    </p>
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                        <p class="text-sm text-gray-700">
                                            <span class="font-semibold">注意：</span>極端に安い見積りを提示する業者は、後から追加費用を請求したり、手抜き工事をする可能性があります
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ポイント5 -->
                        <div class="border-2 border-katayama-blue rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-16 h-16 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-2xl mr-6">5</div>
                                <div>
                                    <h3 class="text-2xl font-bold mb-3 text-katayama-blue">安全管理体制</h3>
                                    <p class="text-gray-700 mb-3">
                                        安全管理をどのように行っているか確認しましょう。労災事故の有無、安全対策の具体的な内容を確認することが重要です。
                                    </p>
                                    <div class="bg-blue-50 p-4 rounded">
                                        <p class="font-semibold text-katayama-blue mb-2">✓ カタヤマの安全管理</p>
                                        <ul class="text-sm text-gray-600 space-y-1">
                                            <li>• 創業以来、労災事故0件</li>
                                            <li>• 毎朝の安全朝礼実施</li>
                                            <li>• 子ども向けイラスト看板設置</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ポイント6 -->
                        <div class="border-2 border-katayama-blue rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-16 h-16 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-2xl mr-6">6</div>
                                <div>
                                    <h3 class="text-2xl font-bold mb-3 text-katayama-blue">アフターフォロー・保証</h3>
                                    <p class="text-gray-700 mb-3">
                                        工事完了後の保証期間や定期点検の有無を確認しましょう。長期的にサポートしてくれる業者を選ぶことが安心につながります。
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- ポイント7 -->
                        <div class="border-2 border-katayama-blue rounded-lg p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 w-16 h-16 bg-katayama-blue text-white rounded-full flex items-center justify-center font-bold text-2xl mr-6">7</div>
                                <div>
                                    <h3 class="text-2xl font-bold mb-3 text-katayama-blue">コミュニケーション能力</h3>
                                    <p class="text-gray-700 mb-3">
                                        質問に丁寧に答えてくれるか、説明が分かりやすいかを確認しましょう。工事中も居住者とのコミュニケーションが重要です。
                                    </p>
                                    <div class="bg-blue-50 p-4 rounded">
                                        <p class="font-semibold text-katayama-blue mb-2">✓ カタヤマの対応</p>
                                        <ul class="text-sm text-gray-600 space-y-1">
                                            <li>• 専門用語を避けた分かりやすい説明</li>
                                            <li>• 現場代理人が常駐し、いつでも相談可能</li>
                                            <li>• 定期的な工事進捗報告</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 複数社比較のススメ -->
                <div class="content-block mb-16 fade-in-up">
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-8 rounded-lg">
                        <h2 class="text-2xl font-bold mb-4 text-katayama-blue text-center">複数社から見積りを取りましょう</h2>
                        <p class="text-gray-700 mb-4 text-center">
                            最低でも3社程度から見積りを取り、価格だけでなく、提案内容や対応の質を比較検討することをおすすめします。
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            <div class="bg-white p-4 rounded text-center">
                                <div class="text-3xl mb-2">📊</div>
                                <p class="font-semibold">価格の相場を知る</p>
                            </div>
                            <div class="bg-white p-4 rounded text-center">
                                <div class="text-3xl mb-2">🔍</div>
                                <p class="font-semibold">提案内容を比較</p>
                            </div>
                            <div class="bg-white p-4 rounded text-center">
                                <div class="text-3xl mb-2">💡</div>
                                <p class="font-semibold">業者の対応を確認</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- こんな業者は要注意 -->
                <div class="content-block mb-16 fade-in-up">
                    <h2 class="text-3xl font-bold mb-8 text-red-600 text-center">⚠️ こんな業者は要注意</h2>
                    <div class="space-y-4">
                        <div class="bg-red-50 border-l-4 border-red-500 p-4">
                            <p class="text-gray-800"><span class="font-bold text-red-600">✗</span> 飛び込み営業で「今なら安くできる」と契約を急がせる</p>
                        </div>
                        <div class="bg-red-50 border-l-4 border-red-500 p-4">
                            <p class="text-gray-800"><span class="font-bold text-red-600">✗</span> 見積書が「一式」ばかりで詳細が不明</p>
                        </div>
                        <div class="bg-red-50 border-l-4 border-red-500 p-4">
                            <p class="text-gray-800"><span class="font-bold text-red-600">✗</span> 極端に安い見積りを提示する</p>
                        </div>
                        <div class="bg-red-50 border-l-4 border-red-500 p-4">
                            <p class="text-gray-800"><span class="font-bold text-red-600">✗</span> 質問に対する回答が曖昧</p>
                        </div>
                        <div class="bg-red-50 border-l-4 border-red-500 p-4">
                            <p class="text-gray-800"><span class="font-bold text-red-600">✗</span> 建設業許可や保険加入の証明を見せない</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- お問い合わせCTA -->
    <section class="cta-section py-16 bg-gradient-to-br from-katayama-blue to-blue-900 text-white text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">カタヤマにお任せください</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto">
                40年の実績と確かな技術で、大切なマンションを守ります。<br>
                まずは無料相談・お見積りからお気軽にどうぞ。
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                <a
                    href="<?php echo esc_url(home_url('/contact/')); ?>"
                    class="inline-block bg-white text-katayama-blue px-10 py-4 text-lg font-bold rounded-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl"
                >
                    無料相談・お見積りはこちら →
                </a>
                <a
                    href="<?php echo esc_url(home_url('/estimate/')); ?>"
                    class="inline-block bg-transparent text-white border-2 border-white px-10 py-4 text-lg font-bold rounded-lg hover:bg-white hover:text-katayama-blue transition-all duration-300 shadow-lg hover:shadow-xl"
                >
                    概算見積もりシミュレーター →
                </a>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
