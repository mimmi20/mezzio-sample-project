<?php

/**
 * This file is part of the mimmi20/mezzio-sample-project package.
 *
 * Copyright (c) 2021-2025, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace App\Handler;

use Laminas\Diactoros\Exception\InvalidArgumentException;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\View\Model\ViewModel;
use Mezzio\Template\TemplateRendererInterface;
use Override;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Throwable;

final readonly class HomePageHandler implements RequestHandlerInterface
{
    /** @throws void */
    public function __construct(private TemplateRendererInterface $template, private LoggerInterface $logger)
    {
        // nothing to do
    }

    /** @throws InvalidArgumentException */
    #[Override]
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $layout = new ViewModel(
            ['request' => $request],
        );
        $layout->setTemplate('layout::default');

        try {
            $html = $this->template->render(
                'app::home-page',
                [
                    'layout' => $layout,
                    'request' => $request,
                ],
            );
        } catch (Throwable $e) {
            var_dump($e);
            $this->logger->error(
                $e,
                [
                    'Page' => 'home-page',
                    'File' => 'home-page',
                ],
            );
            $html = '';
        }

        return (new HtmlResponse($html))->withHeader('X-Content-Type-Options', 'nosniff');
    }
}
