<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionnaireOption extends Model
{
    use SoftDeletes;
    protected $fillable = ['option_text', 'weight', 'sort_order'];

    protected $casts = ['weight' => 'integer', 'sort_order' => 'integer'];
}
