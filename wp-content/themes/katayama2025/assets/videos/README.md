# オープニング動画ディレクトリ

## 📁 保存先

このディレクトリにオープニング動画を配置してください。

## 📹 推奨ファイル名

### PC用
- **ファイル名**: `opening-pc.mp4`
- **解像度**: 1920x1080（フルHD）
- **長さ**: 10秒程度
- **ファイルサイズ**: 3-5MB以下推奨
- **形式**: MP4（H.264コーデック）

### スマホ用（オプション）
- **ファイル名**: `opening-sp.mp4`
- **解像度**: 720x1280（縦向き）または 1280x720（横向き）
- **長さ**: 10秒程度
- **ファイルサイズ**: 2MB以下推奨
- **形式**: MP4（H.264コーデック）

## ⚙️ 動画の最適化

### 推奨設定
- **ビットレート**: 1-2 Mbps
- **フレームレート**: 30fps
- **音声**: なし（muted）または非常に小さい音量
  - ブラウザの自動再生ポリシーにより、音声付き動画は自動再生できません

### 圧縮ツール
- [HandBrake](https://handbrake.fr/) - 無料の動画変換ツール
- [FFmpeg](https://ffmpeg.org/) - コマンドラインツール
- オンライン: [Online Video Compressor](https://www.freeconvert.com/video-compressor)

### FFmpegでの圧縮例
```bash
# PC用（1920x1080）
ffmpeg -i input.mp4 -vf scale=1920:1080 -c:v libx264 -preset slow -crf 28 -an opening-pc.mp4

# スマホ用（1280x720）
ffmpeg -i input.mp4 -vf scale=1280:720 -c:v libx264 -preset slow -crf 30 -an opening-sp.mp4
```

## 📂 ファイル配置後

動画をこのディレクトリに配置したら、実装を開始します。

### アクセスパス
```php
// PHP側
get_template_directory_uri() . '/assets/videos/opening-pc.mp4'

// JavaScript側（Vite使用時）
import openingVideo from '@/assets/videos/opening-pc.mp4'
```

## ✅ チェックリスト

- [ ] PC用動画（opening-pc.mp4）を配置
- [ ] （オプション）スマホ用動画（opening-sp.mp4）を配置
- [ ] ファイルサイズが適切か確認（PC: 5MB以下、スマホ: 2MB以下）
- [ ] 動画の長さが10秒前後か確認
- [ ] ブラウザで動画が再生できるか確認
