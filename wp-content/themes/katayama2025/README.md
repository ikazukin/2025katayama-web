# Katayama 2025 WordPress Theme

カタヤマ企業サイト用WordPressテーマ - Vite + Tailwind CSS + ACF

## 必要環境

- WordPress 6.0以上
- PHP 8.0以上
- Node.js 18以上
- Advanced Custom Fields PRO

## セットアップ

### 1. 依存パッケージのインストール

```bash
cd wp-content/themes/katayama2025
npm install
```

### 2. 開発モード

```bash
npm run dev
```

Vite開発サーバーが `http://localhost:5173` で起動します。
WordPress側の `wp-config.php` で `WP_DEBUG` を `true` に設定してください。

### 3. 本番ビルド

```bash
npm run build
```

`dist/` ディレクトリにビルド済みファイルが生成されます。

## ディレクトリ構造

```
katayama2025/
├── acf-json/           # ACF設定保存先
├── assets/             # 静的ファイル
│   ├── images/
│   └── fonts/
├── dist/               # ビルド成果物（本番用）
├── src/
│   ├── main.js        # JavaScriptエントリーポイント
│   └── style.css      # CSSエントリーポイント
├── template-parts/     # テンプレートパーツ
│   ├── hero.php
│   ├── features.php
│   ├── services.php
│   ├── works.php
│   ├── news.php
│   ├── kojiblog.php
│   └── recruit.php
├── functions.php       # テーマ機能
├── header.php         # ヘッダー
├── footer.php         # フッター
├── index.php          # メインテンプレート
├── front-page.php     # フロントページ
└── style.css          # テーマ情報
```

## 機能

- ✅ Vite + Tailwind CSS
- ✅ ACF JSON同期
- ✅ カスタム投稿タイプ（施工実績）
- ✅ レスポンシブ対応
- ✅ スクロールアニメーション
- ✅ ライトボックス（GLightbox）
- ✅ パフォーマンス最適化

## 開発フロー

1. Issue 01: テーマベース構築 ✅
2. Issue 02-09: 各セクション実装
3. Issue 10: 統合・最適化

## ライセンス

GPL v2 or later
