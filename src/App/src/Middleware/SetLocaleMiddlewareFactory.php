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

namespace App\Middleware;

use App\Handler\InfoPageHandler;
use InvalidArgumentException;
use Laminas\Form\Factory;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Mimmi20\Mezzio\Navigation\NavigationMiddleware;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

use function assert;

final class SetLocaleMiddlewareFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws InvalidArgumentException
     */
    public function __invoke(ContainerInterface $container): MiddlewareInterface
    {
        return new SetLocaleMiddleware(
            $container->get(\Laminas\I18n\Translator\TranslatorInterface::class),
            'de_DE'
        );
    }
}
