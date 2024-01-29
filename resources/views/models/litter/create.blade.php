@php
    use App\Models\Litter;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>{{ __('Create a new litter') }}</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('litters.store') }}" class="col">
                @method('POST')
                @csrf

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.name', Litter::class)) }}</strong> *
                    <input type="text" class="form-control" name="name"
                           placeholder="{{ __(sprintf('models.%s.fields.name', Litter::class)) }}"
                           value="{{ old('name') }}" required>
                </label>

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.mother.name', Litter::class)) }}</strong>
                    <x-parent-select
                        name="mother_id"
                        :value="null"
                        :station-animals="$stationAnimalsFemale"
                        :other-animals="$otherAnimalsFemale"
                        i18n-field="mother"
                    />
                </label>

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.father.name', Litter::class)) }}</strong>
                    <x-parent-select
                        name="father_id"
                        :value="null"
                        :station-animals="$stationAnimalsFemale"
                        :other-animals="$otherAnimalsFemale"
                        i18n-field="mother"
                    />
                </label>

                <label class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">{{ __('Save') }}</button>
                </label>
            </form>
        </div>
    </div>
@endsection
