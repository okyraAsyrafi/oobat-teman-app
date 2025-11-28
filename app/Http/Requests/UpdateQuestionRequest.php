<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Kamu sudah pakai pengecekan role di Store, jadi tetap konsisten
        return auth()->check() && (
            auth()->user()->hasRole('superadmin') ||
            auth()->user()->hasRole('perawat')
        );
    }

    // app/Http/Requests/Admin/UpdateQuestionRequest.php
    public function rules(): array
    {
        return [
            'question' => [
                'required',
                'string',

            ],
            'is_active' => ['boolean'],
        ];
    }
}
