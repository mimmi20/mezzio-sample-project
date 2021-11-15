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

namespace App\Config;

use Laminas\Config\Config;

use function assert;

final class ServiceConfig extends Config implements ServiceConfigInterface
{
    /**
     * Get the config options for Novum
     *
     * @return array<string, array<string, string>|string>
     */
    public function getNovumConfig(): array
    {
        $novConfig = $this->get('novum');
        assert($novConfig instanceof Config);

        return $novConfig->toArray();
    }
}
