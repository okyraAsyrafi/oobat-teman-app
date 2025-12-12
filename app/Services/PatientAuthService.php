<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Validation\ValidationException;

class PatientAuthService
{
    public function login($nik, $dateOfBirth)
    {
        // 1. Cari Pasien berdasarkan NIK & Tgl Lahir
        $patient = Patient::where('nik', $nik)
            ->where('date_of_birth', $dateOfBirth)
            ->first();

        // 2. Jika tidak ketemu, lempar error
        if (!$patient) {
            throw ValidationException::withMessages([
                'nik' => ['Data pasien tidak ditemukan atau tanggal lahir salah.'],
            ]);
        }

        // 3. Cek Status Aktif
        if (!$patient->is_active) {
            throw ValidationException::withMessages([
                'nik' => ['Akun pasien non-aktif. Hubungi petugas.'],
            ]);
        }

        // 4. Generate Token Sanctum
        // 'mobile-app' adalah nama tokennya
        $token = $patient->createToken('mobile-app')->plainTextToken;

        return [
            'patient' => $patient,
            'token' => $token
        ];
    }
}
