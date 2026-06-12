<x-layouts.layout>
    @if (session('cart_error'))
        <div class="alert alert-danger mt-3">
            {{ session('cart_error') }}
        </div>
    @endif
    <x-slot name='title'>{{ $product->title }}</x-slot>
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
                    <li class="breadcrumb-item color-dorado-adaptativo" aria-current="page">{{ $product->title }}</li>
                </ol>
            </nav>
        </div>

        <div class="row g-4">
            {{-- Galería de imágenes --}}
            <div class="col-md-7">
                <div class="row g-2">
                    <div class="col-2">
                        <div class="d-flex flex-column gap-2">
                            @if ($product->image_1)
                                <div class="thumb-container active">
                                    <img onclick="changeMainImage(this)"
                                        src="{{ asset('storage/' . $product->image_1) }}" class="img-fluid">
                                </div>
                            @endif
                            @if ($product->image_2)
                                <div class="thumb-container">
                                    <img onclick="changeMainImage(this)"
                                        src="{{ asset('storage/' . $product->image_2) }}" class="img-fluid">
                                </div>
                            @endif
                            @if ($product->image_3)
                                <div class="thumb-container">
                                    <img onclick="changeMainImage(this)"
                                        src="{{ asset('storage/' . $product->image_3) }}" class="img-fluid">
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-10">
                        <div class="product-main-image-card p-3 shadow-lg">
                            <img id="mainImage" src="{{ asset('storage/' . $product->image_1) }}"
                                class="img-fluid w-100 rounded" alt="Imagen principal">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Información de compra --}}
            <div class="col-md-5">
                <div class="product-info-card p-4 h-100">
                    <h1 class="h2 fw-bold color-adaptativo mb-3">{{ $product->title }}</h1>

                    <div class="price-box mb-4">
                        <span class="d-block text-muted-adaptativo text-uppercase small fw-bold">Precio Contado</span>
                        <h2 class="display-5 fw-bold color-dorado-adaptativo">
                            @if ($product->on_sale)
                                <div class="d-flex align-items-baseline gap-2">
                                    <p class="precio-descuento fs-1 mb-0">
                                        ${{ number_format($product->final_price, 2, ',', '.') }}
                                        <span class="descuento-tag">{{ $product->discount }}% OFF</span>
                                    </p>
                                </div>
                                <p class="precio-original mb-0">
                                    ${{ number_format($product->price, 2, ',', '.') }}
                                </p>
                            @else
                                <div class="d-flex align-items-baseline">
                                    <p class="display-5 fw-bold color-dorado-adaptativo mb-0">
                                        ${{ number_format($product->price, 2, ',', '.') }}
                                    </p>
                                </div>
                            @endif
                        </h2>
                    </div>

                    <div class="mb-4">
                        <h6
                            class="color-adaptativo text-uppercase small fw-bold mb-3 border-bottom border-ui-adaptativa pb-2">
                            Características destacadas</h6>
                        <ul class="list-unstyled color-adaptativo small">
                            <li class="mb-2"><i class="bi bi-check2 text-success me-2"></i>
                                {{ $product->subtitle }}</li>
                        </ul>
                    </div>

                    {{-- Indicador de Stock --}}
                    <div class="mb-3">
                        @if ($product->stock > 5)
                            <span class="text-success small fw-bold">
                                <i class="bi bi-box-seam me-1"></i> Disponible ({{ $product->stock }} unidades)
                            </span>
                        @elseif($product->stock > 1)
                            <span class="text-warning small fw-bold">
                                <i class="bi bi-exclamation-triangle me-1"></i> ¡Últimas {{ $product->stock }} unidades
                                disponibles!
                            </span>
                        @elseif($product->stock == 1)
                            <span class="text-warning small fw-bold">
                                <i class="bi bi-x-circle me-1"></i> ¡Última unidad disponible!
                            </span>
                        @else
                            <span class="text-danger small fw-bold">
                                <i class="bi bi-x-circle me-1"></i> Producto Agotado
                            </span>
                        @endif
                    </div>

                    <div class="d-grid gap-3">
                        {{-- Formulario tradicional para añadir al carrito --}}
                        <form action="{{ route('cart.add') }}" method="POST" class="form-agregar-carrito">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            {{-- Selector de cantidad dinámico --}}
                            @if ($product->stock > 0)
                                <div class="mb-3">
                                    <label for="quantity"
                                        class="form-label color-adaptativo small fw-bold text-uppercase">Cantidad</label>
                                    <div class="input-group" style="max-width: 140px;">
                                        <button class="btn btn-outline-secondary border-ui-adaptativa" type="button"
                                            onclick="decrementQty()">-</button>
                                        <input type="number" id="quantity" name="quantity"
                                            class="form-control text-center bg-transparent color-adaptativo border-ui-adaptativa"
                                            value="1" min="1" max="{{ $product->stock }}"
                                            oninput="validateKeyboardInput(this)">
                                        <button class="btn btn-outline-secondary border-ui-adaptativa" type="button"
                                            onclick="incrementQty()">+</button>
                                    </div>

                                    {{-- Mensajes de alerta --}}
                                    <div id="stock-alert" class="text-warning small mt-2 fw-bold d-none">
                                        <i class="bi bi-exclamation-circle me-1"></i> Has alcanzado el límite de stock
                                        disponible.
                                    </div>
                                    <div id="type-alert" class="text-danger small mt-2 fw-bold d-none">
                                        <i class="bi bi-x-circle me-1"></i> Por favor, ingrese solo valores numéricos
                                        enteros.
                                    </div>
                                </div>

                                <div class="d-grid gap-3">
                                    {{-- BOTÓN 1: Añade al carrito y se queda acá --}}
                                    <button type="submit" name="action" value="add_to_cart" class="btn-add-cart btn-agregar text-uppercase py-3 w-100">
                                        Añadir al Carrito
                                    </button>

                                    {{-- BOTÓN 2: Añade al carrito y lleva a la compra--}}
                                    <button type="submit" name="action" value="buy_now" class="btn-agregar text-uppercase py-3 text-center btn-outline-adaptativo text-decoration-none  w-100">
                                        Añadir y finalizar compra
                                    </button>
                                </div>
                            @else
                                <button type="button" class="btn btn-secondary text-uppercase py-3 w-100" disabled>
                                    Producto Agotado
                                </button>
                            @endif
                        </form>
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
                                data-bs-target="#specs" type="button" role="tab">Especificaciones
                                Técnicas</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link custom-tab" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab">Descripción
                                Completa</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="productTabContent">
                        {{-- 🛠️ Pestaña 1: Especificaciones Técnicas --}}
                        <div class="tab-pane fade show active" id="specs" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table custom-table">
                                    <tbody>
                                        {{-- Inyección manual de las columnas estructurales antes del array --}}
                                        <tr>
                                            <th scope="row">Marca</th>
                                            <td>{{ $product->brand->name ?? 'No especificada' }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Modelo</th>
                                            <td>{{ $product->subtitle }}</td>
                                        </tr>

                                        {{-- Despliegue de las especificaciones dinámicas --}}
                                        @foreach ($product->specs as $title => $value)
                                            <tr>
                                                <th scope="row">{{ $title }}</th>
                                                <td>{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- 🛠️ Pestaña 2: Descripción Completa --}}
                        <div class="tab-pane fade" id="description" role="tabpanel">
                            <div class="color-adaptativo lh-lg">
                                {{-- Renderiza el texto real de la columna 'description' de la base de datos --}}
                                <p>{{ $product->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bloque de scripts intacto --}}
    <script>
        function changeMainImage(thumbnail) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = thumbnail.src;
            document.querySelectorAll('.thumb-container').forEach(container => {
                container.classList.remove('active');
            });
            thumbnail.parentElement.classList.add('active');
        }

        function incrementQty() {
            const input = document.getElementById('quantity');
            const stockAlert = document.getElementById('stock-alert');
            const typeAlert = document.getElementById('type-alert');
            const max = parseInt(input.getAttribute('max'));
            if (input.value === '') input.value = 0;
            typeAlert.classList.add('d-none');
            let value = parseInt(input.value);
            if (value < max) {
                input.value = value + 1;
                stockAlert.classList.add('d-none');
            } else {
                stockAlert.setTimeout;
                stockAlert.classList.remove('d-none');
            }
        }

        function decrementQty() {
            const input = document.getElementById('quantity');
            const stockAlert = document.getElementById('stock-alert');
            const typeAlert = document.getElementById('type-alert');
            if (input.value === '') input.value = 2;
            typeAlert.classList.add('d-none');
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
                stockAlert.classList.add('d-none');
            }
        }

        function validateKeyboardInput(input) {
            const stockAlert = document.getElementById('stock-alert');
            const typeAlert = document.getElementById('type-alert');
            const max = parseInt(input.getAttribute('max'));
            if (input.value === '') {
                typeAlert.classList.remove('d-none');
                stockAlert.classList.add('d-none');
                return;
            }
            typeAlert.classList.add('d-none');
            let value = parseInt(input.value);
            if (value < 1) {
                input.value = 1;
                stockAlert.classList.add('d-none');
            } else if (value > max) {
                input.value = max;
                stockAlert.classList.remove('d-none');
            } else {
                stockAlert.classList.add('d-none');
            }
        }
    </script>
</x-layouts.layout>
