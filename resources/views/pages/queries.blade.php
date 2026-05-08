<x-layout>
    <x-slot name="title">Consultas</x-slot>
    <div class="container p-2 p-md-4 px-lg-5">
        {{-- Eliminamos text-light para que herede var(--color-texto) --}}
        <div class="pages-decoration my-4 px-3 px-md-5 pb-4">
            <h2 class="text-center border-bottom border-ui-adaptativa py-4 color-adaptativo">Formulario de consulta</h2>
            <p class="text-center mb-4 color-adaptativo">
                Nuestro compromiso es responder cada consulta con la mayor eficiencia posible,
                asegurando un servicio confiable y de calidad.
            </p>
            @if (session('success'))
                <div class="pages-decoration p-2 p-md-4 px-lg-5">
                    <p class="text-success text-center m-auto">{{ session('success') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="pages-decoration p-2 p-md-4 px-lg-5">
                    <p class="text-danger text-center m-auto">Error en el envío del formulario: revise los campos.</p>
                </div>
            @endif
            <form action="{{ route('queries.send') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="nombre" class="form-label color-adaptativo">Nombre *</label>
                        {{-- La clase form-control ya está configurada en el CSS para ser adaptativa --}}
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Jonathan"
                            value="{{ old('nombre') }}">
                        @error('nombre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="email" class="form-label color-adaptativo">Email *</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="cuenta@correo.com" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="asunto" class="form-label color-adaptativo">Asunto *</label>
                    <select id="asunto" name="asunto" class="form-select" aria-label="Seleccionar asunto">
                        <option value="" disabled {{ old('asunto') == "" ? 'selected' : '' }}>Elija una opción</option>
                        <option value="1" {{ old('asunto') == "1" ? 'selected' : '' }}>Formas de pago</option>
                        <option value="2" {{ old('asunto') == "2" ? 'selected' : '' }}>Modos/costos de envío</option>
                        <option value="3" {{ old('asunto') == "3" ? 'selected' : '' }}>Devolución</option>
                        <option value="4" {{ old('asunto') == "4" ? 'selected' : '' }}>Cuenta</option>
                        <option value="5" {{ old('asunto') == "5" ? 'selected' : '' }}>Otros</option>
                    </select>
                    @error('asunto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="mensaje" class="form-label color-adaptativo">Mensaje *</label>
                    <textarea class="form-control" id="mensaje" maxlength="500" name="mensaje" rows="4" placeholder="Escribe tu consulta aquí...">{{ old('mensaje') }}</textarea>
                    <div id="contador" style="text-align: right; font-size: 0.9em; color: #666;">
                        0 / 500 caracteres
                    </div>
                    @error('mensaje')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-grid d-md-flex justify-content-md-start mt-4">
                    <button type="submit" class="special-btn px-5 py-2 border-0">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </div>
<script src="{{ asset('js/text-area.js') }}"></script>
</x-layout>
