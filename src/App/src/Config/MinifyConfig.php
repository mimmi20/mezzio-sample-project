<?php
/**
 * This file is part of the mimmi20/mezzio-sample-project package.
 *
 * Copyright (c) 2021-2023, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

/**
 * Config für das Minify und das Hinzufügen der Revision
 */

namespace App\Config;

use Laminas\Config\Config;

use function array_key_exists;
use function is_readable;

final class MinifyConfig extends Config
{
    /** @throws void */
    public function isEnabled(): bool
    {
        $config = $this->toArray();

        if (array_key_exists('enabled', $config)) {
            return (bool) $config['enabled'];
        }

        return false;
    }

    /**
     * get the path of the file where the actual git revsion is saved
     *
     * @return string|null Null is returned if the file is not configured or the configured file is not readable, the file path is returned otherwise
     *
     * @throws void
     */
    public function getRevisionFile(): string | null
    {
        $config = $this->toArray();

        if (array_key_exists('revisionfile', $config) && is_readable($config['revisionfile'])) {
            return $config['revisionfile'];
        }

        return null;
    }

    /**
     * get the path of the file where the actual groups/packages are saved
     *
     * @return string|null Null is returned if the file is not configured or the configured file is not readable, the file path is returned otherwise
     *
     * @throws void
     */
    public function getGroupsFile(): string | null
    {
        $config = $this->toArray();

        if (array_key_exists('groups-file', $config) && is_readable($config['groups-file'])) {
            return $config['groups-file'];
        }

        return null;
    }

    /**
     * get the path of the public directory
     *
     * @return string|null Null is returned if the directory is not configured, the path is returned otherwise
     *
     * @throws void
     */
    public function getPublicDir(): string | null
    {
        $config = $this->toArray();

        if (array_key_exists('public-dir', $config) && is_readable($config['public-dir'])) {
            return $config['public-dir'];
        }

        return null;
    }
}
