<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Asegúrate de que Product esté importado arriba: use App\Models\Product;
        $ofertas_home = Product::query()->where('on_sale', true)->take(4)->get();
        $novedades    = Product::query()->latest()->take(4)->get();
        $mas_vistos   = Product::query()->inRandomOrder('')->take(4)->get();

        // Verifica que los nombres en compact coincidan exactamente con las variables
        return view('pages.public.home', compact('ofertas_home', 'novedades', 'mas_vistos'));
    }

    public function terms()
    {
        return view('pages.public.term-and-uses');
    }

    public function about()
    {
        return view('pages.public.about');
    }

    public function marketing()
    {
        return view('pages.public.marketing');
    }

    public function contact()
    {
        return view('pages.public.contact');
    }
}
