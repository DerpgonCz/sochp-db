<?php

namespace App\Policies;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimalPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Animal $animal)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Animal $animal)
    {
        //
    }

    public function delete(User $user, Animal $animal)
    {
        //
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
