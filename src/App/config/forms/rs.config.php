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

namespace Calculator;

use DateInterval;
use DateTimeImmutable;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Date;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Number;
use Laminas\Form\Element\Radio;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Mimmi20\Form\Links\Element\Links;

return [
    'type' => Form::class,
    'options' => [
        'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_HORIZONTAL,
        'form-required-mark' => '<div class="mt-2 text-info-required"><sup>*</sup> Pflichtfeld</div>',
        // 'field-required-mark' => '<span class="text-info-required"><sup>*</sup></span>',
        'row_attributes' => ['class' => 'g-0 my-2 align-items-center'],
        'label_col_attributes' => ['class' => 'col-2'],
        'col_attributes' => ['class' => 'col-8 field-content'],
        'help_attributes' => ['class' => 'col-2 help-content toast'],
        'label_attributes' => ['class' => 'stretched-link'],
    ],
    'attributes' => [
        'method' => 'post',
        'class' => 'g-0',
        'accept-charset' => 'utf-8',
        'novalidate' => 'novalidate',
        'data-needs-validation' => true,
        'data-layout' => 'horizontal',
        'id' => 'rs-form',
    ],
    'elements' => [
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'tarif_privat',
                'options' => [
                    'label' => '<span class="checkbox-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" fill="currentColor" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <circle cx="96" cy="144.00002" r="10"></circle>
                                <circle cx="160" cy="144.00002" r="10"></circle>
                                <path d="M74.4017,80A175.32467,175.32467,0,0,1,128,72a175.32507,175.32507,0,0,1,53.59754,7.99971" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                                <path d="M181.59717,176.00041A175.32523,175.32523,0,0,1,128,184a175.32505,175.32505,0,0,1-53.59753-7.99971" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                                <path d="M155.04392,182.08789l12.02517,24.05047a7.96793,7.96793,0,0,0,8.99115,4.20919c24.53876-5.99927,45.69294-16.45908,61.10024-29.85086a8.05225,8.05225,0,0,0,2.47192-8.38971L205.65855,58.86074a8.02121,8.02121,0,0,0-4.62655-5.10908,175.85294,175.85294,0,0,0-29.66452-9.18289,8.01781,8.01781,0,0,0-9.31925,5.28642l-7.97318,23.91964" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                                <path d="M100.95624,182.08757l-12.02532,24.0508a7.96794,7.96794,0,0,1-8.99115,4.20918c-24.53866-5.99924-45.69277-16.459-61.10006-29.85069a8.05224,8.05224,0,0,1-2.47193-8.38972L50.34158,58.8607a8.0212,8.0212,0,0,1,4.62655-5.1091,175.85349,175.85349,0,0,1,29.66439-9.18283,8.0178,8.0178,0,0,1,9.31924,5.28642l7.97318,23.91964" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                            </svg>
                        </span>
                        <span class="checkbox-label">Privat</span>',
                    'label_attributes' => ['class' => 'btn-tile'],
                    'label_options' => ['always_wrap' => true, 'disable_html_escape' => true],
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'as-button' => true,
                ],
                'attributes' => [
                    'id' => 'tarif_privat',
                    'class' => 'btn-check',
                    'role' => 'button',
                    'data-toggle' => 'p',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'tarif_beruf',
                'options' => [
                    'label' => ' <span class="checkbox-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" fill="currentColor" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <polygon points="56 100 56 168 128 236 128 168 200 168 56 32 200 32 200 100 56 100" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></polygon>
                            </svg>
                        </span>
                        <span class="checkbox-label">Arbeit & Beruf</span>',
                    'label_attributes' => ['class' => 'btn-tile'],
                    'label_options' => ['always_wrap' => true, 'disable_html_escape' => true],
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',
                    'as-button' => true,
                ],
                'attributes' => [
                    'id' => 'tarif_beruf',
                    'class' => 'btn-check',
                    'role' => 'button',
                    'data-toggle' => 'b',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'tarif_verkehr_familie',
                'options' => [
                    'label' => '<span class="checkbox-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" fill="currentColor" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <polygon points="72 40 184 40 240 104 128 224 16 104 72 40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></polygon>
                                <polygon points="177.091 104 128 224 78.909 104 128 40 177.091 104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></polygon>
                                <line x1="16" y1="104" x2="240" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line>
                            </svg>
                        </span>
                        <span class="checkbox-label">Verkehr (Familie - für alle KFZ)</span>',
                    'label_attributes' => ['class' => 'btn-tile'],
                    'label_options' => ['always_wrap' => true, 'disable_html_escape' => true],
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'as-button' => true,
                ],
                'attributes' => [
                    'id' => 'tarif_verkehr_familie',
                    'class' => 'btn-check',
                    'role' => 'button',
                    'data-toggle' => 'f',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'tarif_miete',
                'options' => [
                    'label' => '<span class="checkbox-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" fill="currentColor" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <circle cx="128" cy="128" r="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle>
                                <rect x="36" y="36" width="184" height="184" rx="48" stroke-width="12" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"></rect>
                                <circle cx="180" cy="75.99998" r="10"></circle>
                            </svg>
                        </span>
                        <span class="checkbox-label">Eigentum & Mieter</span>',
                    'label_attributes' => ['class' => 'btn-tile'],
                    'label_options' => ['always_wrap' => true, 'disable_html_escape' => true],
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'as-button' => true,
                ],
                'attributes' => [
                    'id' => 'tarif_miete',
                    'class' => 'btn-check',
                    'role' => 'button',
                    'data-toggle' => 'm',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'tarif_verkehr',
                'options' => [
                    'label' => '<span class="checkbox-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256" fill="currentColor" viewBox="0 0 256 256">
                                <rect width="256" height="256" fill="none"></rect>
                                <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle>
                                <path d="M71.0247,205.27116a159.91145,159.91145,0,0,1,136.98116-77.27311q8.09514,0,15.99054.78906" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                                <path d="M188.0294,53.09083A159.68573,159.68573,0,0,1,64.00586,111.99805a160.8502,160.8502,0,0,1-30.15138-2.83671" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                                <path d="M85.93041,41.68508a159.92755,159.92755,0,0,1,78.99267,138.00723,160.35189,160.35189,0,0,1-4.73107,38.77687" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                            </svg>
                        </span>
                        <span class="checkbox-label">Verkehr (nur für den VN)</span>',
                    'label_attributes' => ['class' => 'btn-tile'],
                    'label_options' => ['always_wrap' => true, 'disable_html_escape' => true],
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'as-button' => true,
                ],
                'attributes' => [
                    'id' => 'tarif_verkehr',
                    'class' => 'btn-check',
                    'role' => 'button',
                    'data-toggle' => 'v',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'vermiet',
                'options' => [
                    'label' => 'Vermietete Wohneinheiten',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        '1' => '1 vermietete WE',
                        '2' => '2 vermietete WEs',
                        '3' => '3 vermietete WEs',
                        '4' => '4 vermietete WEs',
                        '5' => '5 vermietete WEs',
                        '6' => '6 vermietete WEs',
                    ],

                    'row_attributes' => ['data-toggle' => '1'],
                ],
                'attributes' => ['id' => 'vermiet'],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'OB1',
                'options' => [
                    'label' => 'WE 1 Jahresbruttomiete',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'row_attributes' => ['data-show' => '1'],

                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => '&euro;',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'OB1',
                    'title' => 'Bitte geben Sie die Jahresmiete an!',
                    'pattern' => '^\d{1,}$',
                    'data-ob' => 1,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'OB2',
                'options' => [
                    'label' => 'WE 2 Jahresbruttomiete',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'row_attributes' => ['data-show' => '2'],

                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => '&euro;',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'OB2',
                    'title' => 'Bitte geben Sie die Jahresmiete an!',
                    'pattern' => '^\d{1,}$',
                    'data-ob' => 2,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'OB3',
                'options' => [
                    'label' => 'WE 3 Jahresbruttomiete',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'row_attributes' => ['data-show' => '3'],

                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => '&euro;',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'OB3',
                    'title' => 'Bitte geben Sie die Jahresmiete an!',
                    'pattern' => '^\d{1,}$',
                    'data-ob' => 3,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'OB4',
                'options' => [
                    'label' => 'WE 4 Jahresbruttomiete',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'row_attributes' => ['data-show' => '4'],

                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => '&euro;',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'OB4',
                    'title' => 'Bitte geben Sie die Jahresmiete an!',
                    'pattern' => '^\d{1,}$',
                    'data-ob' => 4,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'OB5',
                'options' => [
                    'label' => 'WE 5 Jahresbruttomiete',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'row_attributes' => ['data-show' => '5'],

                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => '&euro;',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'OB5',
                    'title' => 'Bitte geben Sie die Jahresmiete an!',
                    'pattern' => '^\d{1,}$',
                    'data-ob' => 5,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'OB6',
                'options' => [
                    'label' => 'WE 6 Jahresbruttomiete',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'row_attributes' => ['data-show' => '6'],

                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => '&euro;',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'OB6',
                    'title' => 'Bitte geben Sie die Jahresmiete an!',
                    'pattern' => '^\d{1,}$',
                    'data-ob' => 6,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'cyber',
                'options' => [
                    'label' => 'Erweiterter Internet-Schutz',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'cyber'],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'plz',
                'options' => [
                    'label' => 'PLZ des Antragsstellers',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',
                ],
                'attributes' => [
                    'id' => 'plz',
                    'class' => ' -short',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'famstand',
                'options' => [
                    'label' => 'Familiäre Verhältnisse',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'Familie' => 'Familie',
                        'Paar' => 'Paar',
                        'Single' => 'Single',
                        'Alleinerziehend' => 'Alleinerziehend',
                    ],
                    'valid-class' => 'is-valid',

                    'row_attributes' => ['data-toggle' => '1'],
                ],
                'attributes' => ['id' => 'famstand'],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum',
                'options' => [
                    'label' => 'Geburtsdatum des Versicherungsnehmers',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',
                    'messages' => [
                        [
                            'attributes' => ['class' => 'invalid-feedback'],
                            'content' => 'nicht in Ordnung',
                        ],
                        [
                            'attributes' => ['class' => 'invalid-max-feedback'],
                            'content' => 'zu jung',
                        ],
                        [
                            'attributes' => ['class' => 'valid-feedback'],
                            'content' => 'in Ordnung',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'gebdatum',
                    'placeholder' => 'TT.MM.JJJJ',

                    'autocomplete' => 'off',
                    'max' => (new DateTimeImmutable())->sub(
                        new DateInterval('P18Y'),
                    )->format('Y-m-d'),
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'geburtsdatumPartner',
                'options' => [
                    'label' => 'Geburtsdatum des Ehe- oder Lebenspartners',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'row_attributes' => ['data-show' => 'Paar'],
                ],
                'attributes' => [
                    'id' => 'geburtsdatumPartner',
                    'class' => ' datepicker js-datepicker',
                    'placeholder' => 'TT.MM.JJJJ',
                    'autocomplete' => 'off',
                    'max' => (new DateTimeImmutable())->sub(
                        new DateInterval('P18Y'),
                    )->format('Y-m-d'),
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'anag',
                'options' => [
                    'label' => 'Aktuelle Tätigkeit',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'Arbeitnehmer' => 'Arbeitnehmer',
                        'ohne berufliche Tätigkeit' => 'ohne berufliche Tätigkeit',
                        'öffentl. Dienst' => 'öffentlicher Dienst',
                        'Selbständig' => 'Selbständig',
                        'auf Dauer nicht mehr erwerbstätig' => 'auf Dauer nicht mehr erwerbstätig',
                        'Azubi/Student' => 'Azubi/Student',
                    ],
                ],
                'attributes' => [
                    'id' => 'anag',
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'show',
                    'data-toggle-value' => 'Selbständig',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'umsatzselbst',
                'options' => [
                    'label' => 'Jahresumsatz',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        '10000' => '1 - 10.000 EUR',
                        '15000' => '10.001 - 15.000 EUR',
                        '20000' => '15.001 - 20.000 EUR',
                        '50000' => '20.001 - 50.000 EUR',
                        '9999999' => 'ab 50.001 EUR',
                    ],
                ],
                'attributes' => ['id' => 'umsatzselbst'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'laufzeit',
                'options' => [
                    'label' => 'Laufzeit',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        '1' => '1 Jahr',
                        '3' => '3 Jahre',
                    ],
                ],
                'attributes' => ['id' => 'laufzeit'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'vorvers5',
                'options' => [
                    'label' => 'Wie lange bestehen oder bestanden für den Antragsteller und/oder den mitversicherten Lebenspartner Vorversicherungen?',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        '' => '-- Bitte wählen --',
                        'keine Vorversicherung' => 'keine Vorversicherung',
                        'weniger als 2 Jahre' => 'weniger als 2 Jahre',
                        'mind. 2 Jahre' => 'mind. 2 Jahre',
                        'mind. 3 Jahre' => 'mind. 3 Jahre',
                        'mind. 4 Jahre' => 'mind. 4 Jahre',
                        'mind. 5 Jahre' => 'mind. 5 Jahre',
                    ],
                ],
                'attributes' => [
                    'id' => 'vorvers5',
                    'title' => 'Bitte geben Sie die Information zur Vorversicherung an!',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'wannschaden',
                'options' => [
                    'label' => 'Wann wurde der letzte Schaden gemeldet?',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        '' => '-- Bitte wählen --',
                        'vor mehr als 5 Jahren oder schadenfrei' => 'vor mehr als 5 Jahren oder schadenfrei',
                        'innerhalb der letzten 2 Jahre' => 'innerhalb der letzten 2 Jahre',
                        'vor mehr als 2 Jahren' => 'vor mehr als 2 Jahren',
                        'vor mehr als 3 Jahren' => 'vor mehr als 3 Jahren',
                        'vor mehr als 4 Jahren' => 'vor mehr als 4 Jahren',
                    ],
                ],
                'attributes' => [
                    'id' => 'wannschaden',
                    'title' => 'Bitte geben Sie an, wann der letzte Schaden gemeldet wurde!',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'kombirabatte',
                'options' => [
                    'label' => 'Kombirabatte mit berechnen?',
                    'help_content' => '<strong class="toast-header">Kombirabatte mit berechnen?</strong><p class="toast-body">Welche Verträge haben Sie schon oder haben vor, sie zu versichern? Je mehr Verträge Sie bei einer Gesellschaft haben, umso günstiger wird der Preis.</p>',
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
                    'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    // 'label_attributes' => ['class' => 'stretched-link'],
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

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
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'zusatzfragen'],
            ],
        ],
        [
            'spec' => [
                'type' => Links::class,
                'name' => 'links-standard',
                'options' => [
                    'label' => 'Wählen Sie eine Vorgabe für Ihre Berechnung',
                    'help_content' => '<strong>Wählen Sie eine Vorgabe für Ihre Berechnung</strong><p>Die Vorgabe des Arbeitskreis Vermittlerrichlinie (AK-Empfehlung) bietet Ihnen einen empfohlenen Mindestschutz. Heute erfüllen alle wichtigen Tarife diese Vorgaben. Zu Ihrer Sicherheit sollten Sie diese Mindestvorgaben wählen.</p>',
                    'links' => [
                        [
                            'href' => '#',
                            'class' => 'js-standard js-gtm-event',
                            'data-event-type' => 'click',
                            'data-event-category' => 'versicherung',
                            'data-event-label' => 'hr',
                            'data-event-action' => 'choose standard options',
                            'label' => 'Standard',
                        ],
                        [
                            'href' => '#',
                            'class' => 'recommendation js-recommendation js-gtm-event',
                            'data-event-type' => 'click',
                            'data-event-category' => 'versicherung',
                            'data-event-label' => 'hr',
                            'data-event-action' => 'choose AK recommentations',
                            'label' => 'AK Empfehlung',
                        ],
                    ],
                    'separator' => '|',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'vs_v',
                'options' => [
                    'label' => 'Deckungssumme?',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'o100000' => [
                            'value' => '100000',
                            'label' => 'weniger als 300.000 EUR',
                        ],

                        'o300000' => [
                            'value' => '300000',
                            'label' => '300.000 EUR (AK Empfehlung)',
                        ],
                        'o500000' => [
                            'value' => '500000',
                            'label' => '500.000 EUR',
                        ],
                        'ounbegrenzt' => [
                            'value' => 'unbegrenzt',
                            'label' => 'unbegrenzt',
                        ],
                    ],
                ],
                'attributes' => ['id' => 'vs_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'kaution_v',
                'options' => [
                    'label' => 'Strafkautionen?',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'o50000' => [
                            'value' => '50000',
                            'label' => '50.000 EUR',
                        ],
                        'o100000' => [
                            'value' => '100000',
                            'label' => '100.000 EUR (AK Empfehlung)',
                        ],
                        'o100001' => [
                            'value' => '100001',
                            'label' => 'mehr als 100.000 EUR',
                        ],
                    ],
                ],
                'attributes' => ['id' => 'kaution_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'folge_v',
                'options' => [
                    'label' => 'Schadensregulierung nach Folgeereignistheorie',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja (AK Empfehlung)',
                    ],
                ],
                'attributes' => ['id' => 'folge_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'ehestreit_v',
                'options' => [
                    'label' => 'Rechtsschutz in Ehesachen (nur wenn verheiratet)',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'beratung' => 'mindestens Beratungsleistung',
                        'aussergerichtlich' => 'mindestens außergerichtlich',
                        'gerichtlich' => 'Übernahme gerichtliche Kosten',
                    ],
                ],
                'attributes' => ['id' => 'ehestreit_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'unterhalt_v',
                'options' => [
                    'label' => 'Rechtsschutz für Unterhalt',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'beratung' => 'mindestens Beratungsleistung',
                        'aussergerichtlich' => 'mindestens außergerichtlich',
                        'gerichtlich' => 'Übernahme gerichtliche Kosten',
                    ],
                ],
                'attributes' => ['id' => 'unterhalt_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'spezialstraf_v',
                'options' => [
                    'label' => 'Einschluss Spezial-Straf-Rechtschutz',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'spezialstraf_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'zahlweise',
                'options' => [
                    'label' => 'Zahlweise',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',
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
                'type' => Checkbox::class,
                'name' => 'chkErstinfo',
                'options' => [
                    'label' => 'Ich bestätige, die Erstinformation für Versicherungsmakler gemäß § 15 VersVermV heruntergeladen und gelesen zu haben.',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong class="toast-header">Header for Help</strong><p class="toast-body">Help-Content</p>',
                    'col_attributes' => ['class' => 'offset-sm-2'],

                    'as-form-control' => true,
                ],
                'attributes' => [
                    'id' => 'mrmoErstinfo',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Hidden::class,
                'name' => 'selbstMin',
                'options' => ['label' => 'Selbstbeteiligung'],
                'attributes' => ['id' => 'selbstMin'],
            ],
        ],
        [
            'spec' => [
                'type' => Hidden::class,
                'name' => 'selbstMax',
                'options' => ['label' => 'Selbstbeteiligung'],
                'attributes' => ['id' => 'selbstMax'],
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
                'type' => Button::class,
                'name' => 'btn_berechnen',
                'options' => ['label' => 'Berechnen'],
                'attributes' => [
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                ],
            ],
        ],
    ],
    'input_filter' => [
        'tarif_privat' => ['required' => false],
        'tarif_beruf' => ['required' => false],
        'tarif_verkehr_familie' => ['required' => false],
        'tarif_miete' => ['required' => false],
        'tarif_verkehr' => ['required' => false],
        'OB1' => ['required' => false],
        'OB2' => ['required' => false],
        'OB3' => ['required' => false],
        'OB4' => ['required' => false],
        'OB5' => ['required' => false],
        'OB6' => ['required' => false],
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
        'selbst' => ['required' => false],
        'zahlweise' => ['required' => false],
    ],
];
