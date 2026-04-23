@extends('components.auth')

@section('content')
<div class="container py-5">
    <div class="card p-4">
        <h2 class="mb-4 text-center">Regístrate</h2>
        <form>
            <div class="mb-3">
                <label for="nameSignup" class="form-label">Nombre completo</label>
                <input type="text" class="form-control" id="nameSignup" placeholder="Juan Pérez">
            </div>
            <div class="mb-3">
                <label for="emailSignup" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="emailSignup" placeholder="ejemplo@correo.com">
            </div>
            <div class="mb-3">
                <label for="passwordSignup" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="passwordSignup" placeholder="********">
            </div>
            <div class="mb-3">
                <label for="passwordConfirmSignup" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" id="passwordConfirmSignup" placeholder="********">
            </div>
            <button type="submit" class="btn-auth">Crear cuenta</button>
        </form>
        <div class="mt-3 text-center">
            <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
</div>
@endsection