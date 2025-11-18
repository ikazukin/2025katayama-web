/**
 * Gallery Carousel Block
 * 施工実績用カルーセルギャラリーブロック
 */

import { registerBlockType } from '@wordpress/blocks';
import edit from './edit.jsx';
import save from './save.jsx';
import './style.scss';

registerBlockType('katayama/gallery-carousel', {
  title: '📸 カルーセルギャラリー',
  description: '複数の画像をカルーセル（スライドショー）形式で表示します',
  category: 'katayama-works',
  icon: 'images-alt2',
  keywords: ['gallery', 'carousel', 'slider', 'ギャラリー', 'カルーセル', '施工写真'],

  attributes: {
    images: {
      type: 'array',
      default: [],
    },
    autoplay: {
      type: 'boolean',
      default: true,
    },
    speed: {
      type: 'number',
      default: 3000,
    },
    showThumbnails: {
      type: 'boolean',
      default: true,
    },
  },

  edit,
  save,
});
