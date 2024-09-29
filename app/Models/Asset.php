<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = ['asset_tag', 'asset_name', 'asset_unit_id', 'belong_to_user', 'asset_location', 'delivery_date', 'qrcode', 'picture'];

    public function assetTurnovers()
    {
        return $this->hasMany(AssetTurnover::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'asset_unit_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'belong_to_user', 'id');
    }
}
