/**
 * Gallery Carousel Block
 * 施工実績用カルーセルギャラリーブロック
 */

import { registerBlockType } from '@wordpress/blocks';
import edit from './edit';
import save from './save';
import './style.scss';
import metadata from './block.json';

registerBlockType(metadata.name, {
  ...metadata,
  edit,
  save,
});
