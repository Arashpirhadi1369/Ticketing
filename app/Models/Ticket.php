<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'subject', 'content', 'status_id', 'referred_id', 'type_id', 'reply'];

    public function user()
    {
        return $this->belongsTo(User::class, null, 'id');
    }
    public function status()
    {
        return $this->belongsTo(TicketStatus::class, null, 'id');
    }

}
