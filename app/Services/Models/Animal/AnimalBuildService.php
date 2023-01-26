<?php

declare(strict_types=1);

namespace App\Services\Models\Animal;

use App\Enums\Animal\AnimalBuildEnum;
use App\Models\Animal;

class AnimalBuildService
{
    private const PRIORITY = [
        AnimalBuildEnum::FLAG_STANDARD,
        AnimalBuildEnum::FLAG_DUMBO,
        AnimalBuildEnum::FLAG_DWARF,
        AnimalBuildEnum::FLAG_MANX,
    ];

    public function __invoke(Animal $animal): string
    {
        $validCases = [];

        foreach (AnimalBuildEnum::cases() as $case) {
            if (($case->value & $animal->build) === 0) {
                continue;
            }

            $validCases[] = $case;
        }

        return collect($validCases)
            ->sortBy(static fn (AnimalBuildEnum $case): int => array_search($case, self::PRIORITY))
            ->map(static fn (AnimalBuildEnum $case): string => __(sprintf('enums.%s.%s', AnimalBuildEnum::class, $case->value)))
            ->join(' ');
    }
}
