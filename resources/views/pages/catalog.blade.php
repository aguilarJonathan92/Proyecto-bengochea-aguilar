<x-layout>
    <x-slot name="title">Catálogo</x-slot>
    <div class="container pt-2 pb-4">
        <h2 class="text-center bg-white rounded-border m-3 border rounded"> {{ $tituloCategoria }} </h2>
        <div class="row justify-content-center g-2 px-2">
            @forelse ($products as $card)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3 d-flex justify-content-center">
                    <x-card :card="$card" />
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-light border shadow-sm">
                        <p class="h4">No hay productos disponibles</p>
                        <p>Actualmente no tenemos artículos en <strong>{{ $tituloCategoria }}</strong>.</p>
                        <a href="{{ route('catalog') }}" class="btn btn-primary mt-3">
                            Ver todo el catálogo
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
