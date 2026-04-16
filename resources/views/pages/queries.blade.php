<x-layout>
    <x-slot name="title">Consultas</x-slot>
    <div class="container p-2 p-md-4 px-lg-5">
        <div class="pages-decoration text-light my-4 px-3 px-md-5 pb-4">
            <h2 class="text-center border-bottom py-4">Formulario de consulta</h2>
            <p class="text-center mb-4">
                Nuestro compromiso es responder cada consulta con la mayor eficiencia posible,
                asegurando un servicio confiable y de calidad.
            </p>

            <form action="">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Jonathan" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="cuenta@correo.com"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="asunto" class="form-label">Asunto *</label>
                    <select id="asunto" name="asunto" class="form-select" aria-label="Seleccionar asunto" required>
                        <option value="" selected disabled>Elija una opción</option>
                        <option value="1">Formas de pago</option>
                        <option value="2">Modos/costos de envío</option>
                        <option value="3">Devolución</option>
                        <option value="4">Cuenta</option>
                        <option value="5">Otros</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje *</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="Escribe tu consulta aquí..." required></textarea>
                </div>

                <div class="d-grid d-md-block text-center">
                    <button type="submit" class="btn btn-primary px-5 py-2">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
