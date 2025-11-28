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
        return $this->belongsTo(QuestionnaireQuestion::class, 'questionnaire_question_id');
    }

    public function option()
    {
        return $this->belongsTo(QuestionnaireOption::class, 'questionnaire_option_id');
    }

    public function answer()
    {
        return $this->belongsTo(QuestionAnswer::class, 'question_answer_id');
    }
}
