<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'welcome'])
    ->name('welcome');

Route::get('/landing', [HomeController::class, 'landing'])
    ->name('landing');

Route::get('/interactive-map/{countrySide}', [MapController::class, 'show'])
    ->name('map.show');

Route::get('/map-data/{countrySide}', [MapController::class, 'data'])
    ->name('map.data');

Route::get('/areas/{area}', [AreaController::class, 'show'])
    ->name('areas.show');

Route::get('/area-data/{area}', [AreaController::class, 'data'])
    ->name('areas.data');