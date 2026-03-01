<?php

use Illuminate\Support\Facades\Route; // Wajib ada agar tidak error [Sumber: Laravel Docs]
use App\Http\Controllers\KosController;

// Rute untuk Landing Page (Halaman Utama) [Sumber: Laravel Routing]
Route::get('/', [KosController::class, 'landingPage'])->name('landing');

// Rute untuk Manajemen Kos [Sumber: Laravel Resource Controllers]
Route::resource('kos', KosController::class);
