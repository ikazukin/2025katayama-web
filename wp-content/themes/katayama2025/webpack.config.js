const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
  ...defaultConfig,
  entry: {
    'gallery-carousel/index': path.resolve(
      process.cwd(),
      'blocks',
      'gallery-carousel',
      'index.js'
    ),
    'before-after/index': path.resolve(
      process.cwd(),
      'blocks',
      'before-after',
      'index.js'
    ),
  },
};
