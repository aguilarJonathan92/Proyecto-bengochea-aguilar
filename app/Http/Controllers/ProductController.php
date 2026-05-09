<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET/catalogos
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand'])->where('active', true);

        // Filtro por categoría si viene en la URL (?categoria=Audio)
        if ($request->has('categoria')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->categoria);
            });
        }

        $products = $query->get();

        // Calculamos el precio final
        $products->transform(function ($product) {
            $product->final_price = $product->on_sale
                ? $product->price - ($product->price * $product->discount / 100)
                : $product->price;
            return $product;
        });

        $categories = Category::where('active', true)->get();

        // Mismo mapeo que tenías antes
    $nombresCategorias = [
        'Audio'        => 'Equipos de Audio y Sonido',
        'Instrumentos' => 'Instrumentos Musicales',
        'Soportes'     => 'Trípodes y Soportes',
        'Accesorios'   => 'Accesorios',
    ];

    $tituloCategoria = $nombresCategorias[$request->categoria] ?? 'Nuestro Catálogo';

        return view('pages.catalog', compact('products', 'categories', 'tituloCategoria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
