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

/**
 * Konfiguration der Form für Kontaktaufnahme
 */

namespace Application;

use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Radio;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\NotEmpty;

return [
    'type' => Form::class,
    'elements' => [
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'anrede',
                'options' => [
                    'label' => 'Anrede',
                    'label_options' => ['disable_html_escape' => true],
                    'value_options' => [
                        'Herr' => 'Herr',
                        'Frau' => 'Frau',
                        'Divers' => 'Divers',
                    ],
                ],
                'attributes' => [
                    'id' => 'anrede',
                    'required' => 'required',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'vorname',
                'options' => [
                    'label' => 'Vorname',
                    'label_options' => ['disable_html_escape' => true],
                ],
                'attributes' => [
                    'id' => 'vorname',
                    'required' => 'required',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'nachname',
                'options' => [
                    'label' => 'Nachname',
                    'label_options' => ['disable_html_escape' => true],
                ],
                'attributes' => [
                    'id' => 'nachname',
                    'required' => 'required',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'telefon',
                'options' => ['label' => 'Telefonnummer'],
                'attributes' => ['id' => 'telefon'],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'email',
                'options' => [
                    'label' => 'E-Mail-Adresse',
                    'label_options' => ['disable_html_escape' => true],
                ],
                'attributes' => [
                    'id' => 'email',
                    'required' => 'required',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'title',
                'options' => ['label' => 'Ihr Anliegen'],
                'attributes' => ['id' => 'title'],
            ],
        ],
        [
            'spec' => [
                'type' => Textarea::class,
                'name' => 'message',
                'options' => [
                    'label' => 'Ihre Nachricht',
                    'label_options' => ['disable_html_escape' => true],
                ],
                'attributes' => [
                    'id' => 'message',
                    'required' => 'required',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'agb',
                'options' => [
                    'label' => 'Ich habe die <a href="/datenschutz">Datenschutzbestimmungen</a> zur Kenntnis genommen',
                    'label_options' => ['disable_html_escape' => true],
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'agb',
                    'required' => 'required',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Hidden::class,
                'name' => 'sToken',
            ],
        ],
        [
            'spec' => [
                'type' => Submit::class,
                'name' => 'submit',
                'options' => ['label' => 'Nachricht senden'],
                'attributes' => ['value' => 'Absenden'],
            ],
        ],
    ],
    'input_filter' => [
        'anrede' => ['required' => true],
        'vorname' => ['required' => true],
        'nachname' => ['required' => true],
        'email' => [
            'required' => true,
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'break_chain_on_failure' => true,
                    'options' => ['message' => 'Bitte E-Mail Adresse eingeben!'],
                ],
                [
                    'name' => EmailAddress::class,
                    'options' => ['message' => 'Bitte gültige E-Mail eingeben!'],
                ],
            ],
        ],
        'message' => ['required' => true],
        'agb' => ['required' => true],
    ],
];
