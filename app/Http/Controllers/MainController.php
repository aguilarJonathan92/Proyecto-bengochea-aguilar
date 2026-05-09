<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Novedades — últimos 4 productos agregados
        $novedades = Product::with(['category', 'brand'])
            ->where('active', true)
            ->latest()
            ->take(4)
            ->get();

        // Ofertas — productos con descuento
        $ofertas_home = Product::with(['category', 'brand'])
            ->where('active', true)
            ->where('on_sale', true)
            ->take(4)
            ->get();

        // Más vistos — por ahora los primeros 4 (después podés agregar un campo visits)
        $mas_vistos = Product::with(['category', 'brand'])
            ->where('active', true)
            ->take(4)
            ->get();

        // Calculamos final_price en los tres grupos
        foreach ([$novedades, $ofertas_home, $mas_vistos] as $grupo) {
        $grupo->transform(function ($product) {
            $product->final_price = $product->on_sale
                ? $product->price - ($product->price * $product->discount / 100)
                : $product->price;
            return $product;
        });
    }

    return view('pages.home', compact('novedades', 'ofertas_home', 'mas_vistos'));
    }

    public function terms()
    {
        return view('pages.term-and-uses');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function marketing()
    {
        return view('pages.marketing');
    }

    public function contact(){
        return view('pages.contact');
    }

    public function checkout(){
        return view('pages.checkout');
    }
}
