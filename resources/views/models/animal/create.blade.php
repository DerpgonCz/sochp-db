@php
    use App\Models\Animal;
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
    use App\Enums\Animal\AnimalTitleEnum;
    use App\Enums\GenderEnum;
    use App\Models\Litter;
    use App\Models\User;
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">

        <form method="POST" action="{{ route('animals.store') }}" enctype="multipart/form-data">
            @csrf
            <label class="form-group">
                <strong>{{ __(sprintf('models.%s.fields.date_of_birth', Animal::class)) }}</strong>
                <input type="date" class="form-control" name="animal[date_of_birth]"
                       placeholder="{{ __(sprintf('models.%s.fields.date_of_birth', Animal::class)) }}"
                       value="{{ old('animal[date_of_birth]') }}" required>
            </label>

            <label class="form-group">
                <strong>{{ __(sprintf('models.%s.fields.died_on', Animal::class)) }}</strong>
                <input type="date" class="form-control" name="animal[died_on]"
                       placeholder="{{ __(sprintf('models.%s.fields.died_on', Animal::class)) }}"
                       value="{{ old('animal[died_on]') }}">
            </label>

            <label class="form-group">
                <strong>{{ __(sprintf('models.%s.fields.registration_no', Animal::class)) }}</strong>
                <input type="text" class="form-control" name="animal[registration_no]"
                       placeholder="{{ __(sprintf('models.%s.fields.registration_no', Animal::class)) }}"
                       value="{{ old('animal[registration_no]') }}">
            </label>

            <div class="row align-items-center">
                <div class="col-5">
                    <label class="form-group">
                        <strong>{{ __(sprintf('models.%s.fields.caretaker.station.name', Animal::class)) }}</strong>
                        <autocomplete
                            type="station"
                            name="station_id"
                            placeholder="{{ __(sprintf('models.%s.fields.caretaker.station.name', Animal::class)) }}"
                        />
                    </label>
                </div>
                <div class="col-1 text-center">nebo</div>
                <div class="col-3">
                    <label class="form-group">
                        <strong>{{ __(sprintf('models.%s.fields.breeder_station_name', Animal::class)) }}</strong>
                        <input type="text" class="form-control" name="animal[breeder_station_name]"
                               placeholder="{{ __(sprintf('models.%s.fields.breeder_station_name', Animal::class)) }}"
                               value="{{ old('animal[breeder_station_name]') }}">
                    </label>
                </div>
                <div class="col-3">
                    <label class="form-group">
                        <strong>{{ __(sprintf('models.%s.fields.breeder_name', Animal::class)) }}</strong>
                        <input type="text" class="form-control" name="animal[breeder_name]"
                               placeholder="{{ __(sprintf('models.%s.fields.breeder_name', Animal::class)) }}"
                               value="{{ old('animal[breeder_name]') }}">
                    </label>
                </div>
            </div>

            @can('manage', Animal::class)
                <div class="row align-items-center">
                    <div class="col-5">
                        <label class="form-group">
                            <strong>{{ __(sprintf('models.%s.fields.name', User::class)) }}</strong>
                            <autocomplete
                                type="user"
                                name="animal[caretaker_id]"
                                placeholder="{{ __(sprintf('models.%s.fields.name', User::class)) }}"
                                :default-value="'{{ Auth::user()->id }}'"
                                :default-label="'{{ Auth::user()->name }}'"
                            />
                        </label>
                    </div>
                    <div class="col-1 text-center">
                        <div class="align-self-center">nebo</div>
                    </div>
                    <div class="col-3">
                        <label class="form-group">
                            <strong>{{ __(sprintf('models.%s.fields.caretaker_station_name', Animal::class)) }}</strong>
                            <input type="text" class="form-control" name="animal[caretaker_station_name]"
                                   placeholder="{{ __(sprintf('models.%s.fields.caretaker_station_name', Animal::class)) }}"
                                   value="{{ old('animal[caretaker_station_name]') }}">
                        </label>
                    </div>
                    <div class="col-3">
                        <label class="form-group">
                            <strong>{{ __(sprintf('models.%s.fields.caretaker_name', Animal::class)) }}</strong>
                            <input type="text" class="form-control" name="animal[caretaker_station_name]"
                                   placeholder="{{ __(sprintf('models.%s.fields.caretaker_name', Animal::class)) }}"
                                   value="{{ old('animal[caretaker_name]') }}">
                        </label>
                    </div>
                </div>
            @endcan

            <label class="form-group">
                <strong>{{ __(sprintf('models.%s.fields.father.name', Litter::class)) }}</strong>
                <x-parent-select
                    name="father_id"
                    :value="null"
                    :station-animals="$stationAnimalsMale"
                    :other-animals="$otherAnimalsMale"
                    i18n-field="mother"
                />
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

            <animal-editor
                :input-prefix="'animal'"
                :animal-builds="{{ json_encode(AnimalBuildEnum::casesWithTitles()) }}"
                :animal-build-groups="{{ json_encode(AnimalBuildEnum::selectableGroups()) }}"
                :animal-furs="{{ json_encode(AnimalFurEnum::casesWithTitles()) }}"
                :animal-fur-groups="{{ json_encode(AnimalFurEnum::selectableGroups()) }}"
                :animal-eyes="{{ json_encode(AnimalEyesEnum::casesWithTitles()) }}"
                :animal-primary-marks="{{ json_encode(AnimalPrimaryMarkEnum::casesWithTitles()) }}"
                :animal-secondary-marks="{{ json_encode(AnimalSecondaryMarkEnum::casesWithTitles()) }}"
                :animal-effects="{{ json_encode(AnimalEffectEnum::casesWithTitles()) }}"
                :animal-breeding-types="{{ json_encode(AnimalBreedingTypeEnum::casesWithTitles()) }}"
                :animal-titles="{{ json_encode(AnimalTitleEnum::casesWithTitles()) }}"
                :animal-genders="{{ json_encode(GenderEnum::asSelectArray()) }}"
                :delete-existing-animal-message="{{ json_encode(__('modals.animals.edit.delete_existing')) }}"
                :delete-new-animal-message="{{ json_encode(__('modals.animals.edit.delete_new')) }}"
                :color-builder-most-used-label="{{ json_encode(__('modals.animals.edit.labels.most_used')) }}"
                :color-builder-others-label="{{ json_encode(__('modals.animals.edit.labels.others')) }}"
                :color-builder-shaded-label="{{ json_encode(__('modals.animals.edit.labels.shaded')) }}"
                :color-builder-full-color-label="{{ json_encode(__('modals.animals.edit.labels.full')) }}"
                :color-builder-mink-color-label="{{ json_encode(__('modals.animals.edit.labels.mink')) }}"
                :full-colors="{{ json_encode(AnimalColorFull::cases()) }}"
                :full-color-minks="{{ json_encode(AnimalColorFull::MINK_COLORS) }}"
                :full-color-labels="{{ json_encode((object) __('enums.' . AnimalColorFull::class)) }}"
                :shaded-colors="{{ json_encode(AnimalColorShaded::cases()) }}"
                :shaded-color-labels="{{ json_encode((object) __('enums.' . AnimalColorShaded::class)) }}"
                :mink-colors="{{ json_encode(AnimalColorMink::cases()) }}"
                :mink-color-labels="{{ json_encode((object) __('enums.' . AnimalColorMink::class)) }}"
            >
                <template v-slot:modal-header>
                    {{ __('Edit an animal') }}
                </template>
                <template v-slot:animal-name-header>
                    {{ __(sprintf('models.%s.fields.name', Animal::class)) }}
                </template>
                <template v-slot:animal-build-header>
                    {{ __(sprintf('models.%s.fields.build', Animal::class)) }}
                </template>
                <template v-slot:animal-fur-header>
                    {{ __(sprintf('models.%s.fields.fur', Animal::class)) }}
                </template>
                <template v-slot:animal-gender-header>
                    {{ __(sprintf('models.%s.fields.gender', Animal::class)) }}
                </template>
                <template v-slot:animal-eyes-header>
                    {{ __(sprintf('models.%s.fields.eyes', Animal::class)) }}
                </template>
                <template v-slot:animal-mark-primary-header>
                    {{ __(sprintf('models.%s.fields.mark_primary', Animal::class)) }}
                </template>
                <template v-slot:animal-mark-secondary-header>
                    {{ __(sprintf('models.%s.fields.mark_secondary', Animal::class)) }}
                </template>
                <template v-slot:animal-color-header>
                    {{ __(sprintf('models.%s.fields.color', Animal::class)) }}
                </template>
                <template v-slot:animal-effect-header>
                    {{ __(sprintf('models.%s.fields.effect', Animal::class)) }}
                </template>
                <template v-slot:animal-breeding-type-header>
                    {{ __(sprintf('models.%s.fields.breeding_type', Animal::class)) }}
                </template>
                <template v-slot:animal-note-header>
                    {{ __(sprintf('models.%s.fields.note', Animal::class)) }}
                </template>
                <template v-slot:animal-registration-no-header>
                    {{ __(sprintf('models.%s.fields.registration_no', Animal::class)) }}
                </template>
                <template v-slot:animal-title-header>
                    {{ __(sprintf('models.%s.fields.titles', Animal::class)) }}
                </template>
                <template v-slot:modal-footer-close-text>
                    {{ __('Close') }}
                </template>
                <template v-slot:modal-footer-save-text>
                    {{ __('Save') }}
                </template>
                <template v-slot:button-add-label>
                    {{ __('Add') }}
                </template>
            </animal-editor>

            <hr>

            <h2>{{ __('Files') }}</h2>

            <div class="row">
                <div class="col">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">{{ __('Pedigree') }}</span>
                        </div>
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" accept="application/pdf,application/msword" name="files[pedigree]">
                            <label class="custom-file-label">{{ __('Choose File') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
