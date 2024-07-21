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

    case CV = 0b1;
    case CH = 0b10;
    case GCH = 0b100;
    case ICH = 0b1000;
    case GICH = 0b10000;
    case SCH = 0b100000;

    public static function casesWithTitles(string $prefix = ''): object
    {
        $long = collect(self::casesWithTitlesParent('long'));
        $short = collect(self::casesWithTitlesParent('short'));

        return (object) $long
            ->mapWithKeys(static fn (string $longTitle, int $key): array => [$key => sprintf('%s (%s)', $longTitle, $short[$key])])
            ->toArray();
    }
}
