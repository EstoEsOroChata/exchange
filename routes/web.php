<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubastaController;

Route::get('/', HomeController::class)->name('home');

Route::resource('subastas', SubastaController::class);

Route::view('nosotros', 'nosotros')->name('nosotros');