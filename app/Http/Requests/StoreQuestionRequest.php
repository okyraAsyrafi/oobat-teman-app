<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('perawat'));
    }

    public function rules(): array
    {
        return [
            'question' => ['required', 'string'],
            'is_active' => ['boolean'],
        ];
    }
}
