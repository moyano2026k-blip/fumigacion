<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WeatherAlert extends Model
{
    use HasFactory;

    protected $fillable = [
        'forecast_id',
        'alert_type',
        'description',
        'severity',
        'alert_date',
    ];

    protected $casts = [
        'alert_date' => 'datetime',
    ];

    public function forecast()
    {
        return $this->belongsTo(WeatherForecast::class, 'forecast_id');
    }
}