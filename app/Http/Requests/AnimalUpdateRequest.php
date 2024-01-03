<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnimalUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'caretaker_id' => [
                'nullable',
                Rule::exists('users', 'id'),
            ],
        ];
    }
}
