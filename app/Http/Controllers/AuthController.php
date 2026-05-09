<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //muestra la vista de login
    public function login(){
        return view('auth.login');
    }

    //procesa los datos enviados desde el formulario
    public function loginPost(Request $request){
        $credenciales = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credenciales)){
            $request->session()->regenerate();

            $user = Auth::user();

            if(in_array($user->rol->name, ['admin', 'superadmin'])){
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/'); //si son clientes, van a la pantalla principal
        }

        return back()->withErrors([
            'email' => 'Las credenciales no son correctas.',
        ]);
    }

    //muestra la vista de registro
    public function signup(){
        return view('auth.signup');
    }

    //Para registrar el nuevo usuario
    public function signupPost(Request $request){

        //valido los datos antes de hacer el registro definitivo
        $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $rolCliente = Rol::where('name', 'cliente')->first();

        $usuario = User::create([
            'firstName' => $request->nombre,
            'lastName' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol_id'   => $rolCliente->id,
        ]);

        $usuario->perfil()->create();

        Auth::login($usuario);

        return redirect('/');
    }

    //para cerrar las sesion
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}