<?php

declare(strict_types=1);

namespace App\Enums\Animal;

enum AnimalColorFull: int
{
    case INDETERMINABLE = 0;
    case AGOUTI = 1;
    case AMERICAN_BLUE = 2;
    case BEIGE = 3;
    case BUFF = 4;
    case BLACK = 5;
    case CHOCOLATE = 6;
    case CHOCOLATE_AGOUTI = 7;
    case HAVANA = 8;
    case HAVANA_AGOUTI = 9;
    case RUSSIAN_DOVE = 10;
    case RUSSIAN_DOVE_AGOUTI = 11;
    case AMBER = 12;
    case LILAC = 13;
    case LILAC_AGOUTI = 14;
    case MINK = 15;
    case BLUE_AGOUTI = 16;
    case GRAPHITE = 17;
    case GRAPHITE_AGOUTI = 18;
    case PEARL = 19;
    case SILVER_MINK = 20;
    case PLATINUM = 21;
    case PLATINUM_AGOUTI = 22;
    case FAWN = 23;
    case RUSSIAN_BLUE = 24;
    case RUSSIAN_BLUE_AGOUTI = 25;
    case RUSSIAN_PEARL = 26;
    case RUSSIAN_PEARL_AGOUTI = 27;
    case RUSSIAN_SILVER = 28;
    case RUSSIAN_SILVER_AGOUTI = 29;
    case CINNAMON = 30;
    case CINNAMON_PEARL = 31;
    case SILVER = 32;
    case SILVER_AGOUTI = 33;
    case CHAMPAGNE = 34;
    case DARK_PEARL = 35;
    case TOPAZ = 36;
    case ANOTHER_COLOUR = 37;
    case RUSSIAN_PLATINUM = 38;
    case RUSSIAN_PLATINUM_AGOUTI = 39;
    case RUSSIAN_BEIGE = 40;
    case RUSSIAN_FAWN = 41;
    case RUSSIAN_CHAMPAGNE = 42;
    case RUSSIAN_AMBER = 43;
    case POWDER_BLUE = 44;
    case HONEY = 45;
    case HONEY_AGOUTI = 46;
    case RUSSIAN_HONEY = 47;
    case RUSSIAN_HONEY_AGOUTI = 48;
    case DOUBLE_MINK = 49;
    case DOUBLE_MINK_AGOUTI = 50;
    case COFFEE = 51;
    case COFFEE_AGOUTI = 52;
    case PLATINUM_PEARL = 53;
    case PLATINUM_PEARL_AGOUTI = 54;
    case RUSSIAN_PLATINUM_PEARL = 55;
    case RUSSIAN_PLATINUM_PEARL_AGOUTI = 56;
    case RUSSIAN_BUFF = 57;
    case RUSSIAN_TOPAZ = 58;
    case COCOA = 59;
    case COCOCA_AGOUTI = 60;
    case CARAMEL = 61;
    case CARAMEL_AGOUTI = 62;


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
        self::PLATINUM,
        self::PLATINUM_AGOUTI,
        self::RUSSIAN_PLATINUM,
        self::RUSSIAN_PLATINUM_AGOUTI,
        self::HONEY,
        self::HONEY_AGOUTI,
        self::RUSSIAN_HONEY,
        self::RUSSIAN_HONEY_AGOUTI,
        self::DOUBLE_MINK,
        self::DOUBLE_MINK_AGOUTI,
        self::COFFEE,
        self::COFFEE_AGOUTI,
        self::PLATINUM_PEARL,
        self::PLATINUM_PEARL_AGOUTI,
        self::RUSSIAN_PLATINUM_PEARL,
        self::RUSSIAN_PLATINUM_PEARL_AGOUTI,
        self::RUSSIAN_BUFF,
        self::RUSSIAN_TOPAZ,
    ];
}
