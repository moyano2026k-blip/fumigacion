<?php

namespace App\Http\Controllers;

use App\Models\WeatherHistory;
use App\Models\WeatherForecast;
use App\Models\WeatherAlert;
use App\Models\ApiLog;
use App\Models\Location;
use App\Services\OpenWeatherService;

use Illuminate\Http\Request;

use Inertia\Inertia;

class WeatherController extends Controller
{
    public function index()
    {
        return Inertia::render('Clima/Index');
    }

    public function search(
        Request $request,
        OpenWeatherService $weatherService
    ) {

        $request->validate([
            'city' => 'required'
        ]);

        $weather = $weatherService->getWeather(
            $request->city
        );

        ApiLog::create([

            'endpoint' => 'weather',

            'response_status' => 200,

            'response_time' => 0,

            'requested_at' => now(),

        ]);

        $temp = $weather['main']['temp'] ?? 0;
        $humidity = $weather['main']['humidity'] ?? 0;
        $wind = $weather['wind']['speed'] ?? 0;
        $description = $weather['weather'][0]['description'] ?? '';
        $weatherId = $weather['weather'][0]['id'] ?? 0;

        $hasRain =
            isset($weather['rain']) ||
            ($weatherId >= 200 && $weatherId < 600);

        $raining = $hasRain
            ? 'LLUVIA DETECTADA'
            : 'SIN LLUVIA';

        if ($temp > 35) {

            $temperatureStatus = 'TEMPERATURA EXTREMADAMENTE ALTA';

        } elseif ($temp > 30) {

            $temperatureStatus = 'TEMPERATURA ALTA';

        } elseif ($temp < 10) {

            $temperatureStatus = 'TEMPERATURA MUY BAJA';

        } else {

            $temperatureStatus = 'TEMPERATURA NORMAL';
        }

        if ($hasRain) {

            $cropStatus = 'RIESGO POR LLUVIA';

        } elseif ($humidity > 90) {

            $cropStatus = 'ALTO RIESGO DE HONGOS';

        } elseif ($wind > 20) {

            $cropStatus = 'VIENTOS FUERTES';

        } elseif ($temp > 35) {

            $cropStatus = 'ESTRÉS TÉRMICO';

        } elseif (
            $humidity >= 50 &&
            $humidity <= 80 &&
            $temp >= 18 &&
            $temp <= 30
        ) {

            $cropStatus = 'CULTIVO EN CONDICIONES ÓPTIMAS';

        } else {

            $cropStatus = 'CULTIVO ESTABLE';
        }


        if ($hasRain) {

            $level = 'PELIGROSO';

        } elseif ($wind > 15) {

            $level = 'PELIGROSO';

        } elseif ($humidity > 85) {

            $level = 'MODERADO';

        } else {

            $level = 'EXCELENTE';

        }

        if ($hasRain) {

            $recommendation =
                'NO FUMIGAR: EXISTE LLUVIA O LLOVIZNA';

        } elseif ($wind > 15) {

            $recommendation =
                'NO FUMIGAR: VIENTO FUERTE';

        } elseif ($humidity > 85) {

            $recommendation =
                'NO FUMIGAR: HUMEDAD MUY ALTA';

        } elseif ($temp > 35) {

            $recommendation =
                'NO FUMIGAR: TEMPERATURA EXCESIVA';

        } else {

            $recommendation =
                'CONDICIONES ÓPTIMAS PARA FUMIGAR';
        }

        $recommendedTime = '06:00 - 09:00';

        if ($hasRain) {

            $recommendedTime = 'NO RECOMENDADO';

        } elseif ($wind > 15) {

            $recommendedTime = 'ESPERAR A QUE DISMINUYA EL VIENTO';

        } elseif ($humidity > 85) {

            $recommendedTime = '17:00 - 18:30';

        } elseif ($temp > 35) {

            $recommendedTime = '18:00 - 19:00';

        }

        $location = Location::firstOrCreate(
            [
                'city' => $weather['name'],
            ],
            [
                'user_id' => auth()->id(),
                'province' => '',
                'country' => $weather['sys']['country'] ?? 'EC',
                'latitude' => $weather['coord']['lat'] ?? null,
                'longitude' => $weather['coord']['lon'] ?? null,
            ]
        );

        $forecast = WeatherForecast::create([

            'location_id' => $location->id,

            'temperature' => $temp,

            'humidity' => $humidity,

            'pressure' => $weather['main']['pressure'] ?? 0,

            'wind_speed' => $wind,

            'weather_condition' => $description,

            'prediction_date' => now(),

            'api_source' => 'OpenWeather',

        ]);

        WeatherHistory::create([

            'user_id' => auth()->id(),

            'city' =>
                $weather['name'] ?? '',

            'temperature' =>
                $temp,

            'humidity' =>
                $humidity,

            'wind' =>
                $wind,

            'description' =>
                $description,

            'recommendation' =>
                $recommendation,
            'recommended_time' => $recommendedTime,


            'rain_status' =>
                $raining,

            'level' =>
                $level,

            'crop_status' =>
                $cropStatus,

            'temperature_status' =>
                $temperatureStatus,

        ]);

        return redirect()
            ->route('dashboard');
    }
    public function history()
    {

        if (auth()->user()->role == 'admin') {

            $histories = WeatherHistory::latest()
                ->with('user')
                ->get();

        } else {

            $histories = WeatherHistory::where(
                'user_id',
                auth()->id()
            )
                ->latest()
                ->with('user')
                ->get();

        }

        return Inertia::render(
            'Clima/History',
            [
                'histories' => $histories
            ]
        );
    }

    public function forecast(
        Request $request,
        OpenWeatherService $weatherService
    ) {
        $request->validate([
            'city' => 'required'
        ]);

        $forecast = $weatherService->getWeatherForecast(
            $request->city
        );

        $days = collect($forecast['list'])
            ->groupBy(function ($item) {
                return date('Y-m-d', strtotime($item['dt_txt']));
            })
            ->map(function ($items, $date) {
                return [
                    'date' => $date,
                    'temp_min' => collect($items)->min('main.temp_min'),
                    'temp_max' => collect($items)->max('main.temp_max'),
                    'humidity' => round(
                        collect($items)->avg('main.humidity')
                    ),
                    'description' => $items[0]['weather'][0]['description'],
                    'rain_probability' => max(
                        array_column($items->toArray(), 'pop')
                    ) * 100,
                ];
            })
            ->values();

        return response()->json($days);
    }

    public function forecastAnalysis(
        Request $request,
        OpenWeatherService $weatherService
    ) {
        $request->validate([
            'city' => 'required'
        ]);

        $forecast = $weatherService->getWeatherForecast(
            $request->city
        );


        $days = collect($forecast['list'])
            ->groupBy(function ($item) {
                return date('Y-m-d', strtotime($item['dt_txt']));
            })
            ->map(function ($items, $date) {

                $temp = round(
                    collect($items)->avg('main.temp')
                );

                $humidity = round(
                    collect($items)->avg('main.humidity')
                );

                $wind = round(
                    collect($items)->avg('wind.speed')
                );

                $hasRain = collect($items)
                    ->contains(function ($item) {

                        $weatherId =
                            $item['weather'][0]['id'] ?? 0;

                        return $weatherId >= 200 &&
                            $weatherId < 600;
                    });

                if ($hasRain || $wind > 15) {

                    $level = 'PELIGROSO';

                } elseif ($humidity > 85) {

                    $level = 'MODERADO';

                } else {

                    $level = 'EXCELENTE';
                }
                
                if ($hasRain) {

                    $recommendation =
                        'NO FUMIGAR - POSIBLE LLUVIA';

                } elseif ($wind > 15) {

                    $recommendation =
                        'NO FUMIGAR - VIENTO FUERTE';

                } elseif ($humidity > 85) {

                    $recommendation =
                        'PRECAUCIÓN - HUMEDAD ALTA';

                } else {

                    $recommendation =
                        'RECOMENDADO PARA FUMIGAR';
                }

                $recommendation = 'CONDICIONES ÓPTIMAS PARA FUMIGAR';

                $recommendedTime = '06:00 - 09:00';

                if ($hasRain) {

                    $recommendedTime = 'NO RECOMENDADO';

                } elseif ($wind > 15) {

                    $recommendedTime = 'ESPERAR A QUE DISMINUYA EL VIENTO';

                } elseif ($humidity > 85) {

                    $recommendedTime = '17:00 - 18:30';

                } elseif ($temp > 35) {

                    $recommendedTime = '18:00 - 19:00';

                }

                return [
                    'date' => $date,
                    'temperature' => $temp,
                    'humidity' => $humidity,
                    'wind' => $wind,
                    'level' => $level,
                    'recommendation' => $recommendation,
                    'recommended_time' => $recommendedTime
                ];
            })
            ->values();

        return response()->json($days);
    }
}