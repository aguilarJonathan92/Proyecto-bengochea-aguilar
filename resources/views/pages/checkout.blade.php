<x-layout>
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3 fw-bold text-uppercase" style="color: #212529;">Datos de Entrega</h4>
                <form class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ej: Jonathan" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Apellido</label>
                            <input type="text" class="form-control" placeholder="Ej: Aguilar" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="nombre@ejemplo.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Dirección de Envío</label>
                            <input type="text" class="form-control" placeholder="Calle Falsa 123, Corrientes" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3 fw-bold text-uppercase">Método de Pago</h4>
                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                            <label class="form-check-label" for="credit">Tarjeta de Crédito / Débito</label>
                        </div>
                        <div class="form-check">
                            <input id="transfer" name="paymentMethod" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="transfer">Transferencia Bancaria (10% OFF)</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-dark btn-lg" type="submit">Confirmar Pedido</button>
                        <a href="{{ route('catalog') }}" class="btn btn-link text-decoration-none text-muted small">
                            ¿Deseas agregar algo más? Volver a la tienda
                        </a>
                    </div>
                </form>
            </div>

            <div class="col-md-5 col-lg-4">
                <div class="card border-0 shadow-sm p-3" style="background-color: #f8f9fa; border-top: 4px solid #f39c12 !important;">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold" style="color: #f39c12;">Tu Pedido</span>
                        <span class="badge bg-dark rounded-pill">1</span>
                    </h4>
                    <ul class="list-group mb-3 border-0">
                        <li class="list-group-item d-flex justify-content-between lh-sm border-0 bg-transparent px-0">
                            <div>
                                <h6 class="my-0 fw-bold">Piano Casio Privia</h6>
                                <small class="text-muted">Instrumento de teclado</small>
                            </div>
                            <span class="text-muted">$250.000</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between border-0 bg-transparent px-0">
                            <span class="text-success">Envío</span>
                            <span class="text-success">Gratis</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between border-0 bg-transparent px-0 pt-3 border-top">
                            <span class="fw-bold fs-5">TOTAL</span>
                            <strong class="fs-5">$250.000</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layout>