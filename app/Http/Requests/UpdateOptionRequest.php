<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() &&
            (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('perawat'));
    }

    // app/Http/Requests/Admin/UpdateOptionRequest.php
    public function rules(): array
    {
        return [
            'option_text' => [
                'required',
                'string',
                'max:255',
            ],
            'weight' => ['required', 'integer'],
            'sort_order' => ['nullable', 'integer'],
        ];
    }
}
