<?php

use App\Enums\Animal\AnimalBreedingTypeEnum;
use App\Enums\Animal\AnimalBuildEnum;
use App\Enums\Animal\AnimalEffectEnum;
use App\Enums\Animal\AnimalEyesEnum;
use App\Enums\Animal\AnimalFurEnum;
use App\Enums\Animal\AnimalPrimaryMarkEnum;
use App\Enums\GenderEnum;

return [
    GenderEnum::class => [
        GenderEnum::MALE => 'Sire',
        GenderEnum::FEMALE => 'Dam',
    ],
    AnimalBuildEnum::class => [
        AnimalBuildEnum::FLAG_STANDARD->value => __('standard'),
        AnimalBuildEnum::FLAG_DUMBO->value => 'dumbo',
        AnimalBuildEnum::FLAG_DWARF->value => 'dwarf',
        AnimalBuildEnum::FLAG_MANX->value => 'manx',
    ],
    AnimalFurEnum::class => [
        AnimalFurEnum::FLAG_STANDARD->value => 'longhaired',
        AnimalFurEnum::FLAG_LONG_HAIRED->value => 'double rex',
        AnimalFurEnum::FLAG_DOUBLE_REX->value => 'fuzz',
        AnimalFurEnum::FLAG_FUZZ->value => 'rex',
        AnimalFurEnum::FLAG_REX->value => 'satin',
        AnimalFurEnum::FLAG_SATIN->value => 'standard',
        AnimalFurEnum::FLAG_VELVETEEN->value => 'velveteen',
    ],
    AnimalEyesEnum::class => [
        AnimalEyesEnum::PINK->value => 'pink',
        AnimalEyesEnum::RED->value => 'red',
        AnimalEyesEnum::RUBY->value => 'ruby',
        AnimalEyesEnum::DARK_RUBY->value => 'dark ruby',
        AnimalEyesEnum::BROWN->value => 'brown',
        AnimalEyesEnum::BLACK->value => 'black',
    ],
    AnimalPrimaryMarkEnum::class => [
        AnimalPrimaryMarkEnum::AMERICAN_BERKSHIRE->value => 'american berkshire',
        AnimalPrimaryMarkEnum::BERKSHIRE_DOWN_UNDER->value => 'berkshire down under',
        AnimalPrimaryMarkEnum::HOODED_DOWN_UNDER->value => 'hooded down under',
        AnimalPrimaryMarkEnum::BANDED_DOWN_UNDER->value => 'banded down under',
        AnimalPrimaryMarkEnum::VARIEGATED_DOWN_UNDER->value => 'variegated down under',
        AnimalPrimaryMarkEnum::VARIEBERK_DOWN_UNDER->value => 'varieberk down under',
        AnimalPrimaryMarkEnum::BERKSHIRE->value => 'berkshire',
        AnimalPrimaryMarkEnum::self->value => 'self',
        AnimalPrimaryMarkEnum::EYED_WHITE->value => '„colour“ eyed white',
        AnimalPrimaryMarkEnum::DALMATIAN->value => 'dalmatian',
        AnimalPrimaryMarkEnum::ESSEX->value => 'essex',
        AnimalPrimaryMarkEnum::BALDIE->value => 'baldie',
        AnimalPrimaryMarkEnum::IRISH->value => 'irish',
        AnimalPrimaryMarkEnum::HOODED->value => 'hooded',
        AnimalPrimaryMarkEnum::MISMARKED->value => 'mismarked',
        AnimalPrimaryMarkEnum::BAREBACK->value => 'bareback',
        AnimalPrimaryMarkEnum::CAPPED->value => 'capped',
        AnimalPrimaryMarkEnum::PATCHED->value => 'patched',
        AnimalPrimaryMarkEnum::MASKED->value => 'masked',
        AnimalPrimaryMarkEnum::COLLARED->value => 'collared',
        AnimalPrimaryMarkEnum::BANDED->value => 'banded',
        AnimalPrimaryMarkEnum::VARIEGATED->value => 'variegated',
        AnimalPrimaryMarkEnum::VARIEBERK->value => 'varieberk',
        AnimalPrimaryMarkEnum::VAN->value => 'van',
    ],
    AnimalBreedingTypeEnum::class => [
        AnimalBreedingTypeEnum::BREEDABLE_I->value => 'Breedable I',
        AnimalBreedingTypeEnum::BREEDABLE_II->value => 'Breedable II',
        AnimalBreedingTypeEnum::BREDDABLE_WITH_EXCEPTION->value => 'Breedable with exception',
        AnimalBreedingTypeEnum::NOT_BREEDABLE->value => 'Not breedable',
        AnimalBreedingTypeEnum::UNBREEDABLE->value => 'Unbreadable',
    ],
    AnimalEffectEnum::class => [
        AnimalEffectEnum::FLAG_ROAN->value => 'roan',
        AnimalEffectEnum::FLAG_MARBLE->value => 'marble',
        AnimalEffectEnum::FLAG_MERLE->value => 'merle',
        AnimalEffectEnum::FLAG_SILVERMANE->value => 'silvermane',
        AnimalEffectEnum::FLAG_SILVERED->value => 'silvered',
        AnimalEffectEnum::FLAG_ODD_EYED->value => 'odd-eyed',
    ],
];
