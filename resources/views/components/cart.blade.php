<div class="offcanvas offcanvas-end border-0 shadow cart-custom" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header header-cart-custom">
        <h5 class="offcanvas-title fw-bold" id="offcanvasCartLabel">
            <i class="bi bi-cart3 me-2"></i>TU CARRITO
        </h5>
        <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        {{-- Item del Carrito --}}
        <div class="card mb-3 border-0 shadow-sm overflow-hidden item-cart-card">
            <div class="row g-0 align-items-center">
                <div class="col-4 cart-img-container d-flex align-items-center justify-content-center p-2">
                    <img src="{{ asset('images/piano-casio.webp') }}" class="img-fluid" alt="Producto">
                </div>
                <div class="col-8">
                    <div class="card-body py-2">
                        <h6 class="card-title mb-0 fw-bold text-uppercase color-adaptativo" style="font-size: 0.85rem;">Piano Casio Privia</h6>
                        <small class="text-muted-adaptativo d-block mb-2">Cantidad: 1</small>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold color-dorado-adaptativo">$250.000</span>
                            <a href="#" class="texto-rojo"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-4 border-top border-ui-adaptativa"></div>

        {{-- Resumen de Compra --}}
        <div class="p-3 bg-superficie-adaptativa rounded shadow-sm">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted-adaptativo">Subtotal</span>
                <span class="fw-bold color-adaptativo">$250.000</span>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted-adaptativo">Envío</span>
                <span class="text-success fw-bold">Gratis</span>
            </div>
            <hr class="border-ui-adaptativa">
            <div class="d-flex justify-content-between mb-4">
                <span class="fs-5 fw-bold color-adaptativo">TOTAL:</span>
                <span class="fs-5 fw-bold color-adaptativo">$250.000</span>
            </div>

            <div class="d-grid gap-2">
               <a href="{{ route('checkout') }}" class="btn-brand text-uppercase py-3 text-decoration-none">
                    Iniciar Compra
                </a>
                <button class="btn btn-link text-muted-adaptativo text-decoration-none text-uppercase" data-bs-dismiss="offcanvas" style="font-size: 0.8rem;">
                    Continuar comprando
                </button>
            </div>
        </div>
    </div>
</div>
