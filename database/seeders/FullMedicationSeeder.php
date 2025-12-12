<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FullMedicationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DAFTAR ID PASIEN (Sesuai Dump SQL kamu)
        // ID 2 adalah kamu (Okyra), sisanya pasien dummy
        $patientIds = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16];

        // Kosongkan tabel dulu biar bersih (Opsional, hati-hati kalau data real)
        // DB::table('medication_logs')->truncate();
        // DB::table('medication_schedules')->truncate();

        foreach ($patientIds as $patientId) {
            // --- A. BUAT JADWAL (SCHEDULE) ---

            // Kita acak jam minum obatnya biar variatif
            $hours = ['07:00:00', '08:00:00', '12:00:00', '19:00:00', '20:00:00'];
            $timeOfDay = $hours[array_rand($hours)];

            // Kita acak start date (mulai pengobatan) antara 10-30 hari lalu
            $startDate = Carbon::now()->subDays(rand(10, 30));

            $scheduleId = DB::table('medication_schedules')->insertGetId([
                'patient_id'    => $patientId,
                'time_of_day'   => $timeOfDay,
                'duration_days' => 180, // 6 Bulan
                'start_date'    => $startDate->format('Y-m-d'),
                'notes'         => 'Rutin diminum setiap hari, jangan sampai putus.',
                'is_active'     => 1,
                'version'       => 1,
                'status'        => 0,
                'created_by'    => 1, // Admin ID
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            // --- B. BUAT RIWAYAT (LOGS) 7 HARI TERAKHIR ---

            // Loop dari 7 hari lalu sampai hari ini
            for ($i = 6; $i >= 0; $i--) {
                $logDate = Carbon::now()->subDays($i);

                // Random Status: 80% Kemungkinan Diminum (1), 20% Lupa (0)
                $isTaken = (rand(1, 100) <= 80) ? 1 : 0;

                // Kalau ID 2 (Kamu), kita bikin rajin minum obat biar demo bagus
                if ($patientId == 2) {
                    $isTaken = 1;
                    // Kecuali hari ini (index 0), kita set belum minum biar tombol konfirmasi muncul
                    if ($i == 0) continue;
                }

                if ($isTaken) {
                    // Skenario: Sudah Minum
                    DB::table('medication_logs')->insert([
                        'schedule_id' => $scheduleId,
                        'log_date'    => $logDate->format('Y-m-d'),
                        'is_taken'    => 1,
                        // Kita pakai gambar dummy yg ada di folder public/storage/logs/
                        // Pastikan kamu punya file dummy misal: foto_obat_p1_0.jpg
                        'img_path'    => 'logs/foto_obat_p1_0.jpg',
                        'notes'       => 'Aman, tidak ada efek samping.',
                        'taken_at'    => $logDate->format('Y-m-d') . ' ' . $timeOfDay, // Anggap minum pas waktu jadwal
                        'created_by'  => $patientId,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                } else {
                    // Skenario: Lupa / Belum Minum (Missed)
                    // Biasanya row log untuk 'missed' tidak selalu dibuat otomatis
                    // kecuali ada cronjob. Tapi untuk demo history, kita buatkan record 'gagal'.
                    DB::table('medication_logs')->insert([
                        'schedule_id' => $scheduleId,
                        'log_date'    => $logDate->format('Y-m-d'),
                        'is_taken'    => 0,
                        'img_path'    => '',
                        'notes'       => null,
                        'taken_at'    => null,
                        'created_by'  => $patientId,
                        'created_at'  => now(),
                        'updated_at'  => now(),
                    ]);
                }
            }
        }
    }
}
