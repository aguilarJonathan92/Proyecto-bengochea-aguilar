<x-layout>
    <x-slot name='title'>Mi Perfil — {{ auth()->user()->first_name }}</x-slot>
 
    <div class="container py-5" id="perfil-app" data-tiene-errores="{{ $errors->any() ? 'true' : 'false' }}">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-xl-6">
 
                {{-- Cabecera de perfil --}}
                <div class="perfil-header d-flex align-items-center gap-3 mb-4">
                    <div class="perfil-avatar">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="perfil-nombre mb-0">
                            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                        </h2>
                        <span class="perfil-email">{{ auth()->user()->email }}</span>
                    </div>
                </div>
 
                {{-- Modo VISTA: datos del usuario --}}
                <div id="modo-vista">
                    <div class="checkout-section-card shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="checkout-title color-adaptativo mb-0">Mis datos</h5>
                            <button onclick="activarEdicion()" class="btn-editar">
                                <i class="bi bi-pencil me-1"></i> Editar
                            </button>
                        </div>
 
                        <div class="perfil-campo">
                            <span class="perfil-label">Nombre</span>
                            <span class="perfil-valor">{{ auth()->user()->first_name }}</span>
                        </div>
                        <hr class="checkout-separator my-3">
                        <div class="perfil-campo">
                            <span class="perfil-label">Apellido</span>
                            <span class="perfil-valor">{{ auth()->user()->last_name }}</span>
                        </div>
                        <hr class="checkout-separator my-3">
                        <div class="perfil-campo">
                            <span class="perfil-label">Correo electrónico</span>
                            <span class="perfil-valor">{{ auth()->user()->email }}</span>
                        </div>
                        <hr class="checkout-separator my-3">
                        <div class="perfil-campo">
                            <span class="perfil-label">Contraseña</span>
                            <span class="perfil-valor text-muted-adaptativo">••••••••</span>
                        </div>
                    </div>
                </div>
 
                {{-- Modo EDICIÓN: formulario --}}
                <div id="modo-edicion" class="hidden">
                    <div class="checkout-section-card shadow-sm p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="checkout-title color-adaptativo mb-0">Editar perfil</h5>
                            <button onclick="cancelarEdicion()" class="btn-cancelar">
                                <i class="bi bi-x-lg me-1"></i> Cancelar
                            </button>
                        </div>
 
                        <form action="{{ route('panel-usuario.update') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
 
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label color-adaptativo">Nombre</label>
                                    <input type="text" name="first_name"
                                        class="form-control checkout-input @error('first_name') is-invalid @enderror"
                                        placeholder="Ej: Jonathan"
                                        value="{{ old('first_name', auth()->user()->first_name) }}"
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
                                        value="{{ old('last_name', auth()->user()->last_name) }}"
                                        required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
 
                                <div class="col-12">
                                    <label class="form-label color-adaptativo">Correo electrónico</label>
                                    <input type="email" name="email"
                                        class="form-control checkout-input @error('email') is-invalid @enderror"
                                        placeholder="nombre@ejemplo.com"
                                        value="{{ old('email', auth()->user()->email) }}"
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
 
                            <hr class="checkout-separator">
 
                            <h6 class="checkout-title color-adaptativo mb-3" style="font-size: 0.85rem;">
                                Cambiar contraseña <span class="text-muted-adaptativo fw-normal">(opcional)</span>
                            </h6>
 
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
    </div> 
    <script src="{{ asset('js/activar-editar.js') }}"></script>
</x-layout>
 
