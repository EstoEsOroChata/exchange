<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function show(){
        $user = auth()->user();
        return $this->subastasUsuario(); // Llama directamente al método que obtiene las subastas
    }

    public function subastasUsuario()
    {
        // Obtener el usuario actual
        $usuario = auth()->user();
    
        // Obtener las subastas creadas por el usuario actual
        $subastas = Subasta::where('user_id', $usuario->id)->get();
    
        // Pasar las subastas a la vista del perfil del usuario
        return view('profile', compact('usuario', 'subastas'));
    }
}
