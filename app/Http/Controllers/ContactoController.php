<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller

//Esto es para un formulario de contacto, es funcional, pero no lo llegué a implementar.

{
    //Método para el envío del formulario de contacto
    public function index() {
        return view('contacto.index');
    }

    public function store(Request $request) {
        //Validaciones
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required'
        ]);
        //Aquí puse mi correo para testear
        Mail::to('i3sus.maggie@gmail.com')->send(new ContactoMailable($request->all()));
        
        //Redirección una vez enviado el formulario
        return redirect()->route('contacto.index')->with('info', 'Mensaje enviado');
    }
}
