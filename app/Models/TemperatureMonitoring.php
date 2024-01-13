<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemperatureMonitoring extends Model
{
    use HasFactory;

    protected $fillable = ['sensor_id', 'temperature', 'humidity'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class, null, 'id');
    }
}
