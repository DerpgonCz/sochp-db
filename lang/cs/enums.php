<?php

use App\Enums\Animal\AnimalBreedingTypeEnum;
use App\Enums\Animal\AnimalBuildEnum;
use App\Enums\Animal\AnimalColorFull;
use App\Enums\Animal\AnimalColorMink;
use App\Enums\Animal\AnimalColorShaded;
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
    ],
    AnimalFurEnum::class => [
        AnimalFurEnum::FLAG_STANDARD->value => 'standardní',
        AnimalFurEnum::FLAG_LONG_HAIRED->value => 'dlouhosrstý',
        AnimalFurEnum::FLAG_DOUBLE_REX->value => 'dvojitý rex',
        AnimalFurEnum::FLAG_FUZZ->value => 'fuzz',
        AnimalFurEnum::FLAG_REX->value => 'rex',
        AnimalFurEnum::FLAG_SATIN->value => 'saténový',
        AnimalFurEnum::FLAG_VELVETEEN->value => 'velvetýn',
        AnimalFurEnum::FLAG_SILK->value => 'hedvábná',
        AnimalFurEnum::FLAG_SPHYNX->value => 'sphynx',
        AnimalFurEnum::FLAG_PATCHWORK->value => 'patchwork',
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
        AnimalPrimaryMarkEnum::INDETERMINABLE->value => 'neurčitelná',
        AnimalPrimaryMarkEnum::SELF->value => 'bez kresby',
        AnimalPrimaryMarkEnum::AMERICAN_BERKSHIRE->value => 'americká',
        AnimalPrimaryMarkEnum::BERKSHIRE->value => 'berkšírská',
        AnimalPrimaryMarkEnum::EYED_WHITE->value => 'bílá',
        AnimalPrimaryMarkEnum::DALMATIAN->value => 'dalmatinská',
        AnimalPrimaryMarkEnum::ESSEX->value => 'essexská',
        AnimalPrimaryMarkEnum::BALDIE->value => 'essexská s čepicí',
        AnimalPrimaryMarkEnum::IRISH->value => 'irská',
        AnimalPrimaryMarkEnum::HOODED->value => 'japonská',
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
    ],
    AnimalBreedingTypeEnum::class => [
        AnimalBreedingTypeEnum::BREEDABLE_I->value => 'Chovný I',
        AnimalBreedingTypeEnum::BREEDABLE_II->value => 'Chovný II',
        AnimalBreedingTypeEnum::BREDDABLE_WITH_EXCEPTION->value => 'Chovný s výhradou',
        AnimalBreedingTypeEnum::NOT_BREEDABLE->value => 'Neuchovněný',
        AnimalBreedingTypeEnum::UNBREEDABLE->value => 'Neuchovnitelný',
    ],
    AnimalEffectEnum::class => [
        AnimalEffectEnum::FLAG_ROAN->value => 'husky',
        AnimalEffectEnum::FLAG_MARBLE->value => 'marble',
        AnimalEffectEnum::FLAG_MERLE->value => 'mramorovaná',
        AnimalEffectEnum::FLAG_SILVERMANE->value => 'obláčková',
        AnimalEffectEnum::FLAG_SILVERED->value => 'postříbřená',
        AnimalEffectEnum::FLAG_ODD_EYED->value => 'různooká',
    ],
    AnimalColorShaded::class => [
        AnimalColorShaded::ALBINO->value => 'albín',
        AnimalColorShaded::BURMESE->value => 'barmská',
        AnimalColorShaded::BISCUIT_CREAM->value => 'barmský albín',
        AnimalColorShaded::HIMALAYAN->value => 'himalájská',
        AnimalColorShaded::DEVIL_MARTEN->value => 'kuní',
        AnimalColorShaded::SIAMESE->value => 'siamská',
        AnimalColorShaded::SIAMESE_DEVIL->value => 'siamská kuní',
        AnimalColorShaded::IVORY->value => 'slonovinová',
        AnimalColorShaded::SABLE_BURMESE->value => 'sobolí',
        AnimalColorShaded::GOLDEN->value => 'zlatý albín',
        AnimalColorShaded::GOLDEN_SIAMESE->value => 'zlatý siamský',
        AnimalColorShaded::GOLDEN_HIMALAYAN->value => 'zlatý himalájský',
        AnimalColorShaded::PALE_BURMESE->value => 'světlá barmská',
        'eyes' => [
            AnimalEyesEnum::PINK->value => 'červenooká',
            AnimalEyesEnum::RED->value => 'červenooká',
            AnimalEyesEnum::RUBY->value => 'červenooká',
            AnimalEyesEnum::DARK_RUBY->value => 'červenooká',
            AnimalEyesEnum::BROWN->value => 'červenooká',
            AnimalEyesEnum::BLACK->value => 'černooká',
        ],
    ],
    AnimalColorFull::class => [
        AnimalColorFull::INDETERMINABLE->value => 'neurčitelná',
        AnimalColorFull::AGOUTI->value => 'aguti',
        AnimalColorFull::AMERICAN_BLUE->value => 'americká modrá',
        AnimalColorFull::BEIGE->value => 'béžová',
        AnimalColorFull::BUFF->value => 'buvolí',
        AnimalColorFull::BLACK->value => 'černá',
        AnimalColorFull::CHOCOLATE->value => 'čokoládová',
        AnimalColorFull::CHOCOLATE_AGOUTI->value => 'čokoládová aguti',
        AnimalColorFull::HAVANA->value => 'havanská',
        AnimalColorFull::HAVANA_AGOUTI->value => 'havanská aguti',
        AnimalColorFull::RUSSIAN_DOVE->value => 'holubičí',
        AnimalColorFull::RUSSIAN_DOVE_AGOUTI->value => 'holubičí aguti',
        AnimalColorFull::AMBER->value => 'jantarová',
        AnimalColorFull::LILAC->value => 'lila',
        AnimalColorFull::LILAC_AGOUTI->value => 'lila aguti',
        AnimalColorFull::MINK->value => 'mink',
        AnimalColorFull::BLUE_AGOUTI->value => 'modrá aguti',
        AnimalColorFull::GRAPHITE->value => 'německá modrá',
        AnimalColorFull::GRAPHITE_AGOUTI->value => 'německá modrá aguti',
        AnimalColorFull::PEARL->value => 'perlová',
        AnimalColorFull::SILVER_MINK->value => 'perlový mink',
        AnimalColorFull::PLATINUM->value => 'platinová',
        AnimalColorFull::PLATINUM_AGOUTI->value => 'platinová aguti',
        AnimalColorFull::FAWN->value => 'plavá',
        AnimalColorFull::RUSSIAN_BLUE->value => 'ruská modrá',
        AnimalColorFull::RUSSIAN_BLUE_AGOUTI->value => 'ruská modrá aguti',
        AnimalColorFull::RUSSIAN_PEARL->value => 'ruská perlová',
        AnimalColorFull::RUSSIAN_PEARL_AGOUTI->value => 'ruská perlová aguti',
        AnimalColorFull::RUSSIAN_SILVER->value => 'ruská stříbrná',
        AnimalColorFull::RUSSIAN_SILVER_AGOUTI->value => 'ruská stříbrná aguti',
        AnimalColorFull::CINNAMON->value => 'skořicová',
        AnimalColorFull::CINNAMON_PEARL->value => 'skořicová perlová',
        AnimalColorFull::SILVER->value => 'stříbrná',
        AnimalColorFull::SILVER_AGOUTI->value => 'stříbrná aguti',
        AnimalColorFull::CHAMPAGNE->value => 'šampanská',
        AnimalColorFull::DARK_PEARL->value => 'tmavá perlová',
        AnimalColorFull::TOPAZ->value => 'topazová',
        AnimalColorFull::ANOTHER_COLOUR->value => 'jiná',
        AnimalColorFull::RUSSIAN_PLATINUM->value => 'ruská platinová',
        AnimalColorFull::RUSSIAN_PLATINUM_AGOUTI->value => 'ruská platinová aguti',
        AnimalColorFull::RUSSIAN_BEIGE->value => 'ruská béžová',
        AnimalColorFull::RUSSIAN_FAWN->value => 'ruská plavá',
        AnimalColorFull::RUSSIAN_CHAMPAGNE->value => 'ruská šampaňská',
        AnimalColorFull::RUSSIAN_AMBER->value => 'ruská jantarová',
        AnimalColorFull::POWDER_BLUE->value => 'stříbitě modrá',
        AnimalColorFull::HONEY->value => 'medová',
        AnimalColorFull::HONEY_AGOUTI->value => 'medová aguti',
        AnimalColorFull::RUSSIAN_HONEY->value => 'ruská medová',
        AnimalColorFull::RUSSIAN_HONEY_AGOUTI->value => 'ruská medová aguti',
        AnimalColorFull::DOUBLE_MINK->value => 'dvojitá skočicová',
        AnimalColorFull::DOUBLE_MINK_AGOUTI->value => 'dvojitá skořicová aguti',
        AnimalColorFull::COFFEE->value => 'kávová',
        AnimalColorFull::COFFEE_AGOUTI->value => 'kávová aguti',
        AnimalColorFull::PLATINUM_PEARL->value => 'platinová perlová',
        AnimalColorFull::PLATINUM_PEARL_AGOUTI->value => 'platinová perlová aguti',
        AnimalColorFull::RUSSIAN_PLATINUM_PEARL->value => 'ruská platinová perlová',
        AnimalColorFull::RUSSIAN_PLATINUM_PEARL_AGOUTI->value => 'ruská platinová perlová aguti',
        AnimalColorFull::RUSSIAN_BUFF->value => 'ruská béžová',
        AnimalColorFull::RUSSIAN_TOPAZ->value => 'ruská topazová',
        AnimalColorFull::COCOA->value => 'kakaová',
        AnimalColorFull::COCOCA_AGOUTI->value => 'kakaová aguti',
        AnimalColorFull::CARAMEL->value => 'karamelová',
        AnimalColorFull::CARAMEL_AGOUTI->value => 'karamelová aguti',

        'siamese_himalayan' => [
            AnimalColorFull::AGOUTI->value => 's aguti znaky',
            AnimalColorFull::AMERICAN_BLUE->value => 's americkými modrými znaky',
            AnimalColorFull::BEIGE->value => 's béžovými znaky',
            AnimalColorFull::BUFF->value => 's buvolími znaky',
            AnimalColorFull::BLACK->value => 's hnědými znaky',
            AnimalColorFull::CHOCOLATE->value => 's čokoládovými znaky',
            AnimalColorFull::CHOCOLATE_AGOUTI->value => 's čokoládovými aguti znaky',
            AnimalColorFull::HAVANA->value => 's havanskými znaky',
            AnimalColorFull::HAVANA_AGOUTI->value => 's havanskými aguti znaky',
            AnimalColorFull::RUSSIAN_DOVE->value => 's holubičími znaky',
            AnimalColorFull::RUSSIAN_DOVE_AGOUTI->value => 's holubičími aguti znaky',
            AnimalColorFull::AMBER->value => 's jantarovými znaky',
            AnimalColorFull::LILAC->value => 's lila znaky',
            AnimalColorFull::LILAC_AGOUTI->value => 's lila aguti znaky',
            AnimalColorFull::MINK->value => 's mink znaky',
            AnimalColorFull::BLUE_AGOUTI->value => 's modrými aguti znaky',
            AnimalColorFull::GRAPHITE->value => 's německými modrými znaky',
            AnimalColorFull::GRAPHITE_AGOUTI->value => 's německými modrými aguti znaky',
            AnimalColorFull::PEARL->value => 's perlovými znaky',
            AnimalColorFull::SILVER_MINK->value => 's perlovými mink znaky',
            AnimalColorFull::PLATINUM->value => 's platinovými znaky',
            AnimalColorFull::PLATINUM_AGOUTI->value => 's platinovými aguti znaky',
            AnimalColorFull::FAWN->value => 's plavými znaky',
            AnimalColorFull::RUSSIAN_BLUE->value => 's ruskými modrými znaky',
            AnimalColorFull::RUSSIAN_BLUE_AGOUTI->value => 's ruskými modrými aguti znaky',
            AnimalColorFull::RUSSIAN_PEARL->value => 's ruskými perlovými znaky',
            AnimalColorFull::RUSSIAN_PEARL_AGOUTI->value => 's ruskými perlovými aguti znaky',
            AnimalColorFull::RUSSIAN_SILVER->value => 's ruskými stříbrnými znaky',
            AnimalColorFull::RUSSIAN_SILVER_AGOUTI->value => 's ruskými stříbrnými aguti znaky',
            AnimalColorFull::CINNAMON->value => 'se skořicovými znaky',
            AnimalColorFull::CINNAMON_PEARL->value => 'se skořicovými perlovými znaky',
            AnimalColorFull::SILVER->value => 'se stříbrnými znaky',
            AnimalColorFull::SILVER_AGOUTI->value => 'se stříbrnými aguti znaky',
            AnimalColorFull::CHAMPAGNE->value => 's šampaňskými znaky',
            AnimalColorFull::DARK_PEARL->value => 's tmavými perlovými znaky',
            AnimalColorFull::TOPAZ->value => 's topazovými znaky',
            AnimalColorFull::ANOTHER_COLOUR->value => 's jinými znaky',
            AnimalColorFull::RUSSIAN_PLATINUM->value => 's ruskými platinovými znaky',
            AnimalColorFull::RUSSIAN_PLATINUM_AGOUTI->value => 's ruskými platinovými aguti znaky',
            AnimalColorFull::RUSSIAN_BEIGE->value => 's ruskými béžovými znaky',
            AnimalColorFull::RUSSIAN_FAWN->value => 's ruskými plavými znaky',
            AnimalColorFull::RUSSIAN_CHAMPAGNE->value => 's ruskými šampaňskými znaky',
            AnimalColorFull::RUSSIAN_AMBER->value => 's ruskými jantarovými znaky',
            AnimalColorFull::POWDER_BLUE->value => 'se stíbitě modrými znaky',
            AnimalColorFull::HONEY->value => 's medovými znaky',
            AnimalColorFull::HONEY_AGOUTI->value => 's medovými aguti znaky',
            AnimalColorFull::RUSSIAN_HONEY->value => 's ruskými medovými znaky',
            AnimalColorFull::RUSSIAN_HONEY_AGOUTI->value => 's ruskými medovými aguti znaky',
            AnimalColorFull::DOUBLE_MINK->value => 's dvojitými skočicovými znaky',
            AnimalColorFull::DOUBLE_MINK_AGOUTI->value => 's dvojitými skořicovými aguti znaky',
            AnimalColorFull::COFFEE->value => 's kávovými znaky',
            AnimalColorFull::COFFEE_AGOUTI->value => 's kávovými aguti znaky',
            AnimalColorFull::PLATINUM_PEARL->value => 's platinovými perlovými znaky',
            AnimalColorFull::PLATINUM_PEARL_AGOUTI->value => 's platinovými perlovými aguti znaky',
            AnimalColorFull::RUSSIAN_PLATINUM_PEARL->value => 's ruskými platinovými perlovými znaky',
            AnimalColorFull::RUSSIAN_PLATINUM_PEARL_AGOUTI->value => 's ruskými platinovými perlovými aguti znaky',
            AnimalColorFull::RUSSIAN_BUFF->value => 's ruskými béžovými znaky',
            AnimalColorFull::RUSSIAN_TOPAZ->value => 's ruskými topazovými znaky',
            AnimalColorFull::COCOA->value => 's kakaovými znaky',
            AnimalColorFull::COCOCA_AGOUTI->value => 's kakaovými aguti znaky',
            AnimalColorFull::CARAMEL->value => 's karamelovými znaky',
            AnimalColorFull::CARAMEL_AGOUTI->value => 's karamelovými aguti znaky',
        ],
    ],
    AnimalColorMink::class => [
        AnimalColorMink::AMERICAN->value => 'americký',
        AnimalColorMink::BRITISH->value => 'britský',
        AnimalColorMink::AUSTRALIAN->value => 'australský',
    ],
];
