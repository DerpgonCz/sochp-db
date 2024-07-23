<?php

declare(strict_types=1);

namespace App\Services\Frontend\Animal\i18n;

use App\Enums\Animal\AnimalColorFull;
use App\Enums\Animal\AnimalColorMink;
use App\Enums\Animal\AnimalColorShaded;
use App\Models\Animal;

class AnimalColorTranslationService
{
    public function __invoke(Animal $animal, ?string $locale = null): string
    {
        $prependEyes = null;
        if (
            $animal->color_shaded !== null
            && in_array($animal->color_shaded, [
                AnimalColorShaded::HIMALAYAN,
                AnimalColorShaded::DEVIL_MARTEN,
                AnimalColorShaded::SIAMESE,
                AnimalColorShaded::SIAMESE_DEVIL,
            ])) {
            $prependEyes = sprintf(
                '%s ',
                __(sprintf('enums.%s.eyes.%s', AnimalColorShaded::class, $animal->eyes->value), locale: $locale)
            );
        }

        if (
            $animal->color_shaded === null
            && $animal->color_full !== null
            && ($animal->color_mink === null || $animal->color_mink === AnimalColorMink::INDETERMINABLE)
        ) {
            return __(sprintf('enums.%s.%s', AnimalColorFull::class, $animal->color_full->value), locale: $locale);
        }

        if (
            $animal->color_shaded !== null
            && ($animal->color_full === null || $animal->color_full === AnimalColorFull::INDETERMINABLE)
            && ($animal->color_mink === null || $animal->color_mink === AnimalColorMink::INDETERMINABLE)
        ) {
            return $prependEyes . __(sprintf('enums.%s.%s', AnimalColorShaded::class, $animal->color_shaded->value), locale: $locale);
        }

        if (
            $animal->color_shaded !== null
            && ($animal->color_full !== null && $animal->color_full !== AnimalColorFull::INDETERMINABLE)
            && ($animal->color_mink === null || $animal->color_mink === AnimalColorMink::INDETERMINABLE)
        ) {
            if (in_array($animal->color_shaded, [AnimalColorShaded::SIAMESE, AnimalColorShaded::HIMALAYAN])) {
                return sprintf(
                    '%s%s %s',
                    $prependEyes,
                    __(sprintf('enums.%s.%s', AnimalColorShaded::class, $animal->color_shaded->value), locale: $locale),
                    __(sprintf('enums.%s.siamese_himalayan.%s', AnimalColorFull::class, $animal->color_full->value), locale: $locale),
                );
            }

            return sprintf(
                '%s%s %s',
                $prependEyes,
                __(sprintf('enums.%s.%s', AnimalColorFull::class, $animal->color_full->value), locale: $locale),
                __(sprintf('enums.%s.%s', AnimalColorShaded::class, $animal->color_shaded->value), locale: $locale),
            );
        }

        if (
            $animal->color_shaded === null
            && ($animal->color_full !== null && $animal->color_full !== AnimalColorFull::INDETERMINABLE)
            && ($animal->color_mink !== null && $animal->color_mink !== AnimalColorMink::INDETERMINABLE)
        ) {
            return sprintf(
                '%s %s',
                __(sprintf('enums.%s.%s', AnimalColorFull::class, $animal->color_full->value), locale: $locale),
                __(sprintf('enums.%s.%s', AnimalColorMink::class, $animal->color_mink->value), locale: $locale),
            );
        }

        return sprintf(
            '%s %s %s',
            __(sprintf('enums.%s.%s', AnimalColorShaded::class, $animal->color_shaded->value), locale: $locale),
            __(sprintf('enums.%s.%s', AnimalColorFull::class, $animal->color_full->value), locale: $locale),
            __(sprintf('enums.%s.%s', AnimalColorMink::class, $animal->color_mink->value), locale: $locale),
        );
    }
}
