/* global process */

import postcssColorRgbaFallback from 'postcss-color-rgba-fallback';
import postcssPxtorem from 'postcss-pxtorem';
import postcssPresetEnv from 'postcss-preset-env';
import cssnano from 'cssnano';
import { cssDeclarationSorter } from 'css-declaration-sorter';
import postcssUniqueSelectors from 'postcss-unique-selectors';
import postcssOrderedValues from 'postcss-ordered-values';
import postcssDiscardOverridden from 'postcss-discard-overridden';
import postcssDiscardEmpty from 'postcss-discard-empty';
import postcssDiscardDuplicates from 'postcss-discard-duplicates';
import postcssInputStyle from 'postcss-input-style';
import postcssFlexbugsFixes from 'postcss-flexbugs-fixes';
import postcssPseudoColons from 'postcss-pseudo-element-colons';
import autoprefixer from 'autoprefixer';
import postcssDiscardComments from 'postcss-discard-comments';
import postcssImport from 'postcss-import';
import postColorConverter from 'postcss-color-converter';
import postcssLightningcss from 'postcss-lightningcss';
import postcssRtlLogicalProperties from 'postcss-rtl-logical-properties';
import rtlcss from 'rtlcss';

export default function (ctx) {
  const root = process.cwd();

  return {
    plugins: [
      postcssImport({ root: root }),
      postcssInputStyle,
      postcssFlexbugsFixes,
      postcssPseudoColons({
        selectors: ['before', 'after', 'first-letter', 'first-line'],
        'colon-notation': 'double',
      }),
      postcssRtlLogicalProperties({ hDirection: 'LeftToRight', vDirection: 'TopToBottom'}),
      rtlcss(),
      postColorConverter({ outputColorFormat: 'rgb', ignore: ['rgb', 'hsl'], alwaysAlpha: true }),
      postcssPxtorem({
        propList: ['*'],
        replace: true,
        mediaQuery: true,
        minPixelValue: 0,
      }),
      postcssPresetEnv({
        stage: 1,
        minimumVendorImplementations: 0,
        features: {
          'all-property': { reset: 'all' }, // allows using "all" property with the "initial" keyword
          'any-link-pseudo-class': true, // allows using ":any-link" pseudo class
          'blank-pseudo-class': false, // requires js to work
          'break-properties': true,
          'cascade-layers': true,
          'case-insensitive-attributes': false,
          clamp: { precalculate: true }, // allows using "clamp()" function
          'color-function': true, // allows using "color()" function
          'color-functional-notation': true,
          'color-mix': true, // allows using "color-mix()" function
          'custom-media-queries': true,
          'custom-properties': true,
          'custom-selectors': true,
          'dir-pseudo-class': true, // allows using ":dir" pseudo class
          'display-two-values': true,
          'double-position-gradients': { enableProgressiveCustomProperties: true },
          'exponential-functions': true,
          'float-clear-logical-values': false,
          'focus-visible-pseudo-class': false, // allows using ":focus-visible" pseudo class - requires js to work
          'focus-within-pseudo-class': false, // allows using ":focus-within" pseudo class - requires js to work
          'font-format-keywords': true,
          'gamut-mapping': true,
          'gap-properties': true,
          'gradients-interpolation-method': { enableProgressiveCustomProperties: true },
          'has-pseudo-class': false, // allows using ":has()" pseudo class - requires js to work
          'hexadecimal-alpha-notation': true,
          'hwb-function': true, // allows using "hwb()" function
          'ic-unit': true, // allows using "ic" lenth unit
          'image-set-function': { onInvalid: 'warning' }, // allows using "image-set()" function
          'is-pseudo-class': false, // allows using ":is" pseudo class - requires js to work
          'lab-function': { enableProgressiveCustomProperties: true }, // allows using "lab()" function
          'light-dark-function': { enableProgressiveCustomProperties: true }, // allows using "light-dark()" function
          'logical-overflow': false,
          'logical-overscroll-behavior': false,
          'logical-properties-and-values': false,
          'logical-resize': false,
          'logical-viewport-units': false,
          'media-queries-aspect-ratio-number-values': true,
          'media-query-ranges': true,
          'nested-calc': true,
          'nesting-rules': { noIsPseudoSelector: false },
          'not-pseudo-class': true, // allows using ":not" pseudo class
          'oklab-function': { enableProgressiveCustomProperties: true }, // allows using "oklab()" and "oklch()" functions
          'opacity-percentage': true,
          'overflow-property': true,
          'overflow-wrap-property': { method: 'copy' },
          'place-properties': true, // lets you use place-* properties as shorthands for align-* and justify-*
          'prefers-color-scheme-query': false, // lets you use light and dark color schemes in all browsers - requires js to work
          'rebeccapurple-color': { preserve: false }, // use the "rebeccapurple" color
          'relative-color-syntax': true,
          'scope-pseudo-class': false, // allows using ":scope()" pseudo class
          'stepped-value-functions': true, // allows using "round()", "mod()" and "rem()" functions
          'system-ui-font-family': true,
          'text-decoration-shorthand': true,
          'trigonometric-functions': true,
          'unset-value': true,
        },
        autoprefixer: false,
        preserve: true,
        enableClientSidePolyfills: false,
        debug: ctx.env !== 'production',
        logical: false,
      }),
      postcssLightningcss({
        lightningcssOptions: {
          minify: false,
          sourceMap: ctx.env !== 'production',
          cssModules: false,
          // Individually enable various drafts
          drafts: {
            // Enable css nesting (default: undefined)
            nesting: true,
            customMedia: true,
          },
        },
      }),
      postcssColorRgbaFallback,
      autoprefixer({
        add: true,
        remove: true,
        supports: true,
        grid: 'no-autoplace',
      }),
      postcssUniqueSelectors,
      postcssOrderedValues,
      postcssDiscardComments,
      postcssDiscardOverridden,
      postcssDiscardDuplicates,
      postcssDiscardEmpty,
      cssDeclarationSorter({ order: 'smacss', keepOverrides: true }),
      ctx.env === 'production'
        ? cssnano({
            preset: 'default',
            safe: true,
            calc: false,
            minifyFontWeight: false,
            precision: 2,
          })
        : false,
    ],
  };
}
