<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GempaController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk tugas kelompok
Route::get('/info-gempa', [GempaController::class, 'index']);
