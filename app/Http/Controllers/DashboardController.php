<?php

namespace App\Http\Controllers;

use App\Models\WeatherHistory;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function redirect()
    {
        $role = auth()->user()->role;

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($role == 'admin') {

            return Inertia::render(
                'Admin/Dashboard'
            );

        }

        /*
        |--------------------------------------------------------------------------
        | TECNICO
        |--------------------------------------------------------------------------
        */

        /*
     |--------------------------------------------------------------------------
     | TECNICO
     |--------------------------------------------------------------------------
     */

        if ($role == 'tecnico') {

            /*
            |--------------------------------------------------------------------------
            | Ultima consulta climatica
            |--------------------------------------------------------------------------
            */

            $weather = WeatherHistory::latest()
                ->first();

            /*
            |--------------------------------------------------------------------------
            | Total consultas
            |--------------------------------------------------------------------------
            */

            $totalQueries =
                WeatherHistory::count();

            /*
            |--------------------------------------------------------------------------
            | Total ciudades
            |--------------------------------------------------------------------------
            */

            $cities = WeatherHistory::distinct('city')
                ->count('city');

            /*
            |--------------------------------------------------------------------------
            | Alertas climaticas
            |--------------------------------------------------------------------------
            */

            $alerts = WeatherHistory::where(
                'recommendation',
                'NO RECOMENDABLE PARA FUMIGAR'
            )->count();

            /*
            |--------------------------------------------------------------------------
            | Render dashboard
            |--------------------------------------------------------------------------
            */

            return Inertia::render(
                'Tecnico/Dashboard',
                [

                    'weather' =>
                        $weather,

                    'totalQueries' =>
                        $totalQueries,

                    'cities' =>
                        $cities,

                    'alerts' =>
                        $alerts,

                ]
            );

        }
        /*
        |--------------------------------------------------------------------------
        | USUARIO
        |--------------------------------------------------------------------------
        */

        $latestWeather = WeatherHistory::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->first();

        return Inertia::render(
            'Usuario/Dashboard',
            [
                'weather' => $latestWeather
            ]
        );
    }
}