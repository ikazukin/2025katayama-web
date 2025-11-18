# 株式会社カタヤマ Webサイトリニューアルプロジェクト

## 📖 プロジェクト概要

創業40周年を迎えた株式会社カタヤマのWebサイトリニューアルプロジェクト。
大規模修繕工事を中心とした事業の多角化を反映し、信頼と実績を訴求するサイトへ刷新。

---

## 🎯 プロジェクトの目的

1. **創業40周年のブランド刷新**
   - 「実績・人・地域・品質」の4軸で信頼を可視化
   - 事業の多角化を明確に訴求

2. **事業分岐の明確化**
   - 大規模修繕工事、リフォーム、採用情報、パートナー募集の4事業を明示
   - 各事業への導線を最適化

3. **お問い合わせ・エントリー数の向上**
   - CTAボタンの統一（青ベース + ホバー白）
   - 見積もりシミュレーター導入（今後実装予定）

---

## 🏗️ 技術スタック

### フロントエンド
- **WordPress 6.x**
- **Vite + Tailwind CSS**
  - カスタムカラー: `#0056A3`（メインブルー）
  - レスポンシブ対応（スマホ/PC）
  - アニメーション: GSAP ScrollTrigger

### プラグイン
- **Advanced Custom Fields (ACF)**
  - トップページの全セクション管理
  - リピーターフィールドで柔軟なコンテンツ管理
- **Contact Form 7**
- **Flamingo**

### 開発環境
- **Docker**
- **Git/GitHub**: `ikazukin/2025katayama-web`
- **開発サーバー**: Vite (`npm run dev`)
- **本番ビルド**: `npm run build`

---

## 📂 プロジェクト構造

```
/var/www/html/
├── wp-content/
│   └── themes/
│       └── katayama2025/
│           ├── front-page.php           # トップページ
│           ├── template-parts/          # セクション分割
│           │   ├── hero.php            # ヒーロー動画
│           │   ├── services.php        # 事業分岐（4カード）
│           │   ├── features.php        # 信頼セクション（3カード）
│           │   ├── works.php           # 施工実績
│           │   ├── company-intro.php   # カタヤマについて
│           │   ├── news.php            # お知らせ
│           │   ├── kojiblog.php        # 工事部ブログ
│           │   └── recruit.php         # リクルートティーザー
│           ├── functions.php           # ACFフィールド定義
│           ├── tailwind.config.js      # カラー・デザイン設定
│           └── src/                    # Viteソース
└── Docs/                               # プロジェクトドキュメント
    ├── README.md                       # このファイル
    └── 機能要件_追加アイデア.md         # 今後の実装アイデア
```

---

## 🎨 デザインコンセプト

### カラーパレット
- **メインカラー**: `#0056A3`（青）
- **アクセント**: `#A8C5DD`（淡いブルー）
- **サブカラー**: `#002244`（ネイビー）
- **背景**: `#E8EEF2`（シルバー）、白ベース

### UI/UX設計原則
1. **CTAボタンの統一**
   - `bg-katayama-blue hover:bg-white`
   - `border-2 border-katayama-blue`
   - ホバー時に色反転

2. **レスポンシブ対応**
   - モバイルファースト
   - PC: 2カラムグリッド
   - スマホ: 1カラム縦並び

3. **アニメーション**
   - スクロールトリガーでフェードイン
   - カードホバーでシャドウ拡大

---

## 📋 実装済み機能

### トップページ（Issue #24）
- [x] ヒーロー動画セクション
- [x] 事業分岐セクション（4カード）
- [x] 信頼セクション（40年の歩み）
- [x] 施工実績セクション
- [x] カタヤマについてセクション（社是 + 実績サマリー）
- [x] リクルートティーザー
- [x] グローバルナビ（リフォーム・パートナー募集追加）

### カタヤマの歩みページ（Issue #23）
- [ ] 年表タイムラインページ（実装予定）

### 施工実績
- [x] Instagram型ギャラリー（CPT: works, works_gallery）
- [x] カテゴリフィルター機能

---

## 🔮 今後の実装予定

詳細は [`機能要件_追加アイデア.md`](./機能要件_追加アイデア.md) を参照。

1. **見積もりシミュレーター** 🔴 高優先度
2. オンライン相談予約システム
3. 施工実績のビフォーアフター比較機能
4. お客様の声の動画コンテンツ化

---

## 🚀 開発フロー

### 1. ローカル開発（ホストマシン）
```bash
cd /path/to/wp-content/themes/katayama2025
npm run dev
```

### 2. 本番ビルド
```bash
npm run build
```

### 3. Git操作（ホストマシンから）
```bash
git add .
git commit -m "メッセージ"
git push
```

### 4. GitHub Issue管理
```bash
gh issue list --repo ikazukin/2025katayama-web
gh issue create --repo ikazukin/2025katayama-web --title "タイトル" --body "内容"
```

---

## 📞 お問い合わせ

プロジェクトに関する質問や提案は、GitHubのIssueまたはPull Requestでお願いします。

**リポジトリ:** https://github.com/ikazukin/2025katayama-web/

---

**最終更新日:** 2025-11-17
