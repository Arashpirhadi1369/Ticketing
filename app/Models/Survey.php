<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'questions_count'];

    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class,  'survey_id', 'id');
    }

    public function answers()
    {
        return $this->hasManyThrough(SurveyQuestionAnswer::class, SurveyQuestion::class,  'survey_id', 'surveyquestion_id', 'id', 'id');
    }
}
