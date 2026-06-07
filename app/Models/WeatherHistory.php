<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherHistory extends Model
{
    protected $fillable = [

        'user_id',
        'city',
        'temperature',
        'humidity',
        'wind',
        'description',
        'recommendation',

        'rain_status',
        'level',
        'crop_status',
        'temperature_status',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

