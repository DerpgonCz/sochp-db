@php
    use App\Enums\LitterStateEnum;
@endphp
@switch($value)
    @case(LitterStateEnum::DRAFT)
        <span class="badge badge-secondary">{{ __('Created') }}</span>
        @break

    @case(LitterStateEnum::REQUIRES_DRAFT_CHANGES)
        <span class="badge badge-warning">{{ __('Requires changes before breeding') }}</span>
        @break

    @case(LitterStateEnum::REQUIRES_BREEDING_APPROVAL)
        <span class="badge badge-primary">{{ __('Sent for breeding approval') }}</span>
        @break

    @case(LitterStateEnum::BREEDING)
        <span class="badge badge-success">{{ __('Approved for breeding') }}</span>
        @break

    @case(LitterStateEnum::REQUIRES_BREEDING_CHANGES)
        <span class="badge badge-warning">{{ __('Requires changes before final approval') }}</span>
        @break

    @case(LitterStateEnum::REQUIRES_FINAL_APPROVAL)
        <span class="badge badge-primary">{{ __('Sent for final approval') }}</span>
        @break

    @case(LitterStateEnum::FINALIZED)
        <span class="badge badge-success">{{ __('Approved') }}</span>
        @break

@endswitch
