<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QuestionAnswer;
use App\Models\QuestionDetailAnswer;
use App\Models\QuestionnaireOption;
use App\Models\QuestionnaireQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionnaireController extends Controller
{
    // 1. AMBIL SOAL & OPSI
    public function getQuestions()
    {
        // Ambil soal aktif
        $questions = QuestionnaireQuestion::where('is_active', 1)->get();
        // Ambil semua opsi (karena opsinya seragam untuk semua soal di kasus ini)
        $options = QuestionnaireOption::orderBy('sort_order')->get();

        // Format data agar mudah dibaca Flutter
        $data = $questions->map(function ($q) use ($options) {
            return [
                'id' => $q->id,
                'question' => $q->question,
                'options' => $options // Tempel opsi di setiap soal
            ];
        });

        return response()->json(['data' => $data]);
    }

    // 2. CEK STATUS BULAN INI
    public function checkStatus(Request $request)
    {
        $user = $request->user();

        // Cek apakah ada record di tabel question_answers pada bulan & tahun ini
        $hasFilled = QuestionAnswer::where('patient_id', $user->id)
            ->whereYear('date_answer', now()->year)
            ->whereMonth('date_answer', now()->month)
            ->exists();

        return response()->json([
            'meta' => ['code' => 200, 'status' => 'success'],
            'data' => ['has_filled' => $hasFilled]
        ]);
    }

    // 3. KIRIM JAWABAN
    public function submit(Request $request)
    {
        $request->validate([
            'answers' => 'required|array', // Array: [{question_id: 1, option_id: 2}, ...]
            'side_effect' => 'nullable|string',
            'complaints' => 'nullable|string',
        ]);

        $user = $request->user();

        // Validasi Double Submit (Opsional, tapi aman)
        $alreadyFilled = QuestionAnswer::where('patient_id', $user->id)
            ->whereYear('date_answer', now()->year)
            ->whereMonth('date_answer', now()->month)
            ->exists();

        if ($alreadyFilled) {
            return response()->json(['message' => 'Anda sudah mengisi kuesioner bulan ini.'], 400);
        }

        DB::beginTransaction();
        try {
            // A. Hitung Skor Rata-rata
            $totalScore = 0;
            $count = count($request->answers);

            // Ambil bobot dari DB biar aman (jangan percaya bobot kiriman client)
            foreach ($request->answers as $ans) {
                $opt = QuestionnaireOption::find($ans['option_id']);
                if ($opt) $totalScore += $opt->weight;
            }

            $avgScore = $count > 0 ? $totalScore / $count : 0;

            // B. Simpan Header Jawaban
            $header = QuestionAnswer::create([
                'patient_id' => $user->id,
                'date_answer' => now(),
                'score_avg' => $avgScore,
                'side_effect' => $request->side_effect,
                'complaints' => $request->complaints,
                'created_by' => $user->id,
            ]);

            // C. Simpan Detail Jawaban
            foreach ($request->answers as $ans) {
                QuestionDetailAnswer::create([
                    'question_answer_id' => $header->id,
                    'questionnaire_question_id' => $ans['question_id'],
                    'questionnaire_option_id' => $ans['option_id'],
                    'created_by' => $user->id,
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Terima kasih, kuesioner berhasil disimpan.'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan: ' . $e->getMessage()], 500);
        }
    }
}
