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

use Laminas\I18n\Translator\TranslatorInterface;
use Laminas\Router\Http\TranslatorAwareTreeRouteStack;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Mezzio\Router\LaminasRouter;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function assert;

final class RouterFactory implements FactoryInterface
{
    /**
     * @param string $requestedName
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array | null $options = null,
    ): LaminasRouter {
        $translator = $container->get(TranslatorInterface::class);

        assert($translator instanceof TranslatorInterface || $translator === null);

        $router = new TranslatorAwareTreeRouteStack();
        $router->setTranslator($translator, 'routing');

        return new LaminasRouter($router);
    }
}
