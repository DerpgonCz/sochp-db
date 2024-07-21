<?php

declare(strict_types=1);

namespace App\Traits\Enums;

trait Localized
{
    public static function casesWithTitles(string $prefix = ''): object
    {
        return (object) collect(self::cases())
            ->mapWithKeys(
                static fn (self $case): array => [
                    $case->value => __(sprintf('enums.%s.%s%s', self::class, ltrim($prefix . '.', '.'), $case->value)),
                ]
            )
            ->toArray();
    }
}
