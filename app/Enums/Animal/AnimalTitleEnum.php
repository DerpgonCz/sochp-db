<?php

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalTitleEnum: int
{
    use Localized {
        Localized::casesWithTitles as casesWithTitlesParent;
    }
    use Arrayable;

    case FLAG_CV = 0b1;
    case FLAG_CH = 0b10;
    case FLAG_GCH = 0b100;
    case FLAG_ICH = 0b1000;
    case FLAG_GICH = 0b10000;
    case FLAG_SCH = 0b100000;

    public static function casesWithTitles(string $prefix = ''): object
    {
        $long = collect(self::casesWithTitlesParent('long'));
        $short = collect(self::casesWithTitlesParent('short'));

        return (object) $long
            ->mapWithKeys(static fn (string $longTitle, int $key): array => [$key => sprintf('%s (%s)', $longTitle, $short[$key])])
            ->toArray();
    }

    public static function selectableGroups(): array
    {
        return [
            [
                self::FLAG_CV,
                self::FLAG_CH,
                self::FLAG_GCH,
                self::FLAG_ICH,
                self::FLAG_GICH,
                self::FLAG_SCH,
            ]
        ];
    }
}
