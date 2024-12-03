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

use Laminas\Form\Element\Number;
use Laminas\Form\Element\Radio;
use Laminas\Form\Element\Select;
use Laminas\Form\Form;

use function date;

return [
    'type' => Form::class,
    'options' => [
        'floating-labels' => true,
        'col_attributes' => ['class' => 'col-12 mb-3 mt-2 row align-items-center'],
        'help_attributes' => ['class' => 'col-2 help-content toast'],
        'label_attributes' => ['class' => 'stretched-link'],
        'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_VERTICAL,
        'form-required-mark' => '<div class="mt-2 text-info-required"><sup>*</sup> Pflichtfeld</div>',
    ],
    'name' => 'renten-form',
    'method' => 'post',
    'attributes' => [
        'class' => 'g-0',
        'accept-charset' => 'utf-8',
        'id' => 'renten-form',
        'novalidate' => 'novalidate',
        'data-needs-validation' => true,
        'data-layout' => 'vertical',
    ],
    'elements' => [
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'netto',
                'options' => [
                    'label' => 'Monatliches Netto',
                    'group_attributes' => ['class' => 'form-check-inline'],
                    'legend_attributes' => ['class' => 'form-label'],
                    // 'row_attributes' => ['class' => 'gx-3 gy-2 align-items-center'],
                    'help_content' => 'Ihr Nettogehalt, bzw. der Netto-Arbeitslohn, ist die Summe, die nach Abzug aller Abgaben und Steuern von Gehalt oder Lohn übrig bleibt und von Ihrem Arbeitgeber an Sie ausgezahlt wird.',
                ],
                'attributes' => [
                    'id' => 'netto',
                    'placeholder' => ' ',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'min' => '0',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'anzahl',
                'options' => [
                    'label' => 'Anzahl Gehälter je Jahr',
                    'value_options' => [
                        [
                            'label' => '12',
                            'value' => '12',
                        ],
                        [
                            'label' => '13',
                            'value' => '13',
                        ],
                        [
                            'label' => '14',
                            'value' => '14',
                        ],
                    ],
                    // 'group_attributes' => ['class' => 'form-check-inline'],
                    'legend_attributes' => ['class' => 'form-label'],
                    // 'row_attributes' => ['class' => 'gx-3 gy-2 align-items-center'],
                    // 'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_INLINE,
                    'help_content' => 'Wie viele Gehälter werden Ihnen im Jahr insgesamt ausgezahlt? In vielen Branchen ist ein 13. oder 14. Gehalt üblich.',
                ],
                'attributes' => [
                    'id' => 'anzahl',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'stkl',
                'options' => [
                    'label' => 'Steuerklasse',
                    'value_options' => [
                        [
                            'label' => 'Bitte auswählen',
                            'value' => '',
                        ],
                        [
                            'label' => 'Steuerklasse 1',
                            'value' => '1',
                        ],
                        [
                            'label' => 'Steuerklasse 2',
                            'value' => '2',
                        ],
                        [
                            'label' => 'Steuerklasse 3',
                            'value' => '3',
                        ],
                        [
                            'label' => 'Steuerklasse 4',
                            'value' => '4',
                        ],
                        [
                            'label' => 'Steuerklasse 5',
                            'value' => '5',
                        ],
                        [
                            'label' => 'Steuerklasse 6',
                            'value' => '6',
                        ],
                    ],
                    'group_attributes' => ['class' => 'form-check-inline'],
                    'legend_attributes' => ['class' => 'form-label'],
                    // 'row_attributes' => ['class' => 'gx-3 gy-2 align-items-center'],
                    // 'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_INLINE,
                    'help_content' => 'Die Steuerklasse richtet sich in erster Linie nach dem Familienstand: Steuerklasse 1 gilt automatisch für alle ledigen, verwitweten, geschiedenen oder dauernd getrennt lebenden Arbeitnehmer. Alleinerziehende zählt das Finanzamt zur Steuerklasse 2. Verheiratete können je nach Steuerklasse des Ehepartners den Steuerklassen 3 bis 5 angehören. Wer mehr als einen Job hat, fällt ab dem zweiten Job in die Steuerklasse 6.',
                ],
                'attributes' => [
                    'id' => 'stkl',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'state',
                'options' => [
                    'label' => 'Bundesland',
                    'value_options' => [
                        [
                            'label' => 'Bitte auswählen',
                            'value' => '',
                        ],
                        [
                            'label' => 'Baden-Württemberg',
                            'value' => 'Baden-Württemberg',
                        ],
                        [
                            'label' => 'Bayern',
                            'value' => 'Bayern',
                        ],
                        [
                            'label' => 'Berlin',
                            'value' => 'Berlin',
                        ],
                        [
                            'label' => 'Brandenburg',
                            'value' => 'Brandenburg',
                        ],
                    ],
                    'group_attributes' => ['class' => 'form-check-inline'],
                    'legend_attributes' => ['class' => 'form-label'],
                    // 'row_attributes' => ['class' => 'gx-3 gy-2 align-items-center'],
                    // 'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_INLINE,
                    'help_content' => 'Je nach Bundesland können der Berechnung verschiedene Werte zugrunde liegen.',
                ],
                'attributes' => [
                    'id' => 'state',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'geb',
                'options' => [
                    'label' => 'Geburtsjahr',
                    'group_attributes' => ['class' => 'form-check-inline'],
                    'legend_attributes' => ['class' => 'form-label'],
                    // 'row_attributes' => ['class' => 'gx-3 gy-2 align-items-center'],
                ],
                'attributes' => [
                    'id' => 'geb',
                    'placeholder' => ' ',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'min' => date('Y') - 120,
                    'max' => date('Y'),
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'alter',
                'options' => [
                    'label' => 'Alter bei Berufseinstieg',
                    'group_attributes' => ['class' => 'form-check-inline'],
                    'legend_attributes' => ['class' => 'form-label'],
                    // 'row_attributes' => ['class' => 'gx-3 gy-2 align-items-center'],
                    'help_content' => 'In welchem Alter haben Sie begonnen, als Arbeitnehmer eine Tätigkeit gegen Entgelt zu entrichten? Diese Angabe wird benötigt, um zu ermitteln, wie lang Sie bereits in die Rentenversicherung eingezahlt haben. Es zählt bereits der Beginn einer Berufsausbildung.',
                ],
                'attributes' => [
                    'id' => 'alter',
                    'placeholder' => ' ',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'min' => '12',
                    'max' => '100',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'rente',
                'options' => [
                    'label' => 'Wann möchten Sie in Rente gehen?',
                    'value_options' => [
                        [
                            'label' => 'Bitte auswählen',
                            'value' => '',
                        ],
                        [
                            'label' => 'mit vollendetem 63. Lebensjahr',
                            'value' => '63',
                        ],
                        [
                            'label' => 'mit vollendetem 65. Lebensjahr',
                            'value' => '65',
                        ],
                        [
                            'label' => 'mit vollendetem 67. Lebensjahr',
                            'value' => '67',
                        ],
                    ],
                    'group_attributes' => ['class' => 'form-check-inline'],
                    'legend_attributes' => ['class' => 'form-label'],
                    // 'row_attributes' => ['class' => 'gx-3 gy-2 align-items-center'],
                    // 'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_INLINE,
                    'help_content' => 'Das gewünschte Renteneintrittsalter hat Einfluss auf die Höhe Ihrer Rente.',
                ],
                'attributes' => [
                    'id' => 'rente',
                    'autocomplete' => 'off',
                    'spellcheck' => 'false',
                    'placeholder' => ' ',
                ],
            ],
        ],
    ],
    'input_filter' => [
        'netto' => ['required' => true],
        'anzahl' => ['required' => true],
        'stkl' => ['required' => true],
        'state' => ['required' => true],
        'geb' => ['required' => true],
        'alter' => ['required' => true],
        'rente' => ['required' => true],
    ],
];
