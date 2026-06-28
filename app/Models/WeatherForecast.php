<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeatherForecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'temperature',
        'humidity',
        'pressure',
        'wind_speed',
        'weather_condition',
        'prediction_date',
        'api_source',
    ];

    protected $casts = [
        'prediction_date' => 'datetime',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function alerts()
    {
        return $this->hasMany(WeatherAlert::class, 'forecast_id');
    }
}