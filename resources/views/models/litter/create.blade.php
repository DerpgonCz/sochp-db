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
                    <strong>{{ __(sprintf('models.%s.fields.name', Litter::class)) }}</strong>
                    <input type="text" class="form-control" name="name" placeholder="{{ __(sprintf('models.%s.fields.name', Litter::class)) }}" value="{{ old('name') }}" required>
                </label>

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.mother.name', Litter::class)) }}</strong>
                    <select name="mother" class="custom-select" value="{{ old('mother') }}">
                        <option value="">-- {{ __(sprintf('models.%s.fields.mother.name', Litter::class)) }} --</option>
                        <optgroup label="{{ __('My animals') }}">
                            @foreach($stationAnimalsFemale as $animal)
                                <option value="{{ $animal->id }}">{{ $animal->name }} ({{ $animal->litter->name }})</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="{{ __('Other animals') }}">
                            @foreach($otherAnimalsFemale as $animal)
                                <option value="{{ $animal->id }}">{{ $animal->name }} ({{ $animal->litter->name }}
                                    , {{ $animal->litter->station->name }})
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </label>

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.father.name', Litter::class)) }}</strong>
                    <select name="father" class="custom-select" value="{{ old('father') }}">
                        <option value="">-- {{ __(sprintf('models.%s.fields.father.name', Litter::class)) }} --</option>
                        <optgroup label="{{ __('My animals') }}">
                            @foreach($stationAnimalsMale as $animal)
                                <option value="{{ $animal->id }}">{{ $animal->name }} ({{ $animal->litter->name }})</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="{{ __('Other animals') }}">
                            @foreach($otherAnimalsMale as $animal)
                                <option value="{{ $animal->id }}">{{ $animal->name }} ({{ $animal->litter->name }}
                                    , {{ $animal->litter->station->name }})
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </label>

                <label class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">{{ __('Save') }}</button>
                </label>
            </form>
        </div>
    </div>
@endsection
