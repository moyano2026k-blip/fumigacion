<?php

namespace App\Http\Controllers;

use App\Models\WeatherHistory;
use App\Services\OpenWeatherService;

use Illuminate\Http\Request;

use Inertia\Inertia;

class WeatherController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Vista principal clima
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return Inertia::render('Clima/Index');
    }

    /*
    |--------------------------------------------------------------------------
    | Consultar clima
    |--------------------------------------------------------------------------
    */

    public function search(
        Request $request,
        OpenWeatherService $weatherService
    ) {

        $request->validate([
            'city' => 'required'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Consumir API
        |--------------------------------------------------------------------------
        */

        $weather = $weatherService->getWeather(
            $request->city
        );

        /*
        |--------------------------------------------------------------------------
        | Variables principales
        |--------------------------------------------------------------------------
        */

        $temp =
            $weather['main']['temp'] ?? 0;

        $humidity =
            $weather['main']['humidity'] ?? 0;

        $wind =
            $weather['wind']['speed'] ?? 0;

        $description =
            $weather['weather'][0]['description'] ?? '';

        /*
        |--------------------------------------------------------------------------
        | Lluvia
        |--------------------------------------------------------------------------
        */

        $raining =
            isset($weather['rain'])
            ? 'LLUVIA DETECTADA'
            : 'SIN LLUVIA';

        /*
        |--------------------------------------------------------------------------
        | Estado temperatura
        |--------------------------------------------------------------------------
        */

        $temperatureStatus =
            $temp > 32
            ? 'TEMPERATURA MUY ALTA'
            : 'TEMPERATURA ESTABLE';

        /*
        |--------------------------------------------------------------------------
        | Estado cultivo
        |--------------------------------------------------------------------------
        */

        /*
|--------------------------------------------------------------------------
| Estado cultivo inteligente
|--------------------------------------------------------------------------
*/

        if ($humidity > 90) {

            $cropStatus =
                'ALTO RIESGO DE HONGOS';

        } elseif ($temp > 35) {

            $cropStatus =
                'ESTRÉS TÉRMICO EN CULTIVO';

        } elseif ($wind > 20) {

            $cropStatus =
                'RIESGO POR VIENTOS FUERTES';

        } elseif (isset($weather['rain'])) {

            $cropStatus =
                'EXCESO DE HUMEDAD EN CULTIVO';

        } elseif (
            $humidity >= 50 &&
            $humidity <= 80 &&
            $temp >= 18 &&
            $temp <= 30
        ) {

            $cropStatus =
                'CULTIVO EN CONDICIONES ÓPTIMAS';

        } else {

            $cropStatus =
                'CULTIVO ESTABLE';

        }
        /*
        |--------------------------------------------------------------------------
        | Nivel fumigación
        |--------------------------------------------------------------------------
        */

        if ($wind < 10 && $humidity < 80) {

            $level = 'EXCELENTE';

        } elseif ($wind < 15) {

            $level = 'MODERADO';

        } else {

            $level = 'PELIGROSO';

        }

        /*
        |--------------------------------------------------------------------------
        | Recomendación inteligente
        |--------------------------------------------------------------------------
        */

        if (
            $wind < 10 &&
            $humidity < 80 &&
            !isset($weather['rain'])
        ) {

            $recommendation =
                'CONDICIONES ÓPTIMAS PARA FUMIGAR';

        } elseif ($wind < 15) {

            $recommendation =
                'FUMIGACIÓN MODERADA';

        } else {

            $recommendation =
                'NO RECOMENDABLE PARA FUMIGAR';

        }

        /*
        |--------------------------------------------------------------------------
        | Guardar historial
        |--------------------------------------------------------------------------
        */

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

            'rain_status' =>
                $raining,

            'level' =>
                $level,

            'crop_status' =>
                $cropStatus,

            'temperature_status' =>
                $temperatureStatus,

        ]);

        /*
        |--------------------------------------------------------------------------
        | Redireccionar dashboard
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | Historial climático
    |--------------------------------------------------------------------------
    */
    public function history()
    {
        /*
        |--------------------------------------------------------------------------
        | Administrador ve TODO
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->role == 'admin') {

            $histories = WeatherHistory::latest()
                ->with('user')
                ->get();

        } else {

            /*
            |--------------------------------------------------------------------------
            | Usuario/Tecnico solo sus consultas
            |--------------------------------------------------------------------------
            */

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
}