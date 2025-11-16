/**
 * Hero Section Block
 * Issue 18 - ブロックエディタ版（簡易デモ）
 */

import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import Edit from './edit';

registerBlockType('katayama/hero', {
  title: __('Hero Section', 'katayama2025'),
  description: __('トップページのHeroセクション（動画背景＋キャッチコピー）', 'katayama2025'),
  icon: 'align-center',
  category: 'layout',
  keywords: ['hero', 'ヒーロー', '動画'],

  attributes: {
    title: {
      type: 'string',
      default: '',
    },
    subtitle: {
      type: 'string',
      default: '',
    },
    pcVideoId: {
      type: 'number',
      default: 0,
    },
    pcVideoUrl: {
      type: 'string',
      default: '',
    },
    spVideoId: {
      type: 'number',
      default: 0,
    },
    spVideoUrl: {
      type: 'string',
      default: '',
    },
    posterId: {
      type: 'number',
      default: 0,
    },
    posterUrl: {
      type: 'string',
      default: '',
    },
    ctaText: {
      type: 'string',
      default: '',
    },
    ctaLink: {
      type: 'string',
      default: '',
    },
  },

  edit: Edit,

  // 動的レンダリング（PHPで出力）
  save: () => null,
});
