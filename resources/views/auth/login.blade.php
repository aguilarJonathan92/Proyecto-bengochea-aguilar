<x-auth>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="auth-card">
        <div class="auth-header text-center mb-4">
             <div class="logo">
                <span class="logo-soundwave">SOUNDWAVE</span>
                <span class="logo-store">STORE</span>
            </div>
            <div class="titulo">Inicia sesión</div>
        </div>

        <form>
            <div class="mb-3">
                <label for="emailLogin" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="emailLogin" placeholder="ejemplo@correo.com">
            </div>
            <div class="mb-3">
                <label for="passwordLogin" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="passwordLogin" placeholder="********">
            </div>
            <button type="submit" class="btn-auth">Ingresar</button>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('signup') }}">¿No tienes cuenta? Regístrate</a><br>
            <a href="#">¿Olvidaste tu contraseña?</a>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('home') }}" class="btn-volver">← Ir al inicio</a>
        </div>
    </div>
</div>
</x-auth>
