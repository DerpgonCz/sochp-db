<?php

namespace App\Policies;

use App\Enums\LitterStateEnum;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimalPolicy
{
    use HandlesAuthorization;

    private function owns(?User $user, Animal $animal): bool
    {
        return $user?->id === $animal->litter->station->owner_id;
    }

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Animal $animal)
    {
        //
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Animal $animal): bool
    {
        $ownsAnimal = $this->owns($user, $animal);
        $isAnimalRegistered = $animal->litter->state->is(LitterStateEnum::REGISTERED);

        return $ownsAnimal && $isAnimalRegistered;
    }

    public function delete(User $user, Animal $animal): bool
    {
        return $user->can('update', $animal->litter);
    }

    public function restore(User $user, Animal $animal)
    {
        //
    }

    public function forceDelete(User $user, Animal $animal)
    {
        //
    }
}
