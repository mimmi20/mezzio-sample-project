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

namespace App\Handler;

use Laminas\Diactoros\Exception\InvalidArgumentException;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Form\Exception\DomainException;
use Laminas\Form\Factory;
use Laminas\Form\Form;
use Laminas\View\Model\ViewModel;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Throwable;

use function assert;
use function file_exists;
use function is_string;
use function sprintf;

final class InfoPageHandler implements RequestHandlerInterface
{
    /** @throws void */
    public function __construct(
        private readonly TemplateRendererInterface $template,
        private readonly Factory $factory,
        private readonly LoggerInterface $logger,
    ) {
        // nothing to do
    }

    /**
     * @throws InvalidArgumentException
     * @throws \Laminas\Form\Exception\InvalidArgumentException
     * @throws DomainException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $id = $request->getAttribute('id');

        assert(is_string($id) || $id === null);

        $file = sprintf('src/App/config/forms/%s.config.php', $id);

        if ($id === null || !file_exists($file)) {
            $form = null;
        } else {
            try {
                $form = $this->factory->create(require $file);
                assert($form instanceof Form);
            } catch (Throwable $e) {
                $this->logger->error($e);
                $form = null;
            }
        }

        if ($id === 'rs' && $form !== null) {
            $form->setData(['zahlweise' => '-1', 'famstand' => 'Single']);
            $form->isValid();
        }

        $layout = new ViewModel(
            ['request' => $request],
        );
        $layout->setTemplate('layout::default');

        try {
            $html = $this->template->render(
                'app::info-page',
                [
                    'page' => $id,
                    'form' => $form,
                    'layout' => $layout,
                    'request' => $request,
                ],
            );
        } catch (Throwable $e) {
            $this->logger->error(
                $e,
                [
                    'Page' => $id,
                    'File' => $file,
                ],
            );
            $html = '';
        }

        return (new HtmlResponse($html))->withHeader('X-Content-Type-Options', 'nosniff');
    }
}
