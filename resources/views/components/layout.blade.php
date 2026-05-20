<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <!-- SCRIPT ANTI-PARPADEO -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            // Si no hay nada guardado, usamos el sistema. Si hay, usamos lo guardado.
            const theme = savedTheme || (systemPrefersDark ? 'dark' : 'light');

            if (theme === 'dark') {
                document.documentElement.classList.remove('light');
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else {
                document.documentElement.classList.add('light');
                document.documentElement.setAttribute('data-bs-theme', 'light');
            }
        })();
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('icons/ico/icono-soundWave.ico') }}">
    <title>{{ $title ?? 'Inicio' }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="fondo d-flex flex-column min-vh-100">
    <x-header />

    <button id="theme-toggle" class="btn-brand shadow-lg" title="Cambiar modo">
        <!-- Icono Sol: Se muestra cuando estamos en modo oscuro (porque el botón cambiará a claro) -->
        <span id="theme-toggle-light-icon" class="hidden"><i class="fa-solid fa-sun"></i></span>
        <!-- Icono Luna: Se muestra cuando estamos en modo claro -->
        <span id="theme-toggle-dark-icon" class="hidden"><i class="fa-solid fa-moon"></i></span>
    </button>

    <x-navbar />

    <main class="flex-grow-1">
        {{ $slot }}
    </main>

    <x-cart />
    <x-footer />
    <script src="{{ asset('js/theme-toggle.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    @include('sweetalert2::index')
</body>

</html>
