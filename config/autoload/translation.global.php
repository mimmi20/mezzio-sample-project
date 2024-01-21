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

use Mezzio\Application;
use Mezzio\Container\ApplicationConfigInjectionDelegator;
use Laminas\I18n\Translator\Resources;

return [
    'translator' => [
        'locale' => 'de',
        'translation_file_patterns' => [
            [
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../../language',
                'pattern' => '%s.php',
                'text_domain' => 'default',
            ],
            [
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../../language',
                'pattern' => '%s.casually.php',
                'text_domain' => 'casually',
            ],
            [
                // Translations for Filters and Validators
                'type' => 'phparray',
                'base_dir' => Resources::getBasePath(),
                'pattern' => Resources::getPatternForValidator(),
                'text_domain' => 'default',
            ],
            [
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../../language',
                'pattern' => '%s.routing.php',
                'text_domain' => 'routing',
            ],
            [
                'type' => 'phparray',
                'base_dir' => __DIR__ . '/../../language',
                'pattern' => '%s.navigation.php',
                'text_domain' => 'navigation',
            ],
        ],
        'event_manager_enabled' => true,
        //'cache' => false,
    ],
];
