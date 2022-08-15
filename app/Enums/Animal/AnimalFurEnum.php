<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalFurEnum: int
{
    use Localized;
    use Arrayable;

    case FLAG_STANDARD = 0b0000001;
    case FLAG_LONG_HAIRED = 0b0000010;
    case FLAG_DOUBLE_REX = 0b0000100;
    case FLAG_FUZZ = 0b0001000;
    case FLAG_REX = 0b0010000;
    case FLAG_SATIN = 0b0100000;
    case FLAG_VELVETEEN = 0b1000000;

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
                self::FLAG_VELVETEEN,
            ],
        ];
    }

    public function isStandard(): bool
    {
        return ($this->value & self::FLAG_STANDARD->value) === self::FLAG_STANDARD->value;
    }
}