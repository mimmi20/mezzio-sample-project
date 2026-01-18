<?php

/**
 * This file is part of the mimmi20/mezzio-sample-project package.
 *
 * Copyright (c) 2021-2026, Thomas Mueller <mimmi20@live.de>
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
use Psr\Log\LoggerInterface;
use RuntimeException;

final class HomePageHandlerTest extends TestCase
{
    /**
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testReturnsHtmlResponseWhenTemplateRendererProvided(): void
    {
        $content = 'test-content';

        $renderer = $this->createMock(TemplateRendererInterface::class);
        $renderer
            ->expects(self::once())
            ->method('render')
            ->with('app::home-page', new ArrayHasKey('layout'))
            ->willReturn($content);

        $logger = $this->createMock(LoggerInterface::class);
        $logger
            ->expects(self::never())
            ->method('error');

        $homePage = new HomePageHandler($renderer, $logger);

        $response = $homePage->handle(
            $this->createMock(ServerRequestInterface::class),
        );

        self::assertInstanceOf(HtmlResponse::class, $response);

        self::assertSame($content, $response->getBody()->getContents());
    }

    /**
     * @throws Exception
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testLogsError(): void
    {
        $exception = new \Exception();

        $renderer = $this->createMock(TemplateRendererInterface::class);
        $renderer
            ->expects(self::once())
            ->method('render')
            ->with('app::home-page', new ArrayHasKey('layout'))
            ->willThrowException($exception);

        $logger = $this->createMock(LoggerInterface::class);
        $logger
            ->expects(self::once())
            ->method('error')
            ->with(
                $exception,
                [
                    'Page' => 'home-page',
                    'File' => 'home-page',
                ],
            );

        $homePage = new HomePageHandler($renderer, $logger);

        $response = $homePage->handle(
            $this->createMock(ServerRequestInterface::class),
        );

        self::assertInstanceOf(HtmlResponse::class, $response);

        self::assertSame('', $response->getBody()->getContents());
    }
}
