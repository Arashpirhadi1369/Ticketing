<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public static function getId($statusName): int
    {
        $status = self::where('status', $statusName)->get();

        if ($status->isNotEmpty()) {
            return $status[0]->id;
        }
    }
}
