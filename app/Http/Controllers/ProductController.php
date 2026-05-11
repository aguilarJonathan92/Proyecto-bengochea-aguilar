<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // --------------------------------------
    //     MÉTODOS PARA CATÁLOGO PÚBLICO 
    // --------------------------------------

    // GET/catalogos (Muestra todos los productos o filtrados por categorias)
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
     *  GET /catalogo/{id} -- Muestro el detalle de los productos
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'brand'])
            ->where('active', true)
            ->findOrFail($id); // lanza 404 automático si no existe

        $product->final_price = $product->on_sale
            ? $product->price - ($product->price * $product->discount / 100)
            : $product->price;

        return view('pages.product-details', compact('product'));
    }


    // --------------------------------------
    //     MÉTODOS PARA CRUD DE PRODUCTOS (ADMIN)
    // --------------------------------------

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
     * GET -- Product: EDIT
     */
    public function edit(string $id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::where('active', true)->get();
        $brands     = Brand::where('activo', true)->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * PUT -- Product: DELETE (Baja logica, solo desactivo)
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->update(['active' => false]); // solo desactivo el producto
        return redirect()->route('admin.products.index')
        ->with('sucess', 'Producto desactivado correctamente.');
    }
}
