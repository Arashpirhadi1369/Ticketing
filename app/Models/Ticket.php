<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'subject', 'content', 'status_id', 'referred_id', 'type_id', 'reply'];

    public function user()
    {
        return $this->belongsTo(User::class, null, 'id');
    }
}
