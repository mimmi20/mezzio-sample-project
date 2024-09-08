module.exports = function (ctx) {
  const root = process.cwd();

  return {
    plugins: [
      require('postcss-import')({root: root}),
      require('postcss-will-change'),
      require('postcss-color-rebeccapurple')({ preserve: true }),
      require('postcss-color-rgba-fallback'),
      require('postcss-flexbugs-fixes'),
      // require('postcss-prefixwrap')('.base-container'),// no prefix here, will be added in the next step
      // require('postcss-prefix-selector')({
      //   prefix: 'atb__',
      //   transform(prefix, selector, prefixedSelector, filePath, rule) {
      //     if (filePath.match(/node_modules/)) {
      //       return selector; // Do not prefix styles imported from node_modules
      //     }
      //
      //     const annotation = rule.prev();
      //     if (annotation?.type === 'comment' && annotation.text.trim() === 'no-prefix') {
      //       return selector; // Do not prefix style rules that are preceded by: /* no-prefix */
      //     }
      //
      //
      //     const conditionCssClass = /\.([a-z_][\w-]+)/;
      //     const regExpCssClass = new RegExp(conditionCssClass, 'gi');
      //
      //     return selector.replace(regExpCssClass, function (matchAllClass, matchClass) {
      //       const hasNotNamespce = matchClass.match(new RegExp(prefix, 'gi')) === null;
      //
      //       if (hasNotNamespce) {
      //         return '.' + prefix + matchClass;
      //       }
      //
      //       return matchClass;
      //     });
      //   },
      // }),
      require('postcss-preset-env')({
        'stage': 2,
        'minimumVendorImplementations': 0,
        'features': {
          'any-link-pseudo-class': true,
          'cascade-layers': true,
          'clamp': {'precalculate': true},
          'color-function': true,
          'custom-media-queries': true,
          'custom-properties': true,
          'custom-selectors': true,
          'dir-pseudo-class': true,
          'display-two-values': true,
          'focus-visible-pseudo-class': true,
          'focus-within-pseudo-class': true,
          'font-format-keywords': true,
          'gap-properties': true,
          'hexadecimal-alpha-notation': true,
          'image-set-function': {'onInvalid': 'warning'},
          'is-pseudo-class': false,
          'media-query-ranges': true,
          'nested-calc': true,
          'nesting-rules': {'noIsPseudoSelector': false},
          'not-pseudo-class': true,
          'opacity-percentage': true,
          'overflow-property': true,
          'overflow-wrap-property': {'method': 'copy'},
          'rebeccapurple-color': {'preserve': false},
          'system-ui-font-family': true,
          'text-decoration-shorthand': true,
          'trigonometric-functions': true,
          'unset-value': true
        },
        'autoprefixer': {'grid': true},
        'preserve': true
      }),
      ctx.env === 'production' ? require('cssnano')({
        preset: 'default',
        safe: true,
        calc: false,
        minifyFontWeight: false,
        precision: 2
      }) : false,
    ],
  };
};
