<?php
/**
 * This file is part of the mimmi20/mezzio-sample-project package.
 *
 * Copyright (c) 2021, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

// To enable or disable caching, set the `ConfigAggregator::ENABLE_CACHE` boolean in
// `config/autoload/local.php`.
$cacheConfig = ['config_cache_path' => 'data/cache/config-cache.php'];

$aggregator = new ConfigAggregator(
    [
        \Laminas\Hydrator\ConfigProvider::class,
        \Laminas\Filter\ConfigProvider::class,
        \Mezzio\Authentication\ConfigProvider::class,
        \Mezzio\GenericAuthorization\ConfigProvider::class,
        \Laminas\I18n\ConfigProvider::class,
        \Laminas\Form\ConfigProvider::class,
        \Laminas\InputFilter\ConfigProvider::class,
        \Mimmi20\Form\Element\Links\ConfigProvider::class,
        \Mimmi20\Form\Element\Group\ConfigProvider::class,
        \Mimmi20\Form\Element\Paragraph\ConfigProvider::class,
        \Laminas\Log\ConfigProvider::class,
        \Mimmi20\LoggerFactory\ConfigProvider::class,
        \Mezzio\Router\LaminasRouter\ConfigProvider::class,
        \Laminas\Router\ConfigProvider::class,
        \Laminas\Navigation\ConfigProvider::class,
        \Mezzio\Navigation\ConfigProvider::class,
        \Mezzio\LaminasView\ConfigProvider::class,
        \Mimmi20\LaminasView\Helper\PartialRenderer\ConfigProvider::class,
        \Mimmi20\LaminasView\Helper\HtmlElement\ConfigProvider::class,
        \Mezzio\Navigation\Helper\ConfigProvider::class,
        \Mezzio\Navigation\LaminasView\ConfigProvider::class,
        \Mezzio\Navigation\LaminasView\View\Helper\BootstrapNavigation\ConfigProvider::class,
        \Mezzio\BootstrapForm\LaminasView\View\Helper\ConfigProvider::class,
        \Laminas\HttpHandlerRunner\ConfigProvider::class,
        \Laminas\Validator\ConfigProvider::class,
        \Mezzio\Helper\ConfigProvider::class,
        \Mezzio\ConfigProvider::class,
        \Mezzio\Router\ConfigProvider::class,
        \Laminas\Diactoros\ConfigProvider::class,
        // Include cache configuration
        new ArrayProvider($cacheConfig),
        // Swoole config to overwrite some services (if installed)
        class_exists(\Mezzio\Swoole\ConfigProvider::class)
            ? \Mezzio\Swoole\ConfigProvider::class
            : static fn () => [],
        // Default App module config
        App\ConfigProvider::class,
        // Load application config in a pre-defined order in such a way that local settings
        // overwrite global settings. (Loaded as first to last):
        //   - `global.php`
        //   - `*.global.php`
        //   - `local.php`
        //   - `*.local.php`
        new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),
        // Load development config if it exists
        new PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
    ],
    $cacheConfig['config_cache_path']
);

return $aggregator->getMergedConfig();
