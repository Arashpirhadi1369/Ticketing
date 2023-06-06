<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_user_id', 'source_number', 'receiver_user_id', 'destination_number', 'receiver_name',
        'message', 'status', 'cost'
    ];

    public function senderUser()
    {
        return $this->belongsTo(User::class, 'sender_user_id', 'id');
    }

    public function receiverUser()
    {
        return $this->belongsTo(User::class, 'receiver_user_id', 'id');
    }
}
