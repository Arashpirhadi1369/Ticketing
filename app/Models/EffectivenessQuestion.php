<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EffectivenessQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['effectiveness_id', 'question'];

    public function effectiveness()
    {
        return $this->belongsTo(Effectiveness::class,  null, 'id');
    }

    public function answers()
    {
        return $this->hasMany(EffectivenessQuestionAnswer::class, 'effectivenessquestion_id', 'id');
    }
}
