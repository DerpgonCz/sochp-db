<?php

declare(strict_types=1);

namespace App\Services\Frontend\Animal;

use App\Enums\GenderEnum;
use App\Models\Animal;
use App\Models\Station;

class AnimalSelectDataService
{
    public function buildViewDataForParentSelection(?Station $station = null): array
    {
        $stationAnimals = collect([]);
        $otherAnimals = Animal::listable()->with('litter', 'litter.station')->get()
            ->sortBy('litter.happened_on');


        if ($station) {
            $stationAnimals = $station->animals()->listable()->get()->sortBy('litter.happened_on');
            $otherAnimals = $otherAnimals->except($stationAnimals->pluck('id')->toArray());
        }

        return [
            'stationAnimalsMale' => $stationAnimals->where('gender', GenderEnum::MALE()),
            'stationAnimalsFemale' => $stationAnimals->where('gender', GenderEnum::FEMALE()),
            'otherAnimalsMale' => $otherAnimals->where('gender', GenderEnum::MALE()),
            'otherAnimalsFemale' => $otherAnimals->where('gender', GenderEnum::FEMALE()),
        ];
    }
}
