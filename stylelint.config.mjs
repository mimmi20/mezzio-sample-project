/* global process */
/** @type {import('stylelint').Config} */

import sortOrderSmacss from 'stylelint-config-property-sort-order-smacss/generate.js';

export default {
  extends: ['stylelint-config-standard', 'stylelint-config-property-sort-order-smacss'],
  plugins: [
    'stylelint-plugin-logical-css',
    'stylelint-declaration-block-no-ignored-properties',
    'stylelint-use-nesting',
    'stylelint-no-unsupported-browser-features',
    'stylelint-plugin-use-baseline',
    'stylelint-no-indistinguishable-colors',
    'stylelint-no-unresolved-module',
    'stylelint-media-use-custom-media',
    'stylelint-high-performance-animation',
  ],
  rules: {
    // rules for logical properties and values
    'plugin/use-logical-properties-and-values': [true, { severity: 'warning', disableFix: true }],
    'plugin/use-logical-units': [true, { severity: 'warning', disableFix: true }],

    'plugin/declaration-block-no-ignored-properties': true,

    'csstools/use-nesting': ['always', { syntax: 'scss', severity: 'warning', disableFix: true }],

    'order/properties-order': [sortOrderSmacss(), { severity: 'warning' }],

    'plugin/no-unsupported-browser-features': [
      true,
      {
        ignorePartialSupport: true,
        severity: 'warning',
      },
    ],

    'plugin/require-baseline': [
      true,
      {
        // "available" can be "widely" (default) or "newly"
        available: 'newly',
        severity: 'warning',
      },
    ],

    'plugin/stylelint-no-indistinguishable-colors': [
      true,
      {
        allowEquivalentNotation: true,
        threshold: 3,
        severity: 'warning',
      },
    ],

    'plugin/no-unresolved-module': {
      modules: ['node_modules'],
      cwd: process.cwd(),
    },

    'csstools/media-use-custom-media': [
      'known',
      // {
      //   importFrom: [
      //     "path/to/file.css", // => @custom-media --sm (min-width: 40rem);
      //     "path/to/file.json" // => { "custom-media": { "--sm": "(min-width: 40rem)" } }
      //   ]
      // }
    ],

    'plugin/no-low-performance-animation-properties': true,

    // general rules
    'alpha-value-notation': null, // maybe later -> 'percentage',
    'at-rule-empty-line-before': ['always', { ignore: ['after-comment', 'first-nested', 'blockless-after-same-name-blockless'], except: ['first-nested'], ignoreAtRules: ['else'] }],
    'color-function-notation': ['modern', { ignore: ['with-var-inside'] }],
    'color-hex-length': 'short',
    'color-named': 'never',
    'color-no-invalid-hex': true,
    'comment-empty-line-before': 'always',
    'comment-whitespace-inside': 'always',
    'declaration-block-no-redundant-longhand-properties': true,
    'declaration-block-single-line-max-declarations': 1,
    'declaration-empty-line-before': 'never',
    'font-family-name-quotes': 'always-where-recommended',
    'font-family-no-missing-generic-family-keyword': true,
    'function-name-case': 'lower',
    'function-url-quotes': 'always',
    'length-zero-no-unit': true,
    'media-feature-name-no-unknown': true,
    'media-feature-name-no-vendor-prefix': null, // maybe later
    'media-feature-range-notation': 'prefix',
    'no-descending-specificity': null, // too much issues
    'no-duplicate-selectors': true,
    'no-invalid-position-at-import-rule': null,
    'number-max-precision': 5,
    'property-no-unknown': true,
    'property-no-vendor-prefix': true,
    'rule-empty-line-before': ['always', { ignore: ['after-comment'], except: ['first-nested'] }],
    'selector-attribute-quotes': 'always',
    'selector-class-pattern': null, // maybe later
    'selector-id-pattern': null, // maybe later
    'selector-max-compound-selectors': [3, { severity: 'warning' }],
    'selector-not-notation': 'simple',
    'selector-pseudo-element-colon-notation': 'double',
    'shorthand-property-no-redundant-values': true,
    'value-keyword-case': ['lower', { ignoreKeywords: ['currentColor', 'optimizeLegibility'], severity: 'warning', disableFix: true }],
    'value-no-vendor-prefix': true,
  },
  reportDescriptionlessDisables: true,
  reportInvalidScopeDisables: true,
  reportNeedlessDisables: true,
  quietDeprecationWarnings: true,
};
