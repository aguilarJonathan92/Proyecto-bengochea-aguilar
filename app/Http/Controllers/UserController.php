<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user(); // Trae el usuario autenticado
        return view('pages.user-panel', compact('user'));
    }

    public function update(Request $request){

        $user = User::find(Auth::id()); //trae desde la base de datos, los datos de usuario autenticado

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'nullable|min:8|confirmed',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('panel-usuario')->with('success', '¡Datos actualizados correctamente!');
    }
}
