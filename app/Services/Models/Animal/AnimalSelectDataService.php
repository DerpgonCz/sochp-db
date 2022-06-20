<?php

declare(strict_types=1);

namespace App\Services\Models\Animal;

use App\Enums\GenderEnum;
use App\Models\Animal;
use App\Models\Station;

class AnimalSelectDataService
{
    public function buildViewDataForParentSelection(?Station $station = null): array
    {
        $stationAnimals = collect([]);
        $otherAnimals = Animal::with('litter', 'litter.station')->get()
            ->sortBy('litter.happened_on');

        if ($station) {
            $otherAnimals = $otherAnimals->except($station->animals->pluck('id')->toArray());
            $stationAnimals = $station->animals->sortBy('litter.happened_on');
        }

        return [
            'stationAnimalsMale' => $stationAnimals->where('gender', GenderEnum::MALE()),
            'stationAnimalsFemale' => $stationAnimals->where('gender', GenderEnum::FEMALE()),
            'otherAnimalsMale' => $otherAnimals->where('gender', GenderEnum::MALE()),
            'otherAnimalsFemale' => $otherAnimals->where('gender', GenderEnum::FEMALE()),
        ];
    }
}
