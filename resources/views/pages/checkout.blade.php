<x-layout>
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

                    <form class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label color-adaptativo">Nombre</label>
                                <input type="text" class="form-control checkout-input" placeholder="Ej: Jonathan"
                                    required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label color-adaptativo">Apellido</label>
                                <input type="text" class="form-control checkout-input" placeholder="Ej: Aguilar"
                                    required>
                            </div>
                            <div class="col-12">
                                <label class="form-label color-adaptativo">Email</label>
                                <input type="email" class="form-control checkout-input"
                                    placeholder="nombre@ejemplo.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label color-adaptativo">Dirección de Envío</label>
                                <input type="text" class="form-control checkout-input"
                                    placeholder="Calle Falsa 123, Corrientes" required>
                            </div>
                        </div>

                        <hr class="checkout-separator">

                        <h4 class="checkout-title color-adaptativo mb-3">Método de Pago</h4>
                        <div class="payment-options d-flex flex-column gap-2">
                            <div class="form-check checkout-payment-option p-3 rounded border">
                                <input id="credit" name="paymentMethod" type="radio"
                                    class="form-check-input ms-0 me-2" checked required>
                                <label class="form-check-label color-adaptativo fw-bold" for="credit">Tarjeta de
                                    Crédito / Débito</label>
                            </div>
                            <div class="form-check checkout-payment-option p-3 rounded border">
                                <input id="transfer" name="paymentMethod" type="radio"
                                    class="form-check-input ms-0 me-2" required>
                                <label class="form-check-label color-adaptativo fw-bold" for="transfer">Transferencia
                                    Bancaria (10% OFF)</label>
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
                            <span class="badge rounded-pill bg-adaptativo-badge px-3 py-2">1</span>
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <div class="product-item d-flex align-items-center mb-3">
                            <div class="product-info flex-grow-1">
                                <h6 class="product-name color-adaptativo mb-0 fw-bold">Piano Casio Privia</h6>
                                <small class="text-muted-adaptativo">Instrumento de teclado</small>
                            </div>
                            <span class="product-price color-adaptativo fw-bold">$250.000</span>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted-adaptativo">Envío</span>
                            <span class="text-success fw-bold">Gratis</span>
                        </div>

                        <div class="summary-total-section pt-3 mt-3 border-top border-ui-adaptativa">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5 color-adaptativo">TOTAL</span>
                                <strong class="total-amount fs-4">$250.000</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
