# カタヤマ企業サイト - サイト構造とページ遷移図

## サイト全体構造

```
トップページ (/)
│
├── 会社情報
│   ├── 会社紹介 (/company/)
│   └── 沿革 (/history/)
│
├── 事業内容
│   ├── 大規模修繕 (/large-scale-renovation/)
│   └── リフォーム (/reform/)
│
├── 施工実績 (/works/)
│   ├── 施工実績一覧 (archive-works.php)
│   ├── 施工実績詳細 (single-works.php)
│   └── 工事種別別一覧 (/work-category/{term}/)
│       └── taxonomy-work_category.php
│
├── 情報発信
│   ├── お知らせ (/category/news/)
│   │   └── category-news.php
│   └── 工事部ブログ (/category/kojiblog/)
│       └── category-kojiblog.php
│
├── 採用情報 (/recruit/)
│   ├── 新卒採用 (/recruit/shinsotsu/)
│   │   └── page-recruit-shinsotsu.php
│   ├── 中途採用 (/recruit/boshu/)
│   └── 社員インタビュー (/interviews/)
│       ├── インタビュー一覧 (archive)
│       └── インタビュー詳細 (single-interviews.php)
│
├── パートナー募集 (/partner/)
│
└── お問い合わせ (/contact/)
```

---

## トップページのセクション構成

トップページ (`front-page.php`) は以下のセクションで構成されています：

1. **Hero Section** (`template-parts/hero.php`)
   - 動画背景（PC/SP対応）
   - キャッチコピー
   - CTAボタン

2. **Services Section** (`template-parts/services.php`)
   - 事業分岐（4つのカード）
     - 大規模修繕工事
     - リフォーム
     - 採用情報
     - パートナー募集

3. **Features Section** (`template-parts/features.php`)
   - 3つの強み・信頼ポイント
     - 実績と規模で信頼を証明
     - 人と現場が生む品質
     - 地域と共に歩む40年

4. **Works Section** (`template-parts/works.php`)
   - 施工実績の紹介
   - → 施工実績一覧へのリンク

5. **News Section** (`template-parts/news.php`)
   - 最新のお知らせ表示
   - → ニュースカテゴリーへのリンク

6. **Kojiblog Section** (`template-parts/kojiblog.php`)
   - 工事部ブログの最新記事
   - → 工事部ブログカテゴリーへのリンク

7. **Company Introduction Section** (`template-parts/company-intro.php`)
   - カタヤマについて
   - 社是（約束・感謝・夢）
   - 実績サマリー
   - → 会社紹介ページへのリンク

8. **Recruit Section** (`template-parts/recruit.php`)
   - 採用メッセージ
   - 新卒採用・中途採用へのCTAボタン

---

## グローバルナビゲーション

プライマリメニュー (`header.php`) には以下の項目が設定されています：

1. ホーム → `/`
2. 会社紹介 → `/company/`
3. 大規模修繕 → `/large-scale-renovation/`
4. リフォーム → `/reform/`
5. 施工実績 → `/works/`
6. 採用情報 → `/recruit/`
7. パートナー募集 → `/partner/`
8. お問い合わせ → `/contact/`

---

## カスタム投稿タイプ

### 1. works（施工実績）
- **スラッグ**: `/works/`
- **アーカイブ**: 有効
- **テンプレート**:
  - 一覧: `archive-works.php`
  - 詳細: `single-works.php`
- **カスタムフィールド** (ACF):
  - 完成年 (`works_year`)
  - 住所 (`works_address`)
- **カスタムブロック**:
  - Before/After 画像比較ブロック
  - ギャラリーカルーセルブロック
- **タクソノミー**:
  - `work_category` (工事種別)
    - テンプレート: `taxonomy-work_category.php`

### 2. works_gallery（施工実績ギャラリー）
- **公開**: 非公開（管理画面のみ）
- **用途**: Instagram型の画像1枚単位管理
- **親投稿との関連**: ACFの `gallery_parent_work` フィールドで紐付け

### 3. testimonials（お客様の声）
- **スラッグ**: `/testimonials/`
- **アーカイブ**: 有効
- **サポート**: タイトル、本文、アイキャッチ

### 4. interviews（社員インタビュー）
- **スラッグ**: `/interviews/`
- **アーカイブ**: 有効
- **テンプレート**:
  - 詳細: `single-interviews.php`
- **サポート**: タイトル、本文、アイキャッチ

---

## 標準投稿のカテゴリー

### 1. news（お知らせ）
- **URL**: `/category/news/`
- **テンプレート**: `category-news.php`
- **用途**: 会社のお知らせ・ニュース

### 2. kojiblog（工事部ブログ）
- **URL**: `/category/kojiblog/`
- **テンプレート**: `category-kojiblog.php`
- **用途**: 工事現場レポート、施工事例ブログ
- **制約**: アイキャッチ画像必須

---

## ページ遷移図（主要な導線）

### トップページからの主要導線

```mermaid
graph TD
    A[トップページ /] --> B[会社紹介 /company/]
    A --> C[大規模修繕 /large-scale-renovation/]
    A --> D[リフォーム /reform/]
    A --> E[施工実績一覧 /works/]
    A --> F[採用情報 /recruit/]
    A --> G[パートナー募集 /partner/]
    A --> H[お問い合わせ /contact/]

    B --> I[沿革 /history/]

    E --> J[施工実績詳細 /works/{slug}/]
    E --> K[工事種別別一覧 /work-category/{term}/]

    F --> L[新卒採用 /recruit/shinsotsu/]
    F --> M[中途採用 /recruit/boshu/]
    F --> N[社員インタビュー一覧 /interviews/]

    N --> O[社員インタビュー詳細 /interviews/{slug}/]

    A --> P[ニュース一覧 /category/news/]
    A --> Q[工事部ブログ一覧 /category/kojiblog/]

    P --> R[ニュース記事詳細]
    Q --> S[工事部ブログ記事詳細]
```

### 施工実績セクションの詳細導線

```
トップページ (works セクション)
    ↓
施工実績一覧 (/works/)
    ├→ 施工実績詳細 (/works/{slug}/)
    │   └→ 関連する工事種別へ
    │
    └→ 工事種別でフィルタ (/work-category/{term}/)
        └→ 施工実績詳細 (/works/{slug}/)
```

### 採用情報セクションの詳細導線

```
トップページ (recruit セクション)
    ↓
採用情報トップ (/recruit/)
    ├→ 新卒採用 (/recruit/shinsotsu/)
    │   ├→ エントリーフォーム
    │   └→ 社員インタビュー (/interviews/)
    │
    └→ 中途採用 (/recruit/boshu/)
        ├→ 応募フォーム
        └→ 社員インタビュー (/interviews/)

社員インタビュー一覧 (/interviews/)
    └→ インタビュー詳細 (/interviews/{slug}/)
```

### 情報発信セクションの導線

```
トップページ (news/kojiblog セクション)
    ├→ ニュース一覧 (/category/news/)
    │   └→ ニュース記事詳細
    │
    └→ 工事部ブログ一覧 (/category/kojiblog/)
        └→ ブログ記事詳細
```

---

## フッターメニュー

フッターには以下の3つのメニューエリアが設定されています：

1. **footer-company** (会社関連メニュー)
   - 会社紹介、沿革など

2. **footer-services** (事業関連メニュー)
   - 大規模修繕、リフォーム、施工実績など

3. **footer-contact** (採用・問い合わせメニュー)
   - 採用情報、パートナー募集、お問い合わせなど

---

## 使用テンプレートファイル一覧

### メインテンプレート
- `front-page.php` - トップページ
- `page.php` - 固定ページ（汎用）
- `index.php` - フォールバック用

### 固定ページ専用テンプレート
- `page-history.php` - 沿革ページ
- `page-recruit-shinsotsu.php` - 新卒採用ページ
- `page-interview.php` - インタビューページ

### カスタム投稿タイプ用テンプレート
- `archive-works.php` - 施工実績一覧
- `single-works.php` - 施工実績詳細
- `single-interviews.php` - 社員インタビュー詳細

### タクソノミー・カテゴリー用テンプレート
- `taxonomy-work_category.php` - 工事種別別一覧
- `category-news.php` - ニュース一覧
- `category-kojiblog.php` - 工事部ブログ一覧

### テンプレートパーツ
- `header.php` - ヘッダー（グローバルナビ）
- `footer.php` - フッター
- `template-parts/hero.php` - ヒーローセクション
- `template-parts/services.php` - 事業分岐
- `template-parts/features.php` - 信頼セクション
- `template-parts/works.php` - 施工実績
- `template-parts/news.php` - お知らせ
- `template-parts/kojiblog.php` - 工事部ブログ
- `template-parts/company-intro.php` - 会社紹介
- `template-parts/recruit.php` - 採用ティーザー
- `template-parts/works-filter.php` - 施工実績フィルタ
- `template-parts/blocks/hero.php` - Heroブロック

### 採用ページ用パーツ
- `template-parts/recruit/about.php` - 企業について
- `template-parts/recruit/business.php` - 事業内容
- `template-parts/recruit/work.php` - 職種紹介
- `template-parts/recruit/interview.php` - インタビュー
- `template-parts/recruit/benefits.php` - 福利厚生
- `template-parts/recruit/faq.php` - よくある質問
- `template-parts/recruit/job-list.php` - 募集要項
- `template-parts/recruit/entry-form.php` - エントリーフォーム

---

## ACFフィールドグループ一覧

### トップページ用フィールドグループ

1. **Hero Section** (`group_hero_section`)
   - PC動画URL、SP動画URL
   - Poster画像
   - タイトル、サブタイトル
   - CTAボタン

2. **Features Section** (`group_features_section`)
   - 特徴リスト（3件固定）
     - アイコン、タイトル、説明

3. **Services Section** (`group_services_section`)
   - 事業カードリスト（4件固定）
     - 画像、タイトル、キャッチコピー
     - 説明、CTAボタン

4. **Company Introduction** (`group_company_intro`)
   - タイトル、リンク
   - 社是カード（3件固定）
   - 実績サマリー

5. **Recruit Section** (`group_recruit_section`)
   - タイトル、本文
   - 画像1、画像2
   - ボタン1、ボタン2

### カスタム投稿タイプ用フィールドグループ

6. **Works（親投稿）** (`group_works`)
   - 完成年
   - 住所

7. **Works Gallery（子投稿）** (`group_works_gallery`)
   - 親施工実績
   - ギャラリー画像
   - キャプション

8. **Recruit Shinsotsu Page** (`group_recruit_shinsotsu`)
   - Hero、About、Business、Work、Interview
   - Benefits、FAQ、Recruit（募集要項）

---

## WordPress Customizer統合

カスタマイザーパネル「トップページ設定」に以下のセクションが統合されています：

1. **Hero Section** - 動画、タイトル、CTAボタン
2. **Features Section** - 3つの強み
3. **Services Section** - 4つの事業カード
4. **Recruit Section** - 採用メッセージ、CTAボタン

※リアルタイムプレビュー対応（`transport: 'postMessage'`）

---

## カスタムブロック（Gutenberg）

### 施工実績専用ブロック（`katayama-works` カテゴリー）

1. **Before/After ブロック** (`katayama/before-after`)
   - ビフォーアフター画像比較
   - ビルド: `@wordpress/scripts`
   - 出力: `/build/before-after/`

2. **Gallery Carousel ブロック** (`katayama/gallery-carousel`)
   - 施工写真のカルーセル表示
   - ビルド: `@wordpress/scripts`
   - 出力: `/build/gallery-carousel/`

---

## 技術スタック

- **WordPress**: 6.0以上
- **PHP**: 8.0以上
- **Node.js**: 18以上
- **ACF PRO**: カスタムフィールド管理
- **Vite**: フロントエンドビルド
- **Tailwind CSS**: CSSフレームワーク
- **@wordpress/scripts**: ブロックビルド

---

## まとめ

カタヤマ企業サイトは、以下の特徴を持つWordPressテーマです：

- **トップページ**: ACFで管理された8つのセクションで構成
- **施工実績**: カスタム投稿タイプ + カスタムブロックで柔軟に管理
- **採用情報**: 新卒・中途採用ページ + 社員インタビュー
- **情報発信**: ニュース・工事部ブログのカテゴリー分け
- **ナビゲーション**: プライマリメニュー + フッター3エリア
- **パフォーマンス**: Vite + Tailwind CSS による高速化
- **SEO**: パンくずリスト、構造化データ対応

このサイト構造により、企業の信頼性をアピールしながら、施工実績や採用情報を効果的に発信できる設計になっています。
