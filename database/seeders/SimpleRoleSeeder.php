<?php
// database/seeders/SimpleRoleSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class SimpleRoleSeeder extends Seeder
{
    public function run()
    {
        // Reset cache biar ga error kalau dijalankan ulang
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat role kalau belum ada
        Role::firstOrCreate(['name' => 'superadmin']);
        Role::firstOrCreate(['name' => 'perawat']);

        // Buat user Super Admin otomatis
        $superadmin = User::updateOrCreate(
            ['email' => 'admin@obatteman.id'],
            [
                'name'     => 'Super Admin',
                'username' => 'superadmin',
                'password' => bcrypt('obatteman2025'),
            ]
        );

        // Kasih role superadmin
        $superadmin->assignRole('superadmin');

        // Optional: buat contoh user perawat
        $perawat = User::updateOrCreate(
            ['email' => 'perawat@obatteman.id'],
            [
                'name'     => 'Perawat Puskesmas',
                'username' => 'perawat1',
                'password' => bcrypt('perawat2025'),
            ]
        );
        $perawat->assignRole('perawat');

        $this->command->info('Role superadmin & perawat berhasil dibuat!');
        $this->command->info('Login Super Admin: admin@obatteman.id / obatteman2025');
        $this->command->info('Login Perawat    : perawat@obatteman.id / perawat2025');
    }
}
