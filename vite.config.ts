import zlib from 'zlib';
import { defineConfig } from 'vite';
import * as path from 'path';
import { resolveToEsbuildTarget } from 'esbuild-plugin-browserslist';
import browserslist from 'browserslist';
import { compression, defineAlgorithm } from 'vite-plugin-compression2';
import autoOrigin from 'vite-plugin-auto-origin';
import { ViteImageOptimizer } from 'vite-plugin-image-optimizer';
import { NodePackageImporter } from 'sass-embedded';
import { imagetools } from 'vite-imagetools';

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
          removeComments: true,
          cleanupNumericValues: {
            floatPrecision: 2,
          },
          convertColors: {
            shortname: false,
          },
        },
        cleanupIDs: {
          minify: false,
          remove: false,
        },
        convertPathData: false,
      },
    },
    'sortAttrs',
    {
      name: 'addAttributesToSVGElement',
      params: {
        attributes: [{ xmlns: 'http://www.w3.org/2000/svg' }],
      },
    },
  ],
};

const minifyOptions = {
  test: /\.(jpe?g|png|gif|tiff|webp|svg|avif)$/i,
  includePublic: true,
  logStats: true,
  ansiColors: true,
  svg: SvgoOpts,
  png: {
    // https://sharp.pixelplumbing.com/api-output#png
    quality: 100,
  },
  jpeg: {
    // https://sharp.pixelplumbing.com/api-output#jpeg
    quality: 100,
  },
  jpg: {
    // https://sharp.pixelplumbing.com/api-output#jpeg
    quality: 100,
  },
  tiff: {
    // https://sharp.pixelplumbing.com/api-output#tiff
    quality: 100,
  },
  // gif does not support lossless compression
  // https://sharp.pixelplumbing.com/api-output#gif
  gif: {},
  webp: {
    // https://sharp.pixelplumbing.com/api-output#webp
    lossless: true,
  },
  avif: {
    // https://sharp.pixelplumbing.com/api-output#avif
    lossless: true,
  },
  cache: false,
  cacheLocation: undefined,
};

const compress = compression({
  algorithms: [
    defineAlgorithm('gzip', { level: 9 }),
    defineAlgorithm('brotliCompress', {
      params: {
        [zlib.constants.BROTLI_PARAM_QUALITY]: 11,
        [zlib.constants.BROTLI_PARAM_MODE]: 1,
        [zlib.constants.BROTLI_PARAM_LGWIN]: 24,
      },
    }),
  ],
  deleteOriginalAssets: false,
  skipIfLargerOrEqual: true,
  include: /\.(html|css|js|cjs|mjs|svg|woff|woff2|json|jpeg|jpg|gif|png|webp|avif)$/,
});

export default defineConfig({
  appType: 'custom',
  root: __dirname,
  publicDir: 'public',
  base: '/',
  plugins: [
    imagetools({
      exclude: [],
      // include: /^[^?]+\.(avif|gif|heif|jpeg|jpg|png|tiff|webp)(\?.*)?$/
      // https://github.com/JonasKruckenberg/imagetools/issues/317
      include: /\.(gif)/,
      defaultDirectives: () => {
        return new URLSearchParams({
          quality: "82",
          effort: "max",
          format: "gif;webp"
        });
      }
    }),
    imagetools({
      exclude: [],
      // include: /^[^?]+\.(avif|gif|heif|jpeg|jpg|png|tiff|webp)(\?.*)?$/
      // https://github.com/JonasKruckenberg/imagetools/issues/317
      include: /\.(jpe?g)/,
      defaultDirectives: (url) => {
        return new URLSearchParams({
          lossless: "1",
          quality: "100",
          effort: "max",
          format: "jpg;webp;avif"
        });
      }
    }),
    imagetools({
      exclude: [],
      // include: /^[^?]+\.(avif|gif|heif|jpeg|jpg|png|tiff|webp)(\?.*)?$/
      // https://github.com/JonasKruckenberg/imagetools/issues/317
      include: /\.(png)/,
      defaultDirectives: (url) => {
        return new URLSearchParams({
          lossless: "1",
          quality: "100",
          effort: "max",
          format: "png;webp;avif"
        });
      }
    }),
    ViteImageOptimizer(minifyOptions),
    compress,
    autoOrigin()
  ],
  server: {
    host: 'localhost',
    port: 8082,
    strictPort: true,
    hmr: {
      host: 'localhost',
      clientPort: 8082,
      overlay: true,
    },
    watch: {
      usePolling: true,
      ignored: /(^|[\/\\])\..|\.php|vendor/,
    },
    origin: 'http://localhost:8082',
  },
  build: {
    target,
    outDir: 'public/dist', // relative to the `root` folder
    assetsDir: 'assets/',
    emptyOutDir: true,
    copyPublicDir: false,
    minify: false,
    sourcemap: true,
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
        path.resolve(__dirname, 'public/css/styles.scss'),
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
        // Images
        path.resolve(__dirname, 'public/img/ico_datepicker.svg'),
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
        importers: [new NodePackageImporter(process.cwd())],
        quietDeps: true,
        fatalDeprecations: ['legacy-js-api'],
      },
    },
  },
});
