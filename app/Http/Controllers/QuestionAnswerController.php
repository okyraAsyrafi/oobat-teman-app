<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\QuestionAnswer;

class QuestionAnswerController extends Controller
{
    public function index(): View
    {
        // Pastikan relasi 'patient' dipanggil dengan benar
        $results = QuestionAnswer::with([
            'patient', // Akan menggunakan withTrashed() jika sudah diperbaiki di Model
            'details.question',
            'details.option'
        ])
            ->latest()
            ->paginate(10);

        return view('question_answer.index', compact('results'));
    }

    public function show(QuestionAnswer $result): View
    {
        // Pastikan relasi 'patient' dipanggil saat show
        $result->load([
            'patient', // Akan menggunakan withTrashed()
            'details.question',
            'details.option'
        ]);
        return view('question_answer.show', compact('result'));
    }
}
