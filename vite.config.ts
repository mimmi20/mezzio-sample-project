import { defineConfig } from 'vite';
import * as path from 'path';
import viteImagemin from '@vheemstra/vite-plugin-imagemin';
import imageminJpegtran from '@yeanzhi/imagemin-jpegtran';
import imageminPngquant from '@localnerve/imagemin-pngquant';
import imageminGif from '@localnerve/imagemin-gifsicle';
import imageminWebp from '@yeanzhi/imagemin-webp';
import imageminGifToWebp from 'imagemin-gif2webp';
import imageminAviv from '@vheemstra/imagemin-avifenc';
import imageminSvgo from '@koddsson/imagemin-svgo';
import { resolveToEsbuildTarget } from 'esbuild-plugin-browserslist';
import browserslist from 'browserslist';
import { compression } from 'vite-plugin-compression2';

const target = resolveToEsbuildTarget(browserslist('defaults'), {
  printUnknownTargets: false,
});

const SvgoOpts = {
  multipass: true,
  plugins: [
    {
      name: 'preset-default',
      params: {
        overrides: {
          removeViewBox: false,
          removeComments: true,
          cleanupNumericValues: {
            floatPrecision: 2,
          },
          convertColors: {
            shortname: false,
          },
        },
      },
    },
  ],
};

export default defineConfig({
  appType: 'custom',
  root: __dirname,
  publicDir: 'public',
  base: '/dist/',
  plugins: [
    viteImagemin({
      plugins: {
        jpg: imageminJpegtran(),
        png: imageminPngquant({
          quality: [0.8, 1],
        }),
        gif: imageminGif(),
        svg: imageminSvgo(SvgoOpts),
      },
      onlyAssets: true,
      skipIfLarger: true,
      clearCache: true,
      makeWebp: {
        plugins: {
          jpg: imageminWebp({ quality: 100 }),
          png: imageminWebp({ quality: 100 }),
          gif: imageminGifToWebp({ quality: 82 }),
        },
        skipIfLargerThan: 'optimized',
      },
      makeAvif: {
        plugins: {
          jpg: imageminAviv({ lossless: true }),
          png: imageminAviv({ lossless: true }),
        },
        skipIfLargerThan: 'optimized',
      },
    }),
    compression({ deleteOriginalAssets: false, skipIfLargerOrEqual: true, algorithm: 'gzip', include: /\.(html|css|js|cjs|mjs|svg|woff|woff2|json|jpeg|jpg|gif|png|webp|avif)$/ }),
    compression({ deleteOriginalAssets: false, skipIfLargerOrEqual: true, algorithm: 'brotliCompress', include: /\.(html|css|js|cjs|mjs|svg|woff|woff2|json|jpeg|jpg|gif|png|webp|avif)$/ }),
  ],
  server: {
    host: 'localhost',
    port: 3000,
    strictPort: true,
    hmr: {
      host: 'localhost',
      clientPort: 3000,
    },
    origin: 'http://localhost:3000',
  },
  build: {
    target: target,
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
        path.resolve(__dirname, 'public/js/dialog.ts'),
        path.resolve(__dirname, 'public/js/versbeginn.ts'),
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
        path.resolve(__dirname, 'public/css/navigation.css'),
        path.resolve(__dirname, 'public/css/accordion.css'),
        path.resolve(__dirname, 'public/css/validation.css'),
        // Bootstrap
        path.resolve(__dirname, 'node_modules/bootstrap/dist/css/bootstrap.css'),
        path.resolve(__dirname, 'node_modules/bootstrap/dist/js/bootstrap.esm.js'),
        // Bootstrap Icons
        path.resolve(__dirname, 'node_modules/bootstrap-icons/font/bootstrap-icons.css'),
        // Themes
        path.resolve(__dirname, 'node_modules/bootswatch/dist/morph/bootstrap.css'),
        path.resolve(__dirname, 'node_modules/bootswatch/dist/quartz/bootstrap.css'),
        path.resolve(__dirname, 'node_modules/bootswatch/dist/materia/bootstrap.css'),
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
    modulePreload: {
      polyfill: false,
    },
  },
  css: {
    devSourcemap: true,
    transformer: 'postcss',
    preprocessorOptions: {
      scss: {
        api: 'modern-compiler',
        outputStyle: 'expanded',
        alertAscii: true,
        alertColor: true,
        verbose: true,
      },
    },
  },
});
