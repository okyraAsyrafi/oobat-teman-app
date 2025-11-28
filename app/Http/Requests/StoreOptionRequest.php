<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('perawat'));
    }

    public function rules(): array
    {
        return [
            'option_text' => ['required', 'string', 'max:255', 'unique:questionnaire_options'],
            'weight' => ['required', 'integer'],
            'sort_order' => ['nullable', 'integer'],
        ];
    }
}
