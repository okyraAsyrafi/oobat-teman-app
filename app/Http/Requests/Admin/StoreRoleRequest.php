<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->hasRole('superadmin');
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'alpha_dash', // hanya huruf, angka, underscore, dash
                Rule::unique('roles')->where(fn($q) => $q->where('guard_name', 'web')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Role dengan nama ini sudah ada.',
            'name.alpha_dash' => 'Nama role hanya boleh berisi huruf, angka, tanda hubung, atau underscore.',
        ];
    }
}
