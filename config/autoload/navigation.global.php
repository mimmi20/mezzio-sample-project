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
            'faq' => [
                'label' => 'FAQ',
                'title' => 'FAQ',
                'route' => 'info',
                'params' => ['id' => 'faq'],
                'id' => 'faq-id',
            ],
            'ueber-uns' => [
                'label' => 'Über uns',
                'title' => 'Über uns',
                'route' => 'info',
                'params' => ['id' => 'ueber-uns'],
                'id' => 'ueber-uns-id',
            ],
            'submenu' => [
                'label' => 'Beratung & Kontakt',
                'title' => 'Beratung & Kontakt',
                'uri' => '#',
                'id' => 'sub-id',
                'pages' => [
                    'beratung' => [
                        'label' => 'Beratung',
                        'title' => 'Beratung',
                        'route' => 'info',
                        'params' => ['id' => 'beratung'],
                        'id' => 'beratung-id',
                    ],
                    'kontakt' => [
                        'label' => 'Kontakt',
                        'title' => 'Kontakt',
                        'route' => 'info',
                        'params' => ['id' => 'kontakt'],
                        'id' => 'kontakt-id',
                        'pages' => [
                            'beratung' => [
                                'label' => 'Beratung(2)',
                                'title' => 'Beratung(2)',
                                'route' => 'info',
                                'params' => ['id' => 'beratung'],
                                'id' => 'beratung-inner-id',
                            ],
                            'kontakt' => [
                                'label' => 'Kontakt(2)',
                                'title' => 'Kontakt(2)',
                                'route' => 'info',
                                'params' => ['id' => 'kontakt'],
                                'id' => 'kontakt-inner-id',
                            ],
                        ],
                    ],
                ],
            ],
            'vt' => [
                'id' => 'vt',
                'label' => 'VT',
                'title' => 'VT',
                'uri' => '#',
                'pages' => [
                    'rl' => [
                        'label' => 'RL',
                        'title' => 'RL',
                        'route' => 'info',
                        'params' => ['id' => 'rl'],
                        'id' => 'rl-id',
                    ],
                ],
            ],
            'login' => [
                'id' => 'login',
                'label' => 'Anmelden',
                'title' => 'Anmelden',
                'uri' => '#',
                'target' => '_blank',
                'class' => 'btn btn-primary btn',
            ],
        ],
        'bottom' => [
            'impressum' => [
                'label' => 'Impressum',
                'title' => 'Impressum',
                'route' => 'info',
                'params' => ['id' => 'impressum'],
                'target' => '_blank',
                'id' => 'impressum-id',
            ],
        ],
    ],
];
