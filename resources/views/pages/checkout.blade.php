<x-layout>
    <div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('catalog') }}" class="checkout-back-link">
            <i class="bi bi-arrow-left me-2"></i> VOLVER AL CATÁLOGO
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-7 col-lg-8">
            <div class="checkout-section-card">
                <h4 class="checkout-title">Datos de Entrega</h4>
                
                <form class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control checkout-input" placeholder="Ej: Jonathan" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Apellido</label>
                            <input type="text" class="form-control checkout-input" placeholder="Ej: Aguilar" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control checkout-input" placeholder="nombre@ejemplo.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dirección de Envío</label>
                            <input type="text" class="form-control checkout-input" placeholder="Calle Falsa 123, Corrientes" required>
                        </div>
                    </div>

                    <hr class="checkout-separator">

                    <h4 class="checkout-title">Método de Pago</h4>
                    <div class="payment-options">
                        <div class="form-check checkout-payment-option">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                            <label class="form-check-label" for="credit">Tarjeta de Crédito / Débito</label>
                        </div>
                        <div class="form-check checkout-payment-option">
                            <input id="transfer" name="paymentMethod" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="transfer">Transferencia Bancaria (10% OFF)</label>
                        </div>
                    </div>

                    <div class="d-grid gap-3 mt-4">
                        <button class="btn-confirm-order" type="submit">
                            Confirmar Pedido
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5 col-lg-4">
            <div class="card checkout-summary-card">
                <div class="summary-header">
                    <h5 class="d-flex justify-content-between align-items-center mb-0 fw-bold">
                        RESUMEN <span class="badge rounded-pill bg-white text-dark">1</span>
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <div class="product-item d-flex align-items-center mb-3">
                        <div class="product-info flex-grow-1">
                            <h6 class="product-name">Piano Casio Privia</h6>
                            <small class="text-white">Instrumento de teclado</small>
                        </div>
                        <span class="product-price">$250.000</span>
                    </div>

                    <div class="d-flex justify-content-between text-muted mb-2">
                        <span class="text-white">Envío</span>
                        <span class="text-success fw-bold">Gratis</span>
                    </div>

                    <div class="summary-total-section pt-3 mt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-5 text-white">TOTAL</span>
                            <strong class="total-amount">$250.000</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>