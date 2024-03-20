<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubastaController;

Route::get('/', HomeController::class);

Route::get('subastas', [SubastaController::class, 'index']);
Route::get('subastas/create', [SubastaController::class, 'create']);
Route::get('subastas/{subasta}', [SubastaController::class, 'show']);