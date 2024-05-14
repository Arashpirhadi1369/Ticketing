<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Effectiveness extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'questions_count'];

    public function questions()
    {
        return $this->hasMany(EffectivenessQuestion::class,  'effectiveness_id', 'id');
    }

    public function answers()
    {
        return $this->hasManyThrough(EffectivenessQuestionAnswer::class, EffectivenessQuestion::class,  'effectiveness_id', 'effectivenessquestion_id', 'id', 'id');
    }
}
