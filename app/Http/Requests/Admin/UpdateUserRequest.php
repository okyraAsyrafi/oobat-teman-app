<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Hanya superadmin yang boleh mengedit user
        return auth()->check() && auth()->user()->hasRole('superadmin');
    }

    public function rules(): array
    {
        $user = $this->route('user'); // Ambil model User dari route: /admin/users/{user}

        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => [
                'required',
                Rule::exists('roles', 'name')->where(fn($query) => $query->where('guard_name', 'web')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'role.exists' => 'Role yang dipilih tidak valid.',
        ];
    }
}
