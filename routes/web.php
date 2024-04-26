<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubastaController;
use Illuminate\Support\Facades\Route;

//Rutas principales
Route::get('/', HomeController::class)->name('home');
Route::view('nosotros', 'nosotros')->name('nosotros');

//Esto es para un formulario de contacto, es funcional, pero no lo llegué a implementar.
Route::get('contacto',[ContactoController::class, 'index'])->name('contacto.index');
Route::post('contacto', [ContactoController::class, 'store'])->name('contacto.store');

Route::middleware('auth')->group(function () {
    Route::resource('subastas', SubastaController::class)->except(['show', 'edit', 'update', 'destroy']);
    Route::get('/subastas/{subasta}', [SubastaController::class, 'show'])->name('subastas.show');
    Route::get('/subastas/{subasta}/edit', [SubastaController::class, 'edit'])->name('subastas.edit');
    Route::put('/subastas/{subasta}', [SubastaController::class, 'update'])->name('subastas.update');
    Route::post('/subastas/{subasta}/comprar', [SubastaController::class, 'comprar'])->name('subastas.comprar');
    Route::post('/subastas/{subasta}/pujar', [SubastaController::class, 'pujar'])->name('subastas.pujar');
    Route::post('/subastas/{subasta}/finalizar', [SubastaController::class, 'finalizarSubasta'])->name('subastas.finalizar');
});

//Redirige a página de error 403 para usuarios no autenticados
Route::get('/subastas', function () {
    abort(403, 'Acceso prohibido');
})->name('subastas.index');


//Rutas de login y registro
Route::view('/login', 'login')->name('iniciar-sesion');
Route::view('/registro', 'registro')->name('registro');
Route::post('/validar-registro',[LoginController::class,'registro'])->name('validar');
Route::post('/iniciar-sesion',[LoginController::class,'login'])->name('login');
Route::get('/cerrar-sesion',[LoginController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/perfil/{id}', [InventarioController::class, 'show'])->name('perfil.show');
});

//Redirige a página de error 403 para usuarios no autenticados
Route::get('/perfil/{id}', function () {
    abort(403, 'Acceso prohibido');
})->name('perfil.show');

//Rutas de búsquedas
Route::get('search/subastas', [SearchController::class, 'subastas'])->name('search.subastas');