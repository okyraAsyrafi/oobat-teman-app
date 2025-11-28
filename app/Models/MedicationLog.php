<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicationLog extends Model
{
    protected $fillable = [
        'schedule_id',
        'log_date',
        'is_taken',
        'img_path',
        'notes',
        'taken_at',
        'created_by',
    ];

    protected $casts = [
        'log_date' => 'date',
        'is_taken' => 'boolean',
        'taken_at' => 'datetime',
    ];

    public function schedule()
    {
        return $this->belongsTo(MedicationSchedule::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'created_by');
    }

    // Helper: status badge
    public function getStatusClassAttribute()
    {
        if (!$this->is_taken) {
            // Cek apakah sudah lewat
            if ($this->log_date < now()->toDateString()) {
                return 'bg-red-100 text-red-800';
            }
            return 'bg-gray-100 text-gray-800';
        }
        return 'bg-green-100 text-green-800';
    }

    public function getStatusTextAttribute()
    {
        if (!$this->is_taken) {
            if ($this->log_date < now()->toDateString()) {
                return 'Tidak Konfirmasi';
            }
            return 'Belum Konfirmasi';
        }
        return 'Terkonfirmasi';
    }
}
