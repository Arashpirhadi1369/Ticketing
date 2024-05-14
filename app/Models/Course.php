<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'duration_hour', 'survey_id', 'effectiveness_id'];

    // public function units()
    // {
    //     return $this->belongsToMany(Unit::class, 'unit_course', 'course_id', 'unit_id');
    // }

    public function category()
    {
        return $this->belongsTo(Category::class, null, 'id');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class, null, 'id');
    }

    public function effectiveness()
    {
        return $this->belongsTo(Effectiveness::class, null, 'id');
    }
}
