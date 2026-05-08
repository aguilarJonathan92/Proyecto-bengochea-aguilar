<x-admin-layout>
    <x-slot name="title">Dashboard - Soundwave</x-slot>

    <div class="container-fluid animate__animated animate__fadeIn">
        {{-- Encabezado de bienvenida --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 color-adaptativo">Resumen General</h2>
            <span class="badge bg-adaptativo-badge p-2">{{ now()->format('d/m/Y') }}</span>
        </div>

        {{-- Fila de Tarjetas de Estadísticas (Esto ayudará a llenar espacio) --}}
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="checkout-section-card p-3 text-center">
                    <i class="fas fa-shopping-cart color-dorado-adaptativo mb-2 fa-2x"></i>
                    <h5 class="text-muted-adaptativo">Ventas</h5>
                    <p class="h4 fw-bold">24</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkout-section-card p-3 text-center">
                    <i class="fas fa-users color-dorado-adaptativo mb-2 fa-2x"></i>
                    <h5 class="text-muted-adaptativo">Clientes</h5>
                    <p class="h4 fw-bold">150</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkout-section-card p-3 text-center">
                    <i class="fas fa-box color-dorado-adaptativo mb-2 fa-2x"></i>
                    <h5 class="text-muted-adaptativo">Productos</h5>
                    <p class="h4 fw-bold">85</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkout-section-card p-3 text-center">
                    <i class="fas fa-music color-dorado-adaptativo mb-2 fa-2x"></i>
                    <h5 class="text-muted-adaptativo">Cursos</h5>
                    <p class="h4 fw-bold">12</p>
                </div>
            </div>
        </div>

        {{-- Tarjeta de Bienvenida --}}
        <div class="card bg-superficie-adaptativa border-ui-adaptativa shadow-sm p-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="display-6 fw-bold color-dorado-adaptativo">¡Hola de nuevo!</h2>
                    <p class="lead text-muted-adaptativo">Bienvenido al Panel de Control de Soundwave Store. Aquí podrás gestionar tus productos, ventas y alumnos de forma centralizada.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-user-shield fa-5x color-adaptativo opacity-25"></i>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>