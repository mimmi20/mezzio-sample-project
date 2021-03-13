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

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\View\Model\ViewModel;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class HomePageHandler implements RequestHandlerInterface
{
    /** @var TemplateRendererInterface */
    private $template;

    /** @var array */
    private $novumConfig;

    /**
     * @param TemplateRendererInterface $template
     * @param array                     $novumConfig
     */
    public function __construct(TemplateRendererInterface $template, array $novumConfig)
    {
        $this->template    = $template;
        $this->novumConfig = $novumConfig;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $layout = new ViewModel([
            'request' => $request,
            'novumConfig' => $this->novumConfig,
        ]);
        $layout->setTemplate('layout::default');

        return new HtmlResponse(
            $this->template->render(
                'app::home-page',
                [
                    'novumPartner' => 'id24',
                    'novumConfig' => $this->novumConfig,
                    'layout' => $layout,
                ]
            )
        );
    }
}
