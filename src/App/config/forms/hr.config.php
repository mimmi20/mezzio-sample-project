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
use Laminas\Validator\NotEmpty;
use Mimmi20\Form\Links\Element\Links;

return [
    'type' => Form::class,
    'options' => [
        'floating-labels' => true,
        'layout' => \Mimmi20\LaminasView\BootstrapForm\Form::LAYOUT_VERTICAL,
        'form-required-mark' => '<div class="mt-2 text-info-required"><sup>*</sup> Pflichtfeld</div>',
        'col_attributes' => ['class' => 'my-2 col-12 position-relative align-items-center d-flex'],
        'help_attributes' => ['class' => 'help-content'],
        'label_attributes' => ['class' => 'stretched-link'],
    ],
    'attributes' => [
        'method' => 'post',
        'class' => 'g-0 was-validated my-3',
        'accept-charset' => 'utf-8',
        'novalidate' => 'novalidate',
        'data-needs-validation' => true,
        'id' => 'hr-form',
    ],
    'elements' => [
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
                    'label' => 'PLZ - Risiko-Anschrift',

                    'help_content' => '<strong class="toast-header">Warum fragen wir das?</strong><p class="toast-body">Die Postleitzahl Ihrer Wohnung wird für die Risikobeurteilung /Beitragsberechnung benötigt. Die Beitragshöhe ist nicht nur abhängig von Ihren gewünschten Leistungen, sondern wird auch anhand Art und Anzahl der Schäden, die in Ihrem Wohnort durchschnittlich gemeldet werden, bemessen.</p>',
                ],
                'attributes' => [
                    'id' => 'plz',
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
                'name' => 'ort',
                'options' => [
                    'label' => 'Ort',

                    'value_options' => ['' => 'Bitte zuerst PLZ eintragen'],
                    'disable_inarray_validator' => true,
                    'help_content' => '<strong class="toast-header">Ort</strong><p class="toast-body">Der Ort Ihrer zu versichernden Wohnung.</p>',
                ],
                'attributes' => ['id' => 'ort'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'strasse',
                'options' => [
                    'label' => 'Straße',

                    'value_options' => ['' => 'Bitte zuerst Ort wählen'],
                    'disable_inarray_validator' => true,
                    'help_content' => '<strong class="toast-header">Straße</strong><p class="toast-body">Die Straße Ihrer zu versichernden Wohnung.</p>',
                ],
                'attributes' => ['id' => 'strasse'],
            ],
        ],
        [
            'spec' => [
                'type' => Text::class,
                'name' => 'hnr',
                'options' => [
                    'label' => 'Hausnummer',

                    'help_content' => ['header' => '<strong>Hausnummer</strong>', 'content' => 'Die Hausnummer Ihrer zu versichernden Wohnung.'],
                ],
                'attributes' => [
                    'id' => 'hnr',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Links::class,
                'name' => 'link',
                'options' => [
                    'links' => [
                        [
                            'href' => '#modal-missing-street',
                            'class' => 'info-layer-trigger',
                            'label' => 'Fehlende Adresse melden',
                            'data-layer' => 'modal-missing-street',
                        ],
                    ],

                    'as-form-control' => true,
                    'floating' => false,
                ],
                'attributes' => ['data-toggle' => 'modal'],
            ],
        ],
        [
            'spec' => [
                'type' => Date::class,
                'name' => 'gebdatum',
                'options' => ['label' => 'Geburtsdatum'],
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
                'type' => Select::class,
                'name' => 'whg',
                'options' => [
                    'label' => 'Wo wohnen Sie?',

                    'value_options' => [
                        'Mehrfamilienhaus' => 'Mehrfamilienhaus',
                        'Einfamilienhaus' => 'Einfamilienhaus',
                        'Zweifamilienhaus' => 'Zweifamilienhaus',
                        'Doppelhaushälfte' => 'Doppelhaushälfte',
                        'Reihenhaus' => 'Reihenhaus',
                    ],
                    'help_content' => '<strong class="toast-header">Wo wohnen Sie</strong><p class="toast-body">Wählen Sie hier, in welchem Haus sich die zu versichernde Wohnung befindet.</p>',
                ],
                'attributes' => [
                    'id' => 'whg',
                    'class' => 'toggle-trigger',
                    'data-toggle-modus' => 'hide',
                    'data-toggle-value' => 'Mehrfamilienhaus',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'vermietet',
                'options' => [
                    'label' => 'Ist die Wohnung möbliert vermietet?',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'vermietet'],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'wohnfl',
                'options' => [
                    'label' => 'Ihre gesamte Wohnfläche im Haus',
                    'help_content' => '<strong class="toast-header">Ihre gesamte Wohnfläche im Haus</strong><p class="toast-body">Als Wohnfläche gilt die Grundfläche aller Räume der versicherten Wohnung. Räume, die zu Hobbyzwecken genutzt werden, gelten immer als Wohnfläche. Nicht zu berücksichtigen sind: Zubehörräume, Keller- und Speicherräume, die nicht zu Wohnzwecken genutzt werden, nicht ausgebaute Dachböden, Treppen, Balkone, Terrassen, Loggien, Garagen.</p>',
                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => 'm<sup>2</sup>',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'wohnfl',
                    'class' => 'has-legend',
                    'min' => '10',
                    'max' => '2000',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'wohnfl_kg',
                'options' => [
                    'label' => 'Davon sind im Keller',
                    'help_content' => '<strong class="toast-header">Davon sind im Keller</strong><p class="toast-body">Geben Sie hier eine evtl. Wohnfläche im Keller an. Diese muss aber im o.g. Feld schon enthalten sein. Definition siehe oben. (z.B. Hobbyraum)</p>',
                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => 'm<sup>2</sup>',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'wohnfl_kg',
                    'class' => 'has-legend',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'kellerfl',
                'options' => [
                    'label' => 'Grundfläche des Kellers',
                    'help_content' => '<strong class="toast-header">Grundfläche des Kellers</strong><p class="toast-body">Geben Sie hier die gesamte Grundfläche Ihres Kellers in qm an.</p>',
                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => 'm<sup>2</sup>',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'kellerfl',
                    'class' => 'has-legend',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'beamte',
                'options' => [
                    'label' => 'Tarif',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Einige Versicherer bieten Beitragsnachlässe für Beamte und Angestellte im öffentlichen Dienst.</p><strong>Hinweis zur Auswahl</strong><p>Wählen Sie auch &quot;öffentlicher Dienst&quot;, wenn Sie Beamter sind oder früher im öffentlichen Dienst beschäftigt waren und sich mittlerweile im Ruhestand befinden.</p>',
                    'value_options' => [
                        'Normal' => 'Normal',
                        'öffentl. Dienst' => 'öffentlicher Dienst',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'beamte'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'verssummeauto',
                'options' => [
                    'label' => 'Versicherungssumme',
                    'help_content' => '<strong>Versicherungssumme</strong><p>Die vereinbarte Versicherungssumme bildet die Höchst­entschädigungs­grenze nach einem Totalschaden. Wir empfehlen Unter­versicherungs­verzicht zu vereinbaren, damit nach einem Schaden durch den Versicherer keine Abzüge wegen möglicher Unterversicherung vorgenommen werden.</p><p>Eine Unterversicherung liegt vor, wenn im Schadenfall die vereinbarte Versicherungssumme niedriger ist als der tatsächlich vorhandene Wert Ihres Hausrates.<br/>Ein Unter­versicherungs­verzicht erfordert je nach Anbieter und Tarif eine Versicherungssumme in Höhe von 600-700 EUR/qm Wohnfläche. Beachten Sie: Ohne eigene Eingabe der Versicherungssumme wird automatisch der richtige Wert für den Unter­versicherungs­verzicht ermittelt.</p>',
                    'value_options' => [
                        'auto' => 'automatisch ermitteln',
                        'manuell' => 'selbst angeben',
                    ],

                    'col_attributes' => ['data-toggle' => '1'],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'verssummeauto'],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'verssumme',
                'options' => [
                    'label' => 'Versicherungssumme selbst angeben',
                    'help_content' => '<strong>Versicherungssumme selbst angeben</strong><p>Die vereinbarte Versicherungssumme bildet die Höchst­entschädigungs­grenze nach einem Totalschaden. Wir empfehlen Unter­versicherungs­verzicht zu vereinbaren, damit nach einem Schaden durch den Versicherer keine Abzüge wegen möglicher Unterversicherung vorgenommen werden. Dieser Unter­versicherungs­verzicht erfordert je nach Anbieter und Tarif eine Versicherungssumme in Höhe von 600-700 EUR/qm Wohnfläche. Beachten Sie: Ohne Eingabe der Versicherungssumme wird automatisch der richtige Wert für den Unter­versicherungs­verzicht ermittelt.</p>',
                    'col_attributes' => ['data-show' => 'manuell'],
                ],
                'attributes' => [
                    'id' => 'verssumme',
                    'class' => 'has-legend',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'fahrrad',
                'options' => [
                    'label' => 'Fahrraddiebstahl bis',
                    'help_content' => '<strong>Fahrraddiebstahl bis</strong><p>Auch bei Fahrraddiebstahl gilt Neuwertersatz. Achten Sie besonders auf Anbieter, die auf die Nachtzeitklausel verzichten und auch dann Schadenersatz leisten, wenn das Fahrrad in der Zeit zwischen 22:00-06:00 Uhr entwendet wurde. Bedingung: Das Fahrrad muss vor dem Diebstahl in geeigneter Weise gesichert (angeschlossen) gewesen sein. Schaden-Beispiel: Sie fahren mit Ihrem Fahrrad einkaufen, schließen es vor dem Geschäft ordnungsgemäß an. Trotzdem wird Ihr Fahrrad gestohlen.</p>',
                    'in-group' => true,

                    'group-suffixes' => [
                        [
                            'attributes' => ['class' => 'input-group-text'],
                            'content' => '&euro;',
                        ],
                    ],
                ],
                'attributes' => [
                    'id' => 'fahrrad',
                    'class' => 'has-legend',
                    'min' => '0',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'glas',
                'options' => [
                    'label' => 'Glasversicherung',
                    'help_content' => '<strong>Glasversicherung</strong><p>Bei Wohnungen im Mehrfamilienhaus ist nur die Mobiliarverglasung versichert, im selbstgenutzten Einfamilienhaus zusätzlich die Gebäudeverglasung.</p>',
                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'glas'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'elem',
                'options' => [
                    'label' => 'Elementarschäden (Überschwemmung, Erdbeben, Erdsenkung, Erdrutsch, Schneedruck- und Lawinenschäden)',
                    'help_content' => '<strong>Elementarschäden (Überschwemmung, Erdbeben, Erdsenkung, Erdrutsch, Schneedruck- und Lawinenschäden)</strong><p>Dazu gehören Überschwemmung durch Witterungsniederschläge, oder Ausuferung von oberirdischen Gewässern, Schneedruck, Lawinen, Erdrutsch, Erdfall, Erdbeben. Sturm oder Hagelschäden sind schon in der normalen Versicherung enthalten! Schaden-Beispiel: Durch starke Niederschläge wird Ihr Keller überflutet und die darin stehenden Möbel (z.B. Gefrierschrank) kommen zu Schaden.</p>',
                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'elem'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'grob',
                'options' => [
                    'label' => 'Mitversicherung der groben Fahrlässigkeit?',
                    'help_content' => '<strong>Mitversicherung der groben Fahrlässigkeit?</strong><p>Wir empfehlen dringend, die Grobe Fahrlässigkeit mitzuversichern. Ein grob fahrlässiges Verhalten liegt beispielsweise vor, wenn Täter durch geöffnete oder gekippte Fenster bzw. Türen eindringen konnten, während der Versicherungsnehmer über einen längeren Zeitraum abwesend war. Die Auswahl &quot;ja&quot; bedeutet alle Tarife mit dieser Leistung werden angezeigt und bei der Auswahl &quot;ja, nur bestmögliche&quot; werden nur die Tarife angezeigt, die eine höchst mögliche Leistung anbieten.</p>',
                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'grob'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'bauart',
                'options' => [
                    'label' => 'Bauartklasse',
                    'help_content' => '<strong>Bauartklasse Info</strong><p>Die meisten Häuser sind massiv (aus Stein, Ziegel, Beton o. ä.) gebaut und verfügen über eine harte Dachung, z.B. aus Ziegeln, Metall, Beton, Schiefer. Sollten Sie aber z.B. in einem Fachwerkhaus wohnen oder Ihr Haus mit einer weichen Dachung z.B. aus Schilf, Reed, Holz ausgestattet sein, wird ein Zuschlag fällig.</p>',
                    'value_options' => [
                        'massive Bauweise mit harter Dachung (BAK I)' => 'massive Bauweise mit harter Dachung (BAK I)',
                        'Stahl/Glas Bauweise mit harter Dachung (BAK II)' => 'Stahl/Glas Bauweise mit harter Dachung (BAK II)',
                        'Holzhaus oder Lehmfachwerk mit harter Dachung (BAK III)' => 'Holzhaus oder Lehmfachwerk mit harter Dachung (BAK III)',
                        'weiche Dachung (BAK IV oder V)' => 'weiche Dachung (BAK IV oder V)',
                        'Fertighaus, massiv mit harter Dachung (FHG I, FHG II)' => 'Fertighaus, massiv mit harter Dachung (FHG I, FHG II)',
                        'Fertighaus mit harter Dachung (FHG III)' => 'Fertighaus mit harter Dachung (FHG III)',
                    ],
                ],
                'attributes' => ['id' => 'bauart'],
            ],
        ],
        [
            'spec' => [
                'type' => Links::class,
                'name' => 'bauart-link',
                'options' => [
                    'links' => [
                        [
                            'href' => '#modal-dialog-contruction-type',
                            'class' => 'info-layer-trigger',
                            'label' => 'Information zu Bauarten',
                            'data-layer' => 'modal-dialog-contruction-type',
                        ],
                    ],

                    'as-form-control' => true,
                    'floating' => false,
                ],
                'attributes' => ['data-toggle' => 'modal'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'selbst',
                'options' => [
                    'label' => 'Selbstbeteiligung',
                    'help_content' => '<strong>Selbstbeteiligung</strong><p>Eine evtl. vereinbarte Selbstbeteiligung führt zu Beitragsnachlässen und muss durch Sie nach jedem Schadensfall in vereinbarter Höhe selbst tragen werden.</p>',
                    'value_options' => [
                        'nein' => '0 €',
                        '150' => '150 €',
                        '200' => '200 €',
                        '250' => '250 €',
                        '300' => '300 €',
                    ],
                ],
                'attributes' => ['id' => 'selbst'],
            ],
        ],
        [
            'spec' => [
                'type' => Select::class,
                'name' => 'laufzeit',
                'options' => [
                    'label' => 'Laufzeit',
                    'help_content' => '<strong>Laufzeit</strong><p>Sollten Sie eine Vertragslaufzeit von 3 Jahren wählen, können Sie bei einigen Versicherern mit einem Beitragsnachlass in Höhe von 10% rechnen.</p>',
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
                'type' => Radio::class,
                'name' => 'vorvers5',
                'options' => [
                    'label' => 'Bestand in den letzten 5 Jahren eine Vorversicherung?',
                    'help_content' => '<strong>Bestand in den letzten 5 Jahren eine Vorversicherung?</strong><p>Haben Sie eine Vorversicherung, die bislang schadenfrei verlief, können Sie von verschiedenen Versicherern einen Rabatt bis 25% erhalten.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
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
                    'help_content' => '<strong>Schäden in den letzten 5 Jahren</strong><p>Bei Schadenfreiheit gibt es bei einigen Tarifen einen Nachlass.</p>',
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
                'type' => Radio::class,
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

                    'as-form-control' => true,
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
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrPHV', 'placeholder' => ' '],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrTIE',
                'options' => [
                    'label' => 'Tierhalterhaftpflicht',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrTIE'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrHUG',
                'options' => [
                    'label' => 'Haus-Grundbesitzer Haftpflicht',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrHUG'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrOEL',
                'options' => [
                    'label' => 'Gewässerschaden/Öltank',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrOEL'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrWG',
                'options' => [
                    'label' => 'Wohngebäude',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrWG'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrWGGLS',
                'options' => [
                    'label' => 'Wohngebäude-Glas',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrWGGLS'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrHR',
                'options' => [
                    'label' => 'Hausrat',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrHR'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrHRGLS',
                'options' => [
                    'label' => 'Hausrat-Glas',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrHRGLS'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrUNF',
                'options' => [
                    'label' => 'Unfall',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrUNF'],
            ],
        ],
        [
            'spec' => [
                'type' => Checkbox::class,
                'name' => 'KrRS',
                'options' => [
                    'label' => 'Rechtsschutz',
                    'help_content' => '<strong>Warum fragen wir das?</strong><p>Klicken Sie hier, wenn Sie diese Versicherung schon besitzen oder diese neu beantragen möchten.</p>',
                    'use_hidden_element' => true,
                    'checked_value' => '1',
                    'unchecked_value' => '0',

                    'switch' => true,

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'KrRS'],
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
                    'row_attributes' => ['data-toggle' => '1'],

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
                'type' => Radio::class,
                'name' => 'uver_v',
                'options' => [
                    'label' => 'Wünschen Sie einen Unterversicherungsverzicht?',
                    'help_content' => '<strong>Wünschen Sie einen Unter­versicherungs­verzicht?</strong><p>Eine Unterversicherung liegt vor, wenn im Schadenfall die vereinbarte Versicherungssumme niedriger ist als der tatsächlich vorhandene Wert Ihres Hausrates.</p><p>Wenn Sie keinen Unter­versicherungs­verzicht vereinbaren (je nach Anbieter 600-700 EUR/qm) kann es im Schadenfall zur Leistungskürzung kommen.</p>',
                    'value_options' => [
                        'nein - Eingabe einer V-Summe' => 'nein - Eingabe einer V-Summe',
                        'ja' => 'ja - empfohlen',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'uver_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'ues_v',
                'options' => [
                    'label' => 'Mitversicherung von Überspannungsschäden?',
                    'help_content' => '<strong>Mitversicherung von Wertsachen? Ohne Angaben sind mind. 20% der VS mitversichert.</strong><p>Meist sind 20-25% der Versicherungssumme für Wertsachen mitversichert. Bargeld, Wertpapiere, Schmuck, Briefmarken, Münzen, Sachen aus Silber/Gold/Platin, Pelze, handgeknüpfte Teppiche, Kunstgegenstände (z.B. Gemälde, Plastiken), Sachen über 100 Jahre alt. Möbelstücke fallen nicht unter Wertsachen!</p>',
                    'value_options' => [
                        'ja' => 'ja - empfohlen',
                        'nein' => 'nein',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'ues_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Number::class,
                'name' => 'werts_v',
                'options' => [
                    'label' => 'Mitversicherung von Wertsachen? Ohne Angaben sind mind. 20% der VS mitversichert.',
                    'help_content' => '<strong>Mitversicherung von Wertsachen? Ohne Angaben sind mind. 20% der VS mitversichert.</strong><p>Meist sind 20-25% der Versicherungssumme für Wertsachen mitversichert. Bargeld, Wertpapiere, Schmuck, Briefmarken, Münzen, Sachen aus Silber/Gold/Platin, Pelze, handgeknüpfte Teppiche, Kunstgegenstände (z.B. Gemälde, Plastiken), Sachen über 100 Jahre alt. Möbelstücke fallen nicht unter Wertsachen!</p>',
                ],
                'attributes' => [
                    'id' => 'werts_v',
                    'class' => 'has-legend',
                    'min' => '0',
                    'placeholder' => ' ',
                ],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'dieb_v',
                'options' => [
                    'label' => 'Diebstahl von Kinderwagen und Krankenfahrstühlen?',
                    'help_content' => '<strong>Diebstahl von Kinderwagen und Krankenfahrstühlen?</strong><p>Einige Tarife schließen diesen Diebstahl bis zu einer begrenzten Summe mit ein.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'dieb_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'dkfz_v',
                'options' => [
                    'label' => 'Diebstahl aus KFZ?',
                    'help_content' => '<strong>Diebstahl aus KFZ?</strong><p>Ausgeschlossen sind meist elektronische Geräte wie Notebook und Kameras.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'dkfz_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'dkle_v',
                'options' => [
                    'label' => 'Diebstahl von Wäsche auf der Leine?',
                    'help_content' => '<strong>Diebstahl von Wäsche auf der Leine?</strong><p>Falls Ihre Wäsche von der Leine gestohlen wird, muss eine polizeiliche Meldung vorliegen, um Ersatz vom Versicherer zu erhalten.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'dkle_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'rauch_v',
                'options' => [
                    'label' => 'Schäden durch Verpuffung, Rauch und Ruß?',
                    'help_content' => '<strong>Schäden durch Verpuffung, Rauch und Ruß?</strong><p>In einer Heizung, die befeuert wird, entsteht durch sich entwickelnde Gase eine Verpuffung.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'rauch_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'kfz_v',
                'options' => [
                    'label' => 'Schäden durch Anprall von Landfahrzeugen?',
                    'help_content' => '<strong>Schäden durch Anprall von Landfahrzeugen?</strong><p>Fährt ein KFZ gegen Ihr Haus und es entsteht ein Schaden am Hausrat, wird dieser ersetzt.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'kfz_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'bank_v',
                'options' => [
                    'label' => 'Sachen in Bankgewahrsam?',
                    'help_content' => '<strong>Sachen in Bankgewahrsam?</strong><p>Wenn z.B. Ihr Schmuck aus dem Banktresor gestohlen wird.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'bank_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'dgar_v',
                'options' => [
                    'label' => 'Diebstahl von Gartenmöbeln/Geräten?',
                    'help_content' => '<strong>Diebstahl von Gartenmöbeln/Geräten?</strong><p>Falls Ihre Sitzgruppe gestohlen wird, ist diese hier mitversichert.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'dgar_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'was_v',
                'options' => [
                    'label' => 'Haben Sie Aquarien oder Wasserbetten (Wasserschäden)?',
                    'help_content' => '<strong>Haben Sie Aquarien oder Wasserbetten (Wasserschäden)?</strong><p>In der Regel werden nur die Folgen des Wasserschadens ersetzt, nicht das Wasserbett selbst.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'was_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'seng_v',
                'options' => [
                    'label' => 'Sollen Sengschäden mitversichert werden?',
                    'help_content' => '<strong>Sollen Sengschäden mitversichert werden?</strong><p>Darunter versteht man Schäden, die ohne Feuer entstehen, sondern nur durch Hitzeeinwirkung (z.B. Bügeleisen).</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'seng_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'waver_v',
                'options' => [
                    'label' => 'Soll Wasserverlust infolge Rohrbruch mitversichert werden?',
                    'help_content' => '<strong>Soll Wasserverlust infolge Rohrbruch mitversichert werden?</strong><p>Läuft längere Zeit Wasser weg, wird auch das bis zur Höchstgrenze erstattet.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'waver_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'hot_v',
                'options' => [
                    'label' => 'Hotelkosten im Schadenfall?',
                    'help_content' => '<strong>Hotelkosten im Schadenfall?</strong><p>Wird Ihre Wohnung z.B. nach einem Wasserschaden unbewohnbar, werden Hotelkosten ersetzt.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'hot_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'reis_v',
                'options' => [
                    'label' => 'Rückreisekosten aus dem Urlaub?',
                    'help_content' => '<strong>Rückreisekosten aus dem Urlaub?</strong><p>Wenn ein erheblicher Versicherungsfall eintritt, werden Fahrtmehrkosten für die Rückreise aus dem Urlaub ersetzt.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'reis_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'arb_v',
                'options' => [
                    'label' => 'Sachen im häuslichen Arbeitszimmer?',
                    'help_content' => '<strong>Sachen im häuslichen Arbeitszimmer?</strong><p>Üben Sie Ihr Gewerbe aus Ihrer Wohnung aus, sind die gewerblichen Sachen bis zu einer Höchstgrenze bei diesem Einschluss mitversichert.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'arb_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'evors_v',
                'options' => [
                    'label' => 'Erweiterte Vorsorge',
                    'help_content' => '<strong>Erweiterte Vorsorge</strong><p>Kein Deckungsnachteil gegenüber Mitbewerbern im Schadenfall. Im Versicherungsfall gelten Risiken, die im Rahmen des vereinbarten Vertrages nicht eingeschlossen sind, jedoch durch einen leistungsstärkeren, allgemein und für jedermann zugänglichen Tarif zur Hausratversicherung zum Zeitpunkt des Schadeneintritts eingeschlossen wären, automatisch entsprechend den dortigen Regelungen mitversichert.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'evors_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'all_v',
                'options' => [
                    'label' => 'Wünschen Sie für Ihren Hausrat eine Allgefahrendeckung?',
                    'help_content' => '<strong>Wünschen Sie für Ihren Hausrat eine Allgefahrendeckung?</strong><p>Bei der Allgefahrendeckung handelt es sich um einen weitreichenden, über die Leistungen einer klassischen Versicherung hinausgehenden Versicherungsschutz. Auf die gewohnte Aufzählung von versicherten Gefahren, z. B. Feuer, Leitungswasser oder Sturm, wird verzichtet: Schäden - Zerstörung, Beschädigung und Abhandenkommen von versicherten Gegenständen - gelten als Folge aller Gefahren als versichert, soweit diese nicht explizit vom Versicherungsschutz ausgenommen sind.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'all_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'sich_v',
                'options' => [
                    'label' => 'Sind an allen Haus- und sonstigen Eingangstüren Sicherheitsschlösser mit von außen nicht abschraubbaren, bündig montierten Sicherheitsbeschlägen vorhanden?',
                    'help_content' => '<strong>Sind an allen Haus- und sonstigen Eingangstüren Sicherheitsschlösser mit von außen nicht abschraubbaren, bündig montierten Sicherheitsbeschlägen vorhanden?</strong><p>Im Falle eines Einbruchdiebstahls wird überprüft, ob die Türen diesen Ansprüchen gerecht werden.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'sich_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'meld_v',
                'options' => [
                    'label' => 'Ist eine vom VdS (Verband der Sachversicherer) anerkannte Einbruchmeldeanlage vorhanden?',
                    'help_content' => '<strong>Ist eine vom VdS (Verband der Sachversicherer) anerkannte Einbruchmeldeanlage vorhanden?</strong><p>Diese Anforderung ist nützlich bei hohen Versicherungssummen oder besonderen Risiken. Im Normalfall spielt eine Meldeanlage im Schadensfall keine Rolle.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'meld_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'bewo_v',
                'options' => [
                    'label' => 'Ist die Wohnung länger als 60 Tage ununterbrochen unbewohnt?',
                    'help_content' => '<strong>Ist die Wohnung länger als 60 Tage ununterbrochen unbewohnt?</strong><p>Bei einigen Gesellschaften erlischt der Versicherungsschutz, wenn die Wohnung länger als 60 Tage leer steht. Bewohnt heißt, dass eine erwachsene Person in der Wohnung übernachtet und sich dort im Normalfall aufhält.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'bewo_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'tres_v',
                'options' => [
                    'label' => 'Ist ein mehrwandiger Stahlschrank mit einem Gewicht von > 200 kg oder ein eingemauerter Tresor mit mehrwandiger Tür vorhanden?',
                    'help_content' => '<strong>Ist ein mehrwandiger Stahlschrank mit einem Gewicht von > 200 kg oder ein eingemauerter Tresor mit mehrwandiger Tür vorhanden?</strong><p>Ist im Normalfall uninteressant. Bei besonderen Risiken muss das gesondert behandelt werden.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'tres_v'],
            ],
        ],
        [
            'spec' => [
                'type' => Radio::class,
                'name' => 'feu_v',
                'options' => [
                    'label' => 'Gibt es auf dem Versicherungsgrundstück oder in einer Entfernung von unter 10 m Betriebe / Lager, von denen eine erhöhte Feuergefahr ausgeht?',
                    'help_content' => '<strong>Gibt es auf dem Versicherungsgrundstück oder in einer Entfernung von unter 10 m Betriebe / Lager, von denen eine erhöhte Feuergefahr ausgeht?</strong><p>Es ist möglich, dass Versicherer bei erhöhtem Risiko den Vertrag ablehnen.</p>',

                    'value_options' => [
                        'nein' => 'nein',
                        'ja' => 'ja',
                    ],

                    'as-form-control' => true,
                ],
                'attributes' => ['id' => 'feu_v'],
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
                    'data-event-label' => 'hr',
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
        [
            'spec' => [
                'type' => Hidden::class,
                'name' => 'addressUri',
                'attributes' => ['id' => 'addressUri'],
            ],
        ],
    ],
    'input_filter' => [
        'plz' => ['required' => true],
        'ort' => [
            'required' => false,
            'validators' => [
                [
                    'name' => NotEmpty::class,
                ],
            ],
        ],
        'strasse' => [
            'required' => false,
            'validators' => [
                [
                    'name' => NotEmpty::class,
                ],
            ],
        ],
        'hnr' => ['required' => false],
        'vermietet' => ['required' => false],
        'versbeginn' => ['required' => true],
        'versbeginn_datum' => ['required' => false],
        'gebdatum' => ['required' => true],
        'vorvers5' => ['required' => true],
        'schaeden5' => ['required' => true],
        'beamte' => ['required' => true],
        'verssummeauto' => ['required' => true],
        'verssumme' => ['required' => false],
        'glas' => ['required' => true],
        'elem' => ['required' => true],
        'grob' => ['required' => true],
        'kombirabatte' => ['required' => true],
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
        'wohnfl' => ['required' => true],
        'whg' => ['required' => true],
    ],
];
