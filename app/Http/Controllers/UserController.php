<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user = Auth::user(); // Trae el usuario autenticado
        return view('pages.user-panel', compact('user'));
    }
}
