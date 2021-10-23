@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>
            {{ __('Animal detail') }}
        </h1>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h3>{{ __('Station') }}</h3>
                <dl class="row">
                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.station.name', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->litter->station->name }}
                        <a href="{{ route('stations.show', $animal->litter->station) }}"><span class="badge badge-secondary">{{ __('Detail') }}</span></a>
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.station.owner.name', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->litter->station->owner->name }}
                    </dt>
                </dl>
            </div>
            <div class="col-md-6">
                <h3>{{ __('Caretaker') }}</h3>
                <dl class="row">
                    <dd class="col-3">{{ __(sprintf('models.%s.fields.caretaker.name', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">{{ optional($animal->caretaker)->name ?: '--' }}</dt>


                    <dd class="col-3">{{ __(sprintf('models.%s.fields.caretaker.station.name', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">
                        @if(optional($animal->caretaker)->station && $animal->caretaker->station->state->is(\App\Enums\StationStateEnum::APPROVED))
                            {{ $animal->caretaker->station->name }}
                            <a href="{{ route('stations.show', $animal->caretaker->station) }}"><span class="badge badge-secondary">{{ __('Detail') }}</span></a>
                        @else
                            --
                        @endif
                    </dt>
                </dl>
            </div>
        </div>
        <hr>
        <div class="row content-justify-center">
            <div class="col-md-6">
                <h3>{{ __('Animal') }}</h3>
                <dl class="row">

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.name', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->name }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.gender', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->gender->description }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.note', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->note ?: '--' }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.happened_on', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->litter->happened_on->format('j. n. Y') }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.status', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->died_on ? sprintf('%s (%s)', __('Dead'), $animal->litter->happened_on->diff($animal->died_on)->format('%yr %mm')) : sprintf('%s (%s)', __('Alive'), $animal->litter->happened_on->diff('now')->format('%yr %mm')) }}</dt>
                </dl>
            </div>
            <div class="col-md-6">
                <h3>{{ __('Litter') }}</h3>
                <dl class="row">

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.name', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->litter->name }}
                        <a href="{{ route('litters.show', $animal->litter) }}"><span class="badge badge-secondary">{{ __('Detail') }}</span></a>
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.mother.name', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->litter->mother->name }}
                        <a href="{{ route('animals.show', $animal->litter->mother) }}"><span class="badge badge-secondary">{{ __('Detail') }}</span></a>
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.father.name', \App\Models\Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->litter->father->name }}
                        <a href="{{ route('animals.show', $animal->litter->father) }}"><span class="badge badge-secondary">{{ __('Detail') }}</span></a>
                    </dt>
                </dl>
            </div>
        </div>
    </div>
@endsection
