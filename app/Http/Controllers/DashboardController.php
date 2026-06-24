<?php

namespace App\Http\Controllers;

use App\Models\WeatherHistory;
use Inertia\Inertia;
use App\Services\OpenWeatherService;

class DashboardController extends Controller
{
    public function redirect()
    {
        $role = auth()->user()->role;

        if ($role == 'admin') {

            return Inertia::render(
                'Admin/Dashboard'
            );
        }

        if ($role == 'tecnico') {

            $weather = WeatherHistory::latest()
                ->first();

            $totalQueries = WeatherHistory::count();

            $cities = WeatherHistory::distinct('city')
                ->count('city');

            $alerts = WeatherHistory::where(
                'recommendation',
                'NO RECOMENDABLE PARA FUMIGAR'
            )->count();

            return Inertia::render(
                'Tecnico/Dashboard',
                [
                    'weather' => $weather,
                    'totalQueries' => $totalQueries,
                    'cities' => $cities,
                    'alerts' => $alerts,
                ]
            );
        }

        $latestWeather = WeatherHistory::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->first();

        $forecast = [];

        if ($latestWeather) {

            $weatherService = app(OpenWeatherService::class);

            $forecastData = $weatherService->getWeatherForecast(
                $latestWeather->city
            );

            if (isset($forecastData['list'])) {

                $forecast = collect($forecastData['list'])
                    ->groupBy(function ($item) {
                        return date(
                            'Y-m-d',
                            strtotime($item['dt_txt'])
                        );
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

                        $level = 'EXCELENTE';

                        if ($hasRain || $wind > 15) {

                            $level = 'PELIGROSO';

                        } elseif ($humidity > 85) {

                            $level = 'MODERADO';
                        }

                        return [
                            'date' => $date,
                            'temperature' => $temp,
                            'humidity' => $humidity,
                            'wind' => $wind,
                            'rain' => $hasRain,
                            'level' => $level,
                            'description' => $items->first()['weather'][0]['description'],
                        ];
                    })
                    ->values();
            }
        }

        return Inertia::render(
            'Usuario/Dashboard',
            [
                'weather' => $latestWeather,
                'forecast' => $forecast,
            ]
        );
    }
}