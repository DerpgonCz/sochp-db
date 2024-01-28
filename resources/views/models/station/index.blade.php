@php
    use App\Enums\StationStateEnum;
    use App\Models\Station;
    use Illuminate\Support\Facades\Gate;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @include('models.station.partial.index-my-station')

                @php
                    $canApprove = Gate::check('approve', Station::class);
                    $activeTab = match(true) {
                        app('request')->has('stationsPage') => 0,
                        app('request')->has('stationsForApprovalPage') && $canApprove => 1,
                        default => 0,
                    };
                @endphp
                <hr>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $activeTab === 0 ? 'active' : '' }}" id="approved-stations" data-toggle="tab" data-target="#approved-stations-content" type="button" role="tab">
                            {{ __('Approved stations') }} ({{ $stations->total() }})
                        </button>
                    </li>
                    @if($canApprove)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 1 ? 'active' : '' }}" id="for-approval-stations" data-toggle="tab" data-target="#for-approval-stations-content" type="button" role="tab">
                                {{ __('For approval') }} ({{ $stationsForApproval->total() }})
                            </button>
                        </li>
                    @endcan
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade {{ $activeTab === 0 ? 'show active' : '' }}" id="approved-stations-content" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ __(sprintf('models.%s.fields.name', Station::class)) }}</th>
                                <th>{{ __(sprintf('models.%s.fields.owner.name', Station::class)) }}</th>
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
                                    <td>{{ $station->breeder_name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="d-inline-block">
                                    {{ $stations->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($canApprove)
                        <div class="tab-pane fade {{ $activeTab === 1 ? 'show active' : '' }}" id="for-approval-stations-content" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ __(sprintf('models.%s.fields.name', Station::class)) }}</th>
                                <th>{{ __(sprintf('models.%s.fields.owner.name', Station::class)) }}</th>
                                <th>{{ __(sprintf('models.%s.fields.state', Station::class)) }}</th>
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
                                    <td>{{ $station->breeder_name }}</td>
                                    <td>
                                        <x-station-state-badge :station="$station" />
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="d-inline-block">
                                    {{ $stationsForApproval->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
