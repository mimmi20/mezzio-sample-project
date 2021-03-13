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
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;

final class HomePageHandlerFactoryTest extends TestCase
{
    /** @var ContainerInterface|ObjectProphecy */
    protected $container;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $router          = $this->prophesize(RouterInterface::class);

        $this->container->get(RouterInterface::class)->willReturn($router);
    }

    /**
     * @return void
     */
    public function testFactoryWithoutTemplate(): void
    {
        $factory = new HomePageHandlerFactory();
        $this->container->has(TemplateRendererInterface::class)->willReturn(false);

        self::assertInstanceOf(HomePageHandlerFactory::class, $factory);

        $homePage = $factory($this->container->reveal());

        self::assertInstanceOf(HomePageHandler::class, $homePage);
    }

    /**
     * @return void
     */
    public function testFactoryWithTemplate(): void
    {
        $this->container->has(TemplateRendererInterface::class)->willReturn(true);
        $this->container
            ->get(TemplateRendererInterface::class)
            ->willReturn($this->prophesize(TemplateRendererInterface::class));

        $factory = new HomePageHandlerFactory();

        $homePage = $factory($this->container->reveal());

        self::assertInstanceOf(HomePageHandler::class, $homePage);
    }
}
