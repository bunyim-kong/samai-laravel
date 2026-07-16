<?php

use App\Http\Controllers\Admin\AreaController as AdminAreaController;
use App\Http\Controllers\Admin\AreaImageController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CountrySideController as AdminCountrySideController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'welcome'])
    ->name('welcome');

Route::get('/landing', [HomeController::class, 'landing'])
    ->name('landing');

Route::get(
    '/interactive-map/{countrySide}',
    [MapController::class, 'show']
)->name('map.show');

Route::get(
    '/map-data/{countrySide}',
    [MapController::class, 'data']
)->name('map.data');

Route::get(
    '/areas/{area}',
    [AreaController::class, 'show']
)->name('areas.show');

Route::get(
    '/area-data/{area}',
    [AreaController::class, 'data']
)->name('areas.data');

Route::middleware('guest')->group(function () {
    Route::get(
        '/admin/login',
        [AdminAuthController::class, 'create']
    )->name('login');

    Route::post(
        '/admin/login',
        [AdminAuthController::class, 'store']
    )
        ->middleware('throttle:5,1')
        ->name('login.store');
});

Route::post(
    '/admin/logout',
    [AdminAuthController::class, 'destroy']
)
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get(
            '/',
            [DashboardController::class, 'index']
        )->name('dashboard');

        Route::resource(
            'country-sides',
            AdminCountrySideController::class
        );

        Route::resource(
            'areas',
            AdminAreaController::class
        );

        Route::delete(
            '/area-images/{areaImage}',
            [AreaImageController::class, 'destroy']
        )->name('area-images.destroy');
    });