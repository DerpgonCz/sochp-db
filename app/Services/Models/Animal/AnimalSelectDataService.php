<?php

declare(strict_types=1);

namespace App\Services\Models\Animal;

use App\Enums\GenderEnum;
use App\Models\Animal;
use App\Models\Station;

class AnimalSelectDataService
{
    public function buildViewDataForParentSelection(Station $station): array
    {
        $stationAnimals = $station->animals
            ->sortBy('litter.happened_on');
        $otherAnimals = Animal::with('litter', 'litter.station')->get()
            ->sortBy('litter.happened_on')
            ->except($station->animals->pluck('id')->toArray());

        return [
            'stationAnimalsMale' => $stationAnimals->where('gender', GenderEnum::MALE()),
            'stationAnimalsFemale' => $stationAnimals->where('gender', GenderEnum::FEMALE()),
            'otherAnimalsMale' => $otherAnimals->where('gender', GenderEnum::MALE()),
            'otherAnimalsFemale' => $otherAnimals->where('gender', GenderEnum::FEMALE()),
        ];
    }
}
