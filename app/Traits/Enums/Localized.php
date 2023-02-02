<?php

declare(strict_types=1);

namespace App\Traits\Enums;

trait Localized
{
    public static function casesWithTitles(): array
    {
        return collect(self::cases())
            ->mapWithKeys(static fn (self $case): array => [$case->value => __(sprintf('enums.%s.%s', self::class, $case->value))])
            ->toArray();
    }
}
