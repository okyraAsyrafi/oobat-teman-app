<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionnaireQuestion extends Model
{
    use SoftDeletes;
    protected $fillable = ['question', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
