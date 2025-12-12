<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ScheduleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'time' => Carbon::parse($this->time_of_day)->format('H:i'),
            'notes' => $this->notes,
            'is_active' => (bool) $this->is_active,
        ];
    }
}
