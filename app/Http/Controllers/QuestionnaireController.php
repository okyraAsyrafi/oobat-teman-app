<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\QuestionnaireOption;
use App\Models\QuestionnaireQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
        $question->delete();

        return back()->with('success', 'Pertanyaan berhasil dihapus.');
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
        $option->delete();

        return back()->with('success', 'Opsi jawaban berhasil dihapus.');
    }
}
