/**
 * Hero Section Block - Edit Component
 */

import { __ } from '@wordpress/i18n';
import {
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
} from '@wordpress/block-editor';
import {
  PanelBody,
  TextControl,
  TextareaControl,
  Button,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
  const {
    title,
    subtitle,
    pcVideoId,
    pcVideoUrl,
    spVideoId,
    spVideoUrl,
    posterId,
    posterUrl,
    ctaText,
    ctaLink,
  } = attributes;

  return (
    <>
      <InspectorControls>
        {/* 動画設定 */}
        <PanelBody title={__('動画設定', 'katayama2025')} initialOpen={true}>
          {/* PC動画 */}
          <div className="components-base-control">
            <label className="components-base-control__label">
              {__('PC動画', 'katayama2025')}
            </label>
            <MediaUploadCheck>
              <MediaUpload
                onSelect={(media) => {
                  setAttributes({
                    pcVideoId: media.id,
                    pcVideoUrl: media.url,
                  });
                }}
                allowedTypes={['video']}
                value={pcVideoId}
                render={({ open }) => (
                  <div>
                    {pcVideoUrl && (
                      <div style={{ marginBottom: '10px' }}>
                        <video
                          src={pcVideoUrl}
                          style={{ width: '100%', maxHeight: '150px' }}
                          controls
                        />
                      </div>
                    )}
                    <Button onClick={open} variant="secondary">
                      {pcVideoUrl ? __('動画を変更', 'katayama2025') : __('動画を選択', 'katayama2025')}
                    </Button>
                    {pcVideoUrl && (
                      <Button
                        onClick={() => setAttributes({ pcVideoId: 0, pcVideoUrl: '' })}
                        variant="link"
                        isDestructive
                        style={{ marginLeft: '10px' }}
                      >
                        {__('削除', 'katayama2025')}
                      </Button>
                    )}
                  </div>
                )}
              />
            </MediaUploadCheck>
          </div>

          {/* SP動画 */}
          <div className="components-base-control" style={{ marginTop: '20px' }}>
            <label className="components-base-control__label">
              {__('SP動画', 'katayama2025')}
            </label>
            <MediaUploadCheck>
              <MediaUpload
                onSelect={(media) => {
                  setAttributes({
                    spVideoId: media.id,
                    spVideoUrl: media.url,
                  });
                }}
                allowedTypes={['video']}
                value={spVideoId}
                render={({ open }) => (
                  <div>
                    {spVideoUrl && (
                      <div style={{ marginBottom: '10px' }}>
                        <video
                          src={spVideoUrl}
                          style={{ width: '100%', maxHeight: '150px' }}
                          controls
                        />
                      </div>
                    )}
                    <Button onClick={open} variant="secondary">
                      {spVideoUrl ? __('動画を変更', 'katayama2025') : __('動画を選択', 'katayama2025')}
                    </Button>
                    {spVideoUrl && (
                      <Button
                        onClick={() => setAttributes({ spVideoId: 0, spVideoUrl: '' })}
                        variant="link"
                        isDestructive
                        style={{ marginLeft: '10px' }}
                      >
                        {__('削除', 'katayama2025')}
                      </Button>
                    )}
                  </div>
                )}
              />
            </MediaUploadCheck>
          </div>

          {/* Poster画像 */}
          <div className="components-base-control" style={{ marginTop: '20px' }}>
            <label className="components-base-control__label">
              {__('Poster画像（LCP用）', 'katayama2025')}
            </label>
            <MediaUploadCheck>
              <MediaUpload
                onSelect={(media) => {
                  setAttributes({
                    posterId: media.id,
                    posterUrl: media.url,
                  });
                }}
                allowedTypes={['image']}
                value={posterId}
                render={({ open }) => (
                  <div>
                    {posterUrl && (
                      <div style={{ marginBottom: '10px' }}>
                        <img
                          src={posterUrl}
                          alt="Poster"
                          style={{ width: '100%', maxHeight: '150px', objectFit: 'cover' }}
                        />
                      </div>
                    )}
                    <Button onClick={open} variant="secondary">
                      {posterUrl ? __('画像を変更', 'katayama2025') : __('画像を選択', 'katayama2025')}
                    </Button>
                    {posterUrl && (
                      <Button
                        onClick={() => setAttributes({ posterId: 0, posterUrl: '' })}
                        variant="link"
                        isDestructive
                        style={{ marginLeft: '10px' }}
                      >
                        {__('削除', 'katayama2025')}
                      </Button>
                    )}
                  </div>
                )}
              />
            </MediaUploadCheck>
          </div>
        </PanelBody>

        {/* テキスト設定 */}
        <PanelBody title={__('テキスト設定', 'katayama2025')} initialOpen={true}>
          <TextControl
            label={__('タイトル', 'katayama2025')}
            value={title}
            onChange={(value) => setAttributes({ title: value })}
            help={__('メインキャッチコピー', 'katayama2025')}
          />

          <TextareaControl
            label={__('サブタイトル', 'katayama2025')}
            value={subtitle}
            onChange={(value) => setAttributes({ subtitle: value })}
            help={__('サブキャッチコピー', 'katayama2025')}
            rows={3}
          />
        </PanelBody>

        {/* CTA設定 */}
        <PanelBody title={__('CTAボタン設定', 'katayama2025')} initialOpen={false}>
          <TextControl
            label={__('ボタンテキスト', 'katayama2025')}
            value={ctaText}
            onChange={(value) => setAttributes({ ctaText: value })}
          />

          <TextControl
            label={__('リンク先URL', 'katayama2025')}
            value={ctaLink}
            onChange={(value) => setAttributes({ ctaLink: value })}
            type="url"
          />
        </PanelBody>
      </InspectorControls>

      {/* プレビュー表示 */}
      <div className="hero-section-preview" style={{ position: 'relative', minHeight: '400px', background: '#000' }}>
        {/* 背景動画/画像 */}
        <div style={{ position: 'absolute', inset: 0 }}>
          {posterUrl && (
            <img
              src={posterUrl}
              alt="Hero Background"
              style={{
                width: '100%',
                height: '100%',
                objectFit: 'cover',
              }}
            />
          )}
          {!posterUrl && (
            <div style={{
              width: '100%',
              height: '100%',
              display: 'flex',
              alignItems: 'center',
              justifyContent: 'center',
              color: '#fff',
              fontSize: '14px',
            }}>
              Poster画像を設定してください →
            </div>
          )}
          <div style={{
            position: 'absolute',
            inset: 0,
            background: 'rgba(0, 0, 0, 0.4)',
          }} />
        </div>

        {/* コンテンツ */}
        <div style={{
          position: 'relative',
          zIndex: 10,
          height: '100%',
          display: 'flex',
          alignItems: 'center',
          justifyContent: 'center',
          textAlign: 'center',
          color: '#fff',
          padding: '60px 20px',
        }}>
          <div style={{ maxWidth: '800px' }}>
            {title && (
              <h1 style={{
                fontSize: '3rem',
                fontWeight: 'bold',
                marginBottom: '1rem',
                lineHeight: 1.2,
              }}>
                {title}
              </h1>
            )}

            {subtitle && (
              <p style={{
                fontSize: '1.5rem',
                marginBottom: '2rem',
                lineHeight: 1.5,
              }}>
                {subtitle}
              </p>
            )}

            {ctaText && (
              <a
                href={ctaLink || '#'}
                style={{
                  display: 'inline-block',
                  background: '#ff6b35',
                  color: '#fff',
                  padding: '1rem 2rem',
                  borderRadius: '9999px',
                  fontWeight: '600',
                  fontSize: '1.125rem',
                  textDecoration: 'none',
                  boxShadow: '0 10px 15px -3px rgba(0, 0, 0, 0.1)',
                }}
              >
                {ctaText}
              </a>
            )}

            {!title && !subtitle && !ctaText && (
              <div style={{ opacity: 0.7 }}>
                右側のサイドバーから編集してください →
              </div>
            )}
          </div>
        </div>
      </div>
    </>
  );
}
