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
use Laminas\Form\Factory;
use Laminas\Form\FormInterface;
use Laminas\View\Model\ViewModel;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class InfoPageHandler implements RequestHandlerInterface
{
    /** @var TemplateRendererInterface */
    private $template;

    /** @var array */
    private $novumConfig;

    /** @var Factory */
    private $factory;

    /**
     * @param TemplateRendererInterface $template
     * @param Factory                   $factory
     * @param array                     $novumConfig
     */
    public function __construct(TemplateRendererInterface $template, Factory $factory, array $novumConfig)
    {
        $this->template    = $template;
        $this->novumConfig = $novumConfig;
        $this->factory     = $factory;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        $file = sprintf('src/App/config/forms/%s.config.php', $id);

        if (null === $id || !file_exists($file)) {
            $form = null;
        } else {
            $form = $this->factory->create(
                require $file
            );
            \assert($form instanceof FormInterface);
        }

        $layout = new ViewModel([
            'request' => $request,
            'novumConfig' => $this->novumConfig,
        ]);
        $layout->setTemplate('layout::default');

        return new HtmlResponse(
            $this->template->render(
                'app::info-page',
                [
                    'page' => $id,
                    'novumPartner' => 'id24',
                    'novumConfig' => $this->novumConfig,
                    'form' => $form,
                    'layout' => $layout,
                ]
            )
        );
    }
}
