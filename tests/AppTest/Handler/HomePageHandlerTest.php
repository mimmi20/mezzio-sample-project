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
use Laminas\Diactoros\Exception\InvalidArgumentException;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\Constraint\ArrayHasKey;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class HomePageHandlerTest extends TestCase
{
    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function testReturnsHtmlResponseWhenTemplateRendererProvided(): void
    {
        $renderer = $this->getMockBuilder(TemplateRendererInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
        $renderer
            ->expects(self::once())
            ->method('render')
            ->with('app::home-page', new ArrayHasKey('layout'))
            ->willReturn('');

        $homePage = new HomePageHandler($renderer);

        $response = $homePage->handle(
            $this->createMock(ServerRequestInterface::class),
        );

        self::assertInstanceOf(HtmlResponse::class, $response);
    }
}
