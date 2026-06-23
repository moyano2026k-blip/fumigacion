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

        //dd($weather);

        /*
|--------------------------------------------------------------------------
| Variables principales
|--------------------------------------------------------------------------
*/

        $temp = $weather['main']['temp'] ?? 0;
        $humidity = $weather['main']['humidity'] ?? 0;
        $wind = $weather['wind']['speed'] ?? 0;
        $description = $weather['weather'][0]['description'] ?? '';
        $weatherId = $weather['weather'][0]['id'] ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Detección de lluvia
        |--------------------------------------------------------------------------
        |
        | 2xx = tormenta
        | 3xx = llovizna
        | 5xx = lluvia
        |
        */

        $hasRain =
            isset($weather['rain']) ||
            ($weatherId >= 200 && $weatherId < 600);

        $raining = $hasRain
            ? 'LLUVIA DETECTADA'
            : 'SIN LLUVIA';

        /*
        |--------------------------------------------------------------------------
        | Estado temperatura
        |--------------------------------------------------------------------------
        */

        if ($temp > 35) {

            $temperatureStatus = 'TEMPERATURA EXTREMADAMENTE ALTA';

        } elseif ($temp > 30) {

            $temperatureStatus = 'TEMPERATURA ALTA';

        } elseif ($temp < 10) {

            $temperatureStatus = 'TEMPERATURA MUY BAJA';

        } else {

            $temperatureStatus = 'TEMPERATURA NORMAL';
        }

        /*
        |--------------------------------------------------------------------------
        | Estado cultivo
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | Nivel de fumigación
        |--------------------------------------------------------------------------
        */

        if ($hasRain) {

            $level = 'PELIGROSO';

        } elseif ($wind > 15) {

            $level = 'PELIGROSO';

        } elseif ($humidity > 85) {

            $level = 'MODERADO';

        } else {

            $level = 'EXCELENTE';
        }

        /*
        |--------------------------------------------------------------------------
        | Recomendación inteligente
        |--------------------------------------------------------------------------
        */

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