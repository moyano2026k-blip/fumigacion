<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherService;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index(OpenWeatherService $weatherService)
    {
        $weather = $weatherService->getWeather('Milagro');

        return Inertia::render('Welcome', [

            'canLogin' => true,
            'canRegister' => true,

            'clima' => [

                'ciudad' =>
                    $weather['name'] ?? 'Quito',

                'temperatura' =>
                    $weather['main']['temp'] ?? 0,

                'humedad' =>
                    $weather['main']['humidity'] ?? 0,

                'viento' =>
                    $weather['wind']['speed'] ?? 0,

                'descripcion' =>
                    $weather['weather'][0]['description'] ?? '',

                'lluvia' =>
                    isset($weather['rain']) ? 80 : 20,

                'estado' =>
                    ($weather['main']['humidity'] ?? 0) > 85
                    ? 'Alerta Agrícola'
                    : 'Condiciones Favorables',

                'recomendacion' =>
                    ($weather['wind']['speed'] ?? 0) < 15
                    ? 'Condiciones adecuadas para fumigación.'
                    : 'No recomendable realizar fumigación.',

            ],

        ]);
    }
}