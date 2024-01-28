<?php

declare(strict_types=1);

namespace App\Services\Frontend\Animal\i18n;

use App\Enums\Animal\AnimalFurEnum;
use App\Models\Animal;

class AnimalFurTranslationService
{
    private const PRIORITY = [
        AnimalFurEnum::FLAG_STANDARD,
        AnimalFurEnum::FLAG_LONG_HAIRED,
        AnimalFurEnum::FLAG_DOUBLE_REX,
        AnimalFurEnum::FLAG_FUZZ,
        AnimalFurEnum::FLAG_REX,
        AnimalFurEnum::FLAG_SATIN,
        AnimalFurEnum::FLAG_VELVETEEN,
        AnimalFurEnum::FLAG_SILK,
        AnimalFurEnum::FLAG_SPHYNX,
        AnimalFurEnum::FLAG_PATCHWORK,
    ];

    public function __invoke(Animal $animal, ?string $locale = null): string
    {
        $validCases = [];

        foreach (AnimalFurEnum::cases() as $case) {
            if (($case->value & $animal->fur) === 0) {
                continue;
            }

            $validCases[] = $case;
        }

        return collect($validCases)
            ->sortBy(static fn (AnimalFurEnum $case): int => array_search($case, self::PRIORITY))
            ->map(static fn (AnimalFurEnum $case): string => __(sprintf('enums.%s.%s', AnimalFurEnum::class, $case->value), locale: $locale))
            ->join(' ');
    }
}
