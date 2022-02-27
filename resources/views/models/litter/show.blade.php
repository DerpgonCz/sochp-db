@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>{{ __('Litter') }} {{ $litter->name }}, {{ __(sprintf('models.%s.fields.station.name', \App\Models\Litter::class)) }} {{ $litter->station->name }}</h1>
            </div>
            <div class="col-md-3 text-right">
                @can('update', $litter)
                    <a href="{{ route('litters.edit', $litter) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                @endcan
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <dl class="row">
                    <dd class="col-3">{{ __(sprintf('models.%s.fields.state', \App\Models\Litter::class)) }}</dd>
                    <dt class="col-9"><x-litter-state-badge :litter="$litter" /></dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.station.name', \App\Models\Litter::class)) }}</dd>
                    <dt class="col-9">{{ $litter->station->name }} <a href="{{ route('stations.show', $litter->station) }}" class="badge badge-secondary">Detail</a></dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.happened_on', \App\Models\Litter::class)) }}</dd>
                    <dt class="col-9">{{ $litter->happened_on ? $litter->happened_on->format('j. n. Y') : '--' }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.mother.name', \App\Models\Litter::class)) }}</dd>
                    <dt class="col-9">
                        @if($litter->mother)
                            {{ $litter->mother->name ?: '--' }}
                            <a href="{{ route('animals.show', $litter->mother) }}"><span class="badge badge-secondary">{{ __('Detail') }}</span></a>
                        @else
                            --
                        @endif
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.father.name', \App\Models\Litter::class)) }}</dd>
                    <dt class="col-9">
                        @if($litter->father)
                            {{ $litter->father->name }}
                            <a href="{{ route('animals.show', $litter->father) }}"><span class="badge badge-secondary">{{ __('Detail') }}</span></a>
                        @else
                            --
                        @endif
                    </dt>
                </dl>
            </div>
        </div>

        <h2>{{ __('Children') }}</h2>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __(sprintf('models.%s.fields.children.name', \App\Models\Litter::class)) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($litter->children as $animal)
                        <tr class="position-relative">
                            <th scope="row">
                                <a href="{{ route('animals.show', $animal) }}" class="stretched-link">
                                    @if(!$animal->isAlive())
                                        ✝
                                    @endif
                                    {{ $animal->name }}
                                </a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
