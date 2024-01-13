<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AverageTemperature extends Model
{
    use HasFactory;

    protected $fillable = ['sensor_id', 'average_temperature', 'average_humidity'];
}
