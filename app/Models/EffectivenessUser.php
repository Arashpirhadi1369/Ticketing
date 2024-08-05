<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EffectivenessUser extends Model
{
    use HasFactory;

    protected $fillable = ['courseuser_id', 'user_id', 'question_id', 'answer_id'];

    public function courseUser()
    {
        return $this->belongsTo(CourseUser::class, 'courseuser_id', 'id');
    }

    public function effectivenessQuestion()
    {
        return $this->belongsTo(EffectivenessQuestion::class, 'question_id', 'id');
    }

    public function effectivenessQuestionAnswer()
    {
        return $this->belongsTo(EffectivenessQuestionAnswer::class, 'answer_id', 'id');
    }
}
