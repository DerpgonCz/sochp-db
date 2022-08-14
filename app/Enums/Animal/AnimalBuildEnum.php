<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalBuildEnum: int
{
    use Localized;
    use Arrayable;

    case FLAG_STANDARD = 0b0001;
    case FLAG_DUMBO = 0b0010;
    case FLAG_DWARF = 0b0100;
    case FLAG_MANX = 0b1000;

    public static function selectableGroups(): array
    {
        return [
            [
                self::FLAG_STANDARD,
            ],
            [
                self::FLAG_DUMBO,
                self::FLAG_DWARF,
                self::FLAG_MANX,
            ],
        ];
    }

    public function isStandard(): bool
    {
        return ($this->value & self::FLAG_STANDARD->value) === self::FLAG_STANDARD;
    }
}
