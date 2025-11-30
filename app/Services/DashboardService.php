<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\MedicationLog;

class DashboardService
{
    /**
     * Menghitung 4 metrik ringkasan utama untuk Summary Cards.
     */
    public function getSummaryData(): array
    {
        $today = Carbon::today()->toDateString();

        // 1. Total Pasien Aktif
        $totalPatients = Patient::where('is_active', true)->count();

        // 2. Pasien Aktif Hari Ini (Memiliki Jadwal yang Berlaku Hari Ini)
        // Logika: start_date <= today AND end_date >= today
        $patientsWithActiveScheduleToday = Patient::where('is_active', true)
            ->whereHas('medicationSchedules', function ($query) use ($today) {
                $query->where('is_active', true)
                    ->where('start_date', '<=', $today)
                    // Menghitung end date: start_date + (duration_days - 1)
                    ->whereRaw('DATE_ADD(start_date, INTERVAL duration_days - 1 DAY) >= ?', [$today])
                    ->where('status', 0); // Status Berlangsung
            })
            ->count();

        // 3. Pasien Sudah Konfirmasi Hari Ini
        // Menggunakan created_by di medication_logs yang merujuk ke patient_id
        $confirmedPatientsToday = MedicationLog::whereDate('log_date', $today)
            ->where('is_taken', true)
            ->distinct('created_by')
            ->count('created_by');

        // 3. Belum Minum Obat (Pasien Aktif yang Belum Konfirmasi)
        $notTakenToday = max(0, $patientsWithActiveScheduleToday - $confirmedPatientsToday);

        // 4. Pasien Selesai Pengobatan
        $finishedPatients = Patient::whereHas('medicationSchedules', function ($query) {
            $query->where('status', 1); // Status Selesai
        })->distinct()->count();


        return [
            'total_patients' => $totalPatients,
            'active_today' => $patientsWithActiveScheduleToday,
            'not_taken_today' => $notTakenToday,
            'finished_treatment' => $finishedPatients,
        ];
    }

    /**
     * Menghitung data tren kepatuhan pasien selama N hari (untuk Stacked Bar Chart).
     * Fokus pada Jumlah Pasien Minum Obat vs. Tidak Minum Obat.
     */
    public function getCompliancePatientTrend(int $days = 30): array
    {
        $results = [];
        $today = Carbon::today();

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = $today->copy()->subDays($i)->toDateString();

            // 1. Pasien yang Konfirmasi Hari Ini
            $confirmedPatients = MedicationLog::whereDate('log_date', $date)
                ->where('is_taken', true)
                ->distinct('created_by')
                ->count('created_by');

            // 2. Pasien yang Seharusnya Aktif Hari Ini (Target)
            $activePatients = Patient::where('is_active', true)
                ->whereHas('medicationSchedules', function ($query) use ($date) {
                    $query->where('is_active', true)
                        ->where('start_date', '<=', $date)
                        ->whereRaw('DATE_ADD(start_date, INTERVAL duration_days - 1 DAY) >= ?', [$date])
                        ->where('status', 0);
                })->count();

            // 3. Pasien yang Belum/Tidak Konfirmasi Hari Ini
            $notConfirmedPatients = max(0, $activePatients - $confirmedPatients);

            $results[] = [
                'date' => Carbon::parse($date)->format('d/m'),
                'confirmed' => $confirmedPatients,
                'not_confirmed' => $notConfirmedPatients,
            ];
        }

        // Mempersiapkan data dalam format yang mudah dibaca oleh Chart.js
        $labels = array_column($results, 'date');
        $confirmedData = array_column($results, 'confirmed');
        $notConfirmedData = array_column($results, 'not_confirmed');

        return [
            'labels' => $labels,
            'confirmed' => $confirmedData,
            'not_confirmed' => $notConfirmedData,
        ];
    }
}
