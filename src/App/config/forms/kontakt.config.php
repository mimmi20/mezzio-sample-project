<?php

/**
 * This file is part of the mimmi20/mezzio-sample-project package.
 *
 * Copyright (c) 2021-2024, Thomas Mueller <mimmi20@live.de>
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
use Laminas\Form\Element\Radio;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Tel;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;
use Laminas\Form\Form;
use Laminas\Validator\EmailAddress;
use Laminas\Validator\NotEmpty;

return [
    'type' => Form::class,
    'options' => [
        'col_attributes' => ['class' => 'col-12 col-md-6'],
        'label_col_attributes' => ['class' => 'col-12 col-md-6'],
        'row_attributes' => ['class' => 'mb-3'],
        'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_HORIZONTAL,
        'form-required-mark' => '<div class="mt-2 text-info-required"><sup>*</sup> Pflichtfeld</div>',
    ],
    'attributes' => [
        'class' => 'g-3',
        'accept-charset' => 'utf-8',
        'novalidate' => 'novalidate',
        'data-needs-validation' => true,
    ],
    'elements' => [
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'anrede',
                'options' => [
                    'label' => 'Anrede',
                    'value_options' => [
                        [
                            'label' => 'Herr',
                            'value' => 'Herr',
                        ],
                        [
                            'label' => 'Frau',
                            'value' => 'Frau',
                            'attributes' => ['id' => 'an_f'],
                        ],
                        [
                            'label' => 'Divers',
                            'value' => 'Divers',
                        ],
                    ],
                    'group_attributes' => ['class' => 'form-check-inline'],
                    // 'col_attributes' => ['class' => 'row align-items-center'],
                    'legend_attributes' => ['class' => 'form-label'],
                    // 'row_attributes' => ['class' => 'gx-3 gy-2 align-items-center'],
                    // 'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_INLINE,
                ],
                'attributes' => ['id' => 'anrede'],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'vorname',
                'options' => ['label' => 'Vorname'],
                'attributes' => [
                    'id' => 'vorname',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'nachname',
                'options' => ['label' => 'Nachname'],
                'attributes' => [
                    'id' => 'nachname',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Tel::class,
                'name' => 'telefon',
                'options' => ['label' => 'Telefonnummer'],
                'attributes' => [
                    'id' => 'telefon',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Email::class,
                'name' => 'email',
                'options' => ['label' => 'E-Mail-Adresse'],
                'attributes' => [
                    'id' => 'email',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'title',
                'options' => ['label' => 'Ihr Anliegen'],
                'attributes' => [
                    'id' => 'title',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Textarea::class,
                'name' => 'message',
                'options' => ['label' => 'Ihre Nachricht'],
                'attributes' => [
                    'id' => 'message',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
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
                    'col_attributes' => ['class' => 'col-md-12'],
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
                'attributes' => [
                    'value' => 'Nachricht senden',
                    'class' => 'btn btn-primary',
                ],
            ],
        ],
    ],
    'input_filter' => [
        'anrede' => ['required' => true],
        'vorname' => ['required' => true],
        'nachname' => ['required' => true],
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
        'message' => ['required' => true],
        'agb' => ['required' => true],
    ],
];
