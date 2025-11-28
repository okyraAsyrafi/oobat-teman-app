<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\QuestionAnswer;
use App\Models\QuestionDetailAnswer;
use App\Models\QuestionnaireOption;
use App\Models\QuestionnaireQuestion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionnaireDummySeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada user untuk created_by
        $admin = User::firstOrCreate([
            'email' => 'admin@obatteman.id',
        ], [
            'name' => 'Admin Utama',
            'username' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // === 1. Buat Pasien Dummy ===
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

        // === 2. Buat Pertanyaan Kuisioner ===
        $questions = QuestionnaireQuestion::insert([
            ['question' => 'Seberapa sering Anda merasa lelah?', 'is_active' => true],
            ['question' => 'Apakah Anda mengalami mual setelah minum obat?', 'is_active' => true],
            ['question' => 'Seberapa patuh Anda dalam minum obat sesuai jadwal?', 'is_active' => true],
        ]);

        // Ambil ID pertanyaan (auto-increment, jadi ambil dari DB)
        $qIds = QuestionnaireQuestion::pluck('id')->toArray();

        // === 3. Buat Opsi Jawaban (UNIK!) ===
        QuestionnaireOption::insert([
            ['option_text' => 'Tidak pernah', 'weight' => 10, 'sort_order' => 1],
            ['option_text' => 'Kadang-kadang', 'weight' => 7, 'sort_order' => 2],
            ['option_text' => 'Sering', 'weight' => 4, 'sort_order' => 3],
            ['option_text' => 'Selalu', 'weight' => 1, 'sort_order' => 4],
        ]);

        // Ambil ID opsi
        $optionIds = QuestionnaireOption::pluck('id')->toArray();

        // === 4. Buat Hasil Kuisioner + Detail Jawaban ===
        // Kuisioner 1: Pasien Satu
        $qa1 = QuestionAnswer::create([
            'patient_id' => $patient1->id,
            'date_answer' => now()->subDays(2),
            'score_avg' => 7.33, // rata-rata dari (10 + 7 + 7) / 3
            'side_effect' => 'Sedikit pusing',
            'complaints' => 'Sulit bangun pagi',
            'created_by' => $patient1->id,
        ]);

        // Detail jawaban untuk kuisioner 1
        QuestionDetailAnswer::insert([
            ['question_answer_id' => $qa1->id, 'questionnaire_question_id' => $qIds[0], 'questionnaire_option_id' => $optionIds[1], 'created_by' => $patient1->id],
            ['question_answer_id' => $qa1->id, 'questionnaire_question_id' => $qIds[1], 'questionnaire_option_id' => $optionIds[0], 'created_by' => $patient1->id],
            ['question_answer_id' => $qa1->id, 'questionnaire_question_id' => $qIds[2], 'questionnaire_option_id' => $optionIds[1], 'created_by' => $patient1->id],
        ]);

        // Kuisioner 2: Pasien Dua
        $qa2 = QuestionAnswer::create([
            'patient_id' => $patient2->id,
            'date_answer' => now()->subDays(1),
            'score_avg' => 3.67, // (1 + 4 + 6) → misal (1+4+4)/3 = 3
            'side_effect' => 'Mual berat',
            'complaints' => 'Tidak nafsu makan',
            'created_by' => $patient2->id,
        ]);

        QuestionDetailAnswer::insert([
            ['question_answer_id' => $qa2->id, 'questionnaire_question_id' => $qIds[0], 'questionnaire_option_id' => $optionIds[3], 'created_by' => $patient2->id],
            ['question_answer_id' => $qa2->id, 'questionnaire_question_id' => $qIds[1], 'questionnaire_option_id' => $optionIds[2], 'created_by' => $patient2->id],
            ['question_answer_id' => $qa2->id, 'questionnaire_question_id' => $qIds[2], 'questionnaire_option_id' => $optionIds[2], 'created_by' => $patient2->id],
        ]);

        $this->command->info('✅ Data dummy kuisioner berhasil diisi!');
    }
}
