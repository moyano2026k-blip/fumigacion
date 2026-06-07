<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherService
{
    public function getWeather($city)
    {
        $apiKey = env('OPENWEATHER_API_KEY');

        $response = Http::get(
            'https://api.openweathermap.org/data/2.5/weather',
            [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'es'
            ]
        );

        return $response->json();
    }
}