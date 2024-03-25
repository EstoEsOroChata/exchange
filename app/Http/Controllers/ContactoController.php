<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index() {
        return view('contacto.index');
    }

    public function store(Request $request) {

        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required'
        ]);

        Mail::to('i3sus.maggie@gmail.com')->send(new ContactoMailable($request->all()));

        return redirect()->route('contacto.index')->with('info', 'Mensaje enviado');
    }
}
