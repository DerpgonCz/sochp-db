@switch($value)
    @case(\App\Enums\StationStateEnum::APPROVED)
        <span class="badge badge-success">{{ __('Approved') }}</span>
    @break

    @case(\App\Enums\StationStateEnum::DRAFT)
        <span class="badge badge-secondary">{{ __('Created') }}</span>
    @break

    @case(\App\Enums\StationStateEnum::REQUIRES_CHANGES)
        <span class="badge badge-warning">{{ __('Requires Changes') }}</span>
    @break

    @case(\App\Enums\StationStateEnum::FOR_APPROVAL)
        <span class="badge badge-primary">{{ __('Sent for Approval') }}</span>
    @break
@endswitch
