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

/*
 * aufgrund des ACL-Aufbaus sollte die Ressource dem Controller und das Privileg der Action entsprechen
 * Menüs sollten kein sinnvolles Linkziel haben, da diese ohnehin nicht anklickbar sind
 */

return [
    'navigation' => [
        'top' => [
            'login' => [
                //'type' => Uri::class,
                'id' => 'login',
                //'order' => 204,
                'label' => 'Anmelden',
                'title' => 'Anmelden',
                'uri' => '${interfaces.novum.uri}insuredirect24/de/login',
                'target' => '_blank',
                'class' => 'btn btn-primary btn',
                'liClass' => 'col-12 col-md-auto order-sm-4 mainmenu login-container d-none d-lg-flex',
            ],
            'faq' => [
                //'type' => Route::class,
                //'order' => 200,
                'label' => 'FAQ',
                'title' => 'FAQ',
                'route' => 'info',
                'params' => ['id' => 'faq'],
                'liClass' => 'col-12 col-md-auto order-sm-0 align-self-center mainmenu',
            ],
            'ueber-uns' => [
                //'type' => Route::class,
                //'order' => 201,
                'label' => 'Über uns',
                'title' => 'Über uns',
                'route' => 'info',
                'params' => ['id' => 'ueber-uns'],
                'liClass' => 'col-12 col-md-auto order-sm-1 align-self-center mainmenu',
            ],
            'beratung' => [
                //'type' => Route::class,
                //'order' => 202,
                'label' => 'Beratung',
                'title' => 'Beratung',
                'route' => 'info',
                'params' => ['id' => 'beratung'],
                'liClass' => 'col-12 col-md-auto order-sm-2 align-self-center mainmenu',
            ],
            'kontakt' => [
                //'type' => Route::class,
                //'order' => 203,
                'label' => 'Kontakt',
                'title' => 'Kontakt',
                'route' => 'info',
                'params' => ['id' => 'kontakt'],
                'liClass' => 'col-12 col-md-auto order-sm-3 align-self-center mainmenu',
            ],
        ],
        'bottom' => [
            'impressum' => [
                //'type' => Route::class,
                //'order' => 200,
                'label' => 'Impressum',
                'title' => 'Impressum',
                'route' => 'info',
                'params' => ['id' => 'impressum'],
                'target' => '_blank',
            ],
        ],
    ],
];
