<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubastaController;

Route::get('/', HomeController::class);

Route::get('subastas', [SubastaController::class, 'index'])->name('subastas.index');

Route::get('subastas/create', [SubastaController::class, 'create'])->name('subastas.create');

Route::post('subastas', [SubastaController::class, 'store'])->name('subastas.store');

Route::get('subastas/{subasta}', [SubastaController::class, 'show'])->name('subastas.show');

Route::get('subastas/{subasta}/edit', [SubastaController::class, 'edit'])->name('subastas.edit');

Route::put('subastas/{subasta}', [SubastaController::class, 'update'])->name('subastas.update');