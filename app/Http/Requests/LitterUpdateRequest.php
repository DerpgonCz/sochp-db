<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Animal\AnimalBreedingTypeEnum;
use App\Enums\Animal\AnimalBuildEnum;
use App\Enums\Animal\AnimalEffectEnum;
use App\Enums\Animal\AnimalEyesEnum;
use App\Enums\Animal\AnimalFurEnum;
use App\Enums\Animal\AnimalPrimaryMarkEnum;
use App\Enums\Animal\AnimalSecondaryMarkEnum;
use App\Enums\Auth\PermissionsEnum;
use App\Enums\GenderEnum;
use App\Enums\LitterStateEnum;
use App\Models\Animal;
use App\Models\Litter;
use App\Rules\FlagEnumRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class LitterUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        /** @var \App\Models\Litter $litter */
        $litter = $this->litter;

        return [
            'name' => [
                'required',
            ],
            'happened_on' => [
                Rule::requiredIf(
                    $litter->state->in([
                        LitterStateEnum::BREEDING,
                        LitterStateEnum::REQUIRES_BREEDING_CHANGES,
                    ])
                ),
                'date',
            ],
            'mother_id' => [
                'nullable',
                Rule::exists('animals', 'id'),
            ],
            'father_id' => [
                'nullable',
                Rule::exists('animals', 'id'),
            ],
            'state' => [
                'integer',
                'numeric',
                Rule::in(LitterStateEnum::getValues()),
            ],
            'registration_no' => [
                Rule::requiredIf(
                    $litter->state->in([
                        LitterStateEnum::FINALIZED,
                    ])
                ),
            ],
            'animals' => [
                Rule::excludeIf(
                    $litter->state->in([
                        LitterStateEnum::DRAFT,
                        LitterStateEnum::REQUIRES_DRAFT_CHANGES,
                        LitterStateEnum::REQUIRES_BREEDING_APPROVAL,
                    ])
                ),
                'array',
            ],
            'animals.*' => [
                'array:id,name,build,fur,gender,eyes,mark_primary,mark_secondary,color,effect,breeding_type,note,registration_no',
            ],
            'animals.*.id' => [
                'nullable',
                'numeric',
                Rule::exists(Animal::class, 'id')->where('litter_id', $litter->id),
            ],
            'animals.*.name' => [
                'max:50',
            ],
            'animals.*.gender' => [
                Rule::in(GenderEnum::getValues()),
            ],
            'animals.*.eyes' => [
                Rule::in(AnimalEyesEnum::values()),
            ],
            'animals.*.mark_primary' => [
                'nullable',
                Rule::in(AnimalPrimaryMarkEnum::values()),
            ],
            'animals.*.mark_secondary' => [
                'nullable',
                Rule::in(AnimalSecondaryMarkEnum::values()),
            ],
            'animas.*.color' => [
                'required',
            ],
            'animas.*.effect' => [
                'nullable',
                'numeric',
                new FlagEnumRule(AnimalEffectEnum::class),
            ],
            'animals.*.breeding_type' => [
                Rule::excludeIf(Gate::check(PermissionsEnum::MANAGE_LITTERS->value, Litter::class)),
                'nullable',
                Rule::in(AnimalBreedingTypeEnum::values()),
            ],
            'animals.*.build' => [
                'numeric',
                new FlagEnumRule(AnimalBuildEnum::class),
            ],
            'animals.*.fur' => [
                'numeric',
                new FlagEnumRule(AnimalFurEnum::class),
            ],
            'animals.*.note' => [
                'nullable',
                'string',
            ],
            'animals.*.registration_no' => [
                Rule::requiredIf(
                    $litter->state->in([
                        LitterStateEnum::FINALIZED,
                    ])
                ),
            ],
        ];
    }
}
