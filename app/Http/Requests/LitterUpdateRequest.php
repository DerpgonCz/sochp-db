<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\Animal\AnimalBuildEnum;
use App\Enums\LitterStateEnum;
use App\Models\Animal;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LitterUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
            ],
            'happened_on' => [
                'nullable',
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
            'animals' => [
                'array',
            ],
            'animals.*' => [
                'array:build,id',
            ],
            'animals.*.build' => [
                'numeric',
                Rule::in(AnimalBuildEnum::values()),
            ],
            'animals.*.id' => [
                'nullable',
                'numeric',
                Rule::exists(Animal::class, 'id')->where('litter_id', $this->litter->id),
            ],
        ];
    }
}
