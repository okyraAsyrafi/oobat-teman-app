<?php

namespace App\Models;

use App\Models\QuestionDetailAnswer;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $fillable = [
        'patient_id',
        'date_answer',
        'score_avg',
        'side_effect',
        'complaints',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'date_answer' => 'datetime',
        'score_avg' => 'decimal:2',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function details()
    {
        return $this->hasMany(QuestionDetailAnswer::class, 'question_answer_id');
    }
}
