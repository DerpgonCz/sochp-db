<?php

namespace App\Policies;

use App\Enums\LitterStateEnum;
use App\Enums\StationStateEnum;
use App\Models\Litter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class LitterPolicy
{
    use HandlesAuthorization;

    private function owns(?User $user, Litter $litter): bool
    {
        return optional($user)->id === $litter->station->owner_id;
    }

    public function view(User $user, Litter $litter)
    {
        //
    }

    public function create(User $user): bool
    {
        return $user->station()->exists() && $user->station->state->is(StationStateEnum::APPROVED);
    }

    public function update(User $user, Litter $litter): bool
    {
        $ownerCanUpdate = $this->owns($user, $litter)
            && $litter->state->in([
                LitterStateEnum::DRAFT,
                LitterStateEnum::REQUIRES_DRAFT_CHANGES,
                LitterStateEnum::BREEDING,
                LitterStateEnum::REQUIRES_BREEDING_CHANGES,
            ]);

        $adminCanUpdate = Gate::forUser($user)->check('admin')
            && $litter->state->in([
                LitterStateEnum::REQUIRES_BREEDING_APPROVAL,
                LitterStateEnum::REQUIRES_FINAL_APPROVAL
            ]);

        return $ownerCanUpdate || $adminCanUpdate;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Litter $litter
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Litter $litter)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Litter $litter
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Litter $litter)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Litter $litter
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Litter $litter)
    {
        //
    }
}
