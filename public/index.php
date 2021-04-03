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

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

// Delegate static file requests back to the PHP built-in webserver
if ('cli-server' === PHP_SAPI && __FILE__ !== $_SERVER['SCRIPT_FILENAME']) {
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
        assert($container instanceof ContainerInterface);

        $app = $container->get(Application::class);
        assert($app instanceof Application);
        $factory = $container->get(MiddlewareFactory::class);

        // Execute programmatic/declarative middleware pipeline and routing
        // configuration statements
        (require 'config/pipeline.php')($app, $factory, $container);

        $app->run();
    } catch (Throwable $e) {
        var_dump($e);
    }
})();
