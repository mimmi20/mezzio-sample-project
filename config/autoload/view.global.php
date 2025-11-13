<?php

declare(strict_types=1);

return [
    'view_helper_config' => [
        'display_exceptions' => true,
        'doctype' => \Laminas\View\Helper\Doctype::XHTML5,
    ],
    'mezzio' => [
        'error_handler' => [
            'layout' => 'layout::default',
        ],
    ],
    'templates' => [
        'map' => [],
        'paths' => [
            'app' => [__DIR__ . '/../../src/App/templates/app'],
            'branding' => [__DIR__ . '/../../src/App/templates/branding'],
            'components' => [__DIR__ . '/../../src/App/templates/components'],
            'error' => [__DIR__ . '/../../src/App/templates/error'],
            'footer' => [__DIR__ . '/../../src/App/templates/footer'],
            'header' => [__DIR__ . '/../../src/App/templates/header'],
            'pages' => [__DIR__ . '/../../src/App/templates/pages'],
            'layout' => [__DIR__ . '/../../src/App/templates/layout'],
            'nav' => [__DIR__ . '/../../src/App/templates/nav'],
        ],
        'layout' => 'layout::default',
    ],
    'vite-url' => [
        'public-dir' => 'public',
        'build-dir' => 'dist',
        'vite-host' => 'http://localhost:8082',
    ],
];
