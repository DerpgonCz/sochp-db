<?php

namespace App\Policies;

use App\Enums\LitterStateEnum;
use App\Enums\Auth\PermissionsEnum;
use App\Enums\StationStateEnum;
use App\Models\Litter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LitterPolicy
{
    use HandlesAuthorization;

    private const STATE_TRANSITIONS_OWNER = [
        LitterStateEnum::DRAFT => [
            LitterStateEnum::REQUIRES_BREEDING_APPROVAL,
        ],
        LitterStateEnum::REQUIRES_DRAFT_CHANGES => [
            LitterStateEnum::REQUIRES_BREEDING_APPROVAL,
        ],
        LitterStateEnum::BREEDING => [
            LitterStateEnum::REQUIRES_FINAL_APPROVAL,
        ],
        LitterStateEnum::REQUIRES_BREEDING_CHANGES => [
            LitterStateEnum::REQUIRES_FINAL_APPROVAL,
        ],
    ];

    private const STATE_TRANSITIONS_MANAGER = [
        LitterStateEnum::REQUIRES_BREEDING_APPROVAL => [
            LitterStateEnum::REQUIRES_DRAFT_CHANGES,
            LitterStateEnum::BREEDING,
        ],
        LitterStateEnum::REQUIRES_FINAL_APPROVAL => [
            LitterStateEnum::REQUIRES_BREEDING_CHANGES,
            LitterStateEnum::FINALIZED,
        ],
        LitterStateEnum::FINALIZED => [
            LitterStateEnum::REGISTERED,
        ]
    ];

    private function owns(?User $user, Litter $litter): bool
    {
        return optional($user)->id === $litter->station->owner_id;
    }

    public function manage(?User $user): bool
    {
        if (!$user) {
            return false;
        }

        return $user->hasPermissionTo(PermissionsEnum::MANAGE_STATIONS->value);
    }

    public function updateState(User $user, Litter $litter, LitterStateEnum $toState): bool
    {
        $fromState = $litter->state;

        $allowedTransitions = array_replace_recursive(
            $this->owns($user, $litter) ? self::STATE_TRANSITIONS_OWNER : [],
            $this->manage($user) ? self::STATE_TRANSITIONS_MANAGER : [],
        );

        return in_array($toState->value, $allowedTransitions[$fromState->value] ?? []);
    }

    public function approve(User $user): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::MANAGE_LITTERS->value);
    }

    public function view(?User $user, Litter $litter): bool
    {
        return $this->owns($user, $litter)
            || $this->manage($user)
            || $litter->state->is(LitterStateEnum::REGISTERED);
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

        $adminCanUpdate = $user->hasPermissionTo(PermissionsEnum::MANAGE_LITTERS->value)
            && $litter->state->in([
                LitterStateEnum::REQUIRES_BREEDING_APPROVAL,
                LitterStateEnum::REQUIRES_FINAL_APPROVAL,
                LitterStateEnum::FINALIZED,
            ]);

        return $ownerCanUpdate || $adminCanUpdate;
    }
}
