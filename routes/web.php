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

Route::get(
    '/dashboard',
    [DashboardController::class, 'redirect']
)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {


    Route::resource(
        'usuarios',
        UserController::class
    );


    Route::get(
        '/clima',
        [WeatherController::class, 'index']
    );

    Route::post(
        '/clima',
        [WeatherController::class, 'search']
    );

    Route::get(
        '/historial-climatico',
        [WeatherController::class, 'history']
    );

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

Route::get('/test-api', function () {

    return env('OPENWEATHER_API_KEY');

});

Route::post(
    '/weather/forecast',
    [WeatherController::class, 'forecast']
)->name('weather.forecast');

Route::post(
    '/weather/forecast-analysis',
    [WeatherController::class, 'forecastAnalysis']
)->name('weather.forecast.analysis');

require __DIR__ . '/auth.php';