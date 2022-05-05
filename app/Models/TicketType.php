<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public static function getId($typeName): int
    {
        $type = self::where('type', $typeName)->get();

        if ($type->isNotEmpty()) {
            return $type[0]->id;
        }
    }
}
