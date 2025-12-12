<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionDetailAnswer extends Model
{
    protected $fillable = [
        'question_answer_id',
        'questionnaire_question_id',
        'questionnaire_option_id',
        'created_by',
    ];

    public function question()
    {
        return $this->belongsTo(QuestionnaireQuestion::class, 'questionnaire_question_id')->withTrashed();
    }

    // Relasi ke Opsi Jawaban
    // PENTING: Gunakan withTrashed() karena opsi jawaban bisa di-soft delete
    public function option()
    {
        return $this->belongsTo(QuestionnaireOption::class, 'questionnaire_option_id')->withTrashed();
    }

    public function answer()
    {
        return $this->belongsTo(QuestionAnswer::class, 'question_answer_id');
    }
}
