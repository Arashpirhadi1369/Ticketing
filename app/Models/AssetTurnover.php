<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetTurnover extends Model
{
    use HasFactory;

    protected $fillable = ['asset_id', 'user_id', 'unit', 'belong_to_user', 'asset_location', 'delivery_date', 'conflict', 'description'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
}
