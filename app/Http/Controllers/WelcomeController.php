<?php

namespace App\Http\Controllers;

use App\Services\OpenWeatherService;
use Inertia\Inertia;
use Carbon\Carbon;
use Carbon\CarbonInterface;

class WelcomeController extends Controller
{
    public function index(OpenWeatherService $weatherService)
    {
        // Ciudad fija para la pantalla principal
        $city = 'Quito';

        $weather = $weatherService->getWeather($city);
        $forecast = $weatherService->getWeatherForecast($city);
        Carbon::setLocale('es');

        $temperatura = round($weather['main']['temp'] ?? 0, 1);
        $sensacion = round($weather['main']['feels_like'] ?? 0, 1);
        $humedad = $weather['main']['humidity'] ?? 0;
        $presion = $weather['main']['pressure'] ?? 0;

        // Convertir m/s a km/h
        $viento = round(($weather['wind']['speed'] ?? 0) * 3.6, 1);

        $nubosidad = $weather['clouds']['all'] ?? 0;

        $visibilidad = isset($weather['visibility'])
            ? round($weather['visibility'] / 1000, 1)
            : 0;

        $descripcion = ucfirst($weather['weather'][0]['description'] ?? '');

        $icono = $weather['weather'][0]['icon'] ?? '01d';

        $lluvia = 0;

        if (isset($weather['rain']['1h'])) {
            $lluvia = $weather['rain']['1h'];
        } elseif (isset($weather['rain']['3h'])) {
            $lluvia = $weather['rain']['3h'];
        }

        $amanecer = date('H:i', $weather['sys']['sunrise']);
        $atardecer = date('H:i', $weather['sys']['sunset']);

        /*
        |--------------------------------------------------------------------------
        | Recomendación Agrícola
        |--------------------------------------------------------------------------
        */

        $estado = 'Condiciones Favorables';
        $recomendacion = 'Condiciones adecuadas para actividades agrícolas.';

        if ($lluvia > 0) {

            $estado = 'Lluvia Detectada';

            $recomendacion = 'No se recomienda realizar fumigación durante precipitaciones.';

        } elseif ($viento > 15) {

            $estado = 'Viento Fuerte';

            $recomendacion = 'Espere a que disminuya el viento antes de fumigar.';

        } elseif ($temperatura > 30) {

            $estado = 'Temperatura Alta';

            $recomendacion = 'Realice las labores agrícolas durante las primeras horas de la mañana.';

        } elseif ($humedad > 90) {

            $estado = 'Alta Humedad';

            $recomendacion = 'Existe riesgo de aparición de enfermedades fúngicas.';

        }

        /*
        |--------------------------------------------------------------------------
        | Pronóstico (5 días)
        |--------------------------------------------------------------------------
        */

        $pronostico = [];

        if (isset($forecast['list'])) {

            foreach ($forecast['list'] as $item) {

                if (str_contains($item['dt_txt'], '12:00:00')) {

                    $fecha = Carbon::parse($item['dt_txt']);

                    $pronostico[] = [

                        'fecha' => $fecha->format('d/m'),

                        'dia' => ucfirst($fecha->isoFormat('dddd')),

                        'temperatura' => round($item['main']['temp']),

                        'temp_min' => round($item['main']['temp_min']),

                        'temp_max' => round($item['main']['temp_max']),

                        'humedad' => $item['main']['humidity'],

                        'descripcion' => ucfirst($item['weather'][0]['description']),

                        'icono' => $item['weather'][0]['icon'],

                    ];

                }

            }

        }

        return Inertia::render('Welcome', [

            'canLogin' => true,

            'canRegister' => true,

            'clima' => [

                'ciudad' => $weather['name'] . ', Ecuador',

                'temperatura' => $temperatura,

                'sensacion' => $sensacion,

                'humedad' => $humedad,

                'viento' => $viento,

                'lluvia' => $lluvia,

                'presion' => $presion,

                'nubosidad' => $nubosidad,

                'visibilidad' => $visibilidad,

                'descripcion' => $descripcion,

                'icono' => $icono,

                'amanecer' => $amanecer,

                'atardecer' => $atardecer,

                'estado' => $estado,

                'recomendacion' => $recomendacion,

            ],

            'pronostico' => $pronostico,

        ]);
    }
}