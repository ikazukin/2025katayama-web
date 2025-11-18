/**
 * Before-After Block - Save Component
 * 保存処理
 */

import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
  const { beforeImage, afterImage, description, startPosition } = attributes;

  if (!beforeImage || !afterImage) {
    return null;
  }

  const blockProps = useBlockProps.save({
    className: 'wp-block-katayama-before-after',
  });

  return (
    <div {...blockProps}>
      <div
        className="image-compare"
        data-start-position={startPosition}
      >
        {/* Before画像 */}
        <div className="image-before">
          <img
            src={beforeImage.url}
            alt={beforeImage.alt || 'Before'}
            loading="lazy"
          />
          <span className="label label-before">Before</span>
        </div>

        {/* After画像 */}
        <div className="image-after">
          <img
            src={afterImage.url}
            alt={afterImage.alt || 'After'}
            loading="lazy"
          />
          <span className="label label-after">After</span>
        </div>

        {/* スライダー */}
        <div className="slider-handle">
          <div className="slider-line"></div>
          <div className="slider-button">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15 18L9 12L15 6" stroke="white" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
              <path d="M9 18L15 12L9 6" stroke="white" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/>
            </svg>
          </div>
        </div>
      </div>

      {/* 説明文 */}
      {description && (
        <RichText.Content
          tagName="p"
          value={description}
          className="comparison-description"
        />
      )}
    </div>
  );
}
