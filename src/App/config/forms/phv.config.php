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

use DateInterval;
use DateTimeImmutable;
use Laminas\Form\Element\Button;
use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Date;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Radio;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Mimmi20\Form\Links\Element\Links;

return [
    'type' => Form::class,
    'options' => [
        'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_VERTICAL,
        'form-required-mark' => '<div class="mt-2 text-info-required"><sup>*</sup> Pflichtfeld</div>',
        'col_attributes' => ['class' => 'my-2 col-12 position-relative align-items-center'],
        'help_attributes' => ['class' => 'help-content'],
        'label_attributes' => ['class' => 'stretched-link'],
    ],
    'attributes' => [
        'method' => 'post',
        'class' => 'g-0 was-validated my-3',
        'accept-charset' => 'utf-8',
        'novalidate' => 'novalidate',
        'data-needs-validation' => true,
        'id' => 'phv-form',
    ],
    'elements' => [
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'single',
                'options' => [
                    'label' => 'Tarifauswahl',

                    'value_options' => [
                        'Familie/Lebensgemeinschaft mit Kinder' => 'Familie/Lebensgemeinschaft mit Kind(ern)',
                        'Familie/Lebensgemeinschaft ohne Kinder' => 'Familie/Lebensgemeinschaft ohne Kinder',
                        'Single ohne Kinder' => 'Single ohne Kinder',
                        'Single mit Kinder' => 'Single mit Kind(ern)',
                    ],
                    'help_content' => '<strong>Tarifauswahl</strong><p>Der Singletarif ist nur möglich, wenn Sie ledig sind und keinen Lebenspartner mitversichern wollen.</p>',
                ],
                'attributes' => ['id' => 'single'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'versbeginn',
                'options' => [
                    'label' => 'Versicherungsbeginn',

                    'value_options' => [
                        [
                            'label' => 'schnellstmöglich',
                            'value' => 'sofort',
                            'attributes' => ['id' => 'vb_s'],
                        ],
                        [
                            'label' => 'Datum angeben',
                            'value' => 'datum',
                            'attributes' => ['id' => 'vb_d'],
                        ],
                    ],

                    'col_attributes' => ['data-toggle' => '1'],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'versbeginn'],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'versbeginn_datum',
                'options' => [
                    'label' => 'Beginn am',
                    'col_attributes' => ['data-show' => 'datum'],
                ],
                'attributes' => [
                    'id' => 'versbeginn_datum',
                    'autocomplete' => 'off',
                    'min' => (new DateTimeImmutable())->format('Y-m-d'),
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'plz',
                'options' => [
                    'label' => 'PLZ des Antragsstellers',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Die Postleitzahl Ihrer Wohnung wird für die Risikobeurteilung /Beitragsberechnung benötigt. Die Beitragshöhe ist nicht nur abhängig von Ihren gewünschten Leistungen, sondern wird auch anhand Art und Anzahl der Schäden, die in Ihrem Wohnort durchschnittlich gemeldet werden, bemessen.</p>',
                ],
                'attributes' => [
                    'id' => 'plz',
                    'class' => 'form-control-short js-special-zip-message',

                    'pattern' => '^\d{5}$',
                    'minlength' => '5',
                    'maxlength' => '5',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'beamte',
                'options' => [
                    'label' => 'Tarifgruppe',

                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Einige Versicherer bieten Beitragsnachlässe für Beamte und Angestellte im öffentlichen Dienst.</p><strong>Hinweis zur Auswahl</strong><p>Wählen Sie auch &quot;öffentlicher Dienst&quot;, wenn Sie Beamter sind oder früher im öffentlichen Dienst beschäftigt waren und sich mittlerweile im Ruhestand befinden.</p>',
                    'value_options' => [
                        'Normal' => 'Normal',
                        'öffentl. Dienst' => 'öffentlicher Dienst',
                        'ÖD mit Dienst-HP (nur Lehrer)' => 'ÖD mit Dienst-HP (nur Lehrer)',
                    ],
                ],
                'attributes' => ['id' => 'beamte'],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum',
                'options' => [
                    'label' => 'Geburtsdatum des Versicherungsnehmers',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Die Angabe Ihres Geburtsdatums ist relevant für die Höhe des Beitrags. Einige Versicherungs­gesellschaften bieten Beitragsnachlässe für bestimmte Altersgruppen.</p>',
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
                'type' => Radio::class,
                'name' => 'ausfall',
                'options' => [
                    'label' => 'Ausfalldeckung',

                    'help_content' => '<strong>Ausfalldeckung</strong><p>Wir empfehlen Ihnen, die sogenannte Forderungs­ausfalldeckung in Ihren Versicherungs­schutz aufzunehmen. Ihr Versicherer erstattet dann auch Schäden, die Ihnen durch fremde Personen zugefügt werden, die selbst über keine Privathaftpflicht­versicherung verfügen und finanziell nicht in der Lage sind, Ihnen den entstandenen Schaden zu ersetzen. Voraussetzung für die Begleichung des Schadens ist ein rechtskräftiges Urteil des Verursachers. Die meisten Versicherer legen für die Erstattung eine Mindest­schadenshöhe fest (siehe Leistungs­vergleich).</p>',

                    'value_options' => [
                        [
                            'label' => 'nein',
                            'value' => 'nein',
                            'attributes' => ['id' => 'ausfall_n'],
                        ],
                        [
                            'label' => 'ja',
                            'value' => 'ja',
                            'attributes' => ['id' => 'ausfall_j'],
                        ],
                    ],
                    'col_attributes' => ['data-toggle' => '1'],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'ausfall'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'delikt',
                'options' => [
                    'label' => 'Deliktunfähige Kinder unter 7 Jahre mitversichern?',

                    'help_content' => '<strong>Deliktunfähige Kinder unter 7 Jahre mitversichern?</strong><p>Eltern haften nicht für unter 7-jährige Kinder (bei Verkehr nicht bis unter 10 Jahre), wenn sie Ihrer Aufsichtspflicht nachkommen. Diese Schäden können Sie hier versichern.</p>',
                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'delikt'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'Hundn',
                'options' => [
                    'label' => 'Hund mitversichern? (kein Kampfhund!)',

                    'help_content' => '<strong>Hund mitversichern? (kein Kampfhund!)</strong><p>Je nach Gesellschaft gibt es Hunderassen, die nicht versichert werden können. Dazu gehören z.B. folgende Rassen sowie deren Kreuzungen: Bandog, Bordeaux-Dogge, Bulldog, Bullterrier (auch Staffordshire Bullterrier), Dogo Argentino, Fila Brasileiro, Kangal, Mastiff (auch Bullmastiff), Mastino Espanol, Mastino Napoletano, Owtscharka (alle Unterrassen), Pitbullterrier (auch American Pitbullterrier), Rhodesian Ridgeback, Staffordshire Terrier (auch American Staffordshire Terrier bzw. American Stafford Terrier) und Tosa Ino.</p>',
                    'value_options' => [
                        '0' => '0',
                        '1' => '1 Hund',
                        '2' => '2 Hunde',
                        '3' => '3 Hunde',
                        '4' => '4 Hunde',
                        '5' => '5 Hunde',
                    ],

                    'col_attributes' => ['data-toggle' => '1'],
                ],
                'attributes' => ['id' => 'Hundn'],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier1',
                'options' => [
                    'label' => 'Rasse Hund 1 eingeben',
                    'help_content' => '<strong>Rasse Hund 1 eingeben</strong><p>Geben Sie hier die Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier1',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 1,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'mischling_hund1',
                'options' => [
                    'label' => 'Ist Hund 1 ein Mischling?',
                    'help_content' => '<strong>Ist Hund 1 ein Mischling?</strong><p>Ist Ihr Hund ein Mischling?</p>',
                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'col_attributes' => ['data-toggle' => '1'],

                    'as-form-control' => true,
                ],
                'attributes' => [
                    'id' => 'mischling_hund1',
                    'data-dog' => 1,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier1a',
                'options' => [
                    'label' => 'Mischlingsrasse Hund 1',
                    'help_content' => '<strong>Mischlingsrasse Hund 1</strong><p>Geben Sie hier die Mischlings-Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Mischlings-Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',

                    'col_attributes' => ['data-show' => 'ja'],
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier1a',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 1,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier2',
                'options' => [
                    'label' => 'Rasse Hund 2 eingeben',
                    'help_content' => '<strong>Rasse Hund 2 eingeben</strong><p>Geben Sie hier die Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier2',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 2,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'mischling_hund2',
                'options' => [
                    'label' => 'Ist Hund 2 ein Mischling?',
                    'help_content' => '<strong>Ist Hund 2 ein Mischling?</strong><p>Ist Ihr Hund ein Mischling?</p>',
                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'col_attributes' => ['data-toggle' => '1'],

                    'as-form-control' => true,
                ],
                'attributes' => [
                    'id' => 'mischling_hund2',
                    'data-dog' => 2,
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier2a',
                'options' => [
                    'label' => 'Mischlingsrasse Hund 2',
                    'help_content' => '<strong>Mischlingsrasse Hund 2</strong><p>Geben Sie hier die Mischlings-Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Mischlings-Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',

                    'col_attributes' => ['data-show' => 'ja'],
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier2a',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 2,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier3',
                'options' => [
                    'label' => 'Rasse Hund 3 eingeben',
                    'help_content' => '<strong>Rasse Hund 3 eingeben</strong><p>Geben Sie hier die Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier3',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 3,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'mischling_hund3',
                'options' => [
                    'label' => 'Ist Hund 3 ein Mischling?',
                    'help_content' => '<strong>Ist Hund 3 ein Mischling?</strong><p>Ist Ihr Hund ein Mischling?</p>',
                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'col_attributes' => ['data-toggle' => '1'],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'mischling_hund3', 'data-dog' => 3],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier3a',
                'options' => [
                    'label' => 'Mischlingsrasse Hund 3',
                    'help_content' => '<strong>Mischlingsrasse Hund 3</strong><p>Geben Sie hier die Mischlings-Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Mischlings-Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',

                    'col_attributes' => ['data-show' => 'ja'],
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier3a',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 3,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier4',
                'options' => [
                    'label' => 'Rasse Hund 4 eingeben',
                    'help_content' => '<strong>Rasse Hund 4 eingeben</strong><p>Geben Sie hier die Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier4',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 4,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'mischling_hund4',
                'options' => [
                    'label' => 'Ist Hund 4 ein Mischling?',
                    'help_content' => '<strong>Ist Hund 4 ein Mischling?</strong><p>Ist Ihr Hund ein Mischling?</p>',
                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'col_attributes' => ['data-toggle' => '1'],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'mischling_hund4', 'data-dog' => 4],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier4a',
                'options' => [
                    'label' => 'Mischlingsrasse Hund 4',
                    'help_content' => '<strong>Mischlingsrasse Hund 4</strong><p>Geben Sie hier die Mischlings-Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Mischlings-Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',

                    'col_attributes' => ['data-show' => 'ja'],
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier4a',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 4,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier5',
                'options' => [
                    'label' => 'Rasse Hund 5 eingeben',
                    'help_content' => '<strong>Rasse Hund 5 eingeben</strong><p>Geben Sie hier die Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier5',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 5,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'mischling_hund5',
                'options' => [
                    'label' => 'Ist Hund 5 ein Mischling?',
                    'help_content' => '<strong>Ist Hund 5 ein Mischling?</strong><p>Ist Ihr Hund ein Mischling?</p>',
                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'col_attributes' => ['data-toggle' => '1'],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'mischling_hund5', 'data-dog' => 5],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'Rasse_Tier5a',
                'options' => [
                    'label' => 'Mischlingsrasse Hund 5',
                    'help_content' => '<strong>Mischlingsrasse Hund 5</strong><p>Geben Sie hier die Mischlings-Rasse Ihres Hundes an. Wenn Sie diese nicht genau kennen, geben Sie eine Mischlings-Rasse an, die dem am nächsten kommt. Achten Sie aber vor allem bei kampfhundähnlichen Rassen auf die genaue Angabe.</p>',

                    'col_attributes' => ['data-show' => 'ja'],
                ],
                'attributes' => [
                    'id' => 'Rasse_Tier5a',
                    'class' => 'js-pet-autocomplete',
                    'data-dog' => 5,

                    'pattern' => '[A-Za-z_äâàÄÂÀöÖüÜßÉÊÈéèêç()\s.-]{2,}',
                ],
            ],
        ],
        [
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
                    'help_content' => '<strong>Laufzeit</strong><p>Laufzeiten von mehr als einem Jahr führen bei vielen Anbietern zu Beitragsnachlässen zwischen 5% und 10%.</p>',
                ],
                'attributes' => ['id' => 'laufzeit'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'vorvers5',
                'options' => [
                    'label' => 'Bestand in den letzten 5 Jahren eine Vorversicherung?',
                    'help_content' => '<strong>Bestand in den letzten 5 Jahren eine Vorversicherung?</strong><p>Bei einigen Versicherungen gibt es bis zu 30% Rabatt, wenn Sie einen Vertrag hatten, der schadenfrei lief.</p>',

                    'value_options' => [
                        '' => '-- Bitte wählen --',
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                ],
                'attributes' => ['id' => 'vorvers5'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'schaeden5',
                'options' => [
                    'label' => 'Schäden in den letzten 5 Jahren',
                    'help_content' => '<strong>Schäden in den letzten 5 Jahren</strong><p>Teilen Sie mit, ob und wieviele Schäden Sie innerhalb der letzten 5 Jahre verursacht haben. Waren Sie in dieser Zeit schadensfrei, erhalten Sie bei einigen Versicherern einen Beitragsnachlass.</p>',

                    'value_options' => [
                        '' => '-- Bitte wählen --',
                        '0' => '0',
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                    ],
                ],
                'attributes' => ['id' => 'schaeden5'],
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
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
                    'use_hidden_element' => false,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                ],
                'attributes' => [
                    'id' => 'KrRS',
                    'class' => 'form-check-input',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Links::class,
                'name' => 'links',
                'options' => [
                    'label' => 'Wählen Sie eine Vorgabe für Ihre Berechnung',
                    'help_content' => '<strong>Wählen Sie eine Vorgabe für Ihre Berechnung</strong><p>Die Vorgabe des Arbeitskreis Vermittlerrichlinie (AK-Empfehlung) bietet Ihnen einen empfohlenen Mindestschutz. Heute erfüllen alle wichtigen Tarife diese Vorgaben. Zu Ihrer Sicherheit sollten Sie diese Mindestvorgaben wählen.</p>',
                    'links' => [
                        [
                            'href' => '#',
                            'class' => 'js-standard js-gtm-event',
                            'data-event-type' => 'click',
                            'data-event-category' => 'versicherung',
                            'data-event-label' => 'phv',
                            'data-event-action' => 'choose standard options',
                            'label' => 'Standard',
                        ],
                        [
                            'href' => '#',
                            'class' => 'recommendation js-recommendation js-gtm-event',
                            'data-event-type' => 'click',
                            'data-event-category' => 'versicherung',
                            'data-event-label' => 'phv',
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
                    'label' => 'Mindest-Versicherungssumme Personen/Sachschäden',

                    'value_options' => [
                        'o3000000' => [
                            'value' => '3000000',
                            'label' => 'mind. 3 Mio EUR  (AK Empfehlung)',
                        ],
                        'o5000000' => [
                            'value' => '5000000',
                            'label' => 'mind. 5 Mio EUR',
                        ],
                        'o10000000' => [
                            'value' => '10000000',
                            'label' => 'mind. 10 Mio EUR',
                        ],
                    ],
                    'help_content' => '<strong>Mindest-Versicherungssumme Personen/Sachschäden</strong><p>Die Versicherungssumme beschreibt den maximalen Betrag, den eine Versicherung im Schadenfall erstattet.</p><p>Wählen Sie zu Ihrer Sicherheit eine hohe Versicherungssumme.</p>',
                ],
                'attributes' => ['id' => 'vs_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'vsm_v',
                'options' => [
                    'label' => 'Mindest-Versicherungssumme für Mietsachschäden',

                    'value_options' => [
                        '300000' => 'mind. 300.000 EUR (AK Empfehlung)',
                        '500000' => 'mind. 500.000 EUR',
                        '1000000' => 'mind. 1 Mio EUR',
                        '3000000' => 'mind. 3 Mio EUR',
                        '0' => 'unter 500.000 EUR',
                    ],
                    'help_content' => '<strong>Mindest-Versicherungssumme für Mietsachschäden</strong><p>Schäden an festen gemieteten Sachen (Mietwohnung, Hotel) sind mit diesem Einschluss versichert.</p>',
                ],
                'attributes' => ['id' => 'vsm_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'vsv_v',
                'options' => [
                    'label' => 'Mindest-Versicherungssumme für Vermögensschäden',

                    'value_options' => [
                        '50000' => 'mind. 50.000 EUR (AK Empfehlung)',
                        '100000' => 'mind. 100.000 EUR',
                        '1000000' => 'mind. 1 Mio EUR',
                        '10000' => 'unter 50.000 EUR',
                    ],
                    'help_content' => '<strong>Mindest-Versicherungssumme für Vermögensschäden</strong><p>Beispiel für einen Vermögensschaden:<br/>Sie fahren mit dem Fahrrad einen Passanten an, welcher daraufhin für 2 Wochen im Krankenhaus liegt. Dadurch hat er Verdienstausfall und Einnahmenverluste.</p>',
                ],
                'attributes' => ['id' => 'vsv_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'best_v',
                'options' => [
                    'label' => 'Best-Leistungsgarantie',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Best-Leistungsgarantie</strong><p>Einige Gesellschaften bieten eine Best-Leistungs-Garantie an. Bietet ein anderer Haftpflicht-Tarif zum Zeitpunkt des Schadens einen größeren Leistungsumfang an, wird der Schaden nach diesen besseren Bedingungen reguliert.</p>',
                ],
                'attributes' => ['id' => 'best_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'sgwe_v',
                'options' => [
                    'label' => 'Selbstgenutztes Wohneigentum',

                    'value_options' => [
                        '0 kein Wohneigentum' => 'kein Wohneigentum',
                        '1 Wohnung' => 'Wohnung',
                        '1 EFH' => 'Einfamilienhaus',
                        '2 ZFH' => 'Zweifamilienhaus',
                        '4' => 'Mehrfamilienhaus bis 4 Wohnungen',
                        '100' => 'Mehrfamilienhaus über 4 Wohnungen',
                    ],
                    'help_content' => '<strong>Selbstgenutztes Wohneigentum</strong><p>Dieser Einschluss deckt Schäden, die durch Ihr Wohneigentum verursacht werden (Streupflicht, Herabfallende Äste usw.). Vermietetes Eigentum muss normalerweise in einer extra Haftpflicht versichert werden. Nur wenige Tarife bieten den Einschluss von Mehrfamilienhäusern an.</p>',
                ],
                'attributes' => ['id' => 'sgwe_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'ew_v',
                'options' => [
                    'label' => 'Eigentumswohnungen in Deutschland, vermietet',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Eigentumswohnungen in Deutschland, vermietet</strong><p>Durch eine lose Treppenstufe stürzt ein Besucher in Ihrer vermieteten Wohnung.</p>',
                ],
                'attributes' => ['id' => 'ew_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'unbgru_v',
                'options' => [
                    'label' => 'Unbebautes Grundstück',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Unbebautes Grundstück</strong><p>Bereits von einem unbe­bauten Grund­stück können Gefahren ausgehen. Der Eigen­tümer ist dafür verantwort­lich, dass dort niemand zu Schaden kommt.</p>',
                ],
                'attributes' => ['id' => 'unbgru_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'einlw_v',
                'options' => [
                    'label' => 'Einliegerwohnung vermietet im selbstbewohnten Haus',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Einliegerwohnung vermietet im selbstbewohnten Haus</strong><p>Schäden, die durch Ihre vermietete Einliegerwohnung entstehen, sind versichert.</p>',
                ],
                'attributes' => ['id' => 'einlw_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'fewoi_v',
                'options' => [
                    'label' => 'Ferienhaus-/Wohnung im Inland selbstgenutzt',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Ferienhaus-/Wohnung im Inland selbstgenutzt</strong><p>Schäden, die durch dieses Risiko entstehen, sind versichert.</p>',
                ],
                'attributes' => ['id' => 'fewoi_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'fewoa_v',
                'options' => [
                    'label' => 'Wohnung / Ferienwohnung / Ferienhaus im europ. Ausland ohne Vermietung',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Wohnung / Ferienwohnung / Ferienhaus im europ. Ausland ohne Vermietung</strong><p>Schäden, die durch genannte Wohneinheiten entstehen, sind versichert.</p>',
                ],
                'attributes' => ['id' => 'fewoa_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'fach_v',
                'options' => [
                    'label' => 'Fachpraktischer Unterricht (Laborarbeiten)',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja (AK Empfehlung)',
                    ],
                    'help_content' => '<strong>Fachpraktischer Unterricht (Laborarbeiten)</strong><p>Sie sind auch versichert, wenn Sie Schäden bei Arbeiten in Schul-, Berufsausbildung oder im Studium verursachen.</p>',
                ],
                'attributes' => ['id' => 'fach_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'tier_v',
                'options' => [
                    'label' => 'Hüten eines fremden Hundes/Pferdes',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja (AK Empfehlung)',
                    ],
                    'help_content' => '<strong>Hüten eines fremden Hundes/Pferdes</strong><p>Sollte durch das von Ihnen gehütete Tier ein Schaden entstehen, haftet diese Versicherung, falls Sie ein Verschulden am Schaden trifft.</p><p>In der Regel leistet immer zuerst die Tierhalter­haftpflicht­versicherung des Tieres.</p>',
                ],
                'attributes' => ['id' => 'tier_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'oel_v',
                'options' => [
                    'label' => 'Einschluss Öltankhaftpflicht',

                    'value_options' => [
                        'kein Tank vorhanden' => 'kein Tank vorhanden',
                        '3000' => 'bis 3.000 Liter',
                        '5000' => 'bis 5.000 Liter',
                        '10000' => 'bis 10.000 Liter',
                        '20000' => 'bis 20.000 Liter',
                        '50000' => 'bis 50.000 Liter',
                        '100000' => 'bis 100.000 Liter',
                    ],
                    'help_content' => '<strong>Einschluss Öltankhaftpflicht</strong><p>Wenn Sie einen Öltank besitzen, können Sie den Schutz hier mit einschließen.</p>',
                    'col_attributes' => ['data-toggle' => '1'],
                ],
                'attributes' => ['id' => 'oel_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'oelwo_v',
                'options' => [
                    'label' => 'Wo befindet sich der Öltank?',

                    'value_options' => [
                        'oberirdisch' => 'oberirdisch',
                        'unterirdisch' => 'unterirdisch',
                    ],
                    'help_content' => '<strong>Wo befindet sich der Öltank?</strong><p>Wählen Sie, ob der Tank ober- oder unterirdisch steht. Unterirdische Tanks haben ein höheres Risiko, da nicht sofort erkennbar ist, wenn Öl ausfliesst.</p>',
                    'col_attributes' => ['data-show' => '3000'],
                ],
                'attributes' => ['id' => 'oelwo_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'allm_v',
                'options' => [
                    'label' => 'Allmählichkeitsschäden',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'mind. 3 Mio (AK Empfehlung)',
                    ],
                    'help_content' => '<strong>Allmählichkeits­schäden</strong><p>Sachschäden, die durch schuldhafte allmähliche Einwirkung der Temperatur, von Gasen, Dämpfen oder Feuchtigkeit und von Niederschlägen (Rauch, Ruß, Staub) und dergleichen entstehen.</p>',
                ],
                'attributes' => ['id' => 'allm_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'gewsa_v',
                'options' => [
                    'label' => 'Gewässerschaden-Risiko, z.B. Farben',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja (AK Empfehlung)',
                    ],
                    'help_content' => '<strong>Gewässerschaden-Risiko, z.B. Farben</strong><p>Auch im Haushalt verwendete Farben, Lacke oder Reinigungsmittel können Gewässerschäden verursachen, diese sind hier mitversichert.</p>',
                ],
                'attributes' => ['id' => 'gewsa_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'abwa_v',
                'options' => [
                    'label' => 'Schäden durch häusliche Abwässer',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'mind. 3 Mio (AK Empfehlung)',
                    ],
                    'help_content' => '<strong>Schäden durch häusliche Abwässer</strong><p>Durch Chemikalien, die Sie in Ihren Abfluss gießen, entsteht ein Schaden an der Umwelt.</p>',
                ],
                'attributes' => ['id' => 'abwa_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'inet_v',
                'options' => [
                    'label' => 'Schäden durch elektronischen Datenaustausch/Internetnutzung',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja (AK Empfehlung)',
                    ],
                    'help_content' => '<strong>Schäden durch elektronischen Datenaustausch / Internetnutzung</strong><p>Durch Ihren virenbefallenen PC werden z.B. fremde PCs angegriffen bzw. Festplatten gelöscht. Oder Sie verbreiten z.B. unbewusst auf einem USB Stick Viren, die einen anderen PC unbrauchbar machen.</p>',
                ],
                'attributes' => ['id' => 'inet_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'gef_v',
                'options' => [
                    'label' => 'Gefälligkeitsschäden',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Gefälligkeitsschäden</strong><p>Wenn Sie jemanden helfen und dabei etwas kaputt machen, ist das normalerweise NICHT versichert. Es gibt nur wenige Tarife, die diesen Einschluss bieten.</p>',
                ],
                'attributes' => ['id' => 'gef_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'geli_v',
                'options' => [
                    'label' => 'Gemietete oder geliehene Sachen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Gemietete oder geliehene Sachen</strong><p>Bewegliche fremde geliehene Sachen sind normalerweise nicht versichert, es sei denn, Sie möchten diesen Schutz einschließen.</p>',
                ],
                'attributes' => ['id' => 'geli_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'sv_v',
                'options' => [
                    'label' => 'Schlüsselverlust, fremder privater Schlüssel (Mietwohnung)',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Schlüsselverlust, fremder privater Schlüssel (Mietwohnung)</strong><p>Sie verlieren den Schlüssel Ihrer Mietwohnung und die Tür muss geöffnet werden.</p>',
                ],
                'attributes' => ['id' => 'sv_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'sva_v',
                'options' => [
                    'label' => 'Schlüsselverlust für Zentrale Schließanlage (keine Eigenschäden)',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Schlüsselverlust für Zentrale Schließanlage (keine Eigenschäden)</strong><p>Sie verlieren den Schlüssel Ihrer Mietwohnung im Mehrfamilienhaus und die die gesamte Schließanlage muss getauscht werden.</p>',
                ],
                'attributes' => ['id' => 'sva_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'svd_v',
                'options' => [
                    'label' => 'Schlüsselverlust von fremden Dienstschlüsseln',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Schlüsselverlust von fremden Dienstschlüsseln</strong><p>Schlüsselverlust bei Ihren Firmenschlüsseln können Sie hier versichern.</p>',
                ],
                'attributes' => ['id' => 'svd_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'welt_v',
                'options' => [
                    'label' => 'Weltweite Deckung gewünscht (Standard ist Europa oder EU)',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Weltweite Deckung gewünscht (Standard ist Europa oder EU)</strong><p>Der Aufenthalt in außereuropäischen Ländern ist meist nur zeitlich begrenzt versicherbar und die Bezahlung muss über ein deutsches Institut laufen.</p>',
                ],
                'attributes' => ['id' => 'welt_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'elt_v',
                'options' => [
                    'label' => 'Alleinstehendes Elternteil im Haushalt lebend',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Alleinstehendes Elternteil im Haushalt lebend</strong><p>Wenn ein Elternteil alleinstehend und im Haushalt des VN gemeldet ist, kann hier der Versicherungsschutz eingeschlossen werden.</p>',
                ],
                'attributes' => ['id' => 'elt_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'ehr_v',
                'options' => [
                    'label' => 'Ehrenamtliche Tätigkeit',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Ehrenamtliche Tätigkeit</strong><p>Sie sind versichert, wenn Sie eine ehrenamtlichen Tätigkeit ausüben.</p>',
                ],
                'attributes' => ['id' => 'ehr_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'tagmu_v',
                'options' => [
                    'label' => 'Tätigkeit als Tagesmutter',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Tätigkeit als Tagesmutter</strong><p>Sie sind versichert, als Tagesmutter, meist bei der Betreuung von max. 5-6 Kindern.</p>',
                ],
                'attributes' => ['id' => 'tagmu_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'regr_v',
                'options' => [
                    'label' => 'Regressansprüche von Sozialversicherungsträgern von mitversicherten Personen',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja (AK Empfehlung)',
                    ],
                    'help_content' => '<strong>Regressansprüche von Sozial­versicherungs­trägern von mitversicherten Personen</strong><p>Durch Ihr Verschulden kommt Ihr Partner zu Sturz und muss behandelt werden, die Krankenversicherung des Partners will die Behandlungskosten wieder haben. Ansprüche durch fremde Geschädigte sind mitversichert.</p>',
                ],
                'attributes' => ['id' => 'regr_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'bau_v',
                'options' => [
                    'label' => 'Bauherrenhaftpflicht am Haus oder Grundstück',

                    'value_options' => [
                        '0' => 'nein',
                        '50000' => 'bis 50.000 EUR (AK Empfehlung)',
                        '100000' => 'bis 100.000 EUR',
                        '200000' => 'bis 200.000 EUR',
                        '1000000' => 'bis Versicherungssumme',
                    ],
                    'help_content' => '<strong>Bauherrenhaftpflicht am Haus oder Grundstück</strong><p>Für Neu- und Umbauten auf dem versicherten Grundstück.</p>',
                ],
                'attributes' => ['id' => 'bau_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'surf_v',
                'options' => [
                    'label' => 'Eigene Surfbretter',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Eigene Surfbretter</strong><p>Geliehene Surfbretter sind i.d.R. mitversichert, eigene müssen Sie extra beantragen bzw. einen Tarif wählen, der diese einschließt.</p>',
                ],
                'attributes' => ['id' => 'surf_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'tiere_v',
                'options' => [
                    'label' => 'Besitzen Sie Hunde, Pferde, Rinder, landwirtschaftliche Tiere?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja, evtl. extra Vertrag notwendig!' => 'ja, evtl. extra Vertrag notwendig!',
                    ],
                    'help_content' => '<strong>Besitzen Sie Hunde, Pferde, Rinder, landwirtschaftliche Tiere?</strong><p>Für einige Tiere ist eine extra Haftpflicht nötig.</p>',
                ],
                'attributes' => ['id' => 'tiere_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'wafa_v',
                'options' => [
                    'label' => 'Benutzen Sie eigene Wasserfahrzeuge?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja, extra Vertrag notwendig!' => 'ja, extra Vertrag notwendig!',
                    ],
                    'help_content' => '<strong>Benutzen Sie eigene Wasserfahrzeuge?</strong><p>Je nach Größe und Leistung ist eine eigene Versicherung nötig.</p>',
                ],
                'attributes' => ['id' => 'wafa_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'flug_v',
                'options' => [
                    'label' => 'Besitzen Sie Modellflugzeuge, Ballone oder Drachen?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja, evtl. extra Vertrag notwendig!' => 'ja, evtl. extra Vertrag notwendig!',
                    ],
                    'help_content' => '<strong>Besitzen Sie Modellflugzeuge, Ballone oder Drachen?</strong><p>Je nach Leistung und Art ist eine eigene Versicherung nötig.</p>',
                ],
                'attributes' => ['id' => 'flug_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'drohne_v',
                'options' => [
                    'label' => 'Besitzen Sie privat genutzte Drohnen?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Besitzen Sie privat genutzte Drohnen?</strong><p>Drohnen benötigen einen extra Versicherungsschutz. Über die Privathaftpflicht können nur privat genutzte Drohnen versichert werden.</p>',
                ],
                'attributes' => ['id' => 'drohne_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'jagd_v',
                'options' => [
                    'label' => 'Gehen Sie auf die Jagd?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja, evtl. extra Vertrag notwendig!' => 'ja, evtl. extra Vertrag notwendig!',
                    ],
                    'help_content' => '<strong>Gehen Sie auf die Jagd?</strong><p>Es gibt Jagdhaftpflicht Versicherungen, die dieses Risiko abdecken.</p>',
                ],
                'attributes' => ['id' => 'jagd_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'foto_v',
                'options' => [
                    'label' => 'Betreiben Sie eine Photovoltaikanlage?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja, evtl. extra Vertrag notwendig!' => 'ja, evtl. extra Vertrag notwendig!',
                    ],
                    'help_content' => '<strong>Betreiben Sie eine Photovoltaikanlage?</strong><p>Photovoltaikanlagen müssen extra versichert werden.</p>',
                ],
                'attributes' => ['id' => 'foto_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'rsausfall',
                'options' => [
                    'label' => 'Rechtsschutz zur Ausfalldeckung',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],
                    'help_content' => '<strong>Rechtsschutz zur Ausfalldeckung</strong><p>Wenn ein Dritter den Ihnen zugefügten Schaden nicht begleichen kann, führt das oftmals zu einem Rechtsstreit. Die Kosten für Anwalt und Gericht werden dann von dieser Versicherung übernommen. Wir empfehlen Ihnen jedoch, einen eigenen RS Vertrag abzuschließen, da dieser Einschluss i.d.R. geringere Leistungen bietet als ein selbständiger RS Vertrag. Wenn Sie eine RS Versicherung für den privaten Bereich besitzen, benötigen Sie diesen Einschluss nicht.</p>',

                    'col_attributes' => ['data-show' => 'ja', 'data-ausfall' => '1'],
                ],
                'attributes' => ['id' => 'rsausfall'],
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
                    'col_attributes' => ['class' => 'col-12', 'data-toggle' => '1'],

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
                'type' => Checkbox::class,
                'name' => 'chkErstinfo',
                'options' => [
                    'label' => 'Ich bestätige, die <strong>Erstinformation</strong> für Versicherungsmakler gemäß § 15 VersVermV und die <strong>Mitteilung zur Beratungsgrundlage</strong> gemäß § 60 VVG heruntergeladen und gelesen zu haben.',
                    'label_options' => ['disable_html_escape' => true],
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',
                    'col_attributes' => ['class' => 'col-12'],

                    'as-form-control' => true,
                ],
                'attributes' => [
                    'id' => 'mrmoErstinfo',
                    'class' => 'col-12',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Button::class,
                'name' => 'btn_berechnen',
                'options' => [
                    'label' => 'Berechnen',
                    'col_attributes' => ['class' => 'col-12'],
                ],
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
        [
            'spec' => [
                'type' => Hidden::class,
                'name' => 'selbst',
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
                'type' => Hidden::class,
                'name' => 'zahlweise',
            ],
        ],
        [
            'spec' => [
                'type' => Hidden::class,
                'name' => 'chkFilterNachhaltigkeit',
            ],
        ],
    ],
    'input_filter' => [
        'single' => ['required' => true],
        'versbeginn' => ['required' => true],
        'versbeginn_datum' => ['required' => false],
        'plz' => ['required' => true],
        'beamte' => ['required' => true],
        'gebdatum' => ['required' => true],
        'ausfall' => ['required' => true],
        'delikt' => ['required' => true],
        'Rasse_Tier1' => ['required' => false],
        'mischling_hund1' => ['required' => false],
        'Rasse_Tier1a' => ['required' => false],
        'Rasse_Tier2' => ['required' => false],
        'mischling_hund2' => ['required' => false],
        'Rasse_Tier2a' => ['required' => false],
        'Rasse_Tier3' => ['required' => false],
        'mischling_hund3' => ['required' => false],
        'Rasse_Tier3a' => ['required' => false],
        'Rasse_Tier4' => ['required' => false],
        'mischling_hund4' => ['required' => false],
        'Rasse_Tier4a' => ['required' => false],
        'Rasse_Tier5' => ['required' => false],
        'mischling_hund5' => ['required' => false],
        'Rasse_Tier5a' => ['required' => false],
        'vorvers5' => ['required' => true],
        'schaeden5' => ['required' => true],
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
