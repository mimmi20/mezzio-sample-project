import {defineConfig} from 'vite';
import * as path from 'path';
import stylelint from 'vite-plugin-stylelint';
import eslint from 'vite-plugin-eslint';

export default defineConfig({
  appType: 'custom',
  root: __dirname,
  publicDir: 'public',
  base: '/dist/',
  plugins: [
    stylelint(),
    //eslint(),
  ],
  server: {
    host: 'localhost',
    port: 8082,
    strictPort: true,
    hmr: {
      host: 'localhost',
      clientPort: 8082,
    },
    origin: 'http://localhost:8082',
    watch: {},
  },
  build: {
    target: 'modules',
    outDir: 'public/dist', // relative to the `root` folder
    assetsDir: 'assets/',
    emptyOutDir: true,
    copyPublicDir: false,
    minify: false,
    manifest: true,
    assetsInlineLimit: 0,
    rollupOptions: {
      // https://rollupjs.org/configuration-options/
      input: [
        // general js
        path.resolve(__dirname, 'public/js/form.ts'),
        path.resolve(__dirname, 'public/js/hr.ts'),
        path.resolve(__dirname, 'public/js/phv.ts'),
        path.resolve(__dirname, 'public/js/rl.ts'),
        path.resolve(__dirname, 'public/js/rs.ts'),
        path.resolve(__dirname, 'public/js/tie.ts'),
        path.resolve(__dirname, 'public/js/unf.ts'),
        path.resolve(__dirname, 'public/js/wg.ts'),
        path.resolve(__dirname, 'public/js/atb.ts'),
        // glass theme
        path.resolve(__dirname, 'public/css/themes/glass.css'),
        // general css
        path.resolve(__dirname, 'public/css/404.css'),
        path.resolve(__dirname, 'public/css/help.css'),
        path.resolve(__dirname, 'public/css/hr.css'),
        path.resolve(__dirname, 'public/css/phv.css'),
        path.resolve(__dirname, 'public/css/rl.css'),
        path.resolve(__dirname, 'public/css/rs.css'),
        path.resolve(__dirname, 'public/css/styles.css'),
        path.resolve(__dirname, 'public/css/tie.css'),
        path.resolve(__dirname, 'public/css/unf.css'),
        path.resolve(__dirname, 'public/css/wg.css'),
        path.resolve(__dirname, 'public/css/atb.css'),
        path.resolve(__dirname, 'node_modules/@fortawesome/fontawesome-free/css/all.css'),
      ],
      output: {
        // dir: 'public/dist',
        format: 'es',
        generatedCode: {
          arrowFunctions: true,
          constBindings: true,
        },
        strict: true,
      },
    },
    watch: {
      // https://rollupjs.org/configuration-options/#watch
    },
    modulePreload: {
      polyfill: false
    },
  },
  css: {
    devSourcemap: true,
    transformer: 'postcss',
    preprocessorOptions: {
      scss: {
        outputStyle: 'expanded',
        alertAscii: true,
        alertColor: true,
        verbose: true,
      }
    }
  },
})
