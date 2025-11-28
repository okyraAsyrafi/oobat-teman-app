<?php

namespace App\Models;

use App\Models\MedicationLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicationSchedule extends Model
{
    protected $fillable = [
        'patient_id',
        'time_of_day',
        'duration_days',
        'start_date',
        'notes',
        'is_active',
        'version',
        'status',
        'cancelled_by',
        'cancellation_reason',
        'cancelled_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'time_of_day' => 'datetime:H:i',
        'start_date' => 'date',
        'duration_days' => 'integer',
        'is_active' => 'boolean',
        'status' => 'integer',
        'cancelled_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function canceller()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    public function logs()
    {
        return $this->hasMany(MedicationLog::class, 'schedule_id');
    }

    // Helper: cek apakah jadwal masih aktif
    public function isActive(): bool
    {
        return $this->is_active && $this->status === 0;
    }

    // Helper: hitung end date
    public function getEndDateAttribute()
    {
        return $this->start_date->addDays($this->duration_days - 1);
    }

    // Helper: status label
    public function getStatusLabelAttribute()
    {
        return $this->status === 1 ? 'Selesai' : 'Berlangsung';
    }

    // Helper: status badge class
    public function getStatusClassAttribute()
    {
        return $this->status === 1 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800';
    }
}
