<x-auth>
    <x-slot name="title">Iniciar Sesión</x-slot>

    <div class="auth-card">
        <div class="text-center mb-4">
            <h2 class="h4 fw-bold color-adaptativo text-uppercase">Inicia sesión</h2>
            <p class="small text-muted-adaptativo">Ingresa tus credenciales para continuar</p>
        </div>

        <form>
            <div class="mb-3">
                <label for="emailLogin" class="form-label color-adaptativo">Correo electrónico</label>
                {{-- La clase form-control ya es adaptativa en tu styles.css --}}
                <input type="email" class="form-control" id="emailLogin" placeholder="ejemplo@correo.com" required>
            </div>
            <div class="mb-3">
                <label for="passwordLogin" class="form-label color-adaptativo">Contraseña</label>
                <input type="password" class="form-control" id="passwordLogin" placeholder="********" required>
            </div>

            <div class="d-grid mt-4">
                {{-- Usamos btn-brand que ya tiene el estilo dorado adaptativo --}}
                <button type="submit" class="btn-brand py-2 fw-bold text-uppercase">
                    Ingresar
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('signup') }}" class="text-decoration-none small color-dorado-adaptativo fw-bold">
                ¿No tienes cuenta? Regístrate
            </a>
            <br>
            <a href="#" class="text-decoration-none small text-muted-adaptativo">
                ¿Olvidaste tu contraseña?
            </a>
        </div>

        <div class="mt-4 pt-3 border-top border-ui-adaptativa text-center">
            {{-- Usamos btn-volver-auth que definimos para el CSS migrado --}}
            <a href="{{ route('home') }}" class="btn-volver-auth w-100">
                <i class="bi bi-house-door me-2"></i>Ir al inicio
            </a>
        </div>
    </div>
</x-auth>
