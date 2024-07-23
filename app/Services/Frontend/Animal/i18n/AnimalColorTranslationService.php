<?php

declare(strict_types=1);

namespace App\Services\Frontend\Animal\i18n;

use App\Enums\Animal\AnimalColorFull;
use App\Enums\Animal\AnimalColorMink;
use App\Enums\Animal\AnimalColorShaded;
use App\Models\Animal;

use function Ramsey\Uuid\v1;

class AnimalColorTranslationService
{
    public function __invoke(Animal $animal, ?string $locale = null): string
    {
        if ($animal->color_full === null) {
            return '';
        }

        $colors = [];

        if (
            in_array($animal->color_shaded, [
            AnimalColorShaded::HIMALAYAN,
            AnimalColorShaded::DEVIL_MARTEN,
            AnimalColorShaded::SIAMESE,
            AnimalColorShaded::SIAMESE_DEVIL,
            ], true
        )) {
            $colors[] = __(sprintf('enums.%s.eyes.%s', AnimalColorShaded::class, $animal->eyes->value), locale: $locale);
        }
        
        if (
            !in_array($animal->color_shaded, [AnimalColorShaded::SIAMESE, AnimalColorShaded::HIMALAYAN, AnimalColorShaded::DEVIL_MARTEN, AnimalColorShaded::SIAMESE_DEVIL], true)
            && ($animal->color_shaded === null || $animal->color_full !== AnimalColorFull::BLACK)
        ) {
            $colors[] = __(sprintf('enums.%s.%s', AnimalColorFull::class, $animal->color_full->value), locale: $locale);
        }
        
        if ($animal->color_shaded !== null) {            
            $colors[] = __(sprintf('enums.%s.%s', AnimalColorShaded::class, $animal->color_shaded->value), locale: $locale);

            if (in_array($animal->color_shaded, [AnimalColorShaded::SIAMESE, AnimalColorShaded::HIMALAYAN], true)) {
                $colors[] = __(sprintf('enums.%s.siamese_himalayan.%s', AnimalColorFull::class, $animal->color_full->value), locale: $locale);
            }
            
            if (
                in_array($animal->color_shaded, [AnimalColorShaded::DEVIL_MARTEN, AnimalColorShaded::SIAMESE_DEVIL], true)
                && $animal->color_full !== AnimalColorFull::BLACK
            ) {
                $colors[] = __(sprintf('enums.%s.%s', AnimalColorFull::class, $animal->color_full->value), locale: $locale);
            }
        }

        if ($animal->color_mink !== null && $animal->color_mink !== AnimalColorMink::INDETERMINABLE) {
            $colors[] = '(' .__(sprintf('enums.%s.%s', AnimalColorMink::class, $animal->color_mink->value), locale: $locale) . ')';
        }

        return implode(' ', $colors,);
    }
}
