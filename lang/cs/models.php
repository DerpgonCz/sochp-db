<?php

use App\Models\Animal;
use App\Models\Litter;
use App\Models\Station;

return [
    'fields' => [
        'actions' => 'Akce',
    ],
    Animal::class => [
        'status' => 'Stav',
        'variety' => 'Varieta',
        'fields' => [
            'name' => 'Jméno',
            'registration_no' => 'Registrační číslo',
            'fur' => 'Srst',
            'color' => 'Barva',
            'effect' => 'Efekt',
            'mark_primary' => 'Hlavní znak',
            'mark_secondary' => 'Vedlejší znak',
            'gender' => 'Pohlaví',
            'caretaker' => [
                'name' => 'Jméno',
                'station' => [
                    'name' => 'ChS',
                ],
            ],
            'litter' => [
                'name' => 'Označení',
                'station' => [
                    'name' => 'Název',
                    'owner' => [
                        'name' => 'Majitel',
                    ],
                ],
                'father' => [
                    'name' => 'Samec',
                ],
                'mother' => [
                    'name' => 'Samice',
                ],
                'happened_on' => 'Datum narození',
            ],
            'note' => 'Poznámka',
        ],
    ],
    Station::class => [
        'fields' => [
            'name' => 'Název',
            'state' => 'Status',
            'owner' => [
                'name' => 'Vlastník',
            ],
        ],
    ],
    Litter::class => [
        'fields' => [
            'happened_on' => 'Datum narození',
            'name' => 'Označení',
            'state' => 'Status',
            'mother' => [
                'name' => 'Samice',
            ],
            'father' => [
                'name' => 'Samec',
            ],
            'station' => [
                'name' => 'Chovná stanice',
            ],
            'children' => [
                'name' => 'Jméno',
            ],
            'owner' => 'Vlastník ChS',
        ],
        'children_count' => 'Počet potomků',
    ],
];
