<?php
/**
 * This file is part of the mimmi20/mezzio-sample-project package.
 *
 * Copyright (c) 2021-2024, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace App\Container;

use Laminas\Router\Http\TranslatorAwareTreeRouteStack;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Mezzio\Router\LaminasRouter;
use Psr\Container\ContainerInterface;

final class RouterFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return LaminasRouter
     */
    public function __invoke(ContainerInterface $container, $requestedName, array|null $options = null)
    {
        $translator = $container->get(\Laminas\I18n\Translator\TranslatorInterface::class);

        $router = new TranslatorAwareTreeRouteStack();
        $router->setTranslator($translator, 'routing');

        return new LaminasRouter($router);
    }
}
