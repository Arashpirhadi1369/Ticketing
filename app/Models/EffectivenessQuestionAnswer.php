<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EffectivenessQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['effectivenessquestion_id', 'answer'];

    public function question()
    {
        return $this->belongsTo(EffectivenessQuestion::class,  null, 'id');
    }
}
