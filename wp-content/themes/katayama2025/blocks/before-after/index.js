/**
 * Before-After Comparison Block
 * ビフォーアフター比較ブロック
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
