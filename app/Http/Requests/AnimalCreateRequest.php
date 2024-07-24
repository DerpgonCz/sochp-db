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
use App\Enums\Animal\AnimalTitleEnum;
use App\Enums\Auth\PermissionsEnum;
use App\Enums\GenderEnum;
use App\Models\Animal;
use App\Models\Litter;
use App\Rules\FlagEnumRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class AnimalCreateRequest extends FormRequest
{
    public function rules(): array
    {
        /** @var \App\Models\Litter $litter */
        $litter = $this->litter;

        return [
            'father_id' => [
                'nullable',
                Rule::exists('animals', 'id')
                    ->where('gender', GenderEnum::MALE),
            ],
            'mother_id' => [
                'nullable',
                Rule::exists('animals', 'id')
                    ->where('gender', GenderEnum::FEMALE),
            ],
            'station_id' => [
                'nullable',
                Rule::exists('stations', 'id'),
            ],
            'caretaker_id' => [
                'nullable',
                Rule::exists('users', 'id'),
                Rule::can('manage', Animal::class),
            ],
            'animals' => [
                'array:name,build,fur,gender,eyes,mark_primary,mark_secondary,color,effect,breeding_type,note,registration_no,title',
            ],
            'animal.name' => [
                'max:50',
            ],
            'animal.gender' => [
                Rule::in(GenderEnum::getValues()),
            ],
            'animal.eyes' => [
                Rule::in(AnimalEyesEnum::values()),
            ],
            'animal.mark_primary' => [
                Rule::in(AnimalPrimaryMarkEnum::values()),
            ],
            'animal.mark_secondary' => [
                'nullable',
                Rule::in(AnimalSecondaryMarkEnum::values()),
            ],
            'animal.color' => [
                'required',
            ],
            'animal.effect' => [
                'nullable',
                'numeric',
                new FlagEnumRule(AnimalEffectEnum::class),
            ],
            'animal.breeding_type' => [
                Rule::excludeIf(Gate::check(PermissionsEnum::MANAGE_LITTERS->value, Litter::class)),
                'nullable',
                Rule::in(AnimalBreedingTypeEnum::values()),
            ],
            'animal.build' => [
                'numeric',
                new FlagEnumRule(AnimalBuildEnum::class),
            ],
            'animal.fur' => [
                'numeric',
                new FlagEnumRule(AnimalFurEnum::class),
            ],
            'animal.note' => [
                'nullable',
                'string',
            ],
            'animal.registration_no' => [
                'nullable',
            ],
            'animal.title' => [
                'numeric',
                new FlagEnumRule(AnimalTitleEnum::class),
            ],
            'animal.date_of_birth' => [
                'date'
            ]
        ];
    }
}
