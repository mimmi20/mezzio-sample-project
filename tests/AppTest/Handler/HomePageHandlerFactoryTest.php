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

namespace AppTest\Handler;

use App\Handler\HomePageHandler;
use App\Handler\HomePageHandlerFactory;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

final class HomePageHandlerFactoryTest extends TestCase
{
    /**
     * @throws Exception
     * @throws ContainerExceptionInterface
     */
    public function testFactory(): void
    {
        $renderer = $this->createMock(TemplateRendererInterface::class);

        $container = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $container
            ->expects(self::once())
            ->method('get')
            ->with(TemplateRendererInterface::class)
            ->willReturn($renderer);

        $factory = new HomePageHandlerFactory();

        self::assertInstanceOf(HomePageHandlerFactory::class, $factory);

        $homePage = $factory($container);

        self::assertInstanceOf(HomePageHandler::class, $homePage);
    }
}
