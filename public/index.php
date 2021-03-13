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

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && __FILE__ !== $_SERVER['SCRIPT_FILENAME']) {
    return false;
}

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

ini_set('memory_limit', '-1');

/**
 * Self-called anonymous function that creates its own scope and keeps the global namespace clean.
 */
(static function (): void {
    try {
        $container = require 'config/container.php';
        \assert($container instanceof \Psr\Container\ContainerInterface);

        $app = $container->get(\Mezzio\Application::class);
        \assert($app instanceof \Mezzio\Application);
        $factory = $container->get(\Mezzio\MiddlewareFactory::class);

        // Execute programmatic/declarative middleware pipeline and routing
        // configuration statements
        (require 'config/pipeline.php')($app, $factory, $container);

        $app->run();
    } catch (\Throwable $e) {
        var_dump($e);
    }
})();
