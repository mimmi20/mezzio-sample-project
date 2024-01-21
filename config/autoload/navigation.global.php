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
                'class' => 'btn-secondary',
            ],
            'ueber-uns' => [
                'label' => 'Über uns',
                'title' => 'Über uns',
                'route' => 'info',
                'params' => ['id' => 'ueber-uns'],
                'id' => 'ueber-uns-id',
                'class' => 'btn-secondary',
            ],
            'submenu' => [
                'label' => 'Beratung & Kontakt',
                'title' => 'Beratung & Kontakt',
                'uri' => '#',
                'id' => 'sub-id',
                'class' => 'btn-secondary',
                'pages' => [
                    'beratung' => [
                        'label' => 'Beratung',
                        'title' => 'Beratung',
                        'route' => 'info',
                        'params' => ['id' => 'beratung'],
                        'id' => 'beratung-id',
                        'class' => 'btn-secondary',
                    ],
                    'kontakt' => [
                        'label' => 'Kontakt',
                        'title' => 'Kontakt',
                        'route' => 'info',
                        'params' => ['id' => 'kontakt'],
                        'id' => 'kontakt-id',
                        'class' => 'btn-secondary',
                        'pages' => [
                            'beratung' => [
                                'label' => 'Beratung(2)',
                                'title' => 'Beratung(2)',
                                'route' => 'info',
                                'params' => ['id' => 'beratung'],
                                'id' => 'beratung-inner-id',
                                'class' => 'btn-secondary',
                            ],
                            'kontakt' => [
                                'label' => 'Kontakt(2)',
                                'title' => 'Kontakt(2)',
                                'route' => 'kontakt',
                                'id' => 'kontakt-inner-id',
                                'class' => 'btn-secondary',
                                'text_domain' => 'navigation',
                            ],
                        ],
                    ],
                ],
            ],
            'atb' => [
                'label' => 'ATB',
                'title' => 'ATB',
                'route' => 'atb',
                'id' => 'atb-id',
                'class' => 'btn-secondary',
                'text_domain' => 'navigation',
                'fragment' => 'atb-start',
            ],
            'svr' => [
                'id' => 'svr',
                'label' => 'SVR',
                'title' => 'SVR',
                'uri' => '#',
                'class' => 'btn-secondary',
                'pages' => [
                    'hr' => [
                        'label' => 'HR',
                        'title' => 'HR',
                        'route' => 'info',
                        'params' => ['id' => 'hr'],
                        'id' => 'hr-id',
                        'class' => 'btn-secondary',
                    ],
                    'phv' => [
                        'label' => 'PHV',
                        'title' => 'PHV',
                        'route' => 'info',
                        'params' => ['id' => 'phv'],
                        'id' => 'phv-id',
                        'class' => 'btn-secondary',
                    ],
                    'rs' => [
                        'label' => 'RS',
                        'title' => 'RS',
                        'route' => 'info',
                        'params' => ['id' => 'rs'],
                        'id' => 'rs-id',
                        'class' => 'btn-secondary',
                    ],
                    'tie' => [
                        'label' => 'Tier',
                        'title' => 'Tier',
                        'route' => 'info',
                        'params' => ['id' => 'tie'],
                        'id' => 'tie-id',
                        'class' => 'btn-secondary',
                    ],
                    'unf' => [
                        'label' => 'Unfall',
                        'title' => 'Unfall',
                        'route' => 'info',
                        'params' => ['id' => 'unf'],
                        'id' => 'unf-id',
                        'class' => 'btn-secondary',
                    ],
                    'wg' => [
                        'label' => 'WG',
                        'title' => 'WG',
                        'route' => 'info',
                        'params' => ['id' => 'wg'],
                        'id' => 'wg-id',
                        'class' => 'btn-secondary',
                    ],
                ],
            ],
            'vt' => [
                'id' => 'vt',
                'label' => 'VT',
                'title' => 'VT',
                'uri' => '#',
                'class' => 'btn-secondary',
                'pages' => [
                    'rl' => [
                        'label' => 'RL',
                        'title' => 'RL',
                        'route' => 'info',
                        'params' => ['id' => 'rl'],
                        'id' => 'rl-id',
                        'class' => 'btn-secondary',
                    ],
                ],
            ],
            'login' => [
                'id' => 'login',
                'label' => 'Anmelden',
                'title' => 'Anmelden',
                'uri' => '#',
                // 'target' => '_blank',
                'class' => 'btn-primary',
            ],
        ],
        'bottom' => [
            'impressum' => [
                'label' => 'Impressum',
                'title' => 'Impressum',
                'route' => 'info',
                'params' => ['id' => 'impressum'],
                // 'target' => '_blank',
                'id' => 'impressum-id',
                'class' => 'btn-secondary',
            ],
        ],
    ],
];
