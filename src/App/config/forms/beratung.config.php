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
use Laminas\Form\Element\Email;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Tel;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\NotEmpty;

return [
    'type' => Form::class,
    'options' => [
        'floating-labels' => true,
        'col_attributes' => ['class' => 'col-12 col-md-6'],
        'layout' => \Mimmi20\Mezzio\BootstrapForm\LaminasView\View\Helper\Form::LAYOUT_VERTICAL,
    ],
    'attributes' => ['class' => 'g-3'],
    'elements' => [
        [
            'spec' => [
                'type' => Tel::class,
                'name' => 'telefon',
                'options' => ['label' => 'Telefonnummer'],
                'attributes' => [
                    'id' => 'telefon',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Email::class,
                'name' => 'email',
                'options' => [
                    'label' => 'E-Mail-Adresse',
                    'label_options' => ['disable_html_escape' => true],
                ],
                'attributes' => [
                    'id' => 'email',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
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
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
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
                'options' => ['label' => 'Beratung anfordern'],
                'attributes' => ['value' => 'Absenden'],
            ],
        ],
    ],
    'input_filter' => [
        'telefon' => ['required' => false],
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
        'agb' => ['required' => true],
    ],
];
