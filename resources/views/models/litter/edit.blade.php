@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>{{ __('Edit a litter') }}</h2>
                <h5>{{ __('State') }}: <x-litter-state-badge :litter="$litter" /></h5>
            </div>
        </div>
        {{ $errors }}
        <div class="row justify-content-center">
            <form method="POST" action="{{ route('litters.update', $litter) }}" class="col">
                @method('PUT')
                @csrf

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.name', \App\Models\Litter::class)) }}</strong>
                    <input type="text" class="form-control" name="name" placeholder="{{ __(sprintf('models.%s.fields.name', \App\Models\Litter::class)) }}" value="{{ $litter->name }}" required>
                </label>

                @if(
                    $litter->state->in([
                        \App\Enums\LitterStateEnum::BREEDING,
                        \App\Enums\LitterStateEnum::REQUIRES_BREEDING_CHANGES,
                    ])
                )
                    <label class="form-group">
                        <strong>{{ __(sprintf('models.%s.fields.happened_on', \App\Models\Litter::class)) }}</strong>
                        <input type="date" class="form-control" name="happened_on" placeholder="{{ __(sprintf('models.%s.fields.happened_on', \App\Models\Litter::class)) }}" value="{{ optional($litter->happened_on ?? old('happened_on'))->format('Y-m-d') }}" required>
                    </label>
                @endif

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

                <hr>
                <h3>{{ __('Children') }}</h3>
                <animal-builder
                    :animals="{{ json_encode($litter->children->toArray()) }}"
                    :animal-builds="{{ json_encode(\App\Enums\Animal\AnimalBuildEnum::casesWithTitles()) }}"
                    :animal-build-groups="{{ json_encode(\App\Enums\Animal\AnimalBuildEnum::selectableGroups()) }}"
                    :animal-furs="{{ json_encode(\App\Enums\Animal\AnimalFurEnum::casesWithTitles()) }}"
                    :animal-fur-groups="{{ json_encode(\App\Enums\Animal\AnimalFurEnum::selectableGroups()) }}"
                    :animal-eyes="{{ json_encode(\App\Enums\Animal\AnimalEyesEnum::casesWithTitles()) }}"
                    :animal-primary-marks="{{ json_encode(\App\Enums\Animal\AnimalPrimaryMarkEnum::casesWithTitles()) }}"
                    :animal-secondary-marks="{{ json_encode(\App\Enums\Animal\AnimalSecondaryMarkEnum::casesWithTitles()) }}"
                    :animal-effects="{{ json_encode(\App\Enums\Animal\AnimalEffectEnum::casesWithTitles()) }}"
                    :animal-breeding-types="{{ json_encode(\App\Enums\Animal\AnimalBreedingTypeEnum::casesWithTitles()) }}"
                    :animal-genders="{{ json_encode(\App\Enums\GenderEnum::asSelectArray()) }}"
                    :can-manage="{{ json_encode(\Illuminate\Support\Facades\Gate::check('manage', $litter)) }}"
                    :delete-existing-animal-message="{{ json_encode(__('modals.animals.edit.delete_existing')) }}"
                    :delete-new-animal-message="{{ json_encode(__('modals.animals.edit.delete_new')) }}"
                >
                    <template v-slot:animal-name-header>
                        {{ __(sprintf('models.%s.fields.name', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:animal-build-header>
                        {{ __(sprintf('models.%s.fields.build', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:animal-fur-header>
                        {{ __(sprintf('models.%s.fields.fur', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:animal-gender-header>
                        {{ __(sprintf('models.%s.fields.gender', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:animal-eyes-header>
                        {{ __(sprintf('models.%s.fields.eyes', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:animal-mark-primary-header>
                        {{ __(sprintf('models.%s.fields.mark_primary', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:animal-mark-secondary-header>
                        {{ __(sprintf('models.%s.fields.mark_secondary', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:animal-effect-header>
                        {{ __(sprintf('models.%s.fields.effect', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:animal-breeding-type-header>
                        {{ __(sprintf('models.%s.fields.breeding_type', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:animal-note-header>
                        {{ __(sprintf('models.%s.fields.note', \App\Models\Animal::class)) }}
                    </template>
                    <template v-slot:button-add-label>
                        {{ __('Add') }}
                    </template>
                    <template v-slot:modal-footer-save-text>
                        {{ __('Save') }}
                    </template>
                </animal-builder>
                <hr>

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
