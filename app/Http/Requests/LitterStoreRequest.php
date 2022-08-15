<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LitterStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            // TODO: Animals are approved
            'mother' => ['nullable', Rule::exists('animals', 'id')],
            'father' => ['nullable', Rule::exists('animals', 'id')],
        ];
    }
}
