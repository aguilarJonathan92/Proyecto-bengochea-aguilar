<x-layout>
    <x-slot name="title">Principal</x-slot>

    {{-- Carrusel --}}
    <div id="carouselExampleIndicators" class="carousel slide mb-3" data-bs-ride="carousel">
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
            ['titulo' => 'Novedades', 'icon' => 'bi-stars', 'datos' => $novedades],
            ['titulo' => 'Ofertas imperdibles', 'icon' => 'bi-tag-fill', 'datos' => $ofertas_home],
            ['titulo' => 'Más visitados', 'icon' => 'bi-graph-up', 'datos' => $mas_visitados],
        ];
    @endphp

    @foreach ($secciones as $seccion)
        <div class="container pt-2 pb-5">
            <h3 class="mb-4 text-center text-white border-bottom border-secondary pb-3">
                <i class="bi {{ $seccion['icon'] }} texto-rojo me-2"></i> {{ $seccion['titulo'] }}
            </h3>
            <div class="row justify-content-center g-4 px-2">
                @foreach ($seccion['datos'] as $card)
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center">
                        <x-card :card="$card" />
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

</x-layout>
