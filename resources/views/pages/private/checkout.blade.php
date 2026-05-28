<x-layouts.layout>
    <x-slot name='title'>Finalizar Compra</x-slot>
    <div class="container py-5">
        <div class="mb-4 animate__animated animate__fadeIn">
            <a href="{{ route('catalog') }}" class="checkout-back-link">
                <i class="bi bi-arrow-left-circle-fill me-2 fs-5"></i>
                <span>Volver al Catálogo</span>
            </a>
        </div>

        <div class="row g-4">
            <div class="col-md-7 col-lg-8 order-2 order-md-1">
                <div class="checkout-section-card shadow-sm p-4">
                    <h4 class="checkout-title color-adaptativo mb-4">Datos de Entrega</h4>

                    <form action="{{ route('checkout.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label color-adaptativo">Nombre</label>
                                <input type="text" name="customer_name" class="form-control checkout-input" placeholder="Ej: Jonathan"
                                    value="{{ auth()->user()->first_name ?? '' }}" required >
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label color-adaptativo">Apellido</label>
                                <input type="text"  name="customer_lastname" class="form-control checkout-input" placeholder="Ej: Aguilar"
                                    value="{{ auth()->user()->last_name ?? '' }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label color-adaptativo">Email</label>
                                <input type="email" name="customer_email" class="form-control checkout-input"
                                    placeholder="nombre@ejemplo.com" value="{{ auth()->user()->email ?? '' }}" required>
                            </div>
                            {{-- SELECCIÓN DE DIRECCIÓN --}}
                            <div class="col-12">
                                <label class="form-label color-adaptativo">Mis Direcciones Guardadas</label>
                                <select name="user_address_id" id="select-direccion-checkout" class="form-select checkout-input" onchange="evaluarDireccionNueva(this)" required>
                                    @foreach($direcciones as $dir)
                                        <option value="{{ $dir->id }}" 
                                                data-street="{{ $dir->street }}" 
                                                data-postal="{{ $dir->postal_code }}" 
                                                data-city="{{ $dir->city_id }}"
                                                {{ $dir->is_default ? 'selected' : '' }}>
                                            {{ $dir->alias }} ({{ $dir->street }}, {{ $dir->city->name }}) {{ $dir->is_default ? '— [Predeterminada]' : '' }}
                                        </option>
                                    @endforeach
                                    <option value="nueva_direccion" {{ $direcciones->isEmpty() ? 'selected' : '' }}>➕ Usar una nueva dirección de envío...</option>
                                </select>
                            </div>
                            {{-- BLOQUE OCULTO PARA NUEVA DIRECCIÓN --}}
                            {{-- Se mostrará automáticamente si el usuario no tiene ninguna guardada o si elige "Nueva dirección" --}}
                            <div id="bloque-nueva-direccion" class="{{ $direcciones->isNotEmpty() ? 'hidden' : '' }} mt-3">
                                <div class="p-3 bg-superficie-adaptativa rounded border border-ui-adaptativa row g-3">
                                    <h6 class="color-dorado-adaptativo fw-bold mb-0">Registrar nueva dirección de entrega</h6>
                                    
                                    <div class="col-12">
                                        <label class="form-label color-adaptativo small">Calle, Número, Piso/Depto</label>
                                        <input type="text" name="delivery_street" id="input-nueva-calle" class="form-control checkout-input form-control-sm"
                                            placeholder="Ej: Av. Tres de Abril 1234, Piso 2 B" {{ $direcciones->isNotEmpty() ? 'disabled' : 'required' }}>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <label class="form-label color-adaptativo small">Código Postal</label>
                                        <input type="text" name="delivery_postal_code" id="input-nuevo-cp" class="form-control checkout-input form-control-sm"
                                            placeholder="Ej: 3400" {{ $direcciones->isNotEmpty() ? 'disabled' : 'required' }}>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label color-adaptativo small">Alias de la dirección</label>
                                        <input type="text" name="delivery_alias" id="input-nuevo-alias" class="form-control checkout-input form-control-sm"
                                            placeholder="Ej: Casa Nueva, Depto Facu" value="Mi Entrega" {{ $direcciones->isNotEmpty() ? 'disabled' : 'required' }}>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label color-adaptativo small">Provincia</label>
                                        <select id="select-provincia-checkout" class="form-select form-select-sm" onchange="cargarCiudadesCheckout(this)" {{ $direcciones->isNotEmpty() ? 'disabled' : 'required' }}>
                                            <option value="" disabled selected>Selecciona Provincia...</option>
                                            @foreach($provincias as $provincia)
                                                <option value="{{ $provincia->id }}">{{ $provincia->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label color-adaptativo small">Ciudad</label>
                                        <input type="hidden" name="delivery_city_id" id="hidden-city-id">
                                        <select id="select-ciudad-checkout" class="form-select form-select-sm" onchange="document.getElementById('hidden-city-id').value = this.value" {{ $direcciones->isNotEmpty() ? 'disabled' : 'required' }} disabled>
                                            <option value="" disabled selected>Selecciona Ciudad...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="checkout-separator">

                        <h4 class="checkout-title color-adaptativo mb-3">Método de Pago</h4>
                        <div class="payment-options d-flex flex-column gap-2">
                            <div class="form-check checkout-payment-option p-3 rounded border">
                                <input id="credit" name="paymentMethod" type="radio"
                                    class="form-check-input ms-0 me-2" value="credit" required>
                                <label class="form-check-label color-adaptativo fw-bold" for="credit">Tarjeta de
                                    Crédito / Débito</label>
                            </div>
                            <div class="form-check checkout-payment-option p-3 rounded border">
                                <input id="transfer_bank" name="paymentMethod" type="radio"
                                    class="form-check-input ms-0 me-2" value="transfer_bank" required>
                                <label class="form-check-label color-adaptativo fw-bold" for="transfer">Transferencia
                                    Bancaria</label>
                            </div>
                            <div class="form-check checkout-payment-option p-3 rounded border">
                                <input id="transfer_mp" name="paymentMethod" type="radio"
                                    class="form-check-input ms-0 me-2" value="transfer_mp" required>
                                <label class="form-check-label color-adaptativo fw-bold" for="transfer">Mercado Pago</label>
                            </div>
                        </div>

                        <div class="d-grid gap-3 mt-4">
                            <button class="btn-confirm-order py-3 fw-bold text-uppercase" type="submit">
                                Confirmar Pedido
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Resumen lateral mejorado --}}
            <div class="col-md-5 col-lg-4 order-1 order-md-2">
                <div class="card checkout-summary-card shadow-sm border-0">
                    {{-- El padding aquí evita que "RESUMEN" se pegue a los bordes --}}
                    <div class="summary-header p-4">
                        <h5 class="d-flex justify-content-between align-items-center mb-0 fw-bold color-adaptativo">
                            <span>RESUMEN</span>
                            <span class="badge rounded-pill bg-adaptativo-badge px-3 py-2">{{ $cart->items->sum('quantity') }}</span>
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        @php
                        $subtotal = 0;
                    @endphp

                    {{-- Listado de productos reales --}}
                    <div class="productos-checkout-lista mb-3" style="max-height: 280px; overflow-y: auto;">
                        @foreach ($cart->items as $item)
                            @php
                                // Usamos final_price que contempla ofertas activas automáticamente
                                $precioUnitario = $item->product->final_price;
                                $itemTotal = $precioUnitario * $item->quantity;
                                $subtotal += $itemTotal;
                            @endphp

                            <div class="product-item d-flex align-items-center justify-content-between mb-3">
                                <div class="product-info grow me-2">
                                    <h6 class="product-name color-adaptativo mb-0 fw-bold text-uppercase small text-truncate" style="max-width: 160px;">
                                        {{ $item->product->title }}
                                    </h6>
                                    <small class="text-muted-adaptativo">
                                        Cant: {{ $item->quantity }} x ${{ number_format($precioUnitario, 0, ',', '.') }}
                                    </small>
                                </div>
                                <span class="product-price color-adaptativo fw-bold small flex-shrink-0">
                                    ${{ number_format($itemTotal, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted-adaptativo">Envío</span>
                            <span class="text-success fw-bold">Gratis</span>
                        </div>

                        <div class="summary-total-section pt-3 mt-3 border-top border-ui-adaptativa">
                            <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold fs-5 color-adaptativo">TOTAL</span>
                                    <strong class="total-amount fs-4 color-dorado-adaptativo">
                                        ${{ number_format($subtotal, 0, ',', '.') }}
                                    </strong>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/checkout-direcciones.js') }}"></script>
</x-layouts.layout>
