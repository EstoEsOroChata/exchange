<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function registro(Request $request){
        
        $usuario = new Usuario();

        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->contrasena = Hash::make($request->contrasena);

        $usuario->save();

        return redirect(route('home'));
    }

    public function login(Request $request){

        $credentials = [
            "nombre" => $request->nombre,
            "contrasena" => $request->contrasena,
        ];
        
        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credentials, $remember)){

        }else{
            return redirect('login');
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
