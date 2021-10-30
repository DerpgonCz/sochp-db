<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DevLoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                Rule::exists('users', 'email'),
            ],
        ];
    }
}
