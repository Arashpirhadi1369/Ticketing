<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $fillable = ['user_id', 'subject', 'content', 'status_id', 'referred_id', 'type_id', 'reply'];

    public function user()
    {
        return $this->belongsTo(User::class, null, 'id');
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class, null, 'id');
    }

    public function type()
    {
        return $this->belongsTo(TicketType::class, null, 'id');
    }

    public function referred()
    {
        return $this->belongsTo(User::class, null, 'id');
    }

    public function routeNotificationForSlack($notification)
    {
        return 'https://hooks.slack.com/services/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';
    }
}
