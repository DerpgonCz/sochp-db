<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalFurEnum: int
{
    use Localized;
    use Arrayable;

    case FLAG_STANDARD = 0b1;
    case FLAG_LONG_HAIRED = 0b10;
    case FLAG_DOUBLE_REX = 0b100;
    case FLAG_FUZZ = 0b1000;
    case FLAG_REX = 0b10000;
    case FLAG_SATIN = 0b100000;
    case FLAG_VELVETEEN = 0b1000000;
    case FLAG_SILK = 0b10000000;
    case FLAG_SPHYNX = 0b100000000;
    case FLAG_PATCHWORK = 0b1000000000;

    public static function selectableGroups(): array
    {
        return [
            [
                self::FLAG_STANDARD,
            ],
            [
                self::FLAG_LONG_HAIRED,
                self::FLAG_DOUBLE_REX,
                self::FLAG_FUZZ,
                self::FLAG_REX,
                self::FLAG_SATIN,
                self::FLAG_SILK,
                self::FLAG_VELVETEEN,
                self::FLAG_SPHYNX,
                self::FLAG_PATCHWORK,
            ]
        ];
    }
}
