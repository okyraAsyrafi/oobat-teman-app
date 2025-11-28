<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('perawat'));
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
