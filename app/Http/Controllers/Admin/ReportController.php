<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Exports\UsersExport;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\WeatherHistory;

use Inertia\Inertia;

class ReportController extends Controller
{
    public function index()
    {
        $histories = WeatherHistory::latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Estadisticas
        |--------------------------------------------------------------------------
        */

        $avgTemperature =
            round(
                WeatherHistory::avg('temperature'),
                1
            );

        $avgHumidity =
            round(
                WeatherHistory::avg('humidity'),
                1
            );

        $avgWind =
            round(
                WeatherHistory::avg('wind'),
                1
            );

        /*
        |--------------------------------------------------------------------------
        | Estado general
        |--------------------------------------------------------------------------
        */

        $status =
            $avgHumidity > 85
            ? 'Alerta'
            : 'Estable';

        return Inertia::render(
            'Admin/Reports',
            [

                'histories' =>
                    $histories,

                'avgTemperature' =>
                    $avgTemperature,

                'avgHumidity' =>
                    $avgHumidity,

                'avgWind' =>
                    $avgWind,

                'status' =>
                    $status,

            ]
        );
    }
    public function usersExcel()
    {
        return Excel::download(
            new UsersExport,
            'usuarios.xlsx'
        );
    }

    public function usersPdf()
    {
        $users = User::all();

        $pdf = Pdf::loadView(
            'pdf.users',
            compact('users')
        );

        return $pdf->download('usuarios.pdf');
    }

    public function technical()
    {
        $histories = WeatherHistory::latest()
            ->take(10)
            ->get();

        $totalQueries =
            WeatherHistory::count();

        $alerts =
            WeatherHistory::where(
                'recommendation',
                'NO RECOMENDABLE PARA FUMIGAR'
            )->count();

        $cities =
            WeatherHistory::distinct('city')
                ->count('city');

        return Inertia::render(
            'Tecnico/Reports',
            [
                'histories' => $histories,
                'totalQueries' => $totalQueries,
                'alerts' => $alerts,
                'cities' => $cities,
            ]
        );
    }
}