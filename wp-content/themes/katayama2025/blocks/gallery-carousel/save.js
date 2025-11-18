/**
 * Gallery Carousel Block - Save Component
 * 保存処理
 */

import { useBlockProps } from '@wordpress/block-editor';

export default function save({ attributes }) {
  const { images, autoplay, speed, showThumbnails } = attributes;

  if (!images || images.length === 0) {
    return null;
  }

  const blockProps = useBlockProps.save({
    className: 'wp-block-katayama-gallery-carousel',
  });

  return (
    <div
      {...blockProps}
      data-autoplay={autoplay}
      data-speed={speed}
      data-thumbnails={showThumbnails}
    >
      <div className="swiper carousel-container">
        <div className="swiper-wrapper">
          {images.map((image, index) => (
            <div key={image.id} className="swiper-slide">
              <img
                src={image.url}
                alt={image.alt || `施工写真 ${index + 1}`}
                loading="lazy"
              />
            </div>
          ))}
        </div>

        {/* ナビゲーションボタン */}
        <div className="swiper-button-prev"></div>
        <div className="swiper-button-next"></div>

        {/* ページネーション */}
        <div className="swiper-pagination"></div>
      </div>

      {/* サムネイル */}
      {showThumbnails && images.length > 1 && (
        <div className="swiper carousel-thumbs">
          <div className="swiper-wrapper">
            {images.map((image, index) => (
              <div key={`thumb-${image.id}`} className="swiper-slide">
                <img
                  src={image.sizes?.thumbnail?.url || image.url}
                  alt={image.alt || `サムネイル ${index + 1}`}
                  loading="lazy"
                />
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  );
}
