import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'src/main.js'),
        style: path.resolve(__dirname, 'src/style.css')
      },
      output: {
        entryFileNames: 'assets/[name].[hash].js',
        chunkFileNames: 'assets/[name].[hash].js',
        assetFileNames: 'assets/[name].[hash].[ext]'
      }
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
