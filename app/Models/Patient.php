<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory, HasApiTokens;

    protected $guarded = ['id'];

    // Kita sembunyikan kolom yang tidak perlu dilihat Flutter
    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'is_active'
    ];

    protected $fillable = [
        'name',
        'nik',
        'date_of_birth',
        'phone',
        'address',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active' => 'boolean',
    ];

    // Relasi ke User (Petugas) yang membuat/memperbarui data pasien
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Relasi ke Jadwal Obat (treatment_plans)
    public function medicationSchedules(): HasMany
    {
        return $this->hasMany(MedicationSchedule::class);
    }

    // Relasi ke Log Konfirmasi Obat (medication_logs)
    public function medicationLogs(): HasMany
    {
        // Dalam skema DDL Anda, medication_logs.created_by merujuk ke patients.id
        return $this->hasMany(MedicationLog::class, 'created_by');
    }

    // Relasi ke Jawaban Kuesioner
    public function questionAnswers(): HasMany
    {
        // Dalam skema DDL Anda, question_answers.patient_id merujuk ke patients.id
        return $this->hasMany(QuestionAnswer::class, 'patient_id');
    }
}
