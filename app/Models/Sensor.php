<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = ['device_name', 'sensor_name', 'location', 'ip', 'temperature_max_allowance', 'humidity_max_allowance', 'alarmable_numbers'];

    protected $casts = [
        'alarmable_numbers' => 'array'
    ];

    public function average()
    {
        return $this->hasMany(AverageTemperature::class);
    }
}
