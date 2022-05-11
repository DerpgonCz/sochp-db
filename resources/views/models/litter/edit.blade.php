@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>{{ __('Edit a litter') }}</h2>
                <h5>{{ __('State') }}: <x-litter-state-badge :litter="$litter" /></h5>
            </div>
        </div>
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('litters.update', $litter) }}" class="col">
                @method('PUT')
                @csrf

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.name', \App\Models\Litter::class)) }}</strong>
                    <input type="text" class="form-control" name="name" placeholder="{{ __(sprintf('models.%s.fields.name', \App\Models\Litter::class)) }}" value="{{ $litter->name }}" required>
                </label>

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.mother.name', \App\Models\Litter::class)) }}</strong>
                    <select name="mother_id" class="custom-select">
                        <option value="">-- {{ __(sprintf('models.%s.fields.mother.name', \App\Models\Litter::class)) }} --</option>
                        <optgroup label="{{ __('My animals') }}">
                            @foreach($stationAnimalsFemale as $animal)
                                <option value="{{ $animal->id }}" @selected($animal->id === optional($litter->mother)->id)>{{ $animal->name }} ({{ $animal->litter->name }})</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="{{ __('Other animals') }}">
                            @foreach($otherAnimalsFemale as $animal)
                                <option value="{{ $animal->id }}" @selected($animal->id === optional($litter->mother)->id)>{{ $animal->name }} ({{ $animal->litter->name }}, {{ $animal->litter->station->name }})</option>
                            @endforeach
                        </optgroup>
                    </select>
                </label>

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.father.name', \App\Models\Litter::class)) }}</strong>
                    <select name="father_id" class="custom-select">
                        <option value="">-- {{ __(sprintf('models.%s.fields.father.name', \App\Models\Litter::class)) }} --</option>
                        <optgroup label="{{ __('My animals') }}">
                            @foreach($stationAnimalsMale as $animal)
                                <option value="{{ $animal->id }}" @selected($animal->id === optional($litter->father)->id)>{{ $animal->name }} ({{ $animal->litter->name }})</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="{{ __('Other animals') }}">
                            @foreach($otherAnimalsMale as $animal)
                                <option value="{{ $animal->id }}" @selected($animal->id === optional($litter->father)->id)>{{ $animal->name }} ({{ $animal->litter->name }}, {{ $animal->litter->station->name }})</option>
                            @endforeach
                        </optgroup>
                    </select>
                </label>

                <label class="form-group text-right">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    @if($litter->state->in([\App\Enums\LitterStateEnum::DRAFT, \App\Enums\LitterStateEnum::REQUIRES_DRAFT_CHANGES]))
                        <button type="submit" name="state" value="{{ \App\Enums\LitterStateEnum::REQUIRES_BREEDING_APPROVAL }}" class="btn btn-success">{{ __('Send for breeding approval') }}</button>
                    @endif
                    @if($litter->state->in([\App\Enums\LitterStateEnum::BREEDING, \App\Enums\LitterStateEnum::REQUIRES_BREEDING_CHANGES]))
                        <button type="submit" name="state" value="{{ \App\Enums\LitterStateEnum::REQUIRES_FINAL_APPROVAL }}" class="btn btn-success">{{ __('Send for final approval') }}</button>
                    @endif

                    @if($litter->state->is(\App\Enums\LitterStateEnum::REQUIRES_BREEDING_APPROVAL))
                        <button type="submit" name="state" value="{{ \App\Enums\LitterStateEnum::REQUIRES_DRAFT_CHANGES }}" class="btn btn-warning">{{ __('Requires changes') }}</button>
                        <button type="submit" name="state" value="{{ \App\Enums\LitterStateEnum::BREEDING }}" class="btn btn-success">{{ __('Approve for breeding') }}</button>
                    @endif
                    @if($litter->state->is(\App\Enums\LitterStateEnum::REQUIRES_FINAL_APPROVAL))
                        <button type="submit" name="state" value="{{ \App\Enums\LitterStateEnum::REQUIRES_BREEDING_CHANGES }}" class="btn btn-warning">{{ __('Requires changes') }}</button>
                        <button type="submit" name="state" value="{{ \App\Enums\LitterStateEnum::FINALIZED }}" class="btn btn-success">{{ __('Approve') }}</button>
                    @endif
                </label>
            </form>
        </div>
    </div>
@endsection
