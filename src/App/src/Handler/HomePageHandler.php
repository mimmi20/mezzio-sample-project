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

use Laminas\Diactoros\Exception\InvalidArgumentException;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Log\Logger;
use Laminas\View\Model\ViewModel;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class HomePageHandler implements RequestHandlerInterface
{
    private TemplateRendererInterface $template;

    /** @phpcsSuppress SlevomatCodingStandard.Classes.UnusedPrivateElements.WriteOnlyProperty */
    private Logger $logger;

    public function __construct(TemplateRendererInterface $template, Logger $logger)
    {
        $this->template = $template;
        $this->logger   = $logger;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $layout = new ViewModel(
            ['request' => $request]
        );
        $layout->setTemplate('layout::default');

        return new HtmlResponse(
            $this->template->render(
                'app::home-page',
                ['layout' => $layout]
            )
        );
    }
}
