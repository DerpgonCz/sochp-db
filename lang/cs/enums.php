<?php

use App\Enums\Animal\AnimalBuildEnum;
use App\Enums\GenderEnum;

return [
    GenderEnum::class => [
        GenderEnum::MALE => 'Samec',
        GenderEnum::FEMALE => 'Samice',
    ],
    AnimalBuildEnum::class => [
        AnimalBuildEnum::STANDARD->value => __('Standard'),
        AnimalBuildEnum::DUMBO->value => 'Dumbo',
        AnimalBuildEnum::DWARF->value => 'Minipotkan',
        AnimalBuildEnum::MANX->value => 'Bezocasí',
        AnimalBuildEnum::DUMBO_DWARF->value => 'Dumbo minipotkan',
        AnimalBuildEnum::DUMBO_MANX->value => 'Dumbo bezocasí',
        AnimalBuildEnum::DWARF_MANX->value => 'Minipotkan bezocasí',
        AnimalBuildEnum::DUMBO_DWARF_MANX->value => 'Dumbo minipotkan bezocasí',
    ]
];
