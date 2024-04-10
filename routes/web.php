<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubastaController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::resource('subastas', SubastaController::class);

Route::view('nosotros', 'nosotros')->name('nosotros');

Route::get('contacto',[ContactoController::class, 'index'])->name('contacto.index');

Route::post('contacto', [ContactoController::class, 'store'])->name('contacto.store');

Route::get('/subastas/{subasta}', [SubastaController::class, 'show'])->name('subastas.show');

Route::get('/subastas/{subasta}/edit', [SubastaController::class, 'edit'])->name('subastas.edit');

Route::put('/subastas/{subasta}', [SubastaController::class, 'update'])->name('subastas.update');

Route::post('/subastas/{subasta}/comprar', [SubastaController::class, 'comprar'])->name('subastas.comprar');

Route::post('/subastas/{subasta}/pujar', [SubastaController::class, 'pujar'])->name('subastas.pujar');




//Login
Route::view('/login', 'login')->name('iniciar-sesion');
Route::view('/registro', 'registro')->name('registro');
Route::view('/perfil', 'secret')->middleware('auth')->name('perfil');

Route::post('/validar-registro',[LoginController::class,'registro'])->name('validar');
Route::post('/iniciar-sesion',[LoginController::class,'login'])->name('login');
Route::get('/cerrar-sesion',[LoginController::class,'logout'])->name('logout');

Route::get('/perfil', [InventarioController::class, 'show'])->name('perfil');