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

namespace AppTest\Handler;

use App\Handler\HomePageHandler;
use App\Handler\HomePageHandlerFactory;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final class HomePageHandlerFactoryTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testFactory(): void
    {
        $renderer = $this->createMock(TemplateRendererInterface::class);
        $logger   = $this->createMock(LoggerInterface::class);

        $container = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $container
            ->expects(self::exactly(2))
            ->method('get')
            ->withConsecutive([TemplateRendererInterface::class], [LoggerInterface::class])
            ->willReturnOnConsecutiveCalls($renderer, $logger);

        $factory = new HomePageHandlerFactory();

        self::assertInstanceOf(HomePageHandlerFactory::class, $factory);

        $homePage = $factory($container);

        self::assertInstanceOf(HomePageHandler::class, $homePage);
    }
}
