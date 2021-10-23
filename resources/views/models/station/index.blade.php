@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @auth
                    <h2>{{ __('My station') }}</h2>
                    @if($userStation)
                        @switch($userStation->state->value)
                            @case(\App\Enums\StationStateEnum::DRAFT)
                                <a href="{{ route('stations.edit', $userStation) }}" class="btn btn-secondary">{{ __('Edit') }}</a>
                                @break

                            @case(\App\Enums\StationStateEnum::FOR_APPROVAL)
                                <a href="{{ route('stations.show', $userStation) }}" class="btn btn-primary">{{ __('Sent for Approval') }}</a>
                                @break

                            @case(\App\Enums\StationStateEnum::REQUIRES_CHANGES)
                                <a href="{{ route('stations.edit', $userStation) }}" class="btn btn-warning">{{ __('Requires Changes') }}</a>
                                @break

                            @case(\App\Enums\StationStateEnum::APPROVED)
                                <a href="{{ route('stations.show', $userStation) }}" class="btn btn-success">{{ __('Approved') }}</a>
                                @break
                        @endswitch

                    @else
                        <a href="{{ route('stations.create') }}" class="btn btn-primary">{{ __('Create') }}</a>
                    @endif
                @endauth

                @can('approve', \App\Models\Station::class)
                    <div class="my-4"></div>
                    <h2>{{ __('For approval') }}</h2>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ __(sprintf('models.%s.fields.name', \App\Models\Station::class)) }}</th>
                            <th>{{ __(sprintf('models.%s.fields.owner.name', \App\Models\Station::class)) }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stationsForApproval as $station)
                            <tr class="position-relative">
                                <th scope="row">
                                    <a href="{{ route('stations.edit', $station) }}" class="stretched-link">
                                        {{ $station->name }}
                                    </a>
                                </th>
                                <td>{{ $station->owner->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endauth

                <div class="my-4"></div>
                <h2>{{ __('Approved stations') }}</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __(sprintf('models.%s.fields.name', \App\Models\Station::class)) }}</th>
                        <th>{{ __(sprintf('models.%s.fields.owner.name', \App\Models\Station::class)) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stations as $station)
                        <tr class="position-relative">
                            <th scope="row">
                                <a href="{{ route('stations.show', $station) }}" class="stretched-link">
                                    {{ $station->name }}
                                </a>
                            </th>
                            <td>{{ $station->owner->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
