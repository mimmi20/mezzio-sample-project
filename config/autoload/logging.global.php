<?php

declare(strict_types=1);

return [
    'log' => [
        'writers' => [
            'file' => [
                'name'     => \Laminas\Log\Writer\Stream::class,
                'options' => [
                    'stream' => 'log/error.log',
                    'chmod'  => 0777,
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
