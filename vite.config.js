import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';
import viteReact from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/components/Cart.jsx',
      ],
      refresh: true,
    }),
    react(),
  ],
});
