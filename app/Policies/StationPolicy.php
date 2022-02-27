<?php

namespace App\Policies;

use App\Enums\StationStateEnum;
use App\Models\Station;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class StationPolicy
{
    use HandlesAuthorization;

    public function approve(User $user): bool
    {
        return Gate::forUser($user)->check('admin');
    }

    private function owns(?User $user, Station $station): bool
    {
        return optional($user)->id === $station->owner_id;
    }

    public function view(?User $user, Station $station): bool
    {
        return $this->owns($user, $station)
            || $station->state->is(StationStateEnum::APPROVED);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Station $station): bool
    {
        $ownerCanUpdate = $this->owns($user, $station)
            && $station->state->in([StationStateEnum::DRAFT, StationStateEnum::REQUIRES_CHANGES]);

        $adminCanUpdate = Gate::forUser($user)->check('admin')
            && $station->state->is(StationStateEnum::FOR_APPROVAL);

        return $ownerCanUpdate || $adminCanUpdate;
    }
}
