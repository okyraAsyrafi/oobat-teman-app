<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicationScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan tabel kosong dulu biar gak duplikat (Opsional)
        // DB::table('medication_schedules')->truncate();

        // Jadwal untuk Pasien ID 2 (Okyra - yang kamu pakai login)
        DB::table('medication_schedules')->insert([
            'patient_id'    => 2, // ID Pasien Okyra
            'time_of_day'   => '08:00:00', // Jam Alarm
            'duration_days' => 180, // Pengobatan TB biasanya 6 bulan
            'start_date'    => Carbon::now()->subDays(2)->format('Y-m-d'), // Mulai 2 hari lalu
            'notes'         => 'Minum 4 tablet sekaligus, jangan diputus.',
            'is_active'     => 1, // Aktif
            'version'       => 1,
            'status'        => 0,
            'created_by'    => 1, // ID Admin (User)
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // Tambahan: Jadwal untuk Pasien Lain (ID 13 - dari dump lama)
        DB::table('medication_schedules')->insert([
            'patient_id'    => 13,
            'time_of_day'   => '20:00:00', // Jam 8 Malam
            'duration_days' => 60,
            'start_date'    => Carbon::now()->format('Y-m-d'),
            'notes'         => 'Minum sebelum tidur.',
            'is_active'     => 1,
            'version'       => 1,
            'status'        => 0,
            'created_by'    => 1,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }
}
