@php
    use App\Enums\Animal\AnimalBreedingTypeEnum;
    use App\Enums\Animal\AnimalBuildEnum;
    use App\Enums\Animal\AnimalColorFull;
    use App\Enums\Animal\AnimalColorMink;
    use App\Enums\Animal\AnimalColorShaded;
    use App\Enums\Animal\AnimalEffectEnum;
    use App\Enums\Animal\AnimalEyesEnum;
    use App\Enums\Animal\AnimalFurEnum;
    use App\Enums\Animal\AnimalPrimaryMarkEnum;
    use App\Enums\Animal\AnimalSecondaryMarkEnum;
    use App\Enums\GenderEnum;
    use App\Enums\LitterStateEnum;
    use App\Models\Animal;
    use App\Models\Litter;
    use App\Services\Frontend\Animal\AnimalColorBuilderValueSerializer;
    use Illuminate\Support\Facades\Gate;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>{{ __('Edit an animal') }}</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <form method="POST" action="{{ route('animals.update', $animal) }}" class="col">
                @method('PUT')
                @csrf

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.name', Animal::class)) }}</strong>
                    <input type="text" class="form-control"
                           value="{{ $animal->name }}" disabled>
                </label>

                <label class="form-group">
                    <strong>{{ __('Caretaker') }}</strong>
                    <select name="caretaker_id" class="custom-select">
                        <option>--</option>
                        @foreach($caretakers as $caretaker)
                            <option value="{{ $caretaker->id }}" @selected($caretaker->id === $animal->caretaker_id)>{{ $caretaker->name }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="form-group text-right">
                        <button type="submit" class="btn btn-success">
                            {{ __('Save') }}
                        </button>
                </label>
            </form>
        </div>
    </div>
@endsection
