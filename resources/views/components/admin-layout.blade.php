<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('icons/ico/icono-soundWave.ico') }}">
    <title>{{ $title ?? 'Panel Administrativo' }}</title>

    {{-- Script Anti-Parpadeo (Crucial para que no se vea blanco un segundo al cargar) --}}
    <script>
        (function() {
            const theme = localStorage.getItem('theme');
            if (theme === 'light') {
                document.documentElement.classList.add('light');
            }
        })();
    </script>
    <link rel="stylesheet" href="{{ asset('vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="admin-wrapper d-flex">
        {{-- Switch de Tema --}}
        <button id="theme-toggle" class="btn-brand shadow-lg" title="Cambiar modo">
            <!-- Icono Sol: Se muestra cuando estamos en modo oscuro (porque el botón cambiará a claro) -->
            <span id="theme-toggle-light-icon" class="hidden"><i class="fa-solid fa-sun"></i></span>
            <!-- Icono Luna: Se muestra cuando estamos en modo claro -->
            <span id="theme-toggle-dark-icon" class="hidden"><i class="fa-solid fa-moon"></i></span>
        </button>
        <x-admin.sidebar />

        {{-- El contenido principal debe tener un margen izquierdo igual al ancho del sidebar --}}
        <main class="admin-main-content grow p-4">
            {{ $slot }}
        </main>

    </div>
    
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/theme-toggle.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>