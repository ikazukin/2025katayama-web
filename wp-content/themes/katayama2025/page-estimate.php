<?php
/**
 * Template Name: 見積もりシミュレーター
 * Description: 大規模修繕の概算見積もりを簡易計算
 */

get_header();
?>

<main id="primary" class="site-main estimate-page">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Hero Section -->
        <section class="estimate-hero">
            <div class="container mx-auto px-4">
                <div class="text-center py-16">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up">
                        大規模修繕 概算見積もりシミュレーター
                    </h1>
                    <p class="text-lg text-gray-600 mb-8" data-aos="fade-up" data-aos-delay="200">
                        マンションの基本情報を入力して、大規模修繕工事の概算費用を確認できます
                    </p>
                </div>
            </div>
        </section>

        <!-- Simulator Section -->
        <section class="estimate-simulator py-16">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">

                    <!-- 注意書き -->
                    <div class="estimate-notice" data-aos="fade-up">
                        <p>※ こちらは概算の目安です。実際の見積もりは現地調査により算出いたします。</p>
                    </div>

                    <!-- シミュレーターフォーム -->
                    <div class="estimate-form-card" data-aos="fade-up" data-aos-delay="200">
                        <form id="estimate-form">

                            <!-- 築年数 -->
                            <div class="form-group">
                                <label for="building-age">
                                    <span class="label-icon">🏢</span>
                                    <span class="label-text">築年数</span>
                                </label>
                                <select id="building-age" name="building_age" required>
                                    <option value="">選択してください</option>
                                    <option value="0-10">築10年未満</option>
                                    <option value="10-15">築10〜15年</option>
                                    <option value="15-20">築15〜20年</option>
                                    <option value="20-30">築20〜30年</option>
                                    <option value="30+">築30年以上</option>
                                </select>
                            </div>

                            <!-- 戸数 -->
                            <div class="form-group">
                                <label for="units">
                                    <span class="label-icon">🏘️</span>
                                    <span class="label-text">戸数</span>
                                </label>
                                <input
                                    type="number"
                                    id="units"
                                    name="units"
                                    min="10"
                                    max="500"
                                    placeholder="例: 50"
                                    required>
                                <p class="input-hint">10〜500戸まで入力可能</p>
                            </div>

                            <!-- 構造 -->
                            <div class="form-group">
                                <label for="structure">
                                    <span class="label-icon">🏗️</span>
                                    <span class="label-text">建物構造</span>
                                </label>
                                <select id="structure" name="structure" required>
                                    <option value="">選択してください</option>
                                    <option value="rc">RC造（鉄筋コンクリート造）</option>
                                    <option value="src">SRC造（鉄骨鉄筋コンクリート造）</option>
                                    <option value="s">S造（鉄骨造）</option>
                                    <option value="other">その他</option>
                                </select>
                            </div>

                            <!-- 計算ボタン -->
                            <div class="form-group">
                                <button type="submit" class="estimate-submit-btn">
                                    概算費用を計算する
                                </button>
                            </div>

                        </form>
                    </div>

                    <!-- 結果表示エリア -->
                    <div id="estimate-result" class="estimate-result" style="display: none;">
                        <div class="result-card" data-aos="fade-up">
                            <h2 class="result-title">概算見積もり結果</h2>

                            <div class="result-summary">
                                <div class="result-label">工事費用の目安</div>
                                <div class="result-amount">
                                    <span id="result-min">500</span> 万円 〜 <span id="result-max">6,000</span> 万円
                                </div>
                                <div class="result-per-unit">
                                    1戸あたり: <span id="result-per-unit-min">10</span> 万円 〜 <span id="result-per-unit-max">120</span> 万円
                                </div>
                            </div>

                            <div class="result-breakdown">
                                <h3>入力内容</h3>
                                <ul>
                                    <li><strong>築年数:</strong> <span id="result-age">-</span></li>
                                    <li><strong>戸数:</strong> <span id="result-units">-</span>戸</li>
                                    <li><strong>構造:</strong> <span id="result-structure">-</span></li>
                                </ul>
                            </div>

                            <div class="result-notes">
                                <h3>この金額に含まれる工事（例）</h3>
                                <ul>
                                    <li>外壁塗装工事</li>
                                    <li>シーリング打替工事</li>
                                    <li>鉄部塗装工事</li>
                                    <li>屋上・バルコニー防水工事</li>
                                    <li>足場設置・解体工事</li>
                                </ul>
                                <p class="notes-disclaimer">
                                    ※ 建物の状態、立地条件、工事範囲により金額は大きく変動します。<br>
                                    正確なお見積もりは、現地調査の上で作成いたします。
                                </p>
                            </div>

                            <div class="result-cta">
                                <a href="/contact/" class="cta-button cta-primary">
                                    詳しい見積もりを依頼する
                                </a>
                                <button id="reset-estimate" class="cta-button cta-secondary">
                                    再計算する
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 信頼ポイントセクション -->
        <section class="estimate-trust py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-12">カタヤマが選ばれる理由</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="trust-card" data-aos="fade-up">
                        <div class="trust-icon">✅</div>
                        <h3>40年の実績</h3>
                        <p>1985年の創業以来、累計1,200棟以上の大規模修繕を手がけてきました。</p>
                    </div>
                    <div class="trust-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="trust-icon">🛡️</div>
                        <h3>安全対策の徹底</h3>
                        <p>創業以来、居住者様への労災事故0件。安全第一の施工体制です。</p>
                    </div>
                    <div class="trust-card" data-aos="fade-up" data-aos-delay="200">
                        <div class="trust-icon">🏅</div>
                        <h3>ISO認証取得</h3>
                        <p>品質マネジメントシステム（ISO9001）・環境マネジメントシステム（ISO14001）認証取得。</p>
                    </div>
                </div>
            </div>
        </section>

    <?php endwhile; ?>

</main>

<?php
get_footer();
