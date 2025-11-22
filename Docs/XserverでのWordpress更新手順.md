了解。これまでやったこと＋これからの更新フローをまとめた「運用ドキュメント」っぽく書きます。
そのまま Notion / GitHub / Docs にコピペして使えるように、Markdown 形式にします。

---

# Katayama WordPress 移行・運用ドキュメント

（Docker ローカル環境 → Xserver サブドメイン）

## 0. このドキュメントの目的

* ローカル Docker で開発している WordPress サイトを
  **Xserver 上のサブドメイン（例: `test.liveinthemoment.info`）に反映する手順** を残す。
* 今後、デザインやコードの修正が発生したときの
  **「どこをどう更新するか」運用ルール** を決めておく。

---

## 1. 環境の整理

### ローカル（開発環境）

* プロジェクトディレクトリ：`2025katayama-web`
* Docker構成（`docker-compose.yml`）：

```yaml
services:
  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: wordpress
      MYSQL_USER: wp
      MYSQL_PASSWORD: wp
      MYSQL_ROOT_PASSWORD: root
    volumes:
      - db_data:/var/lib/mysql
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]
      interval: 5s
      timeout: 3s
      retries: 30

  wordpress:
    image: wordpress:latest
    depends_on:
      db:
        condition: service_healthy
    ports:
      - "8080:80"
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_USER: wp
      WORDPRESS_DB_PASSWORD: wp
      WORDPRESS_DB_NAME: wordpress
    volumes:
      - ./wp-content:/var/www/html/wp-content
      - ./Docs:/var/www/html/Docs
      - ./.devcontainer:/var/www/html/.devcontainer
      - vscode_server:/var/www/.vscode-server
    user: "0:0"  # 開発用に root で実行

volumes:
  db_data:
  vscode_server:
```

* DB 情報（ローカル）

  * DB名：`wordpress`
  * ユーザー：`wp`
  * パスワード：`wp`
  * rootパスワード：`root`
* ブラウザ URL：`http://localhost:8080`

---

### Xserver（本番相当のデモ環境）

* サイトURL：`http://test.liveinthemoment.info/`
* 管理画面URL：`http://test.liveinthemoment.info/wp-admin/`
* MySQL

  * データベース名：`momentwed_wp7`
  * ユーザー名：`momentwed_wp8`
  * パスワード：Xserver 管理画面に記録
* WordPress は「WordPress簡単インストール」で作成済み

> ☑ 用語メモ
>
> * **DB（データベース）**：記事や固定ページ・メニューなど「中身のテキスト」の保管場所
> * **`wp-content`**：テーマ・プラグイン・画像など「見た目系のファイル」が入っている場所

---

## 2. 初回移行手順（ローカル → Xserver）

### STEP1. ローカル DB のエクスポート（mysqldump）

1. ローカルでコンテナ稼働確認：

   ```bash
   cd 2025katayama-web
   docker compose ps
   ```

   * `2025katayama-web-db-1` / `2025katayama-web-wordpress-1` が `Up` になっていること。

2. `dump.sql` を作成：

   ```bash
   docker compose exec db sh -c 'mysqldump -u root -proot wordpress' > dump.sql
   ```

3. カレントディレクトリに `dump.sql` ができていることを確認：

   ```bash
   ls
   # dump.sql が見えていればOK
   ```

---

### STEP2. Xserver 側で対象 DB を確認

1. Xserver サーバーパネルにログイン。
2. 「WordPress簡単インストール」→ 対象ドメイン（`test.liveinthemoment.info`）を選択。
3. 「インストール済み WordPress 一覧」で以下を確認してメモ：

   * MySQLデータベース名：`momentwed_wp7`
   * MySQLユーザー名：`momentwed_wp8`
   * （パスワードは別途管理）

---

### STEP3. phpMyAdmin で `dump.sql` をインポート

1. サーバーパネル → 「phpmyadmin(MySQL)」を開く。
2. ログイン情報：

   * ユーザー名：`momentwed_wp8`
   * パスワード：対応する MySQL パスワード
3. 左のDB一覧から `momentwed_wp7` を選択。
4. 既存テーブルを全削除：

   * 「すべてチェック」で全選択 → 下部プルダウンで「削除（DROP）」→ 実行。
5. 「インポート」タブ →
   「ファイルを選択」でローカルの `dump.sql` を選ぶ → 実行。
6. エラーが出なければ DB 移行完了。

---

### STEP4. `wp-content` のアップロード

1. ローカルで `wp-content` を zip にまとめる：

   ```bash
   cd 2025katayama-web
   zip -r wp-content.zip wp-content
   ```

2. Xserver サーバーパネル → 「ファイルマネージャー」。

3. `test.liveinthemoment.info` のドキュメントルート
   （中に `wp-admin`, `wp-content`, `wp-includes` がある場所）を開く。

4. 既存 `wp-content` をバックアップ：

   * `wp-content` フォルダを `wp-content_old` などにリネーム。

5. 「アップロード」から `wp-content.zip` をアップロード。

6. アップロード完了後、`wp-content.zip` を選択して「解凍」。

7. 解凍後、新しい `wp-content` フォルダ内に
   `themes/`, `plugins/`, `uploads/` が存在することを確認。

---

### STEP5. サイトURL（localhost → 本番URL）を修正

1. 再度 phpMyAdmin を開き、DB `momentwed_wp7` を選択。
2. テーブル `wp_options`（または `◯◯_options`）を開く。
3. 以下2件を探して編集：

   * `option_name = siteurl`
   * `option_name = home`
4. `option_value` を：

   ```text
   http://localhost:8080
   ```

   →

   ```text
   http://test.liveinthemoment.info
   ```

   に書き換えて保存。

---

### STEP6. 動作確認 & パーマリンク再保存

1. ブラウザで

   * `http://test.liveinthemoment.info/`
     → ローカルと同じ見た目になっているか
2. 管理画面：

   * `http://test.liveinthemoment.info/wp-admin/`
   * ログイン情報はローカルと同じ（DBをコピーしているため）
3. ログイン後：

   * 「設定 → パーマリンク」
   * 何も変更せず「変更を保存」
     → `.htaccess` が Xserver 用に再生成される。

---

## 3. よく起きる問題と対応

### 3-1. グローバルメニューのリンクが `localhost` のまま

原因：

* 「外観 → メニュー」で「カスタムリンク」として
  `http://localhost:8080/xxx` のように**フルURLで登録していた項目**は、自動で書き換わらない。

対処：

1. 管理画面 → 「外観 → メニュー」。
2. グローバルメニューに使っているメニューを選択。
3. 各メニュー項目を開き、URLを：

   * `http://localhost:8080/xxx` → `http://test.liveinthemoment.info/xxx`
     または
   * `/xxx`（相対パス推奨）
     に修正。
4. 「メニューを保存」。

---

### 3-2. 他にも `localhost` が残っていそうな場合

* 本文やボタンリンク、ACF などに `http://localhost:8080` が書き込まれている可能性。

対応例：

* プラグイン「検索・置換」系（Better Search Replace など）を使って
  `http://localhost:8080` → `http://test.liveinthemoment.info` を一括置換。
* その際は **必ず DB のバックアップを取ってから** 実行。

---

## 4. 今後の更新運用ルール

### 4-1. 役割分担の考え方

* **ローカル（Docker）**

  * テーマコードの修正（PHP, CSS, JS, テンプレート）
  * 大きな構成変更のテスト
* **Xserver（`test.liveinthemoment.info`）**

  * 文言修正、画像差し替え、メニュー変更など「コンテンツ編集」
  * クライアントに見せるデモとしての運用

ポイント：

> DB の再インポート（dump.sql を流し込み直す）は
> **「全部作り直したから、一度リセットしたい」時だけ** にする。
> 普段の更新は **テーマ or コンテンツだけ** を変える運用にする。

---

### 4-2. テーマ（コード）を修正したときの反映方法

#### パターンA：テーマ zip をアップロードする方法（簡単）

1. ローカルでテーマフォルダを zip 化：

   ```bash
   cd 2025katayama-web/wp-content/themes
   zip -r katayama2025.zip katayama2025
   ```

2. Xserver 側 WP 管理画面 → 「外観 → テーマ → 新規追加 → テーマのアップロード」。

3. `katayama2025.zip` をアップロード。

4. 同名テーマがある場合は「上書き」を許可。

5. テーマが有効化されていることを確認。

#### パターンB：SFTPで `themes/katayama2025` を上書き（慣れたら便利）

1. SFTP クライアント（Cyberduck, FileZilla など）を使って Xserver に接続。
2. サブドメインの `wp-content/themes/katayama2025` へ移動。
3. ローカルの `wp-content/themes/katayama2025` を丸ごとアップロード（上書き）。

---

### 4-3. コンテンツ（文章・画像・メニュー）を変えるとき

* 基本的に **Xserver 側の管理画面で直接編集** する。

例：

* トップコピーの修正 → 固定ページ編集画面
* 画像差し替え → メディアライブラリ＋該当ブロック編集
* メニュー構成変更 → 「外観 → メニュー」

> ⚠ ローカルと Xserver 両方でコンテンツを編集すると
> 「どっちが最新かわからない」状態になるので、
> **コンテンツは Xserver を正とする**運用が無難。

---

### 4-4. サイト全体を作り直したとき（フルリセットしたい場合）

大幅なリニューアルで「またローカル→Xserverに丸ごと流し込みたい」ときは、
**今回やった初回移行と同じ手順を繰り返す**：

1. ローカルで `dump.sql` を取り直す。
2. Xserverで `momentwed_wp7` のテーブルを全削除 → `dump.sql` 再インポート。
3. `wp-content.zip` を作り直してアップロード → 解凍。
4. `wp_options` の `siteurl` / `home` を修正。

※ この操作をすると、**Xserver 側でそれまで直接編集していたコンテンツは上書きされる**ので要注意。

---

## 5. チートシート（超ざっくり版）

### 初回 or フルリセット移行

1. ローカル：

   ```bash
   docker compose exec db sh -c 'mysqldump -u root -proot wordpress' > dump.sql
   zip -r wp-content.zip wp-content
   ```

2. Xserver：

   * phpMyAdmin → `momentwed_wp7` のテーブル全削除 → `dump.sql` インポート
   * ファイルマネージャー → 既存 `wp-content` をリネーム → `wp-content.zip` アップロード＆解凍
   * phpMyAdmin → `wp_options.siteurl/home` を `http://test.liveinthemoment.info` に変更
   * WP管理画面 → パーマリンク再保存

---

### コード修正だけ反映したいとき

* テーマだけ zip or SFTP で上書き：

```bash
cd wp-content/themes
zip -r katayama2025.zip katayama2025
# → 管理画面からアップロード
```

---

### メニューの `localhost` を直す

* 管理画面 → 「外観 → メニュー」
* カスタムリンクのURLを `http://localhost:8080/...` → `http://test.liveinthemoment.info/...`
  または `/...`（相対パス）に変更。

---

このドキュメントをベースに、

* プロジェクトの `docs/` 配下に `wp-migration-and-ops.md` として置く
* Notion の「Katayama WEB プロジェクト」ページに貼る

みたいにしておくと、後で Claude Code に読ませるときにも使いやすいと思います。
