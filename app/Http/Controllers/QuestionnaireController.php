<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\QuestionAnswer;
use App\Models\QuestionnaireOption;
use App\Models\QuestionnaireQuestion;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;

class QuestionnaireController extends Controller
{
    public function index(): View
    {
        $questions = QuestionnaireQuestion::latest()->paginate(10);
        $options = QuestionnaireOption::orderBy('sort_order')->paginate(10);

        return view('questionnaire.index', compact('questions', 'options'));
    }

    // --- QUESTIONS ---
    public function createQuestion(): View
    {
        return view('questionnaire.create_question');
    }

    public function storeQuestion(StoreQuestionRequest $request): RedirectResponse
    {
        QuestionnaireQuestion::create($request->validated());

        return redirect()->route('questionnaire.index')->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function editQuestion(QuestionnaireQuestion $question): View
    {
        return view('questionnaire.edit_question', compact('question'));
    }

    public function updateQuestion(UpdateQuestionRequest $request, QuestionnaireQuestion $question): RedirectResponse
    {
        $question->update($request->validated());

        return redirect()->route('questionnaire.index')->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroyQuestion(QuestionnaireQuestion $question): RedirectResponse
    {
        // 1. Cek Integritas Data (Jika ada jawaban, jangan dihapus permanen)
        // Karena kita sudah mengaktifkan Soft Deletes di Model Question,
        // kita tidak perlu cek manual Foreign Key lagi. $question->delete() akan berhasil.

        $question->delete();

        return back()->with('success', 'Pertanyaan berhasil dinonaktifkan');
    }
    // --- OPTIONS ---
    public function createOption(): View
    {
        return view('questionnaire.create_option');
    }

    public function storeOption(StoreOptionRequest $request): RedirectResponse
    {
        QuestionnaireOption::create($request->validated());

        return redirect()->route('questionnaire.index')->with('success', 'Opsi jawaban berhasil ditambahkan.');
    }

    public function editOption(QuestionnaireOption $option): View
    {
        return view('questionnaire.edit_option', compact('option'));
    }

    public function updateOption(UpdateOptionRequest $request, QuestionnaireOption $option): RedirectResponse
    {
        $option->update($request->validated());

        return redirect()->route('questionnaire.index')->with('success', 'Opsi jawaban berhasil diperbarui.');
    }

    public function destroyOption(QuestionnaireOption $option): RedirectResponse
    {
        // 1. Cek Integritas Data (Optional, tapi lebih aman untuk audit)
        // Kita bisa cek apakah opsi ini sudah pernah digunakan dalam jawaban
        if (QuestionAnswer::whereHas('details', function ($query) use ($option) {
            $query->where('questionnaire_option_id', $option->id);
        })->exists()) {
            // Jika sudah ada yang menjawab menggunakan opsi ini, lakukan soft delete
            $option->delete(); // Soft Delete
            return back()->with('success', 'Opsi jawaban telah dinonaktifkan.');
        }

        // Jika belum pernah digunakan, lakukan hard delete (permanen)
        $option->forceDelete();
        return back()->with('success', 'Opsi jawaban telah dihapus permanen.');
    }
}
