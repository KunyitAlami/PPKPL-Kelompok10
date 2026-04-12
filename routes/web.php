<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoilLocationController;

/*
|--------------------------------------------------------------------------
| Route Netral (Tanpa ID) - UNTUK DEVELOPMENT
|--------------------------------------------------------------------------
*/

Route::get('/', [SoilLocationController::class, 'create'])->name('locations.create.simple');
Route::get('/location/create', [SoilLocationController::class, 'create'])->name('locations.create.simple');
Route::post('/location/store', [SoilLocationController::class, 'store'])->name('locations.store.simple');

/*
|--------------------------------------------------------------------------
| Route Relational (Dengan SoilTest) - UNTUK PRODUCTION / DATA SUDAH ADA
|--------------------------------------------------------------------------
*/

Route::get('/soil-tests/{soilTest}/location/create', [SoilLocationController::class, 'create'])->name('locations.create');
Route::post('/soil-tests/{soilTest}/location', [SoilLocationController::class, 'store'])->name('locations.store');

/*
|--------------------------------------------------------------------------
| Show Location
|--------------------------------------------------------------------------
*/

Route::get('/locations/{location}', [SoilLocationController::class, 'show'])->name('locations.show');