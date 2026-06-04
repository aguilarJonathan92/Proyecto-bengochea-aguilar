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
    public function index(Request $request){
        // Traemos el carrito del usuario autenticado con sus productos
        $cart = $request->user()->cart()->with('items.product')->first();

        // Si el carrito no existe o no tiene productos, lo mandamos de vuelta al catálogo
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('catalog')->with('swal_error', 'Tu carrito está vacío. Añade productos antes de finalizar la compra.');
        }
        //Quite la ruta completa /App/Models/UserAddress
        $direcciones = UserAddress::where('user_id', $request->user()->id)
        ->with('city.province')
        ->get();

        // Cargamos todas las provincias por si quiere agregar una nueva dirección en el momento
        $provincias = Province::orderBy('name')->get();
        // Retornamos la vista checkout.blade.php pasándole el carrito
        return view('pages.private.checkout', compact('cart', 'direcciones', 'provincias'));
    }

    public function store(CheckoutRequest $request){
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
                'is_default'  => $user->addresses()->count() === 0 // Si es la primera, queda default
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
            return redirect()->route('catalog')->with('swal_error', 'No se pudo procesar la compra porque tu carrito está vacío.');
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
                    return redirect()->back()->with('swal_error', "Lo sentimos, no hay suficiente stock disponible para: {$product->title}. (Stock actual: {$product->stock})");
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
            return redirect()->back()->with('swal_error', 'Ocurrió un error al procesar tu pedido: ' . $e->getMessage());
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

        return view('pages.private.order-success', compact('order'));
    }
}
