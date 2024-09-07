module.exports = function (ctx) {
  const root = process.cwd();

  return {
    map: ctx.env !== 'production',
    syntax: 'postcss-scss',
    parser: 'postcss-scss',
    plugins: [
      require('@csstools/postcss-sass')({
        style: 'expanded',
        alertAscii: true,
        alertColor: true,
        verbose: ctx.env !== 'production',
      }),
      require('postcss-import')({ root: root }),
      require('postcss-strip-inline-comments'),
      require('postcss-will-change'),
      require('postcss-color-rebeccapurple')({ preserve: true }),
      require('css-declaration-sorter')({ order: 'smacss', keepOverrides: true }),
      require('postcss-color-rgba-fallback'),
      //require('postcss-prefixwrap')('.base-container'),// no prefix here, will be added in the next step
      //require('postcss-prefix-selector')(),
      //require('postcss-modules'),
      require('postcss-rtl-logical-properties'),
      require('postcss-preset-env')({
        stage: 2,
        minimumVendorImplementations: 0,
        features: {
          'any-link-pseudo-class': { preserve: true }, // allows using ":any-link" pseudo class
          'cascade-layers': true,
          clamp: { precalculate: true }, // allows using "clamp()" function
          'color-function': { preserve: true }, // allows using "color()" function
          'custom-media-queries': { preserve: true },
          'custom-properties': { preserve: true },
          'custom-selectors': { preserve: true },
          'dir-pseudo-class': { preserve: true }, // allows using ":dir" pseudo class
          'display-two-values': { preserve: true },
          'float-clear-logical-values': true,
          'focus-visible-pseudo-class': { preserve: true }, // allows using ":focus-visible" pseudo class
          'focus-within-pseudo-class': { preserve: true }, // allows using ":focus-within" pseudo class
          'font-format-keywords': { preserve: true },
          'gap-properties': { preserve: true },
          'hexadecimal-alpha-notation': { preserve: true },
          'image-set-function': { preserve: true, onInvalid: 'warning' }, // allows using "image-set()" function
          'is-pseudo-class': false, // allows using ":is" pseudo class
          'logical-overflow': { preserve: true },
          'logical-overscroll-behavior': { preserve: true },
          'logical-properties-and-values': { preserve: true },
          'logical-resize': { preserve: true },
          'logical-viewport-units': { preserve: true },
          'media-query-ranges': true,
          'nested-calc': { preserve: true },
          'nesting-rules': { noIsPseudoSelector: false },
          'not-pseudo-class': true, // allows using ":not" pseudo class
          'opacity-percentage': { preserve: true },
          'overflow-property': { preserve: true },
          'overflow-wrap-property': { method: 'copy' },
          'rebeccapurple-color': { preserve: false },
          'system-ui-font-family': { preserve: true },
          'text-decoration-shorthand': { preserve: true },
          'trigonometric-functions': { preserve: true },
          'unset-value': { preserve: true },
        },
        autoprefixer: { grid: true },
        preserve: true,
      }),
      require('postcss-pxtorem')({ mediaQuery: true, propList: ['*'] }),
      require('css-declaration-sorter')({ keepOverrides: true, order: 'smacss' }),
      ctx.env === 'production'
        ? require('cssnano')({
            preset: 'default',
            safe: true,
            calc: false,
            minifyFontWeight: false,
            precision: 2,
          })
        : false,
    ],
  };
};
