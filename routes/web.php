<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoilLocationController;

Route::get('/', function () {
    // Kita arahkan halaman utama langsung ke form input lokasi
    // Angka 1 di sini adalah ID Soil Test (pastikan datanya ada di database)
    return redirect()->route('locations.create', 1);
});

// Route untuk fitur US 1.2
Route::get('/soil-tests/{soilTest}/location/create', [SoilLocationController::class, 'create'])->name('locations.create');
Route::post('/soil-tests/{soilTest}/location', [SoilLocationController::class, 'store'])->name('locations.store');
Route::get('/locations/{location}', [SoilLocationController::class, 'show'])->name('locations.show');