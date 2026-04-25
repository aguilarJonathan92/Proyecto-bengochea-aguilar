<x-layout>
    <x-slot name="title">Principal</x-slot>

    {{-- Carrusel --}}
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/carro1.webp') }}" class="d-block w-100" alt="carrusel1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/carro2.webp') }}" class="d-block w-100" alt="carrusel2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/carro3.webp') }}" class="d-block w-100" alt="carrusel3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- Secciones de Productos --}}
    @php
        $secciones = [
            ['titulo' => 'Novedades', 'icon' => 'bi-stars'],
            ['titulo' => 'Ofertas imperdibles', 'icon' => 'bi-tag-fill'],
            ['titulo' => 'Más visitados', 'icon' => 'bi-graph-up'],
        ];
    @endphp

    @foreach ($secciones as $seccion)
        <div class="container my-5">
            <h3 class="mb-4 text-center text-white">
                <i class="bi {{ $seccion['icon'] }}"></i> {{ $seccion['titulo'] }}
            </h3>
            <div class="row g-4"> {{-- g-4 añade un espaciado uniforme --}}
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm">
                            <img src="..." class="card-img-top" alt="Producto" loading="lazy">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fs-6">Producto {{ $i }}</h5>
                                <p class="card-text small text-muted">Descripción breve...</p>
                                <a href="#" class="btn btn-danger mt-auto">Ver más</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    @endforeach

</x-layout>
