@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Litter;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @if(Auth::check() && $stationLitters)
                    <h2>{{ __('My litters') }}</h2>

                    <div class="my-4">
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
                    </div>

                    @can('create', Litter::class)
                        <div class="my-4">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('litters.create') }}" class="btn btn-success">{{ __('Create') }}</a>
                                </div>
                            </div>
                        </div>
                    @endcan
                @endif

                @can('approve', Litter::class)
                    <div class="my-4"></div>
                    <h2>{{ __('For approval') }}</h2>
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
                @endcan

                <h2>{{ __('Approved litters') }}</h2>
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
                                <td>{{ $litter->happened_on->format('j. n. Y') }}</td>
                                <td>{{ $litter?->mother?->name ?? '--' }}</td>
                                <td>{{ $litter?->father?->name ?? '--' }}</td>
                                <td class="text-right">{{ $litter->children->count()}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
