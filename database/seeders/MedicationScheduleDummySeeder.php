<?php

namespace Database\Seeders;

use App\Models\MedicationLog;
use App\Models\MedicationSchedule;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MedicationScheduleDummySeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada user admin (untuk created_by)
        $admin = User::firstOrCreate([
            'email' => 'admin@obatteman.id',
        ], [
            'name' => 'Admin Utama',
            'username' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Pastikan ada pasien
        $patient1 = Patient::firstOrCreate([
            'nik' => '3271012345678901',
        ], [
            'name' => 'Pasien Satu',
            'date_of_birth' => '1990-05-15',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 1',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        $patient2 = Patient::firstOrCreate([
            'nik' => '3271012345678902',
        ], [
            'name' => 'Pasien Dua',
            'date_of_birth' => '1985-12-10',
            'phone' => '081234567891',
            'address' => 'Jl. Sudirman No. 2',
            'is_active' => true,
            'created_by' => $admin->id,
        ]);

        // === 1. Buat Jadwal Obat ===
        $schedule1 = MedicationSchedule::create([
            'patient_id' => $patient1->id,
            'time_of_day' => '08:00:00',
            'duration_days' => 7,
            'start_date' => now()->subDays(3)->toDateString(), // mulai 3 hari lalu
            'notes' => 'Minum pagi sebelum sarapan',
            'is_active' => true,
            'version' => 1,
            'status' => 0, // berlangsung
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);

        $schedule2 = MedicationSchedule::create([
            'patient_id' => $patient2->id,
            'time_of_day' => '20:00:00',
            'duration_days' => 5,
            'start_date' => now()->subDays(2)->toDateString(), // mulai 2 hari lalu
            'notes' => 'Minum malam sebelum tidur',
            'is_active' => true,
            'version' => 1,
            'status' => 0,
            'created_by' => $admin->id,
            'updated_by' => $admin->id,
        ]);

        // === 2. Buat Bukti Konfirmasi (medication_logs) ===
        // Simulasi: buat log untuk setiap hari dalam durasi jadwal

        // Jadwal 1: 7 hari → log dari hari ke -3 s/d hari ke +3
        for ($i = -3; $i <= 3; $i++) {
            $logDate = now()->addDays($i)->toDateString();
            $isTaken = $i <= 1; // hari ini dan kemarin sudah konfirmasi, besok belum
            $imgPath = 'logs/foto_obat_p1_' . $i . '.jpg';

            // Simpan foto dummy ke storage (opsional)
            Storage::disk('public')->put($imgPath, 'Dummy image content');

            MedicationLog::create([
                'schedule_id' => $schedule1->id,
                'log_date' => $logDate,
                'is_taken' => $isTaken,
                'img_path' => $imgPath,
                'notes' => $isTaken ? 'Sudah minum obat sesuai jadwal.' : null,
                'taken_at' => $isTaken ? now()->addDays($i)->setTime(8, 15) : null,
                'created_by' => $patient1->id,
            ]);
        }

        // Jadwal 2: 5 hari → log dari hari ke -2 s/d hari ke +2
        for ($i = -2; $i <= 2; $i++) {
            $logDate = now()->addDays($i)->toDateString();
            $isTaken = $i < 0; // hanya hari lalu yang sudah konfirmasi
            $imgPath = 'logs/foto_obat_p2_' . $i . '.jpg';

            Storage::disk('public')->put($imgPath, 'Dummy image content');

            MedicationLog::create([
                'schedule_id' => $schedule2->id,
                'log_date' => $logDate,
                'is_taken' => $isTaken,
                'img_path' => $imgPath,
                'notes' => $isTaken ? 'Minum malam, kondisi baik.' : null,
                'taken_at' => $isTaken ? now()->addDays($i)->setTime(20, 10) : null,
                'created_by' => $patient2->id,
            ]);
        }

        $this->command->info('✅ Data dummy Jadwal Obat & Konfirmasi berhasil diisi!');
    }
}
