@php
    use App\Enums\StationStateEnum;
@endphp

@auth
    <h2>{{ __('My station') }}</h2>
    @if($userStation)
        @switch($userStation->state->value)
            @case(StationStateEnum::DRAFT)
                <a href="{{ route('stations.edit', $userStation) }}">{{ $userStation->name }}</a>
                <span class="badge badge-secondary">{{ __('Created') }}</span>
                @break

            @case(StationStateEnum::FOR_APPROVAL)
                <a href="{{ route('stations.show', $userStation) }}">{{ $userStation->name }}</a>
                <span class="badge badge-primary">{{ __('Sent for approval') }}</span>
                @break

            @case(StationStateEnum::REQUIRES_CHANGES)
                <a href="{{ route('stations.edit', $userStation) }}">{{ $userStation->name }}</a>
                <span class="badge badge-warning">{{ __('Requires changes') }}</span>
                @break

            @case(StationStateEnum::APPROVED)
                <a href="{{ route('stations.show', $userStation) }}">{{ $userStation->name }}</a>
                <span class="badge badge-success">{{ __('Approved') }}</span>
                @break
        @endswitch
    @else
        <a href="{{ route('stations.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
    @endif
@endauth
