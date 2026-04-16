<x-layout>
    <x-slot name="title">Consultas</x-slot>
    <div class="container p-4 px-md-5">
        <div class="terms-decoration text-light my-4 px-5 pb-4">
            <h2 class="text-center border-bottom py-4">Formulario de consulta</h2>
            <p class="text-center">Nuestro compromiso es responder cada consulta con la mayor eficiencia posible, asegurando un servicio
                confiable y acorde a los estándares de calidad que nos representan.</p>
            <form action="">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre *</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Jonathan">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email"
                        placeholder="cuenta@correo.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Asunto *</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Elija una opción</option>
                        <option value="1">Formas de pago</option>
                        <option value="2">Modos/costos de envío</option>
                        <option value="3">Devolución</option>
                        <option value="4">Cuenta</option>
                        <option value="4">Otros</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje *</label>
                    <textarea class="form-control" id="mensaje" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
            </form>
        </div>
    </div>
</x-layout>
