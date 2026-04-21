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

</x-layout>
