<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\QuestionAnswer;

class QuestionAnswerController extends Controller
{
    public function index(): View
    {
        $results = QuestionAnswer::with(['patient', 'details.question', 'details.option'])
            ->latest()
            ->paginate(10);

        return view('question_answer.index', compact('results'));
    }

    public function show(QuestionAnswer $result): View
    {
        $result->load(['patient', 'details.question', 'details.option']);
        return view('question_answer.show', compact('result'));
    }
}
