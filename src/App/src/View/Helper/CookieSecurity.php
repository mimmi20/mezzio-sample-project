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
 * Helper für Cookie Security Abruf
 */

namespace App\View\Helper;

use Laminas\Form\View\Helper\AbstractHelper;
use Laminas\Http\PhpEnvironment\Request;

use function array_key_exists;
use function is_array;
use function is_bool;
use function json_decode;

final class CookieSecurity extends AbstractHelper
{
    public const ACCEPT_COOKIE = 'Y';

    public const DONT_ACCEPT_COOKIE = 'N';

    public const COOKIE_NAME = 'ID24_COOKIE_APPROVAL';

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function cookieExist(): bool
    {
        $cookie = $this->request->getCookie();

        if (is_bool($cookie)) {
            return false;
        }

        return $cookie->offsetExists(self::COOKIE_NAME);
    }

    public function getCookieSecurityLevel(string $securityLevel): string
    {
        $cookieToArr = [
            'essential' => self::ACCEPT_COOKIE,
            'statistic' => self::DONT_ACCEPT_COOKIE,
            'functional' => self::DONT_ACCEPT_COOKIE,
        ];

        $getSecurityLevel = $cookieToArr[$securityLevel];

        if (!$this->cookieExist()) {
            return $getSecurityLevel;
        }

        $cookie = $this->request->getCookie();

        if (is_bool($cookie)) {
            return $getSecurityLevel;
        }

        $cookieToArr = json_decode($cookie->offsetGet(self::COOKIE_NAME), true);

        if (!is_array($cookieToArr) || !array_key_exists($securityLevel, $cookieToArr)) {
            return $getSecurityLevel;
        }

        return $cookieToArr[$securityLevel];
    }
}
