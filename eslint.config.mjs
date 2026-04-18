import eslint from '@eslint/js';
import tseslint from 'typescript-eslint';
import prettierConfig from 'eslint-config-prettier';
import prettier from 'eslint-plugin-prettier';
import globals from 'globals';
import pluginPromise from 'eslint-plugin-promise';
import depend from 'eslint-plugin-depend';
import { importX } from 'eslint-plugin-import-x';

export default tseslint.config(
  eslint.configs.recommended,
  prettierConfig,
  ...tseslint.configs.recommended,
  pluginPromise.configs['flat/recommended'],
  importX.flatConfigs.recommended,
  importX.flatConfigs.typescript,
  {
    rules: {
      'for-direction': 'error',
      'getter-return': 'error',
      'no-async-promise-executor': 'error',
      'no-await-in-loop': 'error',
      'no-compare-neg-zero': 'error',
      'no-cond-assign': 'error',
      'no-constant-condition': 'error',
      'no-control-regex': 'error',
      'no-debugger': 'error',
      'no-dupe-args': 'error',
      'no-dupe-else-if': 'error',
      'no-dupe-keys': 'error',
      'no-duplicate-case': 'error',
      'no-empty-character-class': 'error',
      'no-empty': [
        'error',
        {
          allowEmptyCatch: true,
        },
      ],
      'no-empty-static-block': 'error',
      'no-ex-assign': 'error',
      'no-extra-boolean-cast': 'error',
      'no-func-assign': 'error',
      'no-import-assign': 'error',
      'no-inner-declarations': 'error',
      'no-invalid-regexp': 'error',
      'no-loss-of-precision': 'error',
      'no-misleading-character-class': 'error',
      'no-obj-calls': 'error',
      'no-promise-executor-return': 'error',
      'no-prototype-builtins': 'error',
      'no-regex-spaces': 'error',
      'no-setter-return': 'error',
      'no-sparse-arrays': 'error',
      'no-template-curly-in-string': 'error',
      'no-unreachable': 'error',
      'no-unreachable-loop': 'error',
      'no-unsafe-finally': 'error',
      'no-unsafe-negation': [
        'error',
        {
          enforceForOrderingRelations: true,
        },
      ],
      'no-unsafe-optional-chaining': [
        'error',
        {
          disallowArithmeticOperators: true,
        },
      ],
      'no-useless-backreference': 'error',
      'use-isnan': 'error',
      'valid-typeof': [
        'error',
        {
          requireStringLiterals: false,
        },
      ],
      'no-unexpected-multiline': 'error',
      'accessor-pairs': [
        'error',
        {
          enforceForClassMembers: true,
        },
      ],
      'array-callback-return': [
        'error',
        {
          allowImplicit: true,
        },
      ],
      'block-scoped-var': 'error',
      complexity: ['warn', { max: 24, variant: 'modified' }],
      curly: 'error',
      'default-case': 'error',
      'default-case-last': 'error',
      eqeqeq: 'error',
      'grouped-accessor-pairs': ['error', 'getBeforeSet'],
      'guard-for-in': 'error',
      'no-alert': 'error',
      'no-caller': 'error',
      'no-case-declarations': 'error',
      'no-constructor-return': 'error',
      'no-else-return': [
        'error',
        {
          allowElseIf: false,
        },
      ],
      'no-empty-pattern': 'error',
      'no-eq-null': 'error',
      'no-eval': 'error',
      'no-extend-native': 'error',
      'no-extra-bind': 'error',
      'no-extra-label': 'error',
      'no-fallthrough': 'error',
      'no-global-assign': 'error',
      'no-implicit-coercion': 'error',
      'no-implicit-globals': 'error',
      'no-implied-eval': 'error',
      'no-iterator': 'error',
      'no-labels': 'error',
      'no-lone-blocks': 'error',
      'no-multi-str': 'error',
      'no-new-func': 'error',
      'no-new-wrappers': 'error',
      'no-nonoctal-decimal-escape': 'error',
      'no-object-constructor': 'error',
      'no-new': 'error',
      'no-octal-escape': 'error',
      'no-octal': 'error',
      'no-proto': 'error',
      'no-return-assign': ['error', 'always'],
      'no-return-await': 'error',
      'no-script-url': 'error',
      'no-self-assign': [
        'error',
        {
          props: true,
        },
      ],
      'no-self-compare': 'error',
      'no-sequences': 'error',
      'no-throw-literal': 'error',
      'no-unmodified-loop-condition': 'error',
      'no-unused-expressions': [
        'error',
        {
          enforceForJSX: true,
        },
      ],
      'no-unused-labels': 'error',
      'no-useless-call': 'error',
      'no-useless-catch': 'error',
      'no-useless-concat': 'error',
      'no-useless-escape': 'error',
      'no-useless-return': 'error',
      'no-void': 'error',
      'no-with': 'error',
      'prefer-promise-reject-errors': [
        'error',
        {
          allowEmptyReject: true,
        },
      ],
      'prefer-regex-literals': [
        'error',
        {
          disallowRedundantWrapping: true,
        },
      ],
      radix: 'error',
      yoda: 'error',
      'no-delete-var': 'error',
      'no-label-var': 'error',
      'no-restricted-globals': [
        'error',
        'event',
        // TODO: Enable this in 2025.
        // {
        // 	name: 'Buffer',
        // 	message: 'Use Uint8Array instead. See: https://sindresorhus.com/blog/goodbye-nodejs-buffer',
        // },
        {
          name: 'atob',
          message: 'This API is deprecated. Use https://github.com/sindresorhus/uint8array-extras instead.',
        },
        {
          name: 'btoa',
          message: 'This API is deprecated. Use https://github.com/sindresorhus/uint8array-extras instead.',
        },
      ],
      'no-shadow-restricted-names': 'error',
      'no-undef-init': 'error',
      'no-unused-vars': [
        'error',
        {
          vars: 'all',
          varsIgnorePattern: /^_/.source,
          args: 'after-used',
          ignoreRestSiblings: true,
          argsIgnorePattern: /^_/.source,
          caughtErrors: 'all',
          caughtErrorsIgnorePattern: /^_$/.source,
        },
      ],
      'no-buffer-constructor': 'error',
      'no-restricted-imports': [
        'error',
        'domain',
        'freelist',
        'smalloc',
        'punycode',
        'sys',
        'querystring',
        'colors',
        // TODO: Enable this in 2025.
        // {
        // 	name: 'buffer',
        // 	message: 'Use Uint8Array instead. See: https://sindresorhus.com/blog/goodbye-nodejs-buffer',
        // },
        // {
        // 	name: 'node:buffer',
        // 	message: 'Use Uint8Array instead. See: https://sindresorhus.com/blog/goodbye-nodejs-buffer',
        // },
      ],
      camelcase: [
        'warn',
        {
          properties: 'always',
        },
      ],
      'func-name-matching': [
        'error',
        {
          considerPropertyDescriptor: true,
        },
      ],
      'func-names': ['error', 'never'],
      'max-depth': 'warn',
      'max-lines': [
        'warn',
        {
          max: 1500,
          skipComments: true,
        },
      ],
      'max-nested-callbacks': ['warn', 4],
      'no-array-constructor': 'error',
      'no-bitwise': 'error',
      'no-lonely-if': 'error',
      'no-multi-assign': 'error',
      'no-negated-condition': 'error',
      'no-unneeded-ternary': 'error',
      'one-var': ['error', 'never'],
      'prefer-exponentiation-operator': 'error',
      'prefer-object-spread': 'error',
      'unicode-bom': ['error', 'never'],
      'arrow-body-style': 'error',
      'constructor-super': 'error',
      'no-class-assign': 'error',
      'no-const-assign': 'error',
      'no-constant-binary-expression': 'error',
      'no-dupe-class-members': 'error',
      'no-new-native-nonconstructor': 'error',
      'no-this-before-super': 'error',
      'no-unassigned-vars': 'error',
      'no-useless-computed-key': [
        'error',
        {
          enforceForClassMembers: true,
        },
      ],
      'no-useless-constructor': 'error',
      'no-useless-rename': 'error',
      'no-var': 'error',
      'prefer-arrow-callback': [
        'error',
        {
          allowNamedFunctions: true,
        },
      ],
      'prefer-const': [
        'error',
        {
          destructuring: 'all',
        },
      ],
      'prefer-destructuring': [
        'error',
        {
          // `array` is disabled because it forces destructuring on
          // stupid stuff like `foo.bar = process.argv[2];`
          VariableDeclarator: {
            array: false,
            object: true,
          },
          AssignmentExpression: {
            array: false,

            // Disabled because object assignment destructuring requires parens wrapping:
            // `let foo; ({foo} = object);`
            object: false,
          },
        },
        {
          enforceForRenamedProperties: false,
        },
      ],
      'prefer-numeric-literals': 'error',
      'prefer-rest-params': 'error',
      'prefer-spread': 'error',
      'require-yield': 'error',
      'symbol-description': 'error',
      'import-x/no-dynamic-require': 'warn',
      'import-x/no-nodejs-modules': 'warn',
    },
    languageOptions: {
      globals: {
        ...globals.es2021,
        ...globals.nodeBuiltin,
      },
      ecmaVersion: 'latest',
      parserOptions: {
        ecmaFeatures: {
          jsx: false,
        },
      },
    },
    linterOptions: {
      reportUnusedDisableDirectives: 'error',
      reportUnusedInlineConfigs: 'error',
    },
  },
  {
    plugins: {
      prettier,
    },
    rules: {
      'prettier/prettier': 'error',
      'array-callback-return': 'error',
      'no-empty': [
        'error',
        {
          allowEmptyCatch: true,
        },
      ],
      'no-lonely-if': 'error',
      'no-var': 'error',
      'prefer-const': [
        'error',
        {
          destructuring: 'all',
          ignoreReadBeforeAssign: false,
        },
      ],
      'prefer-destructuring': [
        'error',
        {
          object: true,
          array: false,
        },
      ],
      'prefer-spread': 'error',
      radix: 'error',
      strict: 'error',
      quotes: ['error', 'single'],
      '@typescript-eslint/no-explicit-any': 'off',
      '@typescript-eslint/no-unsafe-function-type': 'off',
    },
    languageOptions: {
      globals: {
        ...globals.es2021,
        ...globals.nodeBuiltin,
      },
      ecmaVersion: 'latest',
    },
    linterOptions: {
      reportUnusedDisableDirectives: 'error',
      reportUnusedInlineConfigs: 'error',
    },
  },
  {
    plugins: {
      depend,
    },
    rules: {
      'depend/ban-dependencies': [
        'error',
        {
          presets: ['native', 'microutilities', 'preferred'],
        },
      ],
    },
  },
  {
    files: ['public/**/*.{mjs,ts}', 'eslint.config.mjs', 'postcss.config.mjs', 'prettier.config.mjs', 'stylelint.config.mjs', 'vite.config.ts', 'cypress.config.ts'],
    languageOptions: {
      sourceType: 'module',
      globals: {
        ...globals.es2021,
        ...globals.nodeBuiltin,
      },
      ecmaVersion: 'latest',
    },
    linterOptions: {
      reportUnusedDisableDirectives: 'error',
      reportUnusedInlineConfigs: 'error',
    },
    rules: {
      'object-shorthand': [
        'error',
        'always',
        {
          avoidExplicitReturnArrows: true,
        },
      ],
      'import/no-unresolved': 'off',
    },
  },
  {
    ignores: [
      'public/**/*.d.ts',
      'public/js/vendor/*.{js,mjs,cjs,ts}',
      'public/js/vendor/**/*.{js,mjs,cjs,ts}',
      'public/dist/**/*.{js,mjs,cjs,ts}',
      'public/js/**/*.js',
      'node_modules/**/*.{js,mjs,cjs,ts}',
      'vendor-bin/**/*.{js,mjs,cjs,ts}',
      'vendor/**/*.{js,mjs,cjs,ts}',
      '.build/**/*.{js,mjs,cjs,ts}',
      '.reports/**/*.{js,mjs,cjs,ts}',
      'cypress/**/*.js',
      'cypress/**/*.d.ts',
      'vendor/**/*.*',
      'infection.json5',
      'public/dist/**/*.*',
      '.github/**/*.*',
    ],
  }
);
