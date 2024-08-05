<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyUser extends Model
{
    use HasFactory;

    protected $fillable = ['courseuser_id', 'user_id', 'question_id', 'answer_id'];

    public function courseUser()
    {
        return $this->belongsTo(CourseUser::class, 'courseuser_id', 'id');
    }

    public function surveyQuestion()
    {
        return $this->belongsTo(SurveyQuestion::class, 'question_id', 'id');
    }

    public function surveyQuestionAnswer()
    {
        return $this->belongsTo(SurveyQuestionAnswer::class, 'answer_id', 'id');
    }
}
