<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'user_id', 'unit_id', 'start_date', 'end_date', 'manager_user_id'];

    public function course()
    {
        return $this->belongsTo(Course::class, null, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, null, 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, null, 'id');
    }

    public function managerUser()
    {
        return $this->belongsTo(User::class, null, 'id');
    }
}
