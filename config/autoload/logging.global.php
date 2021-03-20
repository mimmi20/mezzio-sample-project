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

return [
    'log' => [
        'writers' => [
            'file' => [
                'name' => \Laminas\Log\Writer\Stream::class,
                'options' => [
                    'stream' => 'log/error.log',
                    'chmod' => 0777,
                    'formatter' => [
                        'name' => \Laminas\Log\Formatter\Simple::class,
                    ],
                ],
            ],
        ],
        'processors' => [
            'psr3' => [
                'name' => \Laminas\Log\Processor\PsrPlaceholder::class,
            ],
        ],
    ],
];
