<x-layout>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('catalog') }}" class="btn btn-outline-secondary btn-sm px-3 border-secondary text-uppercase fw-bold" style="letter-spacing: 1px;">
                <i class="bi bi-arrow-left me-2"></i> Regresar
            </a>
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23F5F5F0'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('catalog') }}" class="text-decoration-none text-white">Catálogo</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Piano Casio</li>
                </ol>
            </nav>
        </div>

        <div class="row g-4">
            <div class="col-md-7">
                <div class="row g-2">
                    <div class="col-2">
                        <div class="d-flex flex-column gap-2">
                            <div class="thumb-container active">
                                <img src="{{ asset('images/piano-casio.webp') }}" class="img-fluid rounded shadow-sm">
                            </div>
                            <div class="thumb-container">
                                <img src="{{ asset('images/microfono-1.webp') }}" class="img-fluid rounded shadow-sm">
                            </div>
                            <div class="thumb-container">
                                <img src="{{ asset('images/microfono-2.webp') }}" class="img-fluid rounded shadow-sm">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-10">
                        <div class="product-main-image-card p-3 shadow-lg">
                            <img src="{{ asset('images/piano-casio.webp') }}" class="img-fluid w-100 rounded" alt="Imagen principal">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="product-info-card p-4 h-100">
                    <h1 class="h2 fw-bold text-white mb-3">Piano Casio Privia PX-S1100</h1>
                    
                    <div class="price-box mb-4">
                        <span class="d-block text-white text-uppercase small fw-bold">Precio Contado</span>
                        <h2 class="display-5 fw-bold" style="color: var(--color-dos);">$250.000</h2>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-white text-uppercase small fw-bold mb-3 border-bottom pb-2">Características destacadas</h6>
                        <ul class="list-unstyled text-white small">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Teclado con acción de martillo inteligente</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Conectividad Bluetooth Audio/MIDI</li>
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i> Diseño ultra delgado y elegante</li>
                        </ul>
                    </div>

                    <div class="d-grid gap-3">
                        <button class="btn btn-lg py-3 fw-bold text-uppercase btn-add-cart">
                            Añadir al Carrito
                        </button>
                        <a href="{{ route('checkout') }}" class="btn btn-outline-light btn-lg py-3 text-uppercase small fw-bold">
                            Finalizar Compra
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="product-details-container p-4 p-md-5 shadow-sm">
                    <ul class="nav nav-tabs border-0 mb-4" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active custom-tab" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button" role="tab">Especificaciones Técnicas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link custom-tab" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">Descripción Completa</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="productTabContent">
                        <div class="tab-pane fade show active" id="specs" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-dark table-hover custom-table">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-white border-secondary">Marca</th>
                                            <td class="border-secondary">Casio</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-white border-secondary">Modelo</th>
                                            <td class="border-secondary">Privia PX-S1100</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-white border-secondary">Cantidad de llaves</th>
                                            <td class="border-secondary">88 teclas con acción de martillo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-white border-secondary">Conectividad</th>
                                            <td class="border-secondary">Bluetooth, USB, MIDI, Salida de auriculares</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-white border-secondary">Peso</th>
                                            <td class="border-secondary">11.2 kg</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="description" role="tabpanel">
                            <div class="text-white lh-lg">
                                <p>Experimente una revolución en el diseño de pianos digitales con el PX-S1100. Su diseño ultra compacto no sacrifica la calidad sonora, ofreciendo el tono y la respuesta de un piano de cola acústico.</p>
                                <p>Ideal tanto para estudiantes avanzados como para profesionales que necesitan portabilidad sin perder la sensación táctil de un instrumento real.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
