<div class="offcanvas offcanvas-end border-0 shadow" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel" style="background-color: #f8f9fa;">
    <div class="offcanvas-header bg-dark text-white">
        <h5 class="offcanvas-title fw-bold" id="offcanvasCartLabel">
            <i class="bi bi-cart3 me-2"></i>TU CARRITO
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body">
        <div class="card mb-3 border-0 shadow-sm overflow-hidden" style="border-radius: 10px;">
            <div class="row g-0 align-items-center">
                <div class="col-4 bg-white d-flex align-items-center justify-content-center p-2">
                    <img src="{{ asset('images/piano-casio.webp') }}" class="img-fluid" alt="Producto" style="max-height: 80px; object-fit: contain;">
                </div>
                <div class="col-8">
                    <div class="card-body py-2">
                        <h6 class="card-title mb-0 fw-bold text-dark text-uppercase" style="font-size: 0.85rem;">Piano Casio Privia</h6>
                        <small class="text-muted d-block mb-2">Cantidad: 1</small>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-primary">$250.000</span>
                            <a href="#" class="text-danger"><i class="bi bi-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-4 border-top"></div>

        <div class="p-3 bg-white rounded shadow-sm">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Subtotal</span>
                <span class="fw-bold">$250.000</span>
            </div>
            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Envío</span>
                <span class="text-success fw-bold">Gratis</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-4">
                <span class="fs-5 fw-bold">TOTAL:</span>
                <span class="fs-5 fw-bold text-dark">$250.000</span>
            </div>

            <div class="d-grid gap-2">
               <a href="{{ route('checkout') }}" class="btn btn-lg fw-bold text-uppercase py-3" 
                style="background-color: #f39c12; color: white; border: none; font-size: 0.9rem; letter-spacing: 1px;">
                    Iniciar Compra
                </a>
                <button class="btn btn-outline-secondary border-0 text-uppercase" data-bs-dismiss="offcanvas" style="font-size: 0.8rem;">
                    Continuar comprando
                </button>
            </div>
        </div>
    </div>
</div>