<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SoilLocationController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\TeknisiSondirController;

/*
|--------------------------------------------------------------------------
| Route Authentication
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Fitur Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Dashboard Sementara untuk testing login
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


/*
|--------------------------------------------------------------------------
| Route Netral (Tanpa ID) - UNTUK DEVELOPMENT
|--------------------------------------------------------------------------
*/
Route::get('/', [SoilLocationController::class, 'create'])->name('home');
Route::get('/location/create', [SoilLocationController::class, 'create'])->name('locations.create.simple');
Route::post('/location/store', [SoilLocationController::class, 'store'])->name('locations.store.simple');


/*
|--------------------------------------------------------------------------
| Route Relational (Dengan SoilTest) - UNTUK PRODUCTION / DATA SUDAH ADA
|--------------------------------------------------------------------------
*/
// Dibungkus middleware auth agar hanya actor yang login yang bisa input/lihat data
Route::middleware('auth')->group(function () {

    // US 1.1: Pengajuan untuk Kontraktor
    Route::prefix('kontraktor')->group(function () {
        Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
        Route::get('/pengajuan/buat', [PengajuanController::class, 'create'])->name('pengajuan.create');
        Route::post('/pengajuan/simpan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    });
    
    // US 1.2: Rute untuk Petugas Lab
    Route::prefix('lab')->group(function () {
        Route::get('/penjadwalan', [SoilLocationController::class, 'index'])->name('lab.lokasi.index');
        Route::get('/penjadwalan/{soilTest}/buat', [SoilLocationController::class, 'create'])->name('lab.lokasi.create');
        Route::post('/penjadwalan/{soilTest}/simpan', [SoilLocationController::class, 'store'])->name('lab.lokasi.store');
        Route::delete('/penjadwalan/{soilTest}/revert', [SoilLocationController::class, 'revert'])->name('lab.lokasi.revert');
    });

    // US 1.3: Rute untuk Teknisi Lapangan
    Route::prefix('teknisi')->middleware('auth')->group(function () {
        Route::get('/sondir', [TeknisiSondirController::class, 'index'])->name('teknisi.sondir.index');
        Route::get('/sondir/{lokasi}/input', [TeknisiSondirController::class, 'create'])->name('teknisi.sondir.create');
        Route::post('/sondir/{lokasi}', [TeknisiSondirController::class, 'store'])->name('teknisi.sondir.store');

        Route::delete('/sondir/{hasil}/revert', [TeknisiSondirController::class, 'revert'])->name('teknisi.sondir.revert');
    });

});