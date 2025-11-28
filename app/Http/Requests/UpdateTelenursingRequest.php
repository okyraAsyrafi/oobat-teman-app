<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTelenursingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('perawat'));
    }

    public function rules(): array
    {
        return [
            'name_1' => ['required', 'string', 'max:255'],
            'phone_1' => ['required', 'regex:/^(\+62|62)[0-9]{8,12}$/', 'max:20'],
            'name_2' => ['required', 'string', 'max:255'],
            'phone_2' => ['required', 'regex:/^(\+62|62)[0-9]{8,12}$/', 'max:20'],
            'name_3' => ['required', 'string', 'max:255'],
            'phone_3' => ['required', 'regex:/^(\+62|62)[0-9]{8,12}$/', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_1.regex' => 'Nomor WhatsApp Petugas 1 harus berformat internasional (contoh: +62812... atau 62812...)',
            'phone_2.regex' => 'Nomor WhatsApp Petugas 2 harus berformat internasional',
            'phone_3.regex' => 'Nomor WhatsApp Petugas 3 harus berformat internasional',
        ];
    }
}
