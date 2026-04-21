<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(){
        return view('pages.catalog');
    }

    public function details(){
        return view('pages.product-details');
    }
}
