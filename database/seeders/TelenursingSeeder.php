<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TelenursingSeeder extends Seeder
{
    public function run(): void
    {
        // Data Dummy (3 Petugas)
        $contacts = [
            [
                'name' => 'Ns. Budi Santoso',
                'phone' => '6281234567890',
                'order_index' => 1,
                'is_active' => 1,
                'created_by' => 1, // Admin ID
                'created_at' => now(),
            ],
            [
                'name' => 'Ns. Siti Aminah',
                'phone' => '6289876543210',
                'order_index' => 2,
                'is_active' => 1,
                'created_by' => 1,
                'created_at' => now(),
            ],
            [
                'name' => 'Admin Puskesmas',
                'phone' => '6281122334455',
                'order_index' => 3,
                'is_active' => 1,
                'created_by' => 1,
                'created_at' => now(),
            ],
        ];

        // Masukkan ke database (truncate dulu biar bersih kalau mau reset)
        // DB::table('whatsapp_contacts')->truncate();

        foreach ($contacts as $contact) {
            DB::table('whatsapp_contacts')->updateOrInsert(
                ['phone' => $contact['phone']], // Cek biar gak duplikat by phone
                $contact
            );
        }
    }
}
