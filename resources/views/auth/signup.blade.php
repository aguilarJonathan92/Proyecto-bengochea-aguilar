<x-auth>
    <x-slot name="title">Registro</x-slot>

    <div class="auth-card">
        <div class="text-center mb-4">
            <h2 class="h4 fw-bold color-adaptativo text-uppercase">Crea tu cuenta</h2>
            <p class="small text-muted-adaptativo">Únete a la comunidad de Soundwave Store</p>
        </div>

        <form action="{{ url('/signup') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="nameSignup" class="form-label color-adaptativo">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="nameSignup" placeholder="Juan" required>
                </div>
                <div class="col-12 mb-3">
                    <label for="nameSignup" class="form-label color-adaptativo">Apellido</label>
                    <input type="text" name="apellido" class="form-control" id="nameSignup" placeholder="Pérez" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="emailSignup" class="form-label color-adaptativo">Correo electrónico</label>
                <input type="email" name="email" class="form-control" id="emailSignup" placeholder="ejemplo@correo.com" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="passwordSignup" class="form-label color-adaptativo">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="passwordSignup" placeholder="********" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="passwordConfirmSignup" class="form-label color-adaptativo">Confirmar</label>
                    <input type="password" name="password_confirmation" class="form-control" id="passwordConfirmSignup" placeholder="********" required>
                </div>
            </div>

            <div class="d-grid mt-4">
                <button type="submit" class="btn-brand py-2 fw-bold text-uppercase">
                    Crear cuenta
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none small color-dorado-adaptativo fw-bold">
                ¿Ya tienes cuenta? Inicia sesión
            </a>
        </div>

        <div class="mt-4 pt-3 border-top border-ui-adaptativa text-center">
            <a href="{{ route('home') }}" class="btn-volver-auth w-100">
                <i class="bi bi-house-door me-2"></i>Ir al inicio
            </a>
        </div>
    </div>
</x-auth>
