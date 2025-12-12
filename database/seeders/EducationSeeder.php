<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EducationSeeder extends Seeder
{
    public function run(): void
    {
        // Data Statis (3 Artikel Utama)
        $educations = [
            [
                'title' => 'Cara Minum Obat TB yang Benar',
                'content' => 'Minum obat TB harus rutin setiap hari pada jam yang sama agar bakteri tidak kebal. <br><br> Pastikan Anda tidak melewatkan satu dosis pun. Jika lupa, segera minum saat ingat, kecuali jika sudah dekat waktu minum obat selanjutnya.',
                'image_path' => 'educations/img-edu1.jpg', // Sesuai kolom database: image_path
                'is_active' => 1, // Sesuai kolom database: is_active
                'created_by' => 2, // ID User kamu (Okyra)
                'created_at' => now(),
            ],
            [
                'title' => 'Efek Samping Obat TB & Cara Mengatasinya',
                'content' => 'Beberapa pasien mungkin mengalami mual, pusing, atau air seni berwarna merah. <br><br> Ini adalah reaksi wajar dari obat Rifampisin. Namun jika mata atau kulit menguning, segera hubungi dokter.',
                'image_path' => 'educations/img-edu2.jpg',
                'is_active' => 1,
                'created_by' => 2,
                'created_at' => now()->subDay(),
            ],
            [
                'title' => 'Makanan Bergizi untuk Pasien TB',
                'content' => 'Pasien TB membutuhkan asupan protein tinggi (telur, ikan, daging) untuk memperbaiki sel paru-paru yang rusak. Hindari rokok dan alkohol.',
                'image_path' => 'educations/img-edu3.jpg',
                'is_active' => 1,
                'created_by' => 2,
                'created_at' => now()->subDays(2),
            ],
        ];

        // Tambah 7 Data Dummy Tambahan (Looping)
        for ($i = 4; $i <= 10; $i++) {
            $educations[] = [
                'title' => "Tips Kesehatan TB Bagian $i",
                'content' => "Ini adalah konten edukasi dummy untuk mengetes scroll list artikel. Isi konten ini bisa panjang sekali... " . Str::random(100),
                'image_path' => null,
                'is_active' => 1,
                'created_by' => 2,
                'created_at' => now()->subDays($i),
            ];
        }

        foreach ($educations as $edu) {
            // KITA CEK BERDASARKAN TITLE (Karena tidak ada slug)
            // Dan pastikan nama tabelnya 'education' (sesuai dump SQL)
            DB::table('education')->updateOrInsert(
                ['title' => $edu['title']],
                $edu
            );
        }
    }
}
