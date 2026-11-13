<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\LaporanController;

// Halaman awal
Route::get('/', function () {
    return redirect()->route('login');
});

// Login dan Registrasi
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Halaman yang hanya bisa dibuka setelah login
Route::middleware('auth')->group(function () {
    Route::resource('anggota', AnggotaController::class)
    ->parameters(['anggota' => 'id']);
    Route::resource('simpanan', SimpananController::class);
    Route::resource('pinjaman', PinjamanController::class);
});

// Laporan
Route::middleware('auth')->group(function () {
    Route::get('/laporan/anggota', [LaporanController::class, 'anggota'])->name('laporan.anggota');
    Route::get('/laporan/simpanan', [LaporanController::class, 'simpanan'])->name('laporan.simpanan');
    Route::get('/laporan/pinjaman', [LaporanController::class, 'pinjaman'])->name('laporan.pinjaman');
});
