<?php

declare(strict_types=1);

namespace App\Services\Frontend\Animal\i18n;

use App\Enums\Animal\AnimalBuildEnum;
use App\Enums\Animal\AnimalFurEnum;
use App\Models\Animal;

class AnimalVarietyTranslationService
{
    public function __invoke(Animal $animal, ?string $locale = null): string
    {
        $isFurStandard = $animal->fur === AnimalFurEnum::FLAG_STANDARD->value;
        $isBuildStandard = $animal->build === AnimalBuildEnum::FLAG_STANDARD->value;
        if ($isFurStandard && $isBuildStandard) {
            return __('standard');
        }

        $fur = (new AnimalFurTranslationService())($animal, $locale);
        $build = (new AnimalBuildTranslationService())($animal, $locale);

        if ($isFurStandard && !$isBuildStandard) {
            return $build;
        } elseif (!$isFurStandard && $isBuildStandard) {
            return $fur;
        }

        return sprintf('%s %s', $build, $fur);
    }
}
