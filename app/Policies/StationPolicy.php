<?php

namespace App\Policies;

use App\Enums\Auth\PermissionsEnum;
use App\Enums\StationStateEnum;
use App\Models\Station;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StationPolicy
{
    use HandlesAuthorization;

    private const STATE_TRANSITIONS_OWNER = [
        StationStateEnum::DRAFT => [StationStateEnum::FOR_APPROVAL],
        StationStateEnum::REQUIRES_CHANGES => [StationStateEnum::FOR_APPROVAL],
    ];

    private const STATE_TRANSITIONS_MANAGER = [
        StationStateEnum::FOR_APPROVAL => [StationStateEnum::REQUIRES_CHANGES, StationStateEnum::APPROVED],
    ];


    private function owns(?User $user, Station $station): bool
    {
        return $user?->id === $station->owner_id;
    }

    private function manage(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::MANAGE_STATIONS->value);
    }

    public function updateState(User $user, Station $station, StationStateEnum $toState): bool
    {
        $fromState = $station->state;

        $allowedTransitions = array_replace_recursive(
            $this->owns($user, $station) ? self::STATE_TRANSITIONS_OWNER : [],
            $this->manage($user) ? self::STATE_TRANSITIONS_MANAGER : [],
        );

        return in_array($toState->value, $allowedTransitions[$fromState->value] ?? []);
    }

    public function approve(User $user): bool
    {
        return $this->manage($user);
    }

    public function view(?User $user, Station $station): bool
    {
        return $user
            && (
                $this->owns($user, $station)
                || $this->manage($user)
            )
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

        $adminCanUpdate = $user->hasPermissionTo(PermissionsEnum::MANAGE_STATIONS->value)
            && $station->state->is(StationStateEnum::FOR_APPROVAL);

        return $ownerCanUpdate || $adminCanUpdate;
    }
}
