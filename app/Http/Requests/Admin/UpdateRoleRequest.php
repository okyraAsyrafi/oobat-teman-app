<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole('superadmin');
    }

    public function rules(): array
    {
        $roleId = $this->route('role'); // Ambil ID dari URL: /admin/roles/{role}

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('roles', 'name')
                    ->ignore($roleId) // Hindari bentrok dengan data sendiri
                    ->where(fn($q) => $q->where('guard_name', 'web')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama role wajib diisi.',
            'name.unique' => 'Nama role ini sudah digunakan.',
            'name.alpha_dash' => 'Nama role hanya boleh berisi huruf, angka, underscore (_), atau tanda hubung (-).',
        ];
    }
}
