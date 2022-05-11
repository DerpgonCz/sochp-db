<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\LitterStateEnum;
use App\Models\Litter;
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
        ];
    }
}
