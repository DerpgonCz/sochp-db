@php
    use App\Enums\Animal\AnimalEyesEnum;use App\Enums\Animal\AnimalPrimaryMarkEnum;use App\Enums\Animal\AnimalSecondaryMarkEnum;use App\Enums\StationStateEnum;use App\Models\Animal;use App\Services\Frontend\Animal\i18n\AnimalBuildTranslationService;use App\Services\Frontend\Animal\i18n\AnimalColorTranslationService;use App\Services\Frontend\Animal\i18n\AnimalEffectTranslationService;use App\Services\Frontend\Animal\i18n\AnimalFurTranslationService;use App\Services\Frontend\Animal\i18n\AnimalVarietyTranslationService;
@endphp
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
                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.station.name', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->litter?->station->name ?? '--' }}
                        @if($animal->litter)
                        <a href="{{ route('stations.show', $animal->litter?->station) }}"><span
                                class="badge badge-secondary">{{ __('Detail') }}</span></a>
                        @endif
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.station.owner.name', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->litter?->station->breeder_name ?? '--' }}
                    </dt>
                </dl>
            </div>
            <div class="col-md-6">
                <h3>{{ __('Caretaker') }}</h3>
                <dl class="row">
                    <dd class="col-3">{{ __(sprintf('models.%s.fields.caretaker.name', Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->caretaker?->name ?: '--' }}</dt>


                    <dd class="col-3">{{ __(sprintf('models.%s.fields.caretaker.station.name', Animal::class)) }}</dd>
                    <dt class="col-9">
                        @if(optional($animal->caretaker)->approved_station)
                            {{ $animal->caretaker->approved_station->name }}
                            <a href="{{ route('stations.show', $animal->caretaker->approved_station) }}"><span
                                    class="badge badge-secondary">{{ __('Detail') }}</span></a>
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

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.name', Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->name }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.registration_no', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->registration_no ?? '--' }}
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.happened_on', Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->date_of_birth->format('j. n. Y') }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.gender', Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->gender->description }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.variety', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ (new AnimalVarietyTranslationService())($animal) }}
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.color', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ (new AnimalColorTranslationService())($animal) }}<br>
                        <i class="small">{{ (new AnimalColorTranslationService())($animal, 'en') }}</i>
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.eyes', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ __(sprintf('enums.%s.%s', AnimalEyesEnum::class, $animal->eyes->value)) }}
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.mark', Animal::class)) }}</dd>
                    <dt class="col-9">
                        @if($animal->mark_primary === null && $animal->mark_secondary === null)
                            --
                        @endif
                        @if($animal->mark_primary !== null)
                            {{ __(sprintf('enums.%s.%s', AnimalPrimaryMarkEnum::class, $animal->mark_primary->value)) }}
                        @endif
                        @if($animal->mark_secondary !== null)
                            {{ __(sprintf('enums.%s.%s', AnimalSecondaryMarkEnum::class, $animal->mark_secondary->value)) }}
                        @endif
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.effect', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ (new AnimalEffectTranslationService())($animal) ?: '--' }}
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.status', Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->isAlive() ? sprintf('%s (%s)', __('Alive'), $animal->date_of_birth->diff('now')->format('%yr %mm')) : sprintf('%s (%s)', __('Dead'), $animal->litter->happened_on->diff($animal->died_on)->format('%yr %mm')) }}</dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.note', Animal::class)) }}</dd>
                    <dt class="col-9">{{ $animal->note ?: '--' }}</dt>
                </dl>
            </div>
            <div class="col-md-6">
                <h3>{{ __('Litter') }}</h3>
                <dl class="row">

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.name', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->litter?->name ?? '--' }}
                        @if($animal->litter)
                        <a href="{{ route('litters.show', $animal->litter) }}"><span
                                class="badge badge-secondary">{{ __('Detail') }}</span></a>
                        @endif
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.registration_no', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->litter?->registration_no ?? '--' }}
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.mother.name', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->mother?->name ?? '--' }}
                        @if($animal->mother)
                            <a href="{{ route('animals.show', $animal->mother) }}"><span
                                    class="badge badge-secondary">{{ __('Detail') }}</span></a>
                        @endif
                    </dt>

                    <dd class="col-3">{{ __(sprintf('models.%s.fields.litter.father.name', Animal::class)) }}</dd>
                    <dt class="col-9">
                        {{ $animal->father?->name ?? '--' }}
                        @if($animal->father)
                            <a href="{{ route('animals.show', $animal->father) }}"><span
                                    class="badge badge-secondary">{{ __('Detail') }}</span></a>
                        @endif
                    </dt>
                </dl>
            </div>
        </div>
    </div>
@endsection
