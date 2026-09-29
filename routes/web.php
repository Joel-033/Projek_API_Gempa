<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GempaController;

Route::get('/', [GempaController::class, 'terkini']);
Route::get('/dirasakan', [GempaController::class, 'dirasakan']);
Route::get('/history', [GempaController::class, 'history']);