/**
 * Gallery Carousel Block
 * 施工実績用カルーセルギャラリーブロック
 */

import { registerBlockType } from '@wordpress/blocks';
import edit from './edit.js';
import save from './save.js';
import './style.scss';
import metadata from './block.json' with { type: 'json' };

registerBlockType(metadata.name, {
  ...metadata,
  edit,
  save,
});
