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

namespace App\Handler;

use Laminas\Form\Factory;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

use function assert;

final class InfoPageHandlerFactory
{
    /** @throws ContainerExceptionInterface */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $renderer    = $container->get(TemplateRendererInterface::class);
        $formFactory = $container->get(Factory::class);
        $logger      = $container->get(LoggerInterface::class);

        assert($renderer instanceof TemplateRendererInterface);
        assert($formFactory instanceof Factory);
        assert($logger instanceof LoggerInterface);

        return new InfoPageHandler($renderer, $formFactory, $logger);
    }
}
