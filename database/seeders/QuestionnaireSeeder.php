<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnaireSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Opsi Jawaban (Skala Likert)
        $options = [
            ['option_text' => 'Ya, Selalu', 'weight' => 10, 'sort_order' => 1],
            ['option_text' => 'Kadang-kadang', 'weight' => 5, 'sort_order' => 2],
            ['option_text' => 'Jarang', 'weight' => 2, 'sort_order' => 3],
            ['option_text' => 'Tidak Pernah', 'weight' => 0, 'sort_order' => 4],
        ];

        foreach ($options as $opt) {
            // Pakai updateOrInsert biar gak duplikat kalau di-run berkali-kali
            DB::table('questionnaire_options')->updateOrInsert(
                ['option_text' => $opt['option_text']],
                $opt
            );
        }

        // 2. Buat Pertanyaan
        $questions = [
            'Apakah anda minum obat sesuai jadwal?',
            'Apakah anda mengalami kesulitan tidur setelah minum obat?',
            'Apakah anda merasa mual setelah minum obat?',
            'Apakah ada anggota keluarga yang mengingatkan minum obat?',
            'Apakah anda merasa lelah berlebihan?',
        ];

        foreach ($questions as $q) {
            DB::table('questionnaire_questions')->updateOrInsert(
                ['question' => $q],
                ['is_active' => 1, 'created_at' => now()]
            );
        }
    }
}
