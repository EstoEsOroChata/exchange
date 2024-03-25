<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubastaController;
use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::resource('subastas', SubastaController::class);

Route::view('nosotros', 'nosotros')->name('nosotros');

// Route::get('contacto', function () {

//     Mail::to('i3sus.maggie@gmail.com')->send(new ContactoMailable);

//     return  "Mensaje enviado";
    
// })->name('contacto');

Route::get('contacto',[ContactoController::class, 'index'])->name('contacto.index');

Route::post('contacto', [ContactoController::class, 'store'])->name('contacto.store');