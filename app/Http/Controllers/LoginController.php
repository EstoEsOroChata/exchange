<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\facades\Validator;


class LoginController extends Controller
{
    public function registro(Request $request){

        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'email.unique' => 'Este correo ya está en uso.',
            'email.required' => 'El correo es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.'
        ];

        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], $messages);
    
        // Si la validación falla, redirige de vuelta con los errores
        if ($validator->fails()) {
            return redirect(route('registro'))
                        ->withErrors($validator)
                        ->withInput();
        }
    
        // Si la validación es exitosa, crea el usuario
        $user = new User();
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->oro = 1000;
    
        $user->save();
    
        return redirect(route('home'));
    }

    public function login(Request $request){

        $messages = [
            'email.exists' => 'El correo electrónico no existe.',
            'email.required' => 'El correo es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.'
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], $messages);

        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];
        
        $remember = ($request->has('recordar') ? true : false);

        if(Auth::attempt($credentials, $remember)){

            $request->session()->regenerate();

            return redirect()->intended(route('perfil.show', ['id' => Auth::user()->id]));

        }else{
            return redirect(route('login'));
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'));
    }
}
