<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['survey_id', 'question'];

    public function survey()
    {
        return $this->belongsTo(Survey::class,  null, 'id');
    }

    public function answers()
    {
        return $this->hasMany(SurveyQuestionAnswer::class, 'surveyquestion_id', 'id');
    }
}
