<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('perawat'));
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nik' => [
                'required',
                'digits:16',
                Rule::unique('patients', 'nik'),
            ],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nik.digits' => 'NIK harus 16 digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar.',
            'date_of_birth.before' => 'Tanggal lahir harus di masa lalu.',
        ];
    }
}
