<x-layout>
    <x-slot name="title">Catálogo - {{ $tituloCategoria }}</x-slot>
    <div class="container pt-2 pb-4">

        {{-- Título de Categoría Adaptativo --}}
        <h2 class="text-center catalog-title m-3 p-3">
            {{ $tituloCategoria }}
        </h2>

        <div class="row justify-content-center g-4 px-2">
            @forelse ($products as $card)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center">
                    <x-card :card="$card" />
                </div>
            @empty
                {{-- Estado vacío adaptativo --}}
                <div class="col-12 text-center py-5">
                    <div class="empty-catalog-alert shadow-sm p-5">
                        <i class="bi bi-search mb-3 d-block fs-1 color-dorado-adaptativo"></i>
                        <p class="h4 color-adaptativo">No hay productos disponibles</p>
                        <p class="text-muted-adaptativo">
                            Actualmente no tenemos artículos en <strong>{{ $tituloCategoria }}</strong>.
                        </p>
                        <a href="{{ route('catalog') }}" class="special-btn mt-3 px-4 text-decoration-none">
                            Ver todo el catálogo
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
