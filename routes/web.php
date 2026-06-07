<?php

use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use Inertia\Inertia;


use App\Http\Controllers\WelcomeController;

Route::get(
    '/',
    [WelcomeController::class, 'index']
);

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/dashboard',
    [DashboardController::class, 'redirect']
)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Usuarios
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'usuarios',
        UserController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Clima
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/clima',
        [WeatherController::class, 'index']
    );

    Route::post(
        '/clima',
        [WeatherController::class, 'search']
    );

    /*
    |--------------------------------------------------------------------------
    | Historial Climático
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/historial-climatico',
        [WeatherController::class, 'history']
    );

    /*
    |--------------------------------------------------------------------------
    | Reportes
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/reportes',
        [ReportController::class, 'index']
    );

    Route::get(
        '/reportes/usuarios/pdf',
        [ReportController::class, 'usersPdf']
    );

    Route::get(
        '/reportes/usuarios/excel',
        [ReportController::class, 'usersExcel']
    );

    Route::get(
        '/reportes-tecnicos',
        [ReportController::class, 'technical']
    );
    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| Test API
|--------------------------------------------------------------------------
*/

Route::get('/test-api', function () {

    return env('OPENWEATHER_API_KEY');

});

/*
|--------------------------------------------------------------------------
| Auth Breeze
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';