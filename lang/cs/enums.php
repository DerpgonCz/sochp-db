<?php

use App\Enums\Animal\AnimalBreedingTypeEnum;
use App\Enums\Animal\AnimalBuildEnum;
use App\Enums\Animal\AnimalEffectEnum;
use App\Enums\Animal\AnimalEyesEnum;
use App\Enums\Animal\AnimalFurEnum;
use App\Enums\Animal\AnimalPrimaryMarkEnum;
use App\Enums\Animal\AnimalSecondaryMarkEnum;
use App\Enums\GenderEnum;

return [
    GenderEnum::class => [
        GenderEnum::MALE => 'Samec',
        GenderEnum::FEMALE => 'Samice',
    ],
    AnimalBuildEnum::class => [
        AnimalBuildEnum::FLAG_STANDARD->value => 'standardní',
        AnimalBuildEnum::FLAG_DUMBO->value => 'dumbo',
        AnimalBuildEnum::FLAG_DWARF->value => 'minipotkan',
        AnimalBuildEnum::FLAG_MANX->value => 'bezocasý',
        AnimalBuildEnum::FLAG_DUMBO->value | AnimalBuildEnum::FLAG_DWARF->value => 'dumbo minipotkan',
        AnimalBuildEnum::FLAG_DUMBO->value | AnimalBuildEnum::FLAG_MANX->value => 'dumbo bezocasý',
        AnimalBuildEnum::FLAG_DWARF->value | AnimalBuildEnum::FLAG_MANX->value => 'minipotkan bezocasý',
        AnimalBuildEnum::FLAG_DUMBO->value | AnimalBuildEnum::FLAG_DWARF->value | AnimalBuildEnum::FLAG_MANX->value => 'dumbo minipotkan bezocasý',
    ],
    AnimalFurEnum::class => [
        AnimalFurEnum::FLAG_STANDARD->value => 'standardní',
        AnimalFurEnum::FLAG_LONG_HAIRED->value => 'dlouhosrstý',
        AnimalFurEnum::FLAG_DOUBLE_REX->value => 'dvojitý rex',
        AnimalFurEnum::FLAG_FUZZ->value => 'fuzz',
        AnimalFurEnum::FLAG_REX->value => 'rex',
        AnimalFurEnum::FLAG_SATIN->value => 'saténový',
        AnimalFurEnum::FLAG_VELVETEEN->value => 'velvetýn',
    ],
    AnimalEyesEnum::class => [
        AnimalEyesEnum::PINK->value => 'růžová',
        AnimalEyesEnum::RED->value => 'červená',
        AnimalEyesEnum::RUBY->value => 'rubínová',
        AnimalEyesEnum::DARK_RUBY->value => 'tmavá rubínová',
        AnimalEyesEnum::BROWN->value => 'hnědá',
        AnimalEyesEnum::BLACK->value => 'černá',
    ],
    AnimalPrimaryMarkEnum::class => [
        AnimalPrimaryMarkEnum::AMERICAN_BERKSHIRE->value => 'americká',
        AnimalPrimaryMarkEnum::BERKSHIRE_DOWN_UNDER->value => 'australská',
        AnimalPrimaryMarkEnum::HOODED_DOWN_UNDER->value => 'australská s pruhem',
        AnimalPrimaryMarkEnum::BANDED_DOWN_UNDER->value => 'australská se širokým pruhem',
        AnimalPrimaryMarkEnum::VARIEGATED_DOWN_UNDER->value => 'australská strakovaná',
        AnimalPrimaryMarkEnum::VARIEBERK_DOWN_UNDER->value => 'australská strakovaná berkšírská',
        AnimalPrimaryMarkEnum::BERKSHIRE->value => 'berkšírská',
        AnimalPrimaryMarkEnum::self->value => 'bez kresby',
        AnimalPrimaryMarkEnum::EYED_WHITE->value => 'bílá',
        AnimalPrimaryMarkEnum::DALMATIAN->value => 'dalmatinská',
        AnimalPrimaryMarkEnum::ESSEX->value => 'essexská',
        AnimalPrimaryMarkEnum::BALDIE->value => 'essexská s čepicí',
        AnimalPrimaryMarkEnum::IRISH->value => 'irská',
        AnimalPrimaryMarkEnum::HOODED->value => 'japonská',
        AnimalPrimaryMarkEnum::MISMARKED->value => 'nestandardní',
        AnimalPrimaryMarkEnum::BAREBACK->value => 's bílými zády',
        AnimalPrimaryMarkEnum::CAPPED->value => 's čepicí',
        AnimalPrimaryMarkEnum::PATCHED->value => 's flíčkem',
        AnimalPrimaryMarkEnum::MASKED->value => 's maskou',
        AnimalPrimaryMarkEnum::COLLARED->value => 's obojkem',
        AnimalPrimaryMarkEnum::BANDED->value => 'se širokým pruhem',
        AnimalPrimaryMarkEnum::VARIEGATED->value => 'strakovaná',
        AnimalPrimaryMarkEnum::VARIEBERK->value => 'strakovaná berkšírská',
        AnimalPrimaryMarkEnum::VAN->value => 'turecká',
    ],
    AnimalSecondaryMarkEnum::class => [
        AnimalSecondaryMarkEnum::BLAZED->value => 's lysinou',
        AnimalSecondaryMarkEnum::SPOTTED->value => 's hvězdou',
        AnimalSecondaryMarkEnum::NON_STANDARD->value => 's nestandardní kresbou na hlavě',
    ],
    AnimalBreedingTypeEnum::class => [
        AnimalBreedingTypeEnum::BREEDABLE_I->value => 'Chovný I',
        AnimalBreedingTypeEnum::BREEDABLE_II->value => 'Chovný II',
        AnimalBreedingTypeEnum::BREDDABLE_WITH_EXCEPTION->value => 'Chovný s výhradou',
        AnimalBreedingTypeEnum::NOT_BREEDABLE->value => 'Neuchovněný',
        AnimalBreedingTypeEnum::UNBREEDABLE->value => 'Neuchovnitelný',
    ],
    AnimalEffectEnum::class => [
        AnimalEffectEnum::ROAN->value => 'husky',
        AnimalEffectEnum::MARBLE->value => 'marble',
        AnimalEffectEnum::MERLE->value => 'mramorovaná',
        AnimalEffectEnum::SILVERMANE->value => 'obláčková',
        AnimalEffectEnum::SILVERED->value => 'postříbřená',
        AnimalEffectEnum::ODD_EYED->value => 'různooká',
    ],
];
