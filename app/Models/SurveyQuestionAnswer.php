<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['surveyquestion_id', 'answer'];

    public function question()
    {
        return $this->belongsTo(SurveyQuestion::class,  null, 'id');
    }
}
