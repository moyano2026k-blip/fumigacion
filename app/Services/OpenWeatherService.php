<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenWeatherService
{
    private function normalizeCityQuery($city)
    {
        $city = trim($city);

        /*
        |--------------------------------------------------------------------------
        | Búsqueda priorizada para Ecuador
        |--------------------------------------------------------------------------
        */

        if (!str_contains($city, ',')) {
            return $city . ',EC';
        }

        return $city;
    }

    public function getWeather($city)
    {
        $apiKey = env('OPENWEATHER_API_KEY');

        $response = Http::get(
            'https://api.openweathermap.org/data/2.5/weather',
            [
                'q' => $this->normalizeCityQuery($city),
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'es'
            ]
        );

        return $response->json();
    }

    public function getWeatherForecast($city)
    {
        $apiKey = env('OPENWEATHER_API_KEY');

        $response = Http::get(
            'https://api.openweathermap.org/data/2.5/forecast',
            [
                'q' => $this->normalizeCityQuery($city),
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'es'
            ]
        );

        return $response->json();
    }
}