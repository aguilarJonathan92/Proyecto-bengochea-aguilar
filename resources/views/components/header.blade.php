<header class="container-fluid border-bottom py-2 fondo">
    <div class="row align-items-center">

        {{-- logo --}}
        <div class="col-lg-4 col-xl-3 col-sm-12 d-flex justify-content-center fs-3">
            <a class="navbar-brand texto-rojo animate__animated animate__pulse animate__infinite"
                href="{{ route('home') }}">SOUNDWAVE<span class="text-secondary"> STORE</span></a>
        </div>

        {{-- buscador --}}
        <div class=" px-4 col-lg-4 col-xl-6 p-2 d-none d-lg-block bd-search">
            <form class="d-flex">
                <input class="form-control rounded-start-pill" type="search" placeholder="¿Qué estás buscando?">
                <button class="btn btn-outline-secondary rounded-end-pill" type="submit">
                    <img src="{{ asset('icons/svg/buscar.svg') }}" alt="buscar" class="icon-adaptive">
                </button>
            </form>
        </div>

        {{-- carrito e inicio de sesion --}}
        <div class="col-lg-4 col-xl-3 d-flex justify-content-center align-items-center">
            <div class="d-flex align-items-center me-3">
                <a class="d-flex align-items-center text-decoration-none" href="{{ route('login') }}">
                    <img src="{{ asset('icons/svg/persona.svg') }}" alt="Iniciar Sesion" class="icon-adaptive">
                </a>

                <div class="d-flex flex-column d-none d-lg-flex text-center" style="line-height: 1.2;">
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        {{-- Usamos color-adaptativo para que cambie entre blanco y oscuro --}}
                        <span class="fw-semibold color-adaptativo p-lg-1">Iniciar Sesión</span>
                    </a>
                    <a href="{{ route('signup') }}" class="text-decoration-none">
                        <small class="text-muted-adaptativo">¿Eres Nuevo?</small>
                    </a>
                </div>
            </div>
            <a href="#" class="text-decoration-none px-2 position-relative" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasCart">
                {{-- Eliminamos el style inline de filter e invert --}}
                <img src="{{ asset('icons/svg/carrito.svg') }}" alt="carrito" class="icon-adaptive">
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                    style="font-size: 0.5rem;">
                    1
                </span>
            </a>
        </div>
    </div>
</header>
