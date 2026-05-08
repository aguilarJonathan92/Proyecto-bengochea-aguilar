<x-layout>
    <x-slot name='title'>{{ $product['title']}}</x-slot>
    <div class="container py-5">
        {{-- Navegación superior adaptativa --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('catalog') }}" class="btn-regresar text-uppercase fw-bold">
                <i class="bi bi-arrow-left me-2"></i> Regresar
            </a>
            <nav class="breadcrumb-custom" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('catalog') }}"
                            class="text-decoration-none color-adaptativo">Catálogo</a></li>
                    <li class="breadcrumb-item color-dorado-adaptativo" aria-current="page">{{ $product['title'] }}</li>
                </ol>
            </nav>
        </div>

        <div class="row g-4">
            {{-- Galería de imágenes --}}
            <div class="col-md-7">
                <div class="row g-2">
                    <div class="col-2">
                        <div class="d-flex flex-column gap-2">
                            <div class="thumb-container active">
                                <img src="{{ asset('images/piano-casio.webp') }}" class="img-fluid">
                            </div>
                            <div class="thumb-container">
                                <img src="{{ asset('images/microfono-1.webp') }}" class="img-fluid">
                            </div>
                            <div class="thumb-container">
                                <img src="{{ asset('images/microfono-2.webp') }}" class="img-fluid">
                            </div>
                        </div>
                    </div>

                    <div class="col-10">
                        <div class="product-main-image-card p-3 shadow-lg">
                            <img src="{{ asset($product['image']) }}" class="img-fluid w-100 rounded"
                                alt="Imagen principal">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Información de compra --}}
            <div class="col-md-5">
                <div class="product-info-card p-4 h-100">
                    <h1 class="h2 fw-bold color-adaptativo mb-3">{{ $product['title'] }}</h1>

                    <div class="price-box mb-4">

                        <span class="d-block text-muted-adaptativo text-uppercase small fw-bold">Precio Contado</span>
                        <h2 class="display-5 fw-bold color-dorado-adaptativo">
                            @if ($product['on_sale'])
                                <div class="d-flex align-items-baseline gap-2">
                                    <p class="precio-descuento fs-1 mb-0">
                                        ${{ number_format($product['final_price'], 2, ',', '.') }}
                                        <span class="descuento-tag">{{ $product['discount'] }}% OFF</span>
                                </div>
                                <p class="precio-original mb-0">
                                    ${{ number_format($product['price'], 2, ',', '.') }}
                                </p>
                            @else
                                <div class="d-flex align-items-baseline">
                                    <p class="display-5 fw-bold color-dorado-adaptativo mb-0">
                                        ${{ number_format($product['price'], 2, ',', '.') }}
                                    </p>
                                </div>
                            @endif
                    </div>

                    <div class="mb-4">
                        <h6
                            class="color-adaptativo text-uppercase small fw-bold mb-3 border-bottom border-ui-adaptativa pb-2">
                            Características destacadas</h6>
                        <ul class="list-unstyled color-adaptativo small">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i>
                                {{ $product['subtitle'] }}</li>
                            {{-- Se quitaron 2 hileras iguales, por falta de atributos en el array --}}

                        </ul>
                    </div>

                    <div class="d-grid gap-3">
                        <button class="btn-add-cart text-uppercase py-3">
                            Añadir al Carrito
                        </button>
                        <a href="{{ route('checkout') }}" class="btn-outline-adaptativo text-uppercase py-3">
                            Finalizar Compra
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pestañas de detalles --}}
        <div class="row mt-5">
            <div class="col-12">
                <div class="product-details-container p-4 p-md-5 shadow-sm">
                    <ul class="nav border-0 mb-4" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active custom-tab" id="specs-tab" data-bs-toggle="tab"
                                data-bs-target="#specs" type="button" role="tab">Especificaciones Técnicas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link custom-tab" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab">Descripción
                                Completa</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="productTabContent">
                        <div class="tab-pane fade show active" id="specs" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table custom-table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Marca</th>
                                            <td>{{ $product['brand'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Modelo</th>
                                            <td>{{ $product['subtitle'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Cantidad de llaves</th>
                                            <td>No aplica</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Conectividad</th>
                                            <td>Sin información disponible</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Peso</th>
                                            <td>Sin información disponible</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="description" role="tabpanel">
                            <div class="color-adaptativo lh-lg">
                                <p>Experimente una revolución en el diseño con {{ $product['subtitle'] }}. Excelente
                                    diseño.</p>
                                <p>Ideal tanto para estudiantes avanzados como para profesionales que necesitan
                                    portabilidad sin perder la sensación táctil de un instrumento real.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
