
<x-layout>
   <x-slot name='title'>Aqui Va el nombre del Usuario</x-slot>
   <div class="container py-4">
    <h2>Mi Panel</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="#" method="POST"> {{-- route('panel-usuario.update')--}}
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                   value="{{ old('first_name', $user->first_name) }}">
            @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                   value="{{ old('last_name', $user->last_name) }}">
            @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva contraseña <small class="text-muted">(dejar vacío para no cambiar)</small></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
</x-layout>
