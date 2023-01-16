<?php

declare(strict_types=1);

namespace App\Enums\Animal;

enum AnimalColorFull: int
{
    case AGOUTI = 0;
    case AMERICAN_BLUE = 1;
    case BEIGE = 2;
    case BUFF = 3;
    case BLACK = 4;
    case CHOCOLATE = 5;
    case CHOCOLATE_AGOUTI = 6;
    case HAVANA = 7;
    case HAVANA_AGOUTI = 8;
    case RUSSIAN_DOVE = 9;
    case RUSSIAN_DOVE_AGOUTI = 10;
    case AMBER = 11;
    case LILAC = 12;
    case LILAC_AGOUTI = 13;
    case MINK = 14;
    case BLUE_AGOUTI = 15;
    case GRAPHITE = 16;
    case GRAPHITE_AGOUTI = 17;
    case PEARL = 18;
    case SILVER_MINK = 19;
    case PLATINUM = 20;
    case PLATINUM_AGOUTI = 21;
    case FAWN = 22;
    case RUSSIAN_BLUE = 23;
    case RUSSIAN_BLUE_AGOUTI = 24;
    case RUSSIAN_PEARL = 25;
    case RUSSIAN_PEARL_AGOUTI = 26;
    case RUSSIAN_SILVER = 27;
    case RUSSIAN_SILVER_AGOUTI = 28;
    case CINNAMON = 29;
    case CINNAMON_PEARL = 30;
    case SILVER = 31;
    case SILVER_AGOUTI = 32;
    case CHAMPAGNE = 33;
    case DARK_PEARL = 34;
    case TOPAZ = 35;
    case ANOTHER_COLOUR = 36;

    public const MINK_COLORS = [
        self::BUFF,
        self::HAVANA,
        self::HAVANA_AGOUTI,
        self::RUSSIAN_DOVE,
        self::RUSSIAN_DOVE_AGOUTI,
        self::MINK,
        self::PEARL,
        self::SILVER_MINK,
        self::RUSSIAN_PEARL,
        self::RUSSIAN_PEARL_AGOUTI,
        self::CINNAMON,
        self::CINNAMON_PEARL,
        self::DARK_PEARL,
        self::TOPAZ,
    ];
}
