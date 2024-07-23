@php
    use App\Models\Animal;use App\Services\Frontend\Animal\i18n\AnimalColorTranslationService;use App\Services\Frontend\Animal\i18n\AnimalEffectTranslationService;use App\Services\Frontend\Animal\i18n\AnimalFurTranslationService;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <h2>{{ __('Animals') }}</h2>
                    </div>
                    <div class="col-6 text-right">
                        @auth
                            <a href="{{ route('animals.create') }}" class="btn btn-success">{{ __('Create') }}</a>
                        @endauth
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __(sprintf('models.%s.fields.name', Animal::class)) }}</th>
                        <th>{{ __('Station') }}</th>
                        <th>{{ __(sprintf('models.%s.fields.fur', Animal::class)) }}</th>
                        <th>{{ __(sprintf('models.%s.fields.color', Animal::class)) }}</th>
                        <th>{{ __(sprintf('models.%s.fields.effect', Animal::class)) }}</th>
                        <th>{{ __(sprintf('models.%s.fields.mark', Animal::class)) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($animals as $animal)
                        <tr class="position-relative">
                            <th scope="row">
                                <a href="{{ route('animals.show', $animal) }}" class="stretched-link">
                                    <x-animal-gender :value="$animal"/>
                                    {{ $animal->name }}
                                </a>
                            </th>
                            <td>{{ $animal?->litter?->station->name }}</td>
                            <td>{{ (new AnimalFurTranslationService())($animal) }}</td>
                            <td>{{ (new AnimalColorTranslationService())($animal) ?: '--' }}</td>
                            <td>{{ (new AnimalEffectTranslationService())($animal)  ?: '--'}}</td>
                            <td>{{ $animal?->markings ?: '--' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <div class="d-inline-block">
                    {{ $animals->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
