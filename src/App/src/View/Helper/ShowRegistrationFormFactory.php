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
 * Generates the ShowRegistrationForm view helper object
 */

namespace App\View\Helper;

use App\Config\ServiceConfigInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerExceptionInterface;

use function assert;
use function is_array;

final class ShowRegistrationFormFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     *
     * @param string            $requestedName
     * @param array<mixed>|null $options
     *
     * @throws ContainerExceptionInterface
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): ShowRegistrationForm
    {
        $novumConfig = $container->get(ServiceConfigInterface::class)->getNovumConfig();
        assert(is_array($novumConfig));

        return new ShowRegistrationForm(
            $container->get(TemplateRendererInterface::class),
            $novumConfig
        );
    }
}
