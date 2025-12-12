<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicationLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Wajib ada file gambar, max 5MB (5120 KB), harus format gambar
            'photo' => 'required|image|max:5120',
            'notes' => 'nullable|string|max:500',
            // Kita butuh tau jadwal ID mana yang dikonfirmasi
            'schedule_id' => 'required|exists:medication_schedules,id',
        ];
    }
}
