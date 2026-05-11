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
     *  GET /admin/productos
     */
    public function adminIndex()
    {
        $products = Product::with(['category', 'brand'])->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    /**
     *  GET /admin/productos/crear
     */
    public function create()
    {
        $categories = Category::where('active', true)->get();
        $brands     = Brand::where('activo', true)->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     *  POST /admin/productos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'brand_id'          => 'required|exists:brands,id',
            'title'             => 'required|string|max:200',
            'subtitle'          => 'required|string|max:200',
            'descripcion'       => 'required|string',
            'stock'             => 'required|integer|min:0',
            'price'             => 'required|numeric|min:0',
            'installments'      => 'required|integer|min:1',
            'installment_price' => 'required|numeric|min:0',
            'on_sale'           => 'boolean',
            'discount'          => 'integer|min:0|max:100',
            'image_1'           => 'required|image|max:2048',
            'image_2'           => 'nullable|image|max:2048',
            'image_3'           => 'nullable|image|max:2048',
        ]);

        // Subida de imágenes
        $image1 = $request->file('image_1')->store('products', 'public');
        $image2 = $request->hasFile('image_2') ? $request->file('image_2')->store('products', 'public') : null;
        $image3 = $request->hasFile('image_3') ? $request->file('image_3')->store('products', 'public') : null;

        // Specs desde campos dinámicos
        $specs = null;
        if ($request->has('specs')) {
            $specs = collect($request->specs)
                ->filter(fn($s) => !empty($s['nombre']) && !empty($s['valor']))
                ->mapWithKeys(fn($s) => [$s['nombre'] => $s['valor']])
                ->toArray();
        }

        Product::create([
            'category_id'       => $request->category_id,
            'brand_id'          => $request->brand_id,
            'title'             => $request->title,
            'subtitle'          => $request->subtitle,
            'description'       => $request->descripcion,
            'stock'             => $request->stock,
            'price'             => $request->price,
            'installments'      => $request->installments,
            'installment_price' => $request->installment_price,
            'on_sale'           => $request->boolean('on_sale'),
            'discount'          => $request->discount ?? 0,
            'active'            => true,
            'specs'             => $specs,
            'image_1'           => $image1,
            'image_2'           => $image2,
            'image_3'           => $image3,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto creado correctamente.');
    }

   

    /**
     * GET -- Product: EDIT /admin/productos/{id}/editar
     */
    public function edit(string $id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::where('active', true)->get();
        $brands     = Brand::where('activo', true)->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * PUT /admin/productos/{id}
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'brand_id'          => 'required|exists:brands,id',
            'title'             => 'required|string|max:200',
            'subtitle'          => 'required|string|max:200',
            'descripcion'       => 'required|string',
            'stock'             => 'required|integer|min:0',
            'price'             => 'required|numeric|min:0',
            'installments'      => 'required|integer|min:1',
            'installment_price' => 'required|numeric|min:0',
            'on_sale'           => 'boolean',
            'discount'          => 'integer|min:0|max:100',
            'image_1'           => 'nullable|image|max:2048',
            'image_2'           => 'nullable|image|max:2048',
            'image_3'           => 'nullable|image|max:2048',
        ]);

        // Solo reemplaza la imagen si se sube una nueva
        $image1 = $request->hasFile('image_1')
            ? $request->file('image_1')->store('products', 'public')
            : $product->image_1;

        $image2 = $request->hasFile('image_2')
            ? $request->file('image_2')->store('products', 'public')
            : $product->image_2;

        $image3 = $request->hasFile('image_3')
            ? $request->file('image_3')->store('products', 'public')
            : $product->image_3;

        $specs = $product->specs;
        if ($request->has('specs')) {
            $specs = collect($request->specs)
                ->filter(fn($s) => !empty($s['nombre']) && !empty($s['valor']))
                ->mapWithKeys(fn($s) => [$s['nombre'] => $s['valor']])
                ->toArray();
        }

        $product->update([
            'category_id'       => $request->category_id,
            'brand_id'          => $request->brand_id,
            'title'             => $request->title,
            'subtitle'          => $request->subtitle,
            'descripcion'       => $request->descripcion,
            'stock'             => $request->stock,
            'price'             => $request->price,
            'installments'      => $request->installments,
            'installment_price' => $request->installment_price,
            'on_sale'           => $request->boolean('on_sale'),
            'discount'          => $request->discount ?? 0,
            'specs'             => $specs,
            'image_1'           => $image1,
            'image_2'           => $image2,
            'image_3'           => $image3,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Producto actualizado correctamente.');
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
