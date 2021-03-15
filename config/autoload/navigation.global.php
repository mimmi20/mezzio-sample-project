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
                //'class' => 'nav-link',
                //'liClass' => 'nav-item',
            ],
            'ueber-uns' => [
                'label' => 'Über uns',
                'title' => 'Über uns',
                'route' => 'info',
                'params' => ['id' => 'ueber-uns'],
                //'class' => 'nav-link',
                //'liClass' => 'nav-item',
            ],
            'submenu' => [
                'label' => 'Beratung & Kontakt',
                'title' => 'Beratung & Kontakt',
                'uri' => '#',
                //'class' => 'nav-link dropdown',
                //'liClass' => 'nav-item',
                'pages' => [
                    'beratung' => [
                        'label' => 'Beratung',
                        'title' => 'Beratung',
                        'route' => 'info',
                        'params' => ['id' => 'beratung'],
                        'class' => 'dropdown-item',
                    ],
                    'kontakt' => [
                        'label' => 'Kontakt',
                        'title' => 'Kontakt',
                        'route' => 'info',
                        'params' => ['id' => 'kontakt'],
                        'class' => 'dropdown-item',
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
                //'liClass' => 'nav-item',
            ],
        ],
        'bottom' => [
            'impressum' => [
                'label' => 'Impressum',
                'title' => 'Impressum',
                'route' => 'info',
                'params' => ['id' => 'impressum'],
                'target' => '_blank',
                //'class' => 'nav-link',
                //'liClass' => 'nav-item',
            ],
        ],
    ],
];
