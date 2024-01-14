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

use Laminas\Form\Factory;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Mezzio\Application;
use Mezzio\Container\ApplicationConfigInjectionDelegator;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        // Use 'aliases' to alias a service name to another service. The
        // key is the alias name, the value is the service to which it points.
        'aliases' => [
            // Fully\Qualified\ClassOrInterfaceName::class => Fully\Qualified\ClassName::class,
            \Mezzio\Router\RouterInterface::class => \Mezzio\Router\LaminasRouter::class,
        ],
        // Use 'factories' for services provided by callbacks/factory classes.
        'factories' => [
            // Fully\Qualified\ClassName::class => Fully\Qualified\FactoryName::class,
            \Mezzio\Router\LaminasRouter::class => \App\Container\RouterFactory::class,
            \App\Middleware\SetLocaleMiddleware::class => \App\Middleware\SetLocaleMiddlewareFactory::class,
            \App\Handler\HomePageHandler::class => \App\Handler\HomePageHandlerFactory::class,
            \App\Handler\InfoPageHandler::class => \App\Handler\InfoPageHandlerFactory::class,
            Factory::class => InvokableFactory::class,
        ],

        'delegators' => [
            Application::class => [
                ApplicationConfigInjectionDelegator::class,
            ],
        ],
    ],
];
