<x-layout>
    <x-slot name="title">Consultas</x-slot>
    <div class="container text-light my-4">
        <h2 class="text-center">Formulario de consulta</h2>
        <p>Nuestro compromiso es responder cada consulta con la mayor eficiencia posible, asegurando un servicio confiable y acorde a los estándares de calidad que nos representan.</p>
                <form action="">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nombre *</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Jonathan">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="cuenta@correo.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Asunto *</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Mensaje *</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                    </div>
                     <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
    </div>
</x-layout>
