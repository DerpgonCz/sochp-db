<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\StationStateEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StationUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'nullable',
            ],
            'state' => [
                'integer',
                'numeric',
                Rule::in(StationStateEnum::getValues()),
            ],
        ];
    }
}
