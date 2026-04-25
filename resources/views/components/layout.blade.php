<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('icons/ico/icono-soundWave.ico') }}">
    <title>{{ $title ?? 'Inicio' }}</title>
    <link rel="stylesheet" href="{{ asset('vendor/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="fondo d-flex flex-column min-vh-100">
    <x-header />
    <x-navbar />
    <main class="flex-grow-1">
        {{ $slot }}
    </main>
    <x-cart />
    <x-footer />
    <script src=" {{ asset('vendor/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
