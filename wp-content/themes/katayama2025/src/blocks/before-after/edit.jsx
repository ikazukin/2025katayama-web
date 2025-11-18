/**
 * Before-After Block - Edit Component
 * 編集画面
 */

import { __ } from '@wordpress/i18n';
import {
  useBlockProps,
  MediaUpload,
  MediaPlaceholder,
  InspectorControls,
  RichText,
} from '@wordpress/block-editor';
import {
  PanelBody,
  RangeControl,
  Button,
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
  const { beforeImage, afterImage, description, startPosition } = attributes;
  const blockProps = useBlockProps();

  const onSelectBeforeImage = (media) => {
    setAttributes({
      beforeImage: {
        id: media.id,
        url: media.url,
        alt: media.alt,
        sizes: media.sizes,
      },
    });
  };

  const onSelectAfterImage = (media) => {
    setAttributes({
      afterImage: {
        id: media.id,
        url: media.url,
        alt: media.alt,
        sizes: media.sizes,
      },
    });
  };

  const removeBeforeImage = () => {
    setAttributes({ beforeImage: null });
  };

  const removeAfterImage = () => {
    setAttributes({ afterImage: null });
  };

  return (
    <>
      <InspectorControls>
        <PanelBody title={__('比較設定', 'katayama')}>
          <RangeControl
            label={__('スライダー初期位置（%）', 'katayama')}
            value={startPosition}
            onChange={(value) => setAttributes({ startPosition: value })}
            min={0}
            max={100}
            step={5}
            help={__('0% = すべてBefore、100% = すべてAfter', 'katayama')}
          />
        </PanelBody>
      </InspectorControls>

      <div {...blockProps}>
        <div className="before-after-editor">
          <div className="images-grid">
            {/* Before画像 */}
            <div className="image-column">
              <h4>{__('Before（工事前）', 'katayama')}</h4>
              {!beforeImage ? (
                <MediaPlaceholder
                  icon="format-image"
                  labels={{
                    title: __('Before画像', 'katayama'),
                    instructions: __('工事前の画像をアップロード', 'katayama'),
                  }}
                  onSelect={onSelectBeforeImage}
                  accept="image/*"
                  allowedTypes={['image']}
                />
              ) : (
                <div className="image-preview">
                  <img src={beforeImage.url} alt={beforeImage.alt || 'Before'} />
                  <Button
                    icon="no-alt"
                    label={__('画像を削除', 'katayama')}
                    onClick={removeBeforeImage}
                    className="remove-image"
                  />
                </div>
              )}
            </div>

            {/* After画像 */}
            <div className="image-column">
              <h4>{__('After（工事後）', 'katayama')}</h4>
              {!afterImage ? (
                <MediaPlaceholder
                  icon="format-image"
                  labels={{
                    title: __('After画像', 'katayama'),
                    instructions: __('工事後の画像をアップロード', 'katayama'),
                  }}
                  onSelect={onSelectAfterImage}
                  accept="image/*"
                  allowedTypes={['image']}
                />
              ) : (
                <div className="image-preview">
                  <img src={afterImage.url} alt={afterImage.alt || 'After'} />
                  <Button
                    icon="no-alt"
                    label={__('画像を削除', 'katayama')}
                    onClick={removeAfterImage}
                    className="remove-image"
                  />
                </div>
              )}
            </div>
          </div>

          {/* 説明文 */}
          <div className="description-field">
            <label>{__('説明文（任意）', 'katayama')}</label>
            <RichText
              tagName="p"
              value={description}
              onChange={(value) => setAttributes({ description: value })}
              placeholder={__('工事の説明を入力...', 'katayama')}
            />
          </div>

          {/* プレビューヒント */}
          {beforeImage && afterImage && (
            <div className="preview-hint">
              <p>
                💡 {__('公開ページではスライダーで左右にドラッグして比較できます', 'katayama')}
              </p>
            </div>
          )}
        </div>
      </div>
    </>
  );
}
