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
namespace App\Handler;

use App\Config\ServiceConfigInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class HomePageHandlerFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $container
     *
     * @return \Psr\Http\Server\RequestHandlerInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $novumConfig = $container->get(ServiceConfigInterface::class)->getNovumConfig();
        \assert(\is_array($novumConfig));

        return new HomePageHandler(
            $container->get(TemplateRendererInterface::class),
            $novumConfig
        );
    }
}
