<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Province;
use App\Models\UserAddress;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        // Traemos el carrito del usuario autenticado con sus productos
        $cart = $request->user()->cart()->with('items.product')->first();

        // Si el carrito no existe o no tiene productos, lo mandamos de vuelta al catálogo
        if (!$cart || $cart->items->isEmpty()) {
            // CORREGIDO: Cambiado swal_error por cart_error
            return redirect()->route('catalog')->with('cart_error', 'Tu carrito está vacío. Añade productos antes de finalizar la compra.');
        }

        // =========================================================================
        // CONTROL DE SEGURIDAD 1: Limpieza antes de renderizar la vista Checkout
        // =========================================================================
        $productosEliminados = false;
        foreach ($cart->items as $item) {
            $product = $item->product;

            // Si el producto fue desactivado o borrado mientras miraba el carrito
            if (!$product || !$product->active) {
                $item->delete();
                $productosEliminados = true;
            }
        }

        if ($productosEliminados) {
            $cart->load('items.product'); // Recargamos el carrito limpio

            if ($cart->items->isEmpty()) {
                // Cambiado swal_error por cart_error
                return redirect()->route('catalog')->with('cart_error', 'Los productos de tu carrito ya no están disponibles.');
            }

            // Cambiado swal_error por cart_error y redirigimos al catálogo para asegurar el impacto visual
            return redirect()->route('catalog')->with('cart_error', 'Algunos productos ya no están disponibles y fueron removidos del carrito.');
        }

        // Traemos las direcciones del usuario
        $direcciones = UserAddress::where('user_id', $request->user()->id)
            ->with('city.province')
            ->get();

        // Cargamos todas las provincias por si quiere agregar una nueva dirección en el momento
        $provincias = Province::orderBy('name')->get();

        // Retornamos la vista checkout.blade.php pasándole el carrito
        return view('pages.private.checkout', compact('cart', 'direcciones', 'provincias'));
    }

    public function store(CheckoutRequest $request)
    {
        // 1. Validar los datos que vienen del formulario del checkout
        $validated = $request->validated();

        $user = $request->user();

        // Variables donde guardaremos la info final del envío
        $calleEnvio = '';
        $cpEnvio = '';
        $ciudadEnvioId = null;

        if ($request->user_address_id === 'nueva_direccion') {
            // 1. Es una dirección nueva: La guardamos en su cuenta para el futuro
            $nuevaDireccion = $user->addresses()->create([
                'alias'       => $request->delivery_alias ?? 'Dirección de Compra',
                'street'      => $request->delivery_street,
                'postal_code' => $request->delivery_postal_code,
                'city_id'     => $request->delivery_city_id,
                'is_default'  => $user->addresses()->count() === 0
            ]);

            $calleEnvio    = $nuevaDireccion->street;
            $cpEnvio       = $nuevaDireccion->postal_code;
            $ciudadEnvioId = $nuevaDireccion->city_id;
        } else {
            // 2. Eligió una dirección existente: Buscamos el registro
            $direccionExistente = $user->addresses()->findOrFail($request->user_address_id);

            $calleEnvio    = $direccionExistente->street;
            $cpEnvio       = $direccionExistente->postal_code;
            $ciudadEnvioId = $direccionExistente->city_id;
        }

        // Obtener el carrito del usuario con sus productos
        $cart = $request->user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('catalog')->with('cart_error', 'No se pudo procesar la compra porque tu carrito está vacío.');
        }

        // 2. Usamos una Transacción de Base de Datos
        DB::beginTransaction();

        try {
            $subtotal = 0;
            $itemsToCreate = [];

            // 3. Iterar los productos del carrito para calcular totales y verificar Stock
            foreach ($cart->items as $item) {
                $product = $item->product;

                // =========================================================================
                // CONTROL DE SEGURIDAD 2: El producto se desactivó justo antes de pagar
                // =========================================================================
                if (!$product || !$product->active) {
                    DB::rollBack();  // 1. Cancelamos la transacción primero
                    $item->delete(); // 2. Removemos definitivamente el ítem de la base de datos

                    // 3. Redirigimos usando 'cart_error' para que lo capte tu layout flotante
                    return redirect()->route('catalog')->with('cart_error', 'Uno de los productos de tu orden dejó de estar disponible. El carrito fue actualizado.');
                }

                // Control de Stock tradicional
                if ($product->stock < $item->quantity) {
                    DB::rollBack(); // Hacer rollback si rebota por falta de stock
                    return redirect()->back()->with('cart_error', "Lo sentimos, no hay suficiente stock disponible para: {$product->title}. (Stock actual: {$product->stock})");
                }

                // Calcular el precio real
                $precioUnitario = $product->final_price;
                $subtotal += $precioUnitario * $item->quantity;

                $itemsToCreate[] = [
                    'product_id' => $product->id,
                    'quantity'   => $item->quantity,
                    'price'      => $precioUnitario,
                ];
            }

            // 4. Crear la Cabecera de la Orden
            $order = Order::create([
                'user_id'              => $request->user()->id,
                'total'                => $subtotal,
                'payment_method'       => $request->paymentMethod,
                'status'               => 'processing',
                'customer_name'        => $request->customer_name,
                'customer_lastname'    => $request->customer_lastname,
                'customer_email'       => $request->customer_email,
                'delivery_street'      => $calleEnvio,
                'delivery_postal_code' => $cpEnvio,
                'delivery_city_id'     => $ciudadEnvioId,
            ]);

            // 5. Crear los ítems de la orden y restar stock de los productos
            foreach ($itemsToCreate as $itemData) {
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);

                $product = Product::find($itemData['product_id']);
                $product->decrement('stock', $itemData['quantity']);
            }

            // 6. Vaciar el carrito de compras del usuario
            $cart->items()->delete();
            $cart->delete();

            DB::commit(); // Confirmamos todo en MariaDB

            return redirect()->route('orders.success', $order->id)->with('cart_success', '¡Tu pedido ha sido procesado con éxito!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('catalog')->with('cart_error', 'Ocurrió un error inesperado al procesar tu pedido: ' . $e->getMessage());
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::user()->id) {
            abort(403, 'No tienes permiso para ver este pedido.');
        }

        return view('pages.private.order-success', compact('order'));
    }
}
