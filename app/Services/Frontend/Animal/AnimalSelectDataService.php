<?php

declare(strict_types=1);

namespace App\Services\Frontend\Animal;

use Illuminate\Support\Facades\Auth;
use App\Enums\GenderEnum;
use App\Enums\Auth\PermissionsEnum;
use App\Models\Animal;

class AnimalSelectDataService
{
    public function buildViewDataForParentSelection(): array
    {
        $ownedAnimals = collect();
        $otherAnimals = Animal::listable()->with('litter', 'litter.station')->get()
            ->sortBy('litter.happened_on');
        $user = Auth::user();
        $canManageLitters = $user->hasPermissionTo(PermissionsEnum::MANAGE_LITTERS->value);

        $ownedAnimals = $user->animals()->listable()->get()->sortBy('litter.happened_on');
        $otherAnimals = $otherAnimals->except($ownedAnimals->pluck('id')->toArray());

        return [
            'ownedAnimalsMale' => $ownedAnimals->where('gender', GenderEnum::MALE()),
            'ownedAnimalsFemale' => $ownedAnimals->where('gender', GenderEnum::FEMALE()),
            'otherAnimalsMale' => $otherAnimals->where('gender', GenderEnum::MALE()),
            'otherAnimalsFemale' => $canManageLitters ? $otherAnimals->where('gender', GenderEnum::FEMALE()) : [],
        ];
    }
}
