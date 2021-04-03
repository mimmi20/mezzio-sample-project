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
use Mezzio\Navigation\NavigationMiddleware;

return [
    'routes' => [
        'startpage' => [
            'path' => '/',
            'middleware' => [
                NavigationMiddleware::class,
                HomePageHandler::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
            'options' => [
                'stuff' => 'to',
                'pass' => 'to',
                'the' => 'underlying router',
            ],
        ],
        'info' => [
            'path' => '/:id[/]',
            'middleware' => [
                NavigationMiddleware::class,
                InfoPageHandler::class,
            ],
            'allowed_methods' => ['GET', 'POST'],
            'options' => [
                'constraints' => ['id' => '(faq|ueber-uns|beratung|kontakt|impressum|datenschutz|erstinfo|cookie-layer|cookies)'],
            ],
        ],
    ],
];
