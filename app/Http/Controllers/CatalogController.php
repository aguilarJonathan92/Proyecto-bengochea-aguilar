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

        // 5. Traemos los productos (recomiendo cambiar get() por paginate(12) en el futuro)
        $products = $query->get();
        $categoria = $categoriaId;

        return view('pages.catalog', compact('products', 'tituloCategoria', 'categoria'));
    }

    public function details(int $id)
    {
        // Buscamos el producto por su ID.
        // findOrFail lanza automáticamente un error 404 si no existe.
        $product = Product::findOrFail($id);

        // No hace falta calcular el final_price aquí,
        // lo invocas directamente en la vista con $product->final_price

        return view('pages.product-details', compact('product'));
    }
}
