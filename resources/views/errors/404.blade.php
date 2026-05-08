<x-layout>
    <x-slot name="title">No Encontrado</x-slot>

    <div style="text-align: center; padding: 50px;">
        <h1>¡Ups! 🎸</h1>
        <p>Parece que lo que buscas no está en nuestro sitio web</p>
        <img src="{{ asset('images/guitarra_error404.png') }}" alt="Error 404"
            style="width: 350px; border: 1px solid gray;">
        <br><br>
        <a href="{{ route('home') }}" class="btn-brand mt-3 d-inline px-4 text-decoration-none">
            Volver al inicio
        </a>
    </div>

</x-layout>
