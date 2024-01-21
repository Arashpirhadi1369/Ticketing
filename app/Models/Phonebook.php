<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone'];

    public function sensors()
    {
        return $this->belongsToMany(Sensor::class, 'phonebook_sensor', 'phonebook_id', 'sensor_id');
    }
}
