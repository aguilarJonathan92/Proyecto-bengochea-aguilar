<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Inicio'}}</title>
    <link rel="stylesheet" href="{{ asset('vendor/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
</head>
<body class="fondo d-flex flex-column min-vh-100">
    <x-header/>
    <x-navbar/>
    <main class="flex-grow-1">
        {{ $slot }}
    </main>
    <x-footer/>
    <script src=" {{ asset('vendor/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
