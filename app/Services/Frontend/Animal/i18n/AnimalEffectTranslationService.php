<?php

declare(strict_types=1);

namespace App\Services\Frontend\Animal\i18n;

use App\Enums\Animal\AnimalEffectEnum;
use App\Models\Animal;

class AnimalEffectTranslationService
{
    private const PRIORITY = [
        // TODO: Sort
        AnimalEffectEnum::FLAG_MARBLE,
        AnimalEffectEnum::FLAG_MERLE,
        AnimalEffectEnum::FLAG_SILVERMANE,
        AnimalEffectEnum::FLAG_SILVERED,
        AnimalEffectEnum::FLAG_ODD_EYED,

        // Sorted
        AnimalEffectEnum::FLAG_ROAN,
    ];

    public function __invoke(Animal $animal, ?string $locale = null): string
    {
        $validCases = [];

        foreach (AnimalEffectEnum::cases() as $case) {
            if (($case->value & $animal->effect) === 0) {
                continue;
            }

            $validCases[] = $case;
        }

        return collect($validCases)
            ->sortBy(static fn (AnimalEffectEnum $case): int => array_search($case, self::PRIORITY))
            ->map(static fn (AnimalEffectEnum $case): string => __(sprintf('enums.%s.%s', AnimalEffectEnum::class, $case->value), locale: $locale))
            ->join(' ');
    }
}
