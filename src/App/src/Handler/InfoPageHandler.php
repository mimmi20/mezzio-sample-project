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
use Laminas\Form\Exception\DomainException;
use Laminas\Form\Factory;
use Laminas\Form\FormInterface;
use Laminas\Log\Logger;
use Laminas\View\Model\ViewModel;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;
use function file_exists;
use function sprintf;

final class InfoPageHandler implements RequestHandlerInterface
{
    private TemplateRendererInterface $template;

    private Factory $factory;

    /** @phpcsSuppress SlevomatCodingStandard.Classes.UnusedPrivateElements.WriteOnlyProperty */
    private Logger $logger;

    public function __construct(TemplateRendererInterface $template, Factory $factory, Logger $logger)
    {
        $this->template = $template;
        $this->factory  = $factory;
        $this->logger   = $logger;
    }

    /**
     * @throws InvalidArgumentException
     * @throws DomainException
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
            assert($form instanceof FormInterface);
        }

        $layout = new ViewModel(
            ['request' => $request]
        );
        $layout->setTemplate('layout::default');

        return new HtmlResponse(
            $this->template->render(
                'app::info-page',
                [
                    'page' => $id,
                    'form' => $form,
                    'layout' => $layout,
                ]
            )
        );
    }
}
