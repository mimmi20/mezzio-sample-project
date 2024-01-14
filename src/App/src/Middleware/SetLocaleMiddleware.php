<?php

namespace App\Middleware;

use Laminas\I18n\Translator\Translator;
use Locale;
use Mezzio\Helper\UrlHelper;
use Mezzio\Router\RouteResult;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\I18n\Translator\TranslatorInterface;

final class SetLocaleMiddleware implements MiddlewareInterface
{
    private string | null $defaultLocale = null;
    private string $fallbackLocale = 'de_DE';

    /**
     * @param UrlHelper $helper
     * @param string|null $defaultLocale
     * @throws void
     */
    public function __construct(private readonly Translator $translator, string | null $defaultLocale = null)
    {
        if ($defaultLocale) {
            $this->defaultLocale = $defaultLocale;
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws void
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $locale = Locale::acceptFromHttp(
            $request->getServerParams()['HTTP_ACCEPT_LANGUAGE']
        );

        if (!is_string($locale)) {
            $locale = $this->defaultLocale ?: $this->fallbackLocale;
        }

        $locale = Locale::canonicalize($locale);
        $language = Locale::getPrimaryLanguage($locale);

        $request = $request->withAttribute('language', $language);
        $request = $request->withAttribute('locale', $locale);

        Locale::setDefault($locale);
        $this->translator->setLocale($language);

        return $handler->handle($request);
    }
}
