<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index(){
        return view('pages.home');
    }
    public function terms(){
        return view('pages.term-and-uses');
    }
    public function about(){
        return view('pages.about');
    }
    public function marketing(){
        return view('pages.marketing');
    }
}
