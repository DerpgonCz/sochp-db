<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\GenderEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LitterStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            // TODO: Animals are approved
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
        ];
    }
}
