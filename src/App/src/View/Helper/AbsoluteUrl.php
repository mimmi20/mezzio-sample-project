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
/**
 * View helper for generating absolute URLs
 */
namespace App\View\Helper;

use Laminas\Uri\Http;
use Laminas\View\Helper\AbstractHelper;

final class AbsoluteUrl extends AbstractHelper
{
    /**
     * generate url for current host
     */
    public const DEST_CURRENT = null;

    /**
     * generate url for primary host (www.insuredirect24.de)
     */
    public const DEST_APP = 'app';

    /**
     * list of all existing subdomains
     *
     * @var array
     */
    private $subdomains = [
        self::DEST_APP,
    ];

    /** @var Http */
    private $currentUri;

    /**
     * @param \Laminas\Uri\Http $currentUri
     */
    public function __construct(Http $currentUri)
    {
        $this->currentUri = $currentUri;
    }

    /**
     * Gibt die absolute URL zurück.
     *
     * @param string      $path        host based url like /test.html
     * @param string|null $destination
     * @param array       $query
     * @param string      $fragment
     *
     * @return string
     */
    public function __invoke(string $path, ?string $destination = null, array $query = [], string $fragment = ''): string
    {
        $newUri = clone $this->currentUri;
        $newUri->setPath($path);

        // replace some misc parts if existing
        $newUri->setQuery($query);
        $newUri->setFragment($fragment);

        if (self::DEST_CURRENT !== $destination && null !== $newUri->getHost()) {
            $newUri->setHost($this->replaceHost($newUri->getHost(), $destination));
        }

        return $newUri->toString();
    }

    /**
     * replaces hosts like "www.geld.de" to "mein.geld.de"
     *
     * @param string $currentHost
     * @param string $desiredHost
     *
     * @return string
     */
    private function replaceHost(string $currentHost, string $desiredHost): string
    {
        $hostParts = array_reverse(explode('.', $currentHost));

        if (2 > count($hostParts) || 'de' !== $hostParts[0] || 'insuredirect24' !== $hostParts[1]) {
            // can't replace the host if we are not on a insuredirect24.de domain
            return $currentHost;
        }

        if (isset($hostParts[2]) && in_array($hostParts[2], $this->subdomains, true)) {
            array_splice($hostParts, 2, 1);
        }

        array_splice($hostParts, 2, 0, $desiredHost);

        return implode('.', array_reverse($hostParts));
    }
}
