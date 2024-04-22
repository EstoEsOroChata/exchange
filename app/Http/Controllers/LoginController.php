<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\facades\Validator;


class LoginController extends Controller
{
    //Método para registrar un nuevo usuario
    public function registro(Request $request){

        //Validaciones personalizadas
        $messages = [
            
            'email.unique' => 'Este correo ya está en uso.',
            'email.required' => 'El correo es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.'
        ];

        //Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], $messages);
    
        //Si la validación falla, redirige de vuelta con los errores
        if ($validator->fails()) {
            return redirect(route('registro'))
                        ->withErrors($validator)
                        ->withInput();
        }
    
        //Si la validación ees correcta, crea el usuario
        $user = new User();
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->oro = 1000;
    
        $user->save();
    
        return redirect(route('home'));
    }

    //Método para iniciar sesión
    public function login(Request $request){

        //Validaciones personalizadas
        $messages = [
            'email.exists' => 'El correo electrónico no existe.',
            'email.required' => 'El correo es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.'
        ];

        //Validación de los datos del formulario
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], $messages);

        //Credenciales para iniciar sesión
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        
        //Recordar al usuario si se marca la casilla
        $remember = ($request->has('recordar') ? true : false);

        //Intento de inicio de sesión
        if(Auth::attempt($credentials, $remember)){

            $request->session()->regenerate();

            //Redirige si consigue iniciar sesión
            return redirect()->intended(route('perfil.show', ['id' => Auth::user()->id]));

        }else{
            //Redirige si no consigue iniciar sesión
            return redirect(route('login'));
        }
    }

    //Método para cerrar sesión
    public function logout(Request $request){
        Auth::logout();

        //Invalida la sesión y regenera el token de CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        //Devuelve a la vista "home"
        return redirect(route('home'));
    }
}
