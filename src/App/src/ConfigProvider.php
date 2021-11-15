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

namespace App;

use JsonClass\Json;
use JsonClass\JsonInterface;
use Laminas\Form\Factory;
use Laminas\ServiceManager\Factory\InvokableFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
final class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array<string, array<string, array<string, array<int, string>|string>>>
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
            'view_helpers' => $this->getViewHelperConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array<string, array<string, string>>
     */
    public function getDependencies(): array
    {
        return [
            'factories' => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                Handler\InfoPageHandler::class => Handler\InfoPageHandlerFactory::class,
                Config\ServiceConfigInterface::class => Config\ServiceConfigFactory::class,
                Json::class => InvokableFactory::class,
                Factory::class => InvokableFactory::class,
            ],
            'aliases' => [
                JsonInterface::class => Json::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array<string, array<string, array<int, string>>>
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app' => [__DIR__ . '/../templates/app'],
                'branding' => [__DIR__ . '/../templates/branding'],
                'components' => [__DIR__ . '/../templates/components'],
                'error' => [__DIR__ . '/../templates/error'],
                'footer' => [__DIR__ . '/../templates/footer'],
                'header' => [__DIR__ . '/../templates/header'],
                'pages' => [__DIR__ . '/../templates/pages'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }

    /**
     * @return array<string, array<string, string>>
     */
    public function getViewHelperConfig(): array
    {
        return [];
    }
}
