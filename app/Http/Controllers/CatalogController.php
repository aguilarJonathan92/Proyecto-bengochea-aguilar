<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class CatalogController extends Controller

{

    public function index($categoriaId = null)
    {
        // 1. Iniciamos la consulta base cargando la relación para evitar el problema N+1
        $query = Product::with('category');
        $tituloCategoria = 'Nuestro Catálogo'; // Título por defecto si no hay filtro

        if ($categoriaId) {
            // 2. Buscamos la categoría primero. Si no existe, lanzamos un 404 automáticamente.
            $categoriaActual = Category::findOrFail($categoriaId);

            // 3. Usamos el operador de fusión de nulidad (??) para el título
            $tituloCategoria = $categoriaActual->display_title ?? $categoriaActual->name;

            // 4. Filtramos los productos directamente por el ID de la relación
            $query->where('category_id', $categoriaId);
        }

        // 5. Traemos los productos ( get() o paginate(12))
        $products = $query->paginate(8);
        $categoria = $categoriaId;

        return view('pages.public.catalog', compact('products', 'tituloCategoria', 'categoria'));
    }

    public function details(int $id)
    {
        $product = Product::findOrFail($id);

        // Lista de productos ya vistos desde la sesión (si no existe, empezamos un array vacío)
        $vistos = session()->get('productos_vistos', []);

        // Si el ID de este producto NO está en el array, sumamos la visita y lo agregamos
        if (!in_array($id, $vistos)) {
            $product->increment('views'); // Suma +1 de forma segura

            session()->push('productos_vistos', $id); // Guarda este ID en la sesión
        }
        //el final_price lo calcula getFinalPriceAttribute() en el modelo

        return view('pages.public.product-details', compact('product'));
    }
}
