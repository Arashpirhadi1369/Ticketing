<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'user_id', 'unit_id', 'manager_user_id', 'start_date', 'end_date', 'lecturer', 'survey_finished', 'effectiveness_finished'];

    public function course()
    {
        return $this->belongsTo(Course::class, null, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, null, 'id')->withTrashed();
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, null, 'id');
    }

    public function managerUser()
    {
        return $this->belongsTo(User::class, null, 'id');
    }

    public function effectivenessUser()
    {
        return $this->hasMany(EffectivenessUser::class, 'courseuser_id', 'id');
    }

    public function surveyUser()
    {
        return $this->hasMany(SurveyUser::class, 'courseuser_id', 'id');
    }
}
