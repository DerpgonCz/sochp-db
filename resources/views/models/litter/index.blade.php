@php
    use Illuminate\Database\Eloquent\Collection;
    use App\Models\Litter;
    use App\Models\Station;

    /** @var Collection<Station>|null $stationLitters */
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">

                <ul class="nav nav-tabs" role="tablist">
                    @php
                        $showStationLittersTab = $stationLitters !== null;
                        $activeTab = $showStationLittersTab ? 1 : 0;

                        $activeTab = match(true) {
                            app('request')->has('littersPage') => 0,
                            app('request')->has('stationLittersPage') => 1,
                            app('request')->has('littersForApprovalPage') => 2,
                            app('request')->has('littersForRegistrationPage') => 3,
                            default => $activeTab,
                        }
                    @endphp
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $activeTab === 0 ? 'active' : '' }}" id="approved-litters"
                                data-toggle="tab" data-target="#approved-litters-content" type="button" role="tab">
                            {{ __('Approved litters') }} ({{ $litters->total() }})
                        </button>
                    </li>
                    @if($showStationLittersTab)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 1 ? 'active' : '' }}" id="my-litters" data-toggle="tab" data-target="#my-litters-content" type="button" role="tab">
                                {{ __('My litters') }} ({{ $stationLitters->total() }})
                            </button>
                        </li>
                    @endif
                    @can('approve', Litter::class)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 2 ? 'active' : '' }}" id="for-approval" data-toggle="tab" data-target="#for-approval-content" type="button" role="tab">
                                {{ __('For approval') }} ({{ $littersForApproval->total() }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $activeTab === 3 ? 'active' : '' }}" id="for-registration" data-toggle="tab" data-target="#for-registration-content" type="button" role="tab">
                                {{ __('For registration') }} ({{ $littersForRegistration->total() }})
                            </button>
                        </li>
                    @endcan
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade {{ $activeTab === 0 ? 'show active' : '' }}" id="approved-litters-content"
                         role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th></th>
                                <th>{{ __(sprintf('models.%s.fields.station.name', Litter::class)) }}</th>
                                <th>{{ __(sprintf('models.%s.fields.happened_on', Litter::class)) }}</th>
                                <th>{{ __(sprintf('models.%s.fields.mother.name', Litter::class)) }}</th>
                                <th>{{ __(sprintf('models.%s.fields.father.name', Litter::class)) }}</th>
                                <th class="text-right">{{ __(sprintf('models.%s.children_count', Litter::class)) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($litters as $litter)
                                <tr class="position-relative">
                                    <th scope="row">
                                        <a href="{{ route('litters.show', $litter) }}" class="stretched-link">
                                            {{ $litter->name }}
                                        </a>
                                    </th>
                                    <td>{{ $litter->station->name }}</td>
                                    <td class="text-right">{!! str_replace(' ', '&nbsp;', $litter->happened_on->format('j. n. Y')) !!}</td>
                                    <td>{{ $litter?->mother?->name ?? '--' }}</td>
                                    <td>{{ $litter?->father?->name ?? '--' }}</td>
                                    <td class="text-right">{{ $litter->children->count()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="d-inline-block">
                                    {{ $litters->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($stationLitters !== null)
                        <div class="tab-pane fade {{ $activeTab === 1 ? 'show active' : '' }}" id="my-litters-content"
                             role="tabpanel">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>{{ __(sprintf('models.%s.fields.name', Litter::class)) }}</th>
                                    <th>{{ __(sprintf('models.%s.fields.happened_on', Litter::class)) }}</th>
                                    <th>{{ __(sprintf('models.%s.fields.mother.name', Litter::class)) }}</th>
                                    <th>{{ __(sprintf('models.%s.fields.father.name', Litter::class)) }}</th>
                                    <th class="text-right">{{ __(sprintf('models.%s.children_count', Litter::class)) }}</th>
                                    <th class="text-center">{{ __(sprintf('models.%s.fields.state', Litter::class)) }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($stationLitters as $litter)
                                    <tr class="position-relative">
                                        <th scope="row">
                                            <a href="{{ route('litters.show', $litter) }}" class="stretched-link">
                                                {{ $litter->name }}
                                            </a>
                                        </th>
                                        <td>{{ $litter->happened_on ? $litter->happened_on->format('j. n. Y') : '--' }}</td>
                                        <td>{{ $litter?->mother?->name ?? '--' }}</td>
                                        <td>{{ $litter?->father?->name ?? '--' }}</td>
                                        <td class="text-right">{{ $litter->children->count()}}</td>
                                        <td class="text-center">
                                            <x-litter-state-badge :litter="$litter"/>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @can('create', Litter::class)
                                <div class="my-4">
                                    <div class="row">
                                        <div class="col-12 text-right">
                                            <a href="{{ route('litters.create') }}"
                                               class="btn btn-success">{{ __('Create') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endcan

                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="d-inline-block">
                                        {{ $stationLitters->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @can('approve', Litter::class)
                    <div class="tab-pane fade {{ $activeTab === 2 ? 'show active' : '' }}" id="for-approval-content" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ __(sprintf('models.%s.fields.name', Litter::class)) }}</th>
                                <th>{{ __(sprintf('models.%s.fields.owner', Litter::class)) }}</th>
                                <th>{{ __(sprintf('models.%s.fields.state', Litter::class)) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($littersForApproval as $litter)
                                <tr class="position-relative">
                                    <th scope="row">
                                        <a href="{{ route('litters.edit', $litter) }}" class="stretched-link">
                                            {{ $litter->name }}
                                        </a>
                                    </th>
                                    <td>{{ $litter->station->owner->name }}</td>
                                    <td>
                                        <x-litter-state-badge :litter="$litter"/>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="d-inline-block">
                                    {{ $littersForApproval->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ $activeTab === 3 ? 'show active' : '' }}" id="for-registration-content" role="tabpanel">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>{{ __(sprintf('models.%s.fields.name', Litter::class)) }}</th>
                                <th>{{ __(sprintf('models.%s.fields.owner', Litter::class)) }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($littersForRegistration as $litter)
                                <tr class="position-relative">
                                    <th scope="row">
                                        <a href="{{ route('litters.edit', $litter) }}" class="stretched-link">
                                            {{ $litter->name }}
                                        </a>
                                    </th>
                                    <td>{{ $litter->breeder_name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="d-inline-block">
                                    {{ $littersForRegistration->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
