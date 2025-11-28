<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireQuestion extends Model
{
    protected $fillable = ['question', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
