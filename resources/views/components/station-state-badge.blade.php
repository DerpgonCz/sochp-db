@php
    use App\Enums\StationStateEnum;
@endphp
@switch($value)
    @case(StationStateEnum::APPROVED)
        <span class="badge badge-success">{{ __('Approved') }}</span>
        @break

    @case(StationStateEnum::DRAFT)
        <span class="badge badge-secondary">{{ __('Created') }}</span>
        @break

    @case(StationStateEnum::REQUIRES_CHANGES)
        <span class="badge badge-warning">{{ __('Requires changes') }}</span>
        @break

    @case(StationStateEnum::FOR_APPROVAL)
        <span class="badge badge-primary">{{ __('Sent for approval') }}</span>
        @break
@endswitch
