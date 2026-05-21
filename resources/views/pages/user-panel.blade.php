
<x-layout>
   <x-slot name='title'>Aqui Va el nombre del Usuario</x-slot>
   <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">

                @if(session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif

                <div class="checkout-section-card shadow-sm p-4">
                    <h4 class="checkout-title color-adaptativo mb-4">Mis Datos</h4>

                    <form action="{{ route('panel-usuario.update') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label color-adaptativo">Nombre</label>
                                <input type="text" name="first_name"
                                    class="form-control checkout-input @error('first_name') is-invalid @enderror"
                                    placeholder="Ej: Jonathan"
                                    value="{{ old('first_name', $user->first_name) }}"
                                    required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label color-adaptativo">Apellido</label>
                                <input type="text" name="last_name"
                                    class="form-control checkout-input @error('last_name') is-invalid @enderror"
                                    placeholder="Ej: Aguilar"
                                    value="{{ old('last_name', $user->last_name) }}"
                                    required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label color-adaptativo">Email</label>
                                <input type="email" name="email"
                                    class="form-control checkout-input @error('email') is-invalid @enderror"
                                    placeholder="nombre@ejemplo.com"
                                    value="{{ old('email', $user->email) }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="checkout-separator">

                        <h4 class="checkout-title color-adaptativo mb-3">Cambiar Contraseña</h4>

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label color-adaptativo">Nueva contraseña</label>
                                <input type="password" name="password"
                                    class="form-control checkout-input @error('password') is-invalid @enderror"
                                    placeholder="Dejar vacío para no cambiar">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label color-adaptativo">Confirmar contraseña</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control checkout-input"
                                    placeholder="Repetir nueva contraseña">
                            </div>
                        </div>

                        <hr class="checkout-separator">

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn-confirm-order py-3 fw-bold text-uppercase">
                                Guardar cambios
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</x-layout>
