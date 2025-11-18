/**
 * Gallery Carousel Block - Edit Component
 * 編集画面
 */

import { __ } from '@wordpress/i18n';
import {
  useBlockProps,
  MediaUpload,
  MediaPlaceholder,
  InspectorControls,
} from '@wordpress/block-editor';
import {
  PanelBody,
  ToggleControl,
  RangeControl,
  Button,
  IconButton,
} from '@wordpress/components';
import { DndContext, closestCenter } from '@dnd-kit/core';
import {
  arrayMove,
  SortableContext,
  useSortable,
  verticalListSortingStrategy,
} from '@dnd-kit/sortable';
import { CSS } from '@dnd-kit/utilities';

// ソート可能な画像アイテム
function SortableImage({ id, image, onRemove }) {
  const {
    attributes,
    listeners,
    setNodeRef,
    transform,
    transition,
  } = useSortable({ id });

  const style = {
    transform: CSS.Transform.toString(transform),
    transition,
  };

  return (
    <div ref={setNodeRef} style={style} className="gallery-carousel-image-item">
      <div className="image-container">
        <img src={image.sizes?.medium?.url || image.url} alt={image.alt || ''} />
        <div className="image-actions">
          <Button
            icon="no-alt"
            label={__('画像を削除', 'katayama')}
            onClick={() => onRemove(id)}
            className="remove-image"
          />
          <div className="drag-handle" {...listeners} {...attributes}>
            <span className="dashicons dashicons-move"></span>
          </div>
        </div>
      </div>
    </div>
  );
}

export default function Edit({ attributes, setAttributes }) {
  const { images, autoplay, speed, showThumbnails } = attributes;
  const blockProps = useBlockProps();

  const onSelectImages = (selectedImages) => {
    setAttributes({
      images: selectedImages.map((img) => ({
        id: img.id,
        url: img.url,
        alt: img.alt,
        sizes: img.sizes,
      })),
    });
  };

  const removeImage = (imageId) => {
    setAttributes({
      images: images.filter((img) => img.id !== imageId),
    });
  };

  const handleDragEnd = (event) => {
    const { active, over } = event;

    if (active.id !== over.id) {
      const oldIndex = images.findIndex((img) => img.id === active.id);
      const newIndex = images.findIndex((img) => img.id === over.id);

      setAttributes({
        images: arrayMove(images, oldIndex, newIndex),
      });
    }
  };

  return (
    <>
      <InspectorControls>
        <PanelBody title={__('カルーセル設定', 'katayama')}>
          <ToggleControl
            label={__('自動再生', 'katayama')}
            checked={autoplay}
            onChange={(value) => setAttributes({ autoplay: value })}
            help={autoplay ? __('自動でスライドします', 'katayama') : __('手動でスライドします', 'katayama')}
          />

          {autoplay && (
            <RangeControl
              label={__('スライド速度（ミリ秒）', 'katayama')}
              value={speed}
              onChange={(value) => setAttributes({ speed: value })}
              min={2000}
              max={10000}
              step={500}
            />
          )}

          <ToggleControl
            label={__('サムネイル表示', 'katayama')}
            checked={showThumbnails}
            onChange={(value) => setAttributes({ showThumbnails: value })}
          />
        </PanelBody>
      </InspectorControls>

      <div {...blockProps}>
        {images.length === 0 ? (
          <MediaPlaceholder
            icon="images-alt2"
            labels={{
              title: __('カルーセルギャラリー', 'katayama'),
              instructions: __('複数の画像をアップロードしてください', 'katayama'),
            }}
            onSelect={onSelectImages}
            accept="image/*"
            allowedTypes={['image']}
            multiple
          />
        ) : (
          <div className="gallery-carousel-editor">
            <div className="images-container">
              <DndContext collisionDetection={closestCenter} onDragEnd={handleDragEnd}>
                <SortableContext items={images.map((img) => img.id)} strategy={verticalListSortingStrategy}>
                  {images.map((image) => (
                    <SortableImage
                      key={image.id}
                      id={image.id}
                      image={image}
                      onRemove={removeImage}
                    />
                  ))}
                </SortableContext>
              </DndContext>
            </div>

            <MediaUpload
              onSelect={onSelectImages}
              allowedTypes={['image']}
              multiple
              value={images.map((img) => img.id)}
              render={({ open }) => (
                <Button
                  onClick={open}
                  variant="secondary"
                  className="add-more-images"
                >
                  {__('+ 画像を追加', 'katayama')}
                </Button>
              )}
            />

            <div className="gallery-info">
              <p>
                {images.length} 枚の画像
                {autoplay && ` / ${speed / 1000}秒ごとに自動再生`}
              </p>
            </div>
          </div>
        )}
      </div>
    </>
  );
}
