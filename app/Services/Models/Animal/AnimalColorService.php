<?php

declare(strict_types=1);

namespace App\Services\Models\Animal;

use App\Enums\Animal\AnimalColorFull;
use App\Enums\Animal\AnimalColorShaded;
use App\Models\Animal;

class AnimalColorService
{
    public function __invoke(Animal $animal): string
    {
        if (
            $animal->color_shaded === null
            && $animal->color_full !== null
            && $animal->color_mink === null
        ) {
            return __(sprintf('enums.%s.%s', AnimalColorFull::class, $animal->color_full->value));
        }

        if (
            $animal->color_shaded !== null
            && $animal->color_full !== null
            && $animal->color_mink === null
        ) {
            if (in_array($animal->color_shaded, [AnimalColorShaded::SIAMESE, AnimalColorShaded::HIMALAYAN])) {
                return sprintf(
                    '%s %s',
                    __(sprintf('enums.%s.%s', AnimalColorShaded::class, $animal->color_shaded->value)),
                    __(sprintf('enums.%s.siamese_himalayan.%s', AnimalColorFull::class, $animal->color_full->value)),
                );
            }

            return sprintf(
                '%s %s',
                __(sprintf('enums.%s.%s', AnimalColorFull::class, $animal->color_full->value)),
                __(sprintf('enums.%s.%s', AnimalColorShaded::class, $animal->color_shaded->value)),
            );
        }

        if (
            $animal->color_shaded === null
            && $animal->color_full !== null
            && $animal->color_mink === null
        ) {
            return __(sprintf('enums.%s.%s', AnimalColorFull::class, $animal->color_full->value));
        }
        if (
            $animal->color_shaded !== null
            && $animal->color_full === null
            && $animal->color_mink === null
        ) {
            return __(sprintf('enums.%s.%s', AnimalColorShaded::class, $animal->color_shaded->value));
        }

        return '???';
    }
}
