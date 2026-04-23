<x-layout>
    <x-slot name="title">Principal</x-slot>
    <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
            {{-- imagenes de 1920 x 720 píxeles --}}
          <img src="{{ asset('images/carro1.webp')}}" class="d-block w-100 h-100" alt=carrusel1">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('images/carro2.webp')}}" class="d-block w-100 h-100" alt="carrusel2">
        </div>
        <div class="carousel-item">
          <img src="{{ asset('images/carro3.webp')}}" class="d-block w-100 h-100" alt="carrusel3">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div class="container my-4">
      <h3 class="mb-4 text-center text-white"><i class="bi bi-stars"></i> Novedades</h3>
      <div class="row">
        <!-- Tarjeta 1 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 1</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Tarjeta 2 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 2</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Tarjeta 3 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 3</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Tarjeta 4 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 4</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="container my-4">
      <h3 class="mb-4 text-center text-white"><i class="bi bi-tag-fill"> Ofertas imperdibles</h3>
      <div class="row">
        <!-- Tarjeta 1 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 1</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Tarjeta 2 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 2</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Tarjeta 3 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 3</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Tarjeta 4 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 4</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="container my-4">
      <h3 class="mb-4 text-center text-white"><i class="bi bi-graph-up"> Más visitados</h3>
      <div class="row">
        <!-- Tarjeta 1 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 1</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Tarjeta 2 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 2</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Tarjeta 3 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 3</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
        <!-- Tarjeta 4 -->
        <div class="col-md-3">
            <div class="card h-100">
                <img src="..." class="card-img-top" alt="Producto 1">
                <div class="card-body">
                    <h5 class="card-title">Card title 4</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <a href="#" class="btn btn-primary">Ver más</a>
                </div>
            </div>
        </div>
      </div>
    </div>
</x-layout>
