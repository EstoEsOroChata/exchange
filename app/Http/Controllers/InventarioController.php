<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use App\Models\User;

class InventarioController extends Controller
{
    //Método para mostrar las subastas de un usuario
    public function show($id){
        //Busca el usuario por su ID
        $usuario = User::findOrFail($id);

        //Pasar el usuario al método subastasUsuario
        return $this->subastasUsuario($usuario); 
    }
    
    //Método para mostrar las subastas de un usuario en su perfil
    public function subastasUsuario($usuario)
    {
        //Obtener las subastas creadas por el usuario
        $subastas = Subasta::where('user_id', $usuario->id)->get();
        
        //Pasa las subastas y el usuario a la vista del perfil del usuario
        return view('profile', compact('usuario', 'subastas'));
    }
}
