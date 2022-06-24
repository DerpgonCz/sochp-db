<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalBuildEnum: int
{
    use Localized;
    use Arrayable;

    private const STANDARD_FLAG = 0b0001;
    private const DUMBO_FLAG = 0b0010;
    private const DWARF_FLAG = 0b0100;
    private const MANX_FLAG = 0b1000;

    case STANDARD = self::STANDARD_FLAG;
    case DUMBO = self::DUMBO_FLAG;
    case DWARF = self::DWARF_FLAG;
    case MANX = self::MANX_FLAG;
    case DUMBO_DWARF = self::DUMBO_FLAG | self::DWARF_FLAG;
    case DUMBO_MANX = self::DUMBO_FLAG | self::MANX_FLAG;
    case DWARF_MANX = self::DWARF_FLAG | self::MANX_FLAG;
    case DUMBO_DWARF_MANX = self::DUMBO_FLAG | self::DWARF_FLAG | self::MANX_FLAG;

    public static function flags(): array
    {
        return [
            self::STANDARD_FLAG,
            self::DUMBO_FLAG,
            self::DWARF_FLAG,
            self::MANX_FLAG,
        ];
    }

    public static function flagsWithTitles(): array
    {
        return collect(self::casesWithTitles())
            ->only(self::flags())
            ->toArray();
    }

    public static function selectableGroups(): array
    {
        return [
            [
                self::STANDARD_FLAG,
            ],
            [
                self::DUMBO_FLAG,
                self::DWARF_FLAG,
                self::MANX_FLAG,
            ],
        ];
    }

    public function isStandard(): bool
    {
        return ($this->value & self::STANDARD_FLAG) === self::STANDARD_FLAG;
    }
}
