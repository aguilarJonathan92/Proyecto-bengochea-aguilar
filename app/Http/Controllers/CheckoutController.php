<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request){
        // Traemos el carrito del usuario autenticado con sus productos
        $cart = $request->user()->cart()->with('items.product')->first();

        // Si el carrito no existe o no tiene productos, lo mandamos de vuelta al catálogo
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('catalog')->with('error', 'Tu carrito está vacío. Añade productos antes de finalizar la compra.');
        }

        // Retornamos la vista checkout.blade.php pasándole el carrito
        return view('checkout', compact('cart'));
    }

    public function store(Request $request){
        // 1. Validar los datos que vienen del formulario del checkout
        $validated = $request->validate([
            'customer_name'     => 'required|string|max:255',
            'customer_lastname' => 'required|string|max:255',
            'customer_email'    => 'required|email|max:255',
            'delivery_street'   => 'required|string|max:255',
            'paymentMethod'     => 'required|string|in:credit,transfer',
            'delivery_city_id'  => 'required|exists:cities,id',
            'delivery_postal_code' => 'required|string|max:10',
        ]);

        // Obtener el carrito del usuario con sus productos
        $cart = $request->user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('catalog')->with('error', 'No se pudo procesar la compra porque tu carrito está vacío.');
        }

        // 2. Usamos una Transacción de Base de Datos para asegurarnos de que se guarde TODO o NADA.
        // Si a mitad de camino se cae el sistema o un producto se queda sin stock, no se creará una orden fantasma.
        DB::beginTransaction();

        try {
            $subtotal = 0;
            $itemsToCreate = [];

            // 3. Iterar los productos del carrito para calcular totales y verificar Stock
            foreach ($cart->items as $item) {
                $product = $item->product;

                // Control de Stock
                if ($product->stock < $item->quantity) {
                    return redirect()->back()->with('error', "Lo sentimos, no hay suficiente stock disponible para: {$product->title}. (Stock actual: {$product->stock})");
                }

                // Calcular el precio real (usando tu accesor final_price)
                $precioUnitario = $product->final_price;
                $subtotal += $precioUnitario * $item->quantity;

                // Guardamos los datos del ítem para crearlos luego de generar la cabecera de la orden
                $itemsToCreate[] = [
                    'product_id' => $product->id,
                    'quantity'   => $item->quantity,
                    'price'      => $precioUnitario, // Precio congelado con descuento si aplicaba
                ];
            }

            // APLICAR DESCUENTO POR TRANSFERENCIA (Solo si hay tiempo)
            //if ($request->paymentMethod === 'transfer') {
            //    $subtotal = $subtotal * 0.90; // Aplica un 10% de descuento al total general
            //}

            // 4. Crear la Cabecera de la Orden
            $order = Order::create([
                'user_id'              => $request->user()->id,
                'total'                => $subtotal,
                'payment_method'       => $request->paymentMethod,
                'status'               => 'en proceso', 
                'customer_name'        => $request->customer_name,
                'customer_lastname'    => $request->customer_lastname,
                'customer_email'       => $request->customer_email,
                'delivery_street'      => $request->delivery_street,
                'delivery_postal_code' => $request->delivery_postal_code,
                'delivery_city_id'     => $request->delivery_city_id,
            ]);

            // 5. Crear los ítems de la orden y restar stock de los productos
            foreach ($itemsToCreate as $itemData) {
                // Asociamos el id de la orden que acabamos de crear
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);

                // Restar el stock físicamente al producto
                $product = Product::find($itemData['product_id']);
                $product->decrement('stock', $itemData['quantity']);
            }

            // 6. Vaciar el carrito de compras del usuario (Eliminar sus ítems)
            $cart->items()->delete();
            $cart->delete(); // Opcional: puedes borrar el carrito completo o dejar la cabecera vacía

            DB::commit(); // Todo salió bien, impactamos la base de datos de manera permanente

            // Redireccionar al usuario a una pantalla de éxito
            return redirect()->route('orders.success', $order->id)->with('success', '¡Tu pedido ha sido procesado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack(); // Si algo falló, deshacemos todos los cambios para no corromper datos
            return redirect()->back()->with('error', 'Ocurrió un error al procesar tu pedido: ' . $e->getMessage());
        }
    }
    
        /**
     * Muestra la pantalla de éxito tras finalizar un pedido.
     */
    public function success(Order $order)
    {
        // Opcional: Validar que la orden pertenezca al usuario logueado para que nadie adivine IDs en la URL
        if ($order->user_id !== Auth::user()->id) {
            abort(403, 'No tienes permiso para ver este pedido.');
        }

        return view('pages.order-success', compact('order'));
    }
}
