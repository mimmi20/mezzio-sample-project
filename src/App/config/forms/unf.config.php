<?php

/**
 * This file is part of the mimmi20/mezzio-sample-project package.
 *
 * Copyright (c) 2021-2025, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace Calculator;

use Laminas\Form\Element\Button;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Date;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Radio;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Submit;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;

return [
    'type' => Form::class,
    'options' => [
        'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_HORIZONTAL,
        'form-required-mark' => '<div class="mt-2 text-info-required"><sup>*</sup> Pflichtfeld</div>',
        'field-required-mark' => '<span class="text-info-required"><sup>*</sup></span>',
        'row_attributes' => ['class' => 'my-2'],
        'col_attributes' => ['class' => 'col-sm'],

        'help_attributes' => ['class' => 'help-content'],
    ],
    'attributes' => [
        'method' => 'post',
        'class' => 'g-0',
        'accept-charset' => 'utf-8',
        'novalidate' => 'novalidate',
        'data-needs-validation' => true,
        'id' => 'unfall-form',
    ],
    'elements' => [
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'anz',
                'options' => [
                    'label' => 'Wieviele Personen möchten Sie versichern?',

                    'value_options' => [
                        '1' => '1 Person',
                        '2' => '2 Personen',
                        '3' => '3 Personen',
                        '4' => '4 Personen',
                        '5' => '5 Personen',
                        '6' => '6 Personen',
                        '7' => '7 Personen',
                        '8' => '8 Personen',
                    ],
                ],
                'attributes' => ['id' => 'anz'],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'plz',
                'options' => ['label' => 'PLZ des Antragsstellers'],
                'attributes' => [
                    'id' => 'plz',
                    'class' => ' js-special-zip-message',
                    'required' => 'required',
                    'pattern' => '^\d{5}$',
                    'minlength' => '5',
                    'maxlength' => '5',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'versbeginn',
                'options' => [
                    'label' => 'Versicherungsbeginn',

                    'value_options' => [
                        'sofort' => 'schnellstmöglich',
                        'datum' => 'Datum angeben',
                    ],
                ],
                'attributes' => [
                    'id' => 'versbeginn',
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'show',
                    'data-toggle-value' => 'datum',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'versbeginn_datum',
                'options' => ['label' => 'Beginn am'],
                'attributes' => [
                    'id' => 'versbeginn_datum',
                    'class' => ' datepicker js-datepicker',
                    'required' => 'required',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'beamte',
                'options' => [
                    'label' => 'Tarif',

                    'value_options' => [
                        'Normal' => 'Normal',
                        'öffentl. Dienst' => 'öffentlicher Dienst',
                    ],
                ],
                'attributes' => ['id' => 'beamte'],
            ],
        ],
        'laufzeit' => [
            'spec' => [
                'type' => Select::class,
                'name' => 'laufzeit',
                'options' => [
                    'label' => 'Laufzeit',

                    'value_options' => [
                        '1' => '1 Jahr',
                        '3' => '3 Jahre',
                        '5' => '5 Jahre',
                    ],
                ],
                'attributes' => ['id' => 'laufzeit'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'kombirabatte',
                'options' => [
                    'label' => 'Kombirabatte mit berechnen?',
                    'help_content' => '<strong>Kombirabatte mit berechnen?</strong><p>Welche Verträge haben Sie schon oder haben vor, sie zu versichern? Je mehr Verträge Sie bei einer Gesellschaft haben, umso günstiger wird der Preis.</p>',
                    'value_options' => [
                        [
                            'label' => 'nein',
                            'value' => 'nein',
                            'attributes' => ['id' => 'kr_n'],
                        ],
                        [
                            'label' => 'ja',
                            'value' => 'ja',
                            'attributes' => ['id' => 'kr_j'],
                        ],
                    ],

                    'col_attributes' => ['data-toggle' => '1'],
                ],
                'attributes' => ['id' => 'kombirabatte'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrPHV',
                'options' => [
                    'label' => 'Privathaftpflicht',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrPHV',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrTIE',
                'options' => [
                    'label' => 'Tierhalterhaftpflicht',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrTIE',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrHUG',
                'options' => [
                    'label' => 'Haus-Grundbesitzer Haftpflicht',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrHUG',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrOEL',
                'options' => [
                    'label' => 'Gewässerschaden/Öltank',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrOEL',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrWG',
                'options' => [
                    'label' => 'Wohngebäude',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrWG',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrWGGLS',
                'options' => [
                    'label' => 'Wohngebäude-Glas',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrWGGLS',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrHR',
                'options' => [
                    'label' => 'Hausrat',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrHR',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrHRGLS',
                'options' => [
                    'label' => 'Hausrat-Glas',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrHRGLS',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrUNF',
                'options' => [
                    'label' => 'Unfall',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrUNF',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrRS',
                'options' => [
                    'label' => 'Rechtsschutz',
                    'label_attributes' => ['class' => 'col-sm text-sm-right check-label'],
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'KrRS',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'name1',
                'options' => ['label' => 'Vorname'],
                'attributes' => [
                    'id' => 'name1',
                    'data-pers' => 1,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'name2',
                'options' => ['label' => 'Vorname'],
                'attributes' => [
                    'id' => 'name2',
                    'data-pers' => 2,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'name3',
                'options' => ['label' => 'Vorname'],
                'attributes' => [
                    'id' => 'name3',
                    'data-pers' => 3,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'name4',
                'options' => ['label' => 'Vorname'],
                'attributes' => [
                    'id' => 'name4',
                    'data-pers' => 4,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'name5',
                'options' => ['label' => 'Vorname'],
                'attributes' => [
                    'id' => 'name5',
                    'data-pers' => 5,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'name6',
                'options' => ['label' => 'Vorname'],
                'attributes' => [
                    'id' => 'name6',
                    'data-pers' => 6,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'name7',
                'options' => ['label' => 'Vorname'],
                'attributes' => [
                    'id' => 'name7',
                    'data-pers' => 7,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'name8',
                'options' => ['label' => 'Vorname'],
                'attributes' => [
                    'id' => 'name8',
                    'data-pers' => 8,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum1',
                'options' => ['label' => 'Geburtsdatum'],
                'attributes' => [
                    'id' => 'gebdatum1',
                    'data-pers' => 1,
                    'placeholder' => 'TT.MM.JJJJ',

                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum2',
                'options' => ['label' => 'Geburtsdatum'],
                'attributes' => [
                    'id' => 'gebdatum2',
                    'data-pers' => 2,
                    'placeholder' => 'TT.MM.JJJJ',

                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum3',
                'options' => ['label' => 'Geburtsdatum'],
                'attributes' => [
                    'id' => 'gebdatum3',
                    'data-pers' => 3,
                    'placeholder' => 'TT.MM.JJJJ',

                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum4',
                'options' => ['label' => 'Geburtsdatum'],
                'attributes' => [
                    'id' => 'gebdatum4',
                    'data-pers' => 4,
                    'placeholder' => 'TT.MM.JJJJ',

                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum5',
                'options' => ['label' => 'Geburtsdatum'],
                'attributes' => [
                    'id' => 'gebdatum5',
                    'data-pers' => 5,
                    'placeholder' => 'TT.MM.JJJJ',

                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum6',
                'options' => ['label' => 'Geburtsdatum'],
                'attributes' => [
                    'id' => 'gebdatum6',
                    'data-pers' => 6,
                    'placeholder' => 'TT.MM.JJJJ',

                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum7',
                'options' => ['label' => 'Geburtsdatum'],
                'attributes' => [
                    'id' => 'gebdatum7',
                    'data-pers' => 7,
                    'placeholder' => 'TT.MM.JJJJ',

                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum8',
                'options' => ['label' => 'Geburtsdatum'],
                'attributes' => [
                    'id' => 'gebdatum8',
                    'data-pers' => 8,
                    'placeholder' => 'TT.MM.JJJJ',

                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'geschlecht1',
                'options' => [
                    'label' => 'Geschlecht',

                    'value_options' => [
                        'M' => 'männlich',
                        'W' => 'weiblich',
                    ],
                ],
                'attributes' => [
                    'id' => 'geschlecht1',
                    'data-pers' => 1,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'geschlecht2',
                'options' => [
                    'label' => 'Geschlecht',

                    'value_options' => [
                        'M' => 'männlich',
                        'W' => 'weiblich',
                    ],
                ],
                'attributes' => [
                    'id' => 'geschlecht2',
                    'data-pers' => 2,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'geschlecht3',
                'options' => [
                    'label' => 'Geschlecht',

                    'value_options' => [
                        'M' => 'männlich',
                        'W' => 'weiblich',
                    ],
                ],
                'attributes' => [
                    'id' => 'geschlecht3',
                    'data-pers' => 3,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'geschlecht4',
                'options' => [
                    'label' => 'Geschlecht',

                    'value_options' => [
                        'M' => 'männlich',
                        'W' => 'weiblich',
                    ],
                ],
                'attributes' => [
                    'id' => 'geschlecht4',
                    'data-pers' => 4,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'geschlecht5',
                'options' => [
                    'label' => 'Geschlecht',

                    'value_options' => [
                        'M' => 'männlich',
                        'W' => 'weiblich',
                    ],
                ],
                'attributes' => [
                    'id' => 'geschlecht5',
                    'data-pers' => 5,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'geschlecht6',
                'options' => [
                    'label' => 'Geschlecht',

                    'value_options' => [
                        'M' => 'männlich',
                        'W' => 'weiblich',
                    ],
                ],
                'attributes' => [
                    'id' => 'geschlecht6',
                    'data-pers' => 6,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'geschlecht7',
                'options' => [
                    'label' => 'Geschlecht',

                    'value_options' => [
                        'M' => 'männlich',
                        'W' => 'weiblich',
                    ],
                ],
                'attributes' => [
                    'id' => 'geschlecht7',
                    'data-pers' => 7,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'geschlecht8',
                'options' => [
                    'label' => 'Geschlecht',

                    'value_options' => [
                        'M' => 'männlich',
                        'W' => 'weiblich',
                    ],
                ],
                'attributes' => [
                    'id' => 'geschlecht8',
                    'data-pers' => 8,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master1',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master1',
                    'data-pers' => 1,
                    'class' => ' js-job-autocomplete',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master2',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master2',
                    'data-pers' => 2,
                    'class' => ' js-job-autocomplete',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master3',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master3',
                    'data-pers' => 3,
                    'class' => ' js-job-autocomplete',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master4',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master4',
                    'data-pers' => 4,
                    'class' => ' js-job-autocomplete',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master5',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master5',
                    'data-pers' => 5,
                    'class' => ' js-job-autocomplete',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master6',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master6',
                    'data-pers' => 6,
                    'class' => ' js-job-autocomplete',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master7',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master7',
                    'data-pers' => 7,
                    'class' => ' js-job-autocomplete',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master8',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master8',
                    'data-pers' => 8,
                    'class' => ' js-job-autocomplete',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master1_id',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master1_id',
                    'data-pers' => 1,
                    'class' => '',
                    'required' => 'required',
                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master2_id',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master2_id',
                    'data-pers' => 2,
                    'class' => '',
                    'required' => 'required',
                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master3_id',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master3_id',
                    'data-pers' => 3,
                    'class' => '',
                    'required' => 'required',
                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master4_id',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master4_id',
                    'data-pers' => 4,
                    'class' => '',
                    'required' => 'required',
                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master5_id',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master5_id',
                    'data-pers' => 5,
                    'class' => '',
                    'required' => 'required',
                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master6_id',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master6_id',
                    'data-pers' => 6,
                    'class' => '',
                    'required' => 'required',
                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master7_id',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master7_id',
                    'data-pers' => 7,
                    'class' => '',
                    'required' => 'required',
                    'autocomplete' => 'off',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'beruf_master8_id',
                'options' => ['label' => 'Beruf'],
                'attributes' => [
                    'id' => 'beruf_master8_id',
                    'data-pers' => 8,
                    'class' => '',
                    'required' => 'required',
                    'autocomplete' => 'off',
                ],
            ],
        ],
        'grund1' => [
            'spec' => [
                'type' => Text::class,
                'name' => 'grund1',
                'options' => ['label' => 'Grundinvalidität'],
                'attributes' => [
                    'id' => 'grund1',
                    'data-pers' => 1,
                    'class' => '',
                    'required' => 'required',
                    'min' => '25000',
                ],
            ],
        ],
        'grund2' => [
            'spec' => [
                'type' => Text::class,
                'name' => 'grund2',
                'options' => ['label' => 'Grundinvalidität'],
                'attributes' => [
                    'id' => 'grund2',
                    'data-pers' => 2,
                    'class' => '',
                    'required' => 'required',
                    'min' => '25000',
                ],
            ],
        ],
        'grund3' => [
            'spec' => [
                'type' => Text::class,
                'name' => 'grund3',
                'options' => ['label' => 'Grundinvalidität'],
                'attributes' => [
                    'id' => 'grund3',
                    'data-pers' => 3,
                    'class' => '',
                    'required' => 'required',
                    'min' => '25000',
                ],
            ],
        ],
        'grund4' => [
            'spec' => [
                'type' => Text::class,
                'name' => 'grund4',
                'options' => ['label' => 'Grundinvalidität'],
                'attributes' => [
                    'id' => 'grund4',
                    'data-pers' => 4,
                    'class' => '',
                    'required' => 'required',
                    'min' => '25000',
                ],
            ],
        ],
        'grund5' => [
            'spec' => [
                'type' => Text::class,
                'name' => 'grund5',
                'options' => ['label' => 'Grundinvalidität'],
                'attributes' => [
                    'id' => 'grund5',
                    'data-pers' => 5,
                    'class' => '',
                    'required' => 'required',
                    'min' => '25000',
                ],
            ],
        ],
        'grund6' => [
            'spec' => [
                'type' => Text::class,
                'name' => 'grund6',
                'options' => ['label' => 'Grundinvalidität'],
                'attributes' => [
                    'id' => 'grund6',
                    'data-pers' => 6,
                    'class' => '',
                    'required' => 'required',
                    'min' => '25000',
                ],
            ],
        ],
        'grund7' => [
            'spec' => [
                'type' => Text::class,
                'name' => 'grund7',
                'options' => ['label' => 'Grundinvalidität'],
                'attributes' => [
                    'id' => 'grund7',
                    'data-pers' => 7,
                    'class' => '',
                    'required' => 'required',
                    'min' => '25000',
                ],
            ],
        ],
        'grund8' => [
            'spec' => [
                'type' => Text::class,
                'name' => 'grund8',
                'options' => ['label' => 'Grundinvalidität'],
                'attributes' => [
                    'id' => 'grund8',
                    'data-pers' => 8,
                    'class' => '',
                    'required' => 'required',
                    'min' => '25000',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'prog1',
                'options' => [
                    'label' => 'Progression',

                    'value_options' => [
                        '100' => '100 %',
                        '225' => '225 %',
                        '300' => '300 %',
                        '350' => '350 %',
                        '500' => '500 %',
                        '600' => '600 %',
                        '1000' => '1000 %',
                    ],
                ],
                'attributes' => [
                    'id' => 'prog1',
                    'data-pers' => 1,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'prog2',
                'options' => [
                    'label' => 'Progression',

                    'value_options' => [
                        '100' => '100 %',
                        '225' => '225 %',
                        '300' => '300 %',
                        '350' => '350 %',
                        '500' => '500 %',
                        '600' => '600 %',
                        '1000' => '1000 %',
                    ],
                ],
                'attributes' => [
                    'id' => 'prog2',
                    'data-pers' => 2,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'prog3',
                'options' => [
                    'label' => 'Progression',

                    'value_options' => [
                        '100' => '100 %',
                        '225' => '225 %',
                        '300' => '300 %',
                        '350' => '350 %',
                        '500' => '500 %',
                        '600' => '600 %',
                        '1000' => '1000 %',
                    ],
                ],
                'attributes' => [
                    'id' => 'prog3',
                    'data-pers' => 3,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'prog4',
                'options' => [
                    'label' => 'Progression',

                    'value_options' => [
                        '100' => '100 %',
                        '225' => '225 %',
                        '300' => '300 %',
                        '350' => '350 %',
                        '500' => '500 %',
                        '600' => '600 %',
                        '1000' => '1000 %',
                    ],
                ],
                'attributes' => [
                    'id' => 'prog4',
                    'data-pers' => 4,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'prog5',
                'options' => [
                    'label' => 'Progression',

                    'value_options' => [
                        '100' => '100 %',
                        '225' => '225 %',
                        '300' => '300 %',
                        '350' => '350 %',
                        '500' => '500 %',
                        '600' => '600 %',
                        '1000' => '1000 %',
                    ],
                ],
                'attributes' => [
                    'id' => 'prog5',
                    'data-pers' => 5,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'prog6',
                'options' => [
                    'label' => 'Progression',

                    'value_options' => [
                        '100' => '100 %',
                        '225' => '225 %',
                        '300' => '300 %',
                        '350' => '350 %',
                        '500' => '500 %',
                        '600' => '600 %',
                        '1000' => '1000 %',
                    ],
                ],
                'attributes' => [
                    'id' => 'prog6',
                    'data-pers' => 6,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'prog7',
                'options' => [
                    'label' => 'Progression',

                    'value_options' => [
                        '100' => '100 %',
                        '225' => '225 %',
                        '300' => '300 %',
                        '350' => '350 %',
                        '500' => '500 %',
                        '600' => '600 %',
                        '1000' => '1000 %',
                    ],
                ],
                'attributes' => [
                    'id' => 'prog7',
                    'data-pers' => 7,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'prog8',
                'options' => [
                    'label' => 'Progression',

                    'value_options' => [
                        '100' => '100 %',
                        '225' => '225 %',
                        '300' => '300 %',
                        '350' => '350 %',
                        '500' => '500 %',
                        '600' => '600 %',
                        '1000' => '1000 %',
                    ],
                ],
                'attributes' => [
                    'id' => 'prog8',
                    'data-pers' => 8,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'voll1',
                'options' => ['label' => 'Vollinvalidität'],
                'attributes' => [
                    'id' => 'voll1',
                    'data-pers' => 1,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'voll2',
                'options' => ['label' => 'Vollinvalidität'],
                'attributes' => [
                    'id' => 'voll2',
                    'data-pers' => 2,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'voll3',
                'options' => ['label' => 'Vollinvalidität'],
                'attributes' => [
                    'id' => 'voll3',
                    'data-pers' => 3,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'voll4',
                'options' => ['label' => 'Vollinvalidität'],
                'attributes' => [
                    'id' => 'voll4',
                    'data-pers' => 4,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'voll5',
                'options' => ['label' => 'Vollinvalidität'],
                'attributes' => [
                    'id' => 'voll5',
                    'data-pers' => 5,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'voll6',
                'options' => ['label' => 'Vollinvalidität'],
                'attributes' => [
                    'id' => 'voll6',
                    'data-pers' => 6,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'voll7',
                'options' => ['label' => 'Vollinvalidität'],
                'attributes' => [
                    'id' => 'voll7',
                    'data-pers' => 7,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'voll8',
                'options' => ['label' => 'Vollinvalidität'],
                'attributes' => [
                    'id' => 'voll8',
                    'data-pers' => 8,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'tod1',
                'options' => ['label' => 'Todesfall'],
                'attributes' => [
                    'id' => 'tod1',
                    'data-pers' => 1,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'tod2',
                'options' => ['label' => 'Todesfall'],
                'attributes' => [
                    'id' => 'tod2',
                    'data-pers' => 2,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'tod3',
                'options' => ['label' => 'Todesfall'],
                'attributes' => [
                    'id' => 'tod3',
                    'data-pers' => 3,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'tod4',
                'options' => ['label' => 'Todesfall'],
                'attributes' => [
                    'id' => 'tod4',
                    'data-pers' => 4,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'tod5',
                'options' => ['label' => 'Todesfall'],
                'attributes' => [
                    'id' => 'tod5',
                    'data-pers' => 5,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'tod6',
                'options' => ['label' => 'Todesfall'],
                'attributes' => [
                    'id' => 'tod6',
                    'data-pers' => 6,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'tod7',
                'options' => ['label' => 'Todesfall'],
                'attributes' => [
                    'id' => 'tod7',
                    'data-pers' => 7,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'tod8',
                'options' => ['label' => 'Todesfall'],
                'attributes' => [
                    'id' => 'tod8',
                    'data-pers' => 8,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'ueber1',
                'options' => ['label' => 'Übergangsleistung'],
                'attributes' => [
                    'id' => 'ueber1',
                    'data-pers' => 1,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'ueber2',
                'options' => ['label' => 'Übergangsleistung'],
                'attributes' => [
                    'id' => 'ueber2',
                    'data-pers' => 2,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'ueber3',
                'options' => ['label' => 'Übergangsleistung'],
                'attributes' => [
                    'id' => 'ueber3',
                    'data-pers' => 3,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'ueber4',
                'options' => ['label' => 'Übergangsleistung'],
                'attributes' => [
                    'id' => 'ueber4',
                    'data-pers' => 4,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'ueber5',
                'options' => ['label' => 'Übergangsleistung'],
                'attributes' => [
                    'id' => 'ueber5',
                    'data-pers' => 5,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'ueber6',
                'options' => ['label' => 'Übergangsleistung'],
                'attributes' => [
                    'id' => 'ueber6',
                    'data-pers' => 6,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'ueber7',
                'options' => ['label' => 'Übergangsleistung'],
                'attributes' => [
                    'id' => 'ueber7',
                    'data-pers' => 7,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'ueber8',
                'options' => ['label' => 'Übergangsleistung'],
                'attributes' => [
                    'id' => 'ueber8',
                    'data-pers' => 8,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'kh1',
                'options' => ['label' => 'Krankenhaustage- und Genesungsgeld'],
                'attributes' => [
                    'id' => 'kh1',
                    'data-pers' => 1,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'kh2',
                'options' => ['label' => 'Krankenhaustage- und Genesungsgeld'],
                'attributes' => [
                    'id' => 'kh2',
                    'data-pers' => 2,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'kh3',
                'options' => ['label' => 'Krankenhaustage- und Genesungsgeld'],
                'attributes' => [
                    'id' => 'kh3',
                    'data-pers' => 3,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'kh4',
                'options' => ['label' => 'Krankenhaustage- und Genesungsgeld'],
                'attributes' => [
                    'id' => 'kh4',
                    'data-pers' => 4,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'kh5',
                'options' => ['label' => 'Krankenhaustage- und Genesungsgeld'],
                'attributes' => [
                    'id' => 'kh5',
                    'data-pers' => 5,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'kh6',
                'options' => ['label' => 'Krankenhaustage- und Genesungsgeld'],
                'attributes' => [
                    'id' => 'kh6',
                    'data-pers' => 6,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'kh7',
                'options' => ['label' => 'Krankenhaustage- und Genesungsgeld'],
                'attributes' => [
                    'id' => 'kh7',
                    'data-pers' => 7,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'kh8',
                'options' => ['label' => 'Krankenhaustage- und Genesungsgeld'],
                'attributes' => [
                    'id' => 'kh8',
                    'data-pers' => 8,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'utg1',
                'options' => [
                    'label' => 'Unfall-Krankentagegeld',

                    'value_options' => [
                        'nein' => 'nein',
                        '8' => 'ab 8. Tag',
                        '15' => 'ab 15. Tag',
                        '29' => 'ab 29. Tag',
                        '43' => 'ab 43. Tag',
                    ],
                ],
                'attributes' => [
                    'id' => 'utg1',
                    'data-pers' => 1,
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'hide',
                    'data-toggle-value' => 'nein',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'utg2',
                'options' => [
                    'label' => 'Unfall-Krankentagegeld',

                    'value_options' => [
                        'nein' => 'nein',
                        '8' => 'ab 8. Tag',
                        '15' => 'ab 15. Tag',
                        '29' => 'ab 29. Tag',
                        '43' => 'ab 43. Tag',
                    ],
                ],
                'attributes' => [
                    'id' => 'utg2',
                    'data-pers' => 2,
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'hide',
                    'data-toggle-value' => 'nein',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'utg3',
                'options' => [
                    'label' => 'Unfall-Krankentagegeld',

                    'value_options' => [
                        'nein' => 'nein',
                        '8' => 'ab 8. Tag',
                        '15' => 'ab 15. Tag',
                        '29' => 'ab 29. Tag',
                        '43' => 'ab 43. Tag',
                    ],
                ],
                'attributes' => [
                    'id' => 'utg3',
                    'data-pers' => 3,
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'hide',
                    'data-toggle-value' => 'nein',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'utg4',
                'options' => [
                    'label' => 'Unfall-Krankentagegeld',

                    'value_options' => [
                        'nein' => 'nein',
                        '8' => 'ab 8. Tag',
                        '15' => 'ab 15. Tag',
                        '29' => 'ab 29. Tag',
                        '43' => 'ab 43. Tag',
                    ],
                ],
                'attributes' => [
                    'id' => 'utg4',
                    'data-pers' => 4,
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'hide',
                    'data-toggle-value' => 'nein',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'utg5',
                'options' => [
                    'label' => 'Unfall-Krankentagegeld',

                    'value_options' => [
                        'nein' => 'nein',
                        '8' => 'ab 8. Tag',
                        '15' => 'ab 15. Tag',
                        '29' => 'ab 29. Tag',
                        '43' => 'ab 43. Tag',
                    ],
                ],
                'attributes' => [
                    'id' => 'utg5',
                    'data-pers' => 5,
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'hide',
                    'data-toggle-value' => 'nein',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'utg6',
                'options' => [
                    'label' => 'Unfall-Krankentagegeld',

                    'value_options' => [
                        'nein' => 'nein',
                        '8' => 'ab 8. Tag',
                        '15' => 'ab 15. Tag',
                        '29' => 'ab 29. Tag',
                        '43' => 'ab 43. Tag',
                    ],
                ],
                'attributes' => [
                    'id' => 'utg6',
                    'data-pers' => 6,
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'hide',
                    'data-toggle-value' => 'nein',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'utg7',
                'options' => [
                    'label' => 'Unfall-Krankentagegeld',

                    'value_options' => [
                        'nein' => 'nein',
                        '8' => 'ab 8. Tag',
                        '15' => 'ab 15. Tag',
                        '29' => 'ab 29. Tag',
                        '43' => 'ab 43. Tag',
                    ],
                ],
                'attributes' => [
                    'id' => 'utg7',
                    'data-pers' => 7,
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'hide',
                    'data-toggle-value' => 'nein',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'utg8',
                'options' => [
                    'label' => 'Unfall-Krankentagegeld',

                    'value_options' => [
                        'nein' => 'nein',
                        '8' => 'ab 8. Tag',
                        '15' => 'ab 15. Tag',
                        '29' => 'ab 29. Tag',
                        '43' => 'ab 43. Tag',
                    ],
                ],
                'attributes' => [
                    'id' => 'utg8',
                    'data-pers' => 8,
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'hide',
                    'data-toggle-value' => 'nein',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'utgeur1',
                'options' => ['label' => 'Höhe Unfall-Krankentagegeld'],
                'attributes' => [
                    'id' => 'utgeur1',
                    'data-pers' => 1,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'utgeur2',
                'options' => ['label' => 'Höhe Unfall-Krankentagegeld'],
                'attributes' => [
                    'id' => 'utgeur2',
                    'data-pers' => 2,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'utgeur3',
                'options' => ['label' => 'Höhe Unfall-Krankentagegeld'],
                'attributes' => [
                    'id' => 'utgeur3',
                    'data-pers' => 3,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'utgeur4',
                'options' => ['label' => 'Höhe Unfall-Krankentagegeld'],
                'attributes' => [
                    'id' => 'utgeur4',
                    'data-pers' => 4,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'utgeur5',
                'options' => ['label' => 'Höhe Unfall-Krankentagegeld'],
                'attributes' => [
                    'id' => 'utgeur5',
                    'data-pers' => 5,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'utgeur6',
                'options' => ['label' => 'Höhe Unfall-Krankentagegeld'],
                'attributes' => [
                    'id' => 'utgeur6',
                    'data-pers' => 6,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'utgeur7',
                'options' => ['label' => 'Höhe Unfall-Krankentagegeld'],
                'attributes' => [
                    'id' => 'utgeur7',
                    'data-pers' => 7,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'utgeur8',
                'options' => ['label' => 'Höhe Unfall-Krankentagegeld'],
                'attributes' => [
                    'id' => 'utgeur8',
                    'data-pers' => 8,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'rente1',
                'options' => ['label' => 'Unfall-Rente'],
                'attributes' => [
                    'id' => 'rente1',
                    'data-pers' => 1,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'rente2',
                'options' => ['label' => 'Unfall-Rente'],
                'attributes' => [
                    'id' => 'rente2',
                    'data-pers' => 2,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'rente3',
                'options' => ['label' => 'Unfall-Rente'],
                'attributes' => [
                    'id' => 'rente3',
                    'data-pers' => 3,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'rente4',
                'options' => ['label' => 'Unfall-Rente'],
                'attributes' => [
                    'id' => 'rente4',
                    'data-pers' => 4,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'rente5',
                'options' => ['label' => 'Unfall-Rente'],
                'attributes' => [
                    'id' => 'rente5',
                    'data-pers' => 5,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'rente6',
                'options' => ['label' => 'Unfall-Rente'],
                'attributes' => [
                    'id' => 'rente6',
                    'data-pers' => 6,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'rente7',
                'options' => ['label' => 'Unfall-Rente'],
                'attributes' => [
                    'id' => 'rente7',
                    'data-pers' => 7,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'rente8',
                'options' => ['label' => 'Unfall-Rente'],
                'attributes' => [
                    'id' => 'rente8',
                    'data-pers' => 8,
                    'class' => '',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'assistance1',
                'options' => [
                    'label' => 'Assistance Leistungen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'assistance1',
                    'data-pers' => 1,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'assistance2',
                'options' => [
                    'label' => 'Assistance Leistungen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'assistance2',
                    'data-pers' => 2,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'assistance3',
                'options' => [
                    'label' => 'Assistance Leistungen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'assistance3',
                    'data-pers' => 3,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'assistance4',
                'options' => [
                    'label' => 'Assistance Leistungen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'assistance4',
                    'data-pers' => 4,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'assistance5',
                'options' => [
                    'label' => 'Assistance Leistungen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'assistance5',
                    'data-pers' => 5,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'assistance6',
                'options' => [
                    'label' => 'Assistance Leistungen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'assistance6',
                    'data-pers' => 6,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'assistance7',
                'options' => [
                    'label' => 'Assistance Leistungen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'assistance7',
                    'data-pers' => 7,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'assistance8',
                'options' => [
                    'label' => 'Assistance Leistungen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'assistance8',
                    'data-pers' => 8,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'knochen1',
                'options' => [
                    'label' => 'Knochenbruch',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'knochen1',
                    'data-pers' => 1,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'knochen2',
                'options' => [
                    'label' => 'Knochenbruch',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'knochen2',
                    'data-pers' => 2,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'knochen3',
                'options' => [
                    'label' => 'Knochenbruch',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'knochen3',
                    'data-pers' => 3,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'knochen4',
                'options' => [
                    'label' => 'Knochenbruch',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'knochen4',
                    'data-pers' => 4,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'knochen5',
                'options' => [
                    'label' => 'Knochenbruch',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'knochen5',
                    'data-pers' => 5,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'knochen6',
                'options' => [
                    'label' => 'Knochenbruch',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'knochen6',
                    'data-pers' => 6,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'knochen7',
                'options' => [
                    'label' => 'Knochenbruch',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'knochen7',
                    'data-pers' => 7,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'knochen8',
                'options' => [
                    'label' => 'Knochenbruch',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => [
                    'id' => 'knochen8',
                    'data-pers' => 8,
                ],
            ],
        ],
        [
            'flags' => ['priority' => 17],
            'spec' => [
                'type' => Radio::class,
                'name' => 'zusatzfragen',
                'options' => [
                    'label' => 'weitere Fragen',
                    'value_options' => [
                        'nein' => [
                            'value' => 'nein',
                            'label' => 'Ich verzichte auf die Beantwortung weiterer Fragen und wähle aus dem Vergleich einen Tarif, der meinen Bedarf erfüllt.',
                            'attributes' => ['id' => 'zusatzfragen_nein'],
                        ],
                        'ja' => [
                            'value' => 'ja',
                            'label' => 'Ich möchte weitere Angaben zum gewünschten Versicherungsschutz machen. Es werden dann nur Tarife angezeigt, welche die Vorgaben erfüllen.',
                            'attributes' => ['id' => 'zusatzfragen_ja'],
                        ],
                    ],
                    'col_attributes' => ['data-toggle' => '1'],
                ],
                'attributes' => ['id' => 'zusatzfragen'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'eigen_v',
                'options' => [
                    'label' => 'Bleibende Schäden durch Eigenbewegungen mitversichern?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'eigen_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'kraft_v',
                'options' => [
                    'label' => 'Bleibende Schäden durch erhöhte Kraftanstrengung mitversichern?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'kraft_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'alk_v',
                'options' => [
                    'label' => 'Mitversichern von Bewusstseinsstörungen durch Trunkenheit?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja (EU)' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => [
                    'id' => 'alk_v',

                    'min' => '0',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'gift_v',
                'options' => [
                    'label' => 'Mitversichern von Vergiftungen durch Gase und Dämpfe?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja (EU)' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => ['id' => 'gift_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'kgif_v',
                'options' => [
                    'label' => 'Mitversichern von Vergiftungen bei Kindern bis zu 14 Jahre?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja (EU)' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => ['id' => 'kgif_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'room_v',
                'options' => [
                    'label' => 'Kosten für Übernachtung Erziehungsberechtigter im Krankenhaus bei Kinderunfall (Rooming-In)?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'room_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'nahr_v',
                'options' => [
                    'label' => 'Mitversichern von Nahrungsmittelvergiftungen?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'nahr_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'stral_v',
                'options' => [
                    'label' => 'Mitversichern von Schäden durch Röntgen-, Laser- und künstlich erzeugte ultraviolette Strahlen (außer bei beruflichen Umgang)?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja (EU)' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => ['id' => 'stral_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'tauch_v',
                'options' => [
                    'label' => 'Mitversichern von tauchtypischen Gesundheitsschäden?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja (EU)' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => ['id' => 'tauch_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'sofo_v',
                'options' => [
                    'label' => 'Sofortleistung bei schweren Unfällen (Vorschusszahlung)?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja (EU)' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => ['id' => 'sofo_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'zahn_v',
                'options' => [
                    'label' => 'Kostenerstattung von Zahnersatz infolge Unfall?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'zahn_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'insekt_v',
                'options' => [
                    'label' => 'Mitversichern von Insektenstichen?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'insekt_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'mitw_v',
                'options' => [
                    'label' => 'Keine Anrechnung der Mitwirkung von Krankheiten/Gebrechen bei Unfällen?',

                    'value_options' => [
                        'nein' => 'nein',
                        '40' => 'keine Anrechnung ab 40%',
                        '70' => 'keine Anrechnung ab 70%',
                        '100' => 'generell keine Anrechnung',
                    ],
                ],
                'attributes' => ['id' => 'mitw_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'frist_v',
                'options' => [
                    'label' => 'Wünschen Sie eine erweiterte Meldefrist bei Invalidität?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'frist_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'kap_v',
                'options' => [
                    'label' => 'Leistung als einmalige Kapitalzahlung auch nach dem 65. Lebensjahr?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'kap_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'haus_v',
                'options' => [
                    'label' => 'Kosten einer Haushaltshilfe?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'haus_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'schul_v',
                'options' => [
                    'label' => 'Mitversichern von Umschulungsmaßnahmen und behinderungsbedingten Kosten?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'schul_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'berg_v',
                'options' => [
                    'label' => 'Bergungskosten inkl. Rückholkosten',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja (EU)' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => ['id' => 'berg_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'rett_v',
                'options' => [
                    'label' => 'Mitversichern von Körperschäden anlässlich der Rettung von Menschen und Sachen?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja (EU)' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => ['id' => 'rett_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'leiupd_v',
                'options' => [
                    'label' => 'Sollen künftige Leistungsverbesserungen automatisch eingeschlossen werden ohne Beantragung?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja (EU)' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => ['id' => 'leiupd_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'chkErstinfo',
                'options' => [
                    'label' => 'Ich bestätige, die Erstinformation für Versicherungsmakler gemäß § 15 VersVermV heruntergeladen und gelesen zu haben.',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                ],
                'attributes' => [
                    'id' => 'mrmoErstinfo',
                    'class' => 'form-check-input',
                    'required' => 'required',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'zahlweise',
                'options' => [
                    'label' => 'Zahlweise',
                    'value_options' => [
                        '1' => 'jährlich',
                        '2' => 'halbjährlich',
                        '4' => 'vierteljährlich',
                        '12' => 'monatlich',
                    ],
                ],
                'attributes' => ['id' => 'zahlweise'],
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
                'name' => 'btn_berechnen',
                'options' => ['label' => 'Berechnen'],
                'attributes' => [
                    'value' => 'Berechnen',
                    'class' => 'btn btn-default js-gtm-event',
                    'data-event-type' => 'click',
                    'data-event-category' => 'versicherung',
                    'data-event-action' => 'calculate',
                    'data-event-label' => 'unfall',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Button::class,
                'name' => 'btn_berechnen',
                'options' => ['label' => 'Berechnen'],
                'attributes' => [
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'data-event-type' => 'click',
                    'data-event-category' => 'versicherung',
                    'data-event-action' => 'calculate',
                    'data-event-label' => 'phv',
                ],
            ],
        ],
    ],
    'input_filter' => [
        'plz' => ['required' => true],
        'KrPHV' => ['required' => false],
        'KrTIE' => ['required' => false],
        'KrHUG' => ['required' => false],
        'KrOEL' => ['required' => false],
        'KrWG' => ['required' => false],
        'KrWGGLS' => ['required' => false],
        'KrHR' => ['required' => false],
        'KrHRGLS' => ['required' => false],
        'KrUNF' => ['required' => false],
        'KrRS' => ['required' => false],
    ],
];
