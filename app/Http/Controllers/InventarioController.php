<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use App\Models\User;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function show($id){
        $usuario = User::findOrFail($id); // Buscar el usuario por su ID
        return $this->subastasUsuario($usuario); // Pasar el usuario al método subastasUsuario
    }
    
    public function subastasUsuario($usuario)
    {
        // Obtener las subastas creadas por el usuario proporcionado
        $subastas = Subasta::where('user_id', $usuario->id)->get();
        
        // Pasar las subastas y el usuario a la vista del perfil del usuario
        return view('profile', compact('usuario', 'subastas'));
    }
}
