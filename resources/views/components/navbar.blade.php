<nav class="navbar navbar-expand-lg border-bottom navbar-dark">
    <div class="container-fluid">
        <div class="d-flex d-lg-none flex-grow-1 px-4">
            <form class="d-flex w-100">
                <input class="form-control form-control-sm rounded-start-pill" type="search" placeholder="Buscar...">
                <button class="btn btn-outline-secondary btn-sm rounded-end-pill" type="submit">
                    <img src="{{ asset('icons/svg/buscar.svg') }}" alt="buscar" width="16">
                </button>
            </form>
        </div>
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto py-2 text-center">
                <li class="nav-item">
                    <a class="nav-link link-light {{ request()->routeIs('home') ? 'active fw-bold border-bottom' : '' }}"
                        href="{{ route('home') }}">PRINCIPAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light {{ request()->routeIs('about') ? 'active fw-bold border-bottom' : '' }}"
                        href="{{ route('about') }}">QUIENES SOMOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light {{ request()->routeIs('marketing') ? 'active fw-bold border-bottom' : '' }}"
                        href="{{ route('marketing') }}">COMERCIALIZACIÓN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light {{ request()->routeIs('contact') ? 'active fw-bold border-bottom' : '' }}"
                        href="{{ route('contact') }}">CONTACTO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light {{ request()->routeIs('terms') ? 'active fw-bold border-bottom' : '' }}"
                        href="{{ route('terms') }}">TÉRMINOS DE USO</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link link-light dropdown-toggle  {{ request()->routeIs('catalog') ? 'active fw-bold border-bottom' : '' }}"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CATÁLOGO
                    </a>
                    <ul class="dropdown-menu pages-decoration">
                        <li><a class="dropdown-item item-catalogo" href="{{ route('catalog') }}">VER TODO</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item item-catalogo" href="#">AUDIO</a></li>
                        <li><a class="dropdown-item item-catalogo" href="#">INSTRUMENTOS MUSICALES</a></li>
                        <li><a class="dropdown-item item-catalogo" href="#">FOTOGRAFIA</a></li>
                        <li><a class="dropdown-item item-catalogo" href="#">ILUMINACION Y ESTUDIO</a></li>
                        <li><a class="dropdown-item item-catalogo" href="#">BOLSOS Y MOCHILAS</a></li>
                        <li><a class="dropdown-item item-catalogo" href="#">TRIPODES Y SOPORTES</a></li>
                        <li><a class="dropdown-item item-catalogo" href="#">OUTLET</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-light {{ request()->routeIs('queries') ? 'active fw-bold border-bottom' : '' }}"
                        href="{{ route('queries') }}">CONSULTA</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
