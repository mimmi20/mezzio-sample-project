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

use App\Handler\HomePageHandler;
use App\Handler\InfoPageHandler;
use Fig\Http\Message\RequestMethodInterface;

return [
    'routes' => [
        'startpage' => [
            'path' => '/',
            'middleware' => [
                HomePageHandler::class,
            ],
            'allowed_methods' => [RequestMethodInterface::METHOD_GET, RequestMethodInterface::METHOD_POST],
            'options' => [],
        ],
        'info' => [
            'path' => '/:id[/]',
            'middleware' => [
                InfoPageHandler::class,
            ],
            'allowed_methods' => [RequestMethodInterface::METHOD_GET, RequestMethodInterface::METHOD_POST],
            'options' => [
                'constraints' => ['id' => '(faq|ueber-uns|beratung|impressum|datenschutz|erstinfo|cookie-layer|cookies|rl|hr|phv|rs|tie|unf|wg)'],
            ],
        ],
        'kontakt' => [
            'path' => '/{kontakt}[/]',
            'middleware' => [
                InfoPageHandler::class,
            ],
            'allowed_methods' => [RequestMethodInterface::METHOD_GET, RequestMethodInterface::METHOD_POST],
            'options' => [
                'defaults' => [
                    'id' => 'kontakt',
                ],
            ],
        ],
        'atb' => [
            'path' => '/{atb}[/]',
            'middleware' => [
                InfoPageHandler::class,
            ],
            'allowed_methods' => [RequestMethodInterface::METHOD_GET, RequestMethodInterface::METHOD_POST],
            'options' => [
                'defaults' => [
                    'id' => 'atb',
                ],
            ],
        ],
    ],
];
