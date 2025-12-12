<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MedicationLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->log_date, // Format YYYY-MM-DD
            'is_taken' => (bool) $this->is_taken,
            // Kita generate Full URL gambar biar Flutter tinggal pakai
            'photo_url' => $this->img_path ? url('storage/' . $this->img_path) : null,
            'notes' => $this->notes,
            'taken_at' => $this->taken_at,
        ];
    }
}
