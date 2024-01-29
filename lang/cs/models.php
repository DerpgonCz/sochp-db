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
            'build' => 'Stavba těla',
            'fur' => 'Srst',
            'color' => 'Barva srsti',
            'effect' => 'Efekt',
            'eyes' => 'Barva očí',
            'mark' => 'Kresba',
            'mark_primary' => 'Kresba I',
            'mark_secondary' => 'Kresba II',
            'gender' => 'Pohlaví',
            'breeding_type' => 'Chovnost',
            'date_of_birth' => 'Datum narození',
            'died_on' => 'Datum smrti',
            'breeder_name' => 'Chovatel',
            'caretaker' => [
                'name' => 'Jméno',
                'station' => [
                    'name' => 'ChS',
                ],
            ],
            'litter' => [
                'name' => 'Označení',
                'registration_no' => 'Číslo registrace',
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
            'name' => 'Označení',
            'state' => 'Status',
            'happened_on' => 'Datum narození',
            'registration_no' => 'Registrační číslo',
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
