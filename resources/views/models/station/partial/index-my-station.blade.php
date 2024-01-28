@auth
    <h2>{{ __('My station') }}</h2>
    @if($userStation)
        @switch($userStation->state->value)
            @case(StationStateEnum::DRAFT)
                <a href="{{ route('stations.edit', $userStation) }}" class="btn btn-secondary">{{ __('Edit') }}</a>
                @break

            @case(StationStateEnum::FOR_APPROVAL)
                <a href="{{ route('stations.show', $userStation) }}" class="btn btn-primary">{{ __('Sent for approval') }}</a>
                @break

            @case(StationStateEnum::REQUIRES_CHANGES)
                <a href="{{ route('stations.edit', $userStation) }}" class="btn btn-warning">{{ __('Requires changes') }}</a>
                @break

            @case(StationStateEnum::APPROVED)
                <a href="{{ route('stations.show', $userStation) }}" class="btn btn-success">{{ __('Approved') }}</a>
                @break
        @endswitch
    @else
        <a href="{{ route('stations.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
    @endif
@endauth
