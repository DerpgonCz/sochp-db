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
    use App\Enums\Animal\AnimalTitleEnum;
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
                <h2>{{ __('Edit a litter') }}</h2>
                <h5>{{ __('State') }}:
                    <x-litter-state-badge :litter="$litter"/>
                </h5>
            </div>
        </div>

        @if($errors->isNotEmpty())
        <div class="row justify-content-center">
            <div class="col">
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            </div>
        </div>
        @endif

        <div class="row justify-content-center">
            <form method="POST" action="{{ route('litters.update', $litter) }}" class="col">
                @method('PUT')
                @csrf

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.name', Litter::class)) }}</strong>
                    <input type="text" class="form-control" name="name"
                           placeholder="{{ __(sprintf('models.%s.fields.name', Litter::class)) }}"
                           value="{{ $litter->name }}" required>
                </label>

                @if(
                    $litter->state->in([
                        LitterStateEnum::FINALIZED,
                    ])
                )
                    <label class="form-group">
                        <strong>{{ __(sprintf('models.%s.fields.registration_no', Litter::class)) }} *</strong>
                        <input type="text" class="form-control" name="registration_no"
                               placeholder="{{ __(sprintf('models.%s.fields.registration_no', Litter::class)) }}"
                               value="{{ $litter->registration_no ?? old('registration_no') }}"
                               required>
                    </label>
                @endif

                @if(
                    $litter->state->in([
                        LitterStateEnum::BREEDING,
                        LitterStateEnum::REQUIRES_BREEDING_CHANGES,
                    ])
                )
                    <label class="form-group">
                        <strong>{{ __(sprintf('models.%s.fields.happened_on', Litter::class)) }}</strong>
                        <input type="date" class="form-control" name="happened_on"
                               placeholder="{{ __(sprintf('models.%s.fields.happened_on', Litter::class)) }}"
                               value="{{ optional($litter->happened_on ?? old('happened_on'))->format('Y-m-d') }}"
                               required>
                    </label>
                @endif

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.father.name', Litter::class)) }}</strong>
                    <x-parent-select
                            name="father_id"
                            :value="$litter?->father?->id"
                            :station-animals="$stationAnimalsMale"
                            :other-animals="$otherAnimalsMale"
                            i18n-field="father"
                    />
                </label>

                <label class="form-group">
                    <strong>{{ __(sprintf('models.%s.fields.mother.name', Litter::class)) }}</strong>
                    <x-parent-select
                            name="mother_id"
                            :value="$litter?->mother?->id"
                            :station-animals="$stationAnimalsFemale"
                            :other-animals="$otherAnimalsFemale"
                            i18n-field="mother"
                    />
                </label>

                @if(!$litter->state->in([
                    LitterStateEnum::DRAFT,
                    LitterStateEnum::REQUIRES_DRAFT_CHANGES,
                    LitterStateEnum::REQUIRES_BREEDING_APPROVAL,
                ]))
                    <hr>
                    <h3>{{ __('Children') }}</h3>
                    <animal-builder
                            :animals="{{ json_encode(collect($litter->children)->map(static fn(Animal $animal): array => $animal->toArray() + ['color' => AnimalColorBuilderValueSerializer::serialize($animal)])) }}"
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
                            :can-manage="{{ json_encode(Gate::check('manage', $litter)) }}"
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
                            :show-registration-no="{{ json_encode($litter->state->is(LitterStateEnum::FINALIZED)) }}"
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
                    </animal-builder>
                    <hr>
                @endif

                <label class="form-group text-right">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    @if($litter->state->in([LitterStateEnum::DRAFT, LitterStateEnum::REQUIRES_DRAFT_CHANGES]))
                        <button type="submit" name="state" value="{{ LitterStateEnum::REQUIRES_BREEDING_APPROVAL }}"
                                class="btn btn-success">{{ __('Send for breeding approval') }}</button>
                    @endif
                    @if($litter->state->in([LitterStateEnum::BREEDING, LitterStateEnum::REQUIRES_BREEDING_CHANGES]))
                        <button type="submit" name="state" value="{{ LitterStateEnum::REQUIRES_FINAL_APPROVAL }}"
                                class="btn btn-success">{{ __('Send for final approval') }}</button>
                    @endif

                    @if($litter->state->is(LitterStateEnum::REQUIRES_BREEDING_APPROVAL))
                        <button type="submit" name="state" value="{{ LitterStateEnum::REQUIRES_DRAFT_CHANGES }}"
                                class="btn btn-warning">{{ __('Requires changes') }}</button>
                        <button type="submit" name="state" value="{{ LitterStateEnum::BREEDING }}"
                                class="btn btn-success">{{ __('Approve for breeding') }}</button>
                    @endif
                    @if($litter->state->is(LitterStateEnum::REQUIRES_FINAL_APPROVAL))
                        <button type="submit" name="state" value="{{ LitterStateEnum::REQUIRES_BREEDING_CHANGES }}"
                                class="btn btn-warning">{{ __('Requires changes') }}</button>
                        <button type="submit" name="state" value="{{ LitterStateEnum::FINALIZED }}"
                                class="btn btn-success">{{ __('Approve') }}</button>
                    @endif
                    @if($litter->state->is(LitterStateEnum::FINALIZED))
                        <button type="submit" name="state" value="{{ LitterStateEnum::REGISTERED }}"
                                class="btn btn-success">{{ __('Approve registration') }}</button>
                    @endif
                </label>
            </form>
        </div>
    </div>
@endsection
