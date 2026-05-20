<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(SearchRequest $request)
    {
        // Código validado ya validado por SearchRequest y con el trim() hecho
        $query = $request->input('query');

        // Consulta unificada
        $resultsQuery = Product::query()
            ->where('products.title', 'LIKE', "%{$query}%")
            ->orWhereHas('brand', function ($q) use ($query) {
                $q->where('brands.name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('category', function ($q) use ($query) {
                $q->where('categories.name', 'LIKE', "%{$query}%");
            });

        // Lógica para AJAX (Sugerencias rápidas)
        if ($request->ajax()) {
            $suggestions = $resultsQuery->limit(5)->get();

            if ($suggestions->isEmpty()) {
                return '<div class="list-group-item text-muted">Sin resultados</div>';
            }

            $html = '';
            foreach ($suggestions as $product) {
                $url = route('product-details', ['id' => $product->id]);
                $html .= "
                <a href='{$url}' class='list-group-item list-group-item-action d-flex align-items-center'>
                    <img src='" . asset($product->image_1) . "' style='width: 40px; height: 40px; object-fit: cover;' class='me-2 rounded'>
                    <div>
                        <div class='fw-bold' style='font-size: 0.9rem;'>{$product->title}</div>
                        <small class='text-muted'>{$product->brand->name}</small>
                    </div>
                </a>";
            }
            return $html;
        }

        // Paginación normal para vista completa
        $results = $resultsQuery->paginate(12)->appends(['query' => $query]);

        return view('search.results', compact('results', 'query'));
    }
}
