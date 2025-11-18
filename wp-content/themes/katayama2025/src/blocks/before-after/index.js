/**
 * Before-After Comparison Block
 * ビフォーアフター比較ブロック
 */

import { registerBlockType } from '@wordpress/blocks';
import edit from './edit.jsx';
import save from './save.jsx';
import './style.scss';

registerBlockType('katayama/before-after', {
  title: '🔄 ビフォーアフター比較',
  description: '工事前後の画像を比較スライダーで表示します',
  category: 'katayama-works',
  icon: 'image-flip-horizontal',
  keywords: ['before', 'after', 'comparison', 'slider', 'ビフォー', 'アフター', '比較'],

  attributes: {
    beforeImage: {
      type: 'object',
      default: null,
    },
    afterImage: {
      type: 'object',
      default: null,
    },
    description: {
      type: 'string',
      default: '',
    },
    startPosition: {
      type: 'number',
      default: 50,
    },
  },

  edit,
  save,
});
