@extends('components.auth') 

@section('content')
<div class="container py-5">
    <div class="card p-4">
        <h2 class="mb-4 text-center">Inicia sesión</h2>
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
    </div>
</div>
@endsection
