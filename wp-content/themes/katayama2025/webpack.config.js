import { createRequire } from 'module';
import { fileURLToPath } from 'url';
import { dirname, resolve } from 'path';

const require = createRequire(import.meta.url);
const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

const defaultConfig = require('@wordpress/scripts/config/webpack.config');

export default {
  ...defaultConfig,
  entry: {
    'gallery-carousel/index': resolve(
      __dirname,
      'blocks',
      'gallery-carousel',
      'index.js'
    ),
    'before-after/index': resolve(
      __dirname,
      'blocks',
      'before-after',
      'index.js'
    ),
  },
};
