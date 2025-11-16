import { defineConfig } from 'vite';
import path from 'path';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'src/main.js'),
        style: path.resolve(__dirname, 'src/style.css'),
        blocks: path.resolve(__dirname, 'src/blocks/index.js')
      },
      output: {
        entryFileNames: 'assets/[name].[hash].js',
        chunkFileNames: 'assets/[name].[hash].js',
        assetFileNames: 'assets/[name].[hash].[ext]'
      },
      external: [
        '@wordpress/blocks',
        '@wordpress/i18n',
        '@wordpress/block-editor',
        '@wordpress/components',
        '@wordpress/element',
        '@wordpress/data'
      ]
    }
  },
  resolve: {
    alias: {
      '@wordpress/blocks': 'wp.blocks',
      '@wordpress/i18n': 'wp.i18n',
      '@wordpress/block-editor': 'wp.blockEditor',
      '@wordpress/components': 'wp.components',
      '@wordpress/element': 'wp.element',
      '@wordpress/data': 'wp.data'
    }
  },
  server: {
    host: '0.0.0.0',
    port: 5173,
    strictPort: false,
    cors: true,
    hmr: {
      host: 'localhost'
    }
  }
});
