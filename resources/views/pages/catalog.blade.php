<x-layout>
    <x-slot name="title">Catálogo</x-slot>
    <div class="container pt-2 pb-4">
        <h2 class="text-center bg-white mb-4"> Catálogo De Productos </h2>
        <div class="row justify-content-center g-4">
            @foreach ($products as $card)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
                    <x-card :card="$card" />
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
