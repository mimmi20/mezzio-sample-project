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
 * File Contains Class for AbsoluteUrlFactory
 */

namespace App\View\Helper;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerExceptionInterface;

final class AbsoluteUrlFactory implements FactoryInterface
{
    /**
     * @param string            $requestedName
     * @param array<mixed>|null $options
     *
     * @throws ContainerExceptionInterface
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        ?array $options = null
    ): AbsoluteUrl {
        return new AbsoluteUrl(
            $container->get('Application')->getRequest()->getUri()
        );
    }
}
