<div class="offcanvas offcanvas-end border-0 shadow cart-custom" tabindex="-1" id="offcanvasCart"
    aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header header-cart-custom">
        <h5 class="offcanvas-title fw-bold" id="offcanvasCartLabel">
            <i class="bi bi-cart3 me-2"></i>TU CARRITO
        </h5>
        <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">

        @php
            // Inicializamos el subtotal para calcularlo dinámicamente en la vista
            $subtotal = 0;
        @endphp
        {{-- Validamos si el usuario tiene un carrito y si este contiene artículos --}}
        @if ($cart && $cart->items->count() > 0)

            {{-- Bucle para iterar los productos reales del carrito --}}
            @foreach ($cart->items as $item)
                @php
                    // Sumamos el precio del producto multiplicado por la cantidad elegida
                    $precioUnitarioReal = $item->product->final_price;
                    $itemTotal = $precioUnitarioReal * $item->quantity;
                    $subtotal += $itemTotal;
                @endphp

                {{-- Item del Carrito Dinámico --}}
                <div class="card mb-3 border-0 shadow-sm overflow-hidden item-cart-card">
                    <div class="row g-0 align-items-center">
                        <div class="col-4 cart-img-container d-flex align-items-center justify-content-center p-2">
                            {{-- Mostramos la imagen real del producto si tiene una columna 'image', sino dejamos la que tenías por defecto --}}
                            <img src="{{ $item->product->image_1 ? asset('storage/' . $item->product->image_1) : asset('images/piano-casio.webp') }}"
                                class="img-fluid" alt="{{ $item->product->title }}">
                        </div>
                        <div class="col-8">
                            <div class="card-body py-2">
                                <h6 class="card-title mb-0 fw-bold text-uppercase color-adaptativo"
                                    style="font-size: 0.85rem;">
                                    {{ $item->product->title }}
                                </h6>

                                {{-- DETALLE DE PRECIOS SI TIENE DESCUENTO --}}
                                <div class="small my-1">
                                    @if($item->product->on_sale && $item->product->discount > 0)
                                        <span class="text-decoration-line-through text-muted-adaptativo me-1" style="font-size: 0.75rem;">
                                            ${{ number_format($item->product->price, 0, ',', '.') }}
                                        </span>
                                        <span class="badge bg-danger-subtle text-danger fw-normal" style="font-size: 0.65rem;">
                                            {{ $item->product->discount }}% OFF
                                        </span>
                                    @endif
                                    <small class="text-muted-adaptativo d-block">Cantidad: {{ $item->quantity }}</small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    {{-- Formateamos el precio real a moneda local ($) --}}
                                    <span
                                        class="fw-bold color-dorado-adaptativo">${{ number_format($itemTotal, 0, ',', '.') }}</span>

                                    {{-- Formulario para eliminar el producto de forma segura vía POST/DELETE --}}
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn p-0 text-danger border-0 bg-transparent texto-rojo">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="my-4 border-top border-ui-adaptativa"></div>

            {{-- Resumen de Compra Dinámico --}}
            <div class="p-3 bg-superficie-adaptativa rounded shadow-sm">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted-adaptativo">Subtotal</span>
                    <span class="fw-bold color-adaptativo">${{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted-adaptativo">Envío</span>
                    <span class="text-success fw-bold">Gratis</span>
                </div>
                <hr class="border-ui-adaptativa">
                <div class="d-flex justify-content-between mb-4">
                    <span class="fs-5 fw-bold color-adaptativo">TOTAL:</span>
                    <span class="fs-5 fw-bold color-adaptativo">${{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ route('checkout') }}"
                        class="btn-brand text-uppercase py-3 text-decoration-none text-center">
                        Iniciar Compra
                    </a>
                    <button class="btn btn-link text-muted-adaptativo text-decoration-none text-uppercase"
                        data-bs-dismiss="offcanvas" style="font-size: 0.8rem;">
                        Continuar comprando
                    </button>
                </div>
            </div>
        @else
            {{-- Estado Vacío por si no hay productos agregados --}}
            <div class="text-center py-5">
                <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                <p class="mt-3 text-muted-adaptativo">No tienes productos en tu carrito de compras.</p>
                <button class="btn btn-outline-secondary btn-sm mt-2" data-bs-dismiss="offcanvas">
                    Ir a la tienda
                </button>
            </div>
        @endif
    </div>
</div>
