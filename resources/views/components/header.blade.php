<header class="container-fluid border-bottom py-2 fondo">
    <div class="row align-items-center">

        {{-- logo --}}
        <div class="col-xl-3 col-sm-12 d-flex justify-content-center fs-3">
            <a class="navbar-brand texto-rojo animate__animated animate__pulse animate__infinite" href="{{ route('home') }}">SOUNDWAVE<span class="text-secondary"> STORE</span></a>
        </div>

        {{-- buscador --}}
        <div class="col-xl-6 p-2 px-xl-4 d-none d-lg-block bd-search">
            <form class="d-flex">
                <input class="form-control rounded-start-pill" type="search" placeholder="¿Qué estás buscando?">
                <button class="btn btn-outline-secondary rounded-end-pill" type="submit">
                    <img src="{{ asset('icons/svg/buscar.svg')}}" alt="buscar">
                </button>
            </form>
        </div>

        {{-- carrito e inicio de sesion --}}
        <div class="col-xl-3 d-flex justify-content-center align-items-center">
            <div class="d-flex align-items-center me-3">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('icons/svg/persona.svg')}}" alt="iniciar Sesion">

                    <div class="d-flex flex-column d-none d-lg-flex" style="line-height: 1.2;">
                        <a href="{{ route('login')}}"><span class="fw-semibold text-white p-lg-1">¡Hola! Inicia Sesión</span></a>
                        <a href="{{ route('signup')}}"><small class="text-secondary text-center">¿Eres Nuevo? Regístrate</small></a>
                    </div>
                </a>
            </div>

            <a href="#" class="text-decoration-none px-2"><img src="{{ asset('icons/svg/carrito.svg')}}" alt="carrito de compras"></a>
        </div>
    </div>
</header>
