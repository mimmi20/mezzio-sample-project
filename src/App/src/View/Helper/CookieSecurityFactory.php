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
 * Factory für den Cookie Security Abruf
 */
namespace App\View\Helper;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

final class CookieSecurityFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string             $requestedName
     * @param array|null         $options
     *
     * @return CookieSecurity|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new CookieSecurity(
            $container->get('Request')
        );
    }
}
