<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Traemos los pedidos del usuario autenticado con sus ítems y productos
        $orders = $request->user()->orders()
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.private.my-orders', compact('orders'));
    }

    public function descargarComprobante(Order $order)
{
    // 1. SEGURIDAD: Verificar que la orden pertenezca al usuario autenticado
    if ($order->user_id !== Auth::id()) {
        abort(403, 'No tienes permiso para acceder a este comprobante.');
    }

    // 2. REGLA DE NEGOCIO: Solo permitir estados Procesado (processing) o Completado/Entregado (delivered/shipped)
    // Adaptalo según los strings exactos de tus estados
    $estadosPermitidos = ['processing', 'shipped', 'delivered'];
    if (!in_array($order->status, $estadosPermitidos)) {
        return redirect()->back()->with('cart_error', 'El comprobante aún no está disponible para este pedido.');
    }

    // Cargar las relaciones necesarias para evitar consultas lentas (Lazy Loading)
    $order->load('items.product');

    // 3. Renderizar la vista especial de la factura pasándole la data
    $pdf = Pdf::loadView('pages.private.comprobante', compact('order'));

    // Opcional: configurar tamaño de hoja (A4)
    $pdf->setPaper('a4', 'portrait');

    // 4. Forzar la descarga del archivo con un nombre descriptivo
    return $pdf->download("comprobante-pedido-{$order->id}.pdf");
}
}
