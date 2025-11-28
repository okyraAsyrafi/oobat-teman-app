<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireOption extends Model
{
    protected $fillable = ['option_text', 'weight', 'sort_order'];

    protected $casts = ['weight' => 'integer', 'sort_order' => 'integer'];
}
