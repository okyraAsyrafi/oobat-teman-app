<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class EducationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'date' => Carbon::parse($this->created_at)->translatedFormat('d M Y'), // Format "12 Des 2025"
            'content' => $this->content,
            // Generate Full URL Gambar
            'image_url' => $this->thumbnail_url ? url('storage/' . $this->thumbnail_url) : null,
        ];
    }
}
