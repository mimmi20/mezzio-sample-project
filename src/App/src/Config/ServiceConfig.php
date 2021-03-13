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

final class ServiceConfig extends Config implements ServiceConfigInterface
{
    /**
     * Get the config options for Novum
     *
     * @return array
     */
    public function getNovumConfig(): array
    {
        return $this->get('novum')->toArray();
    }
}
