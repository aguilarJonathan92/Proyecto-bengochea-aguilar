<nav class="navbar navbar-expand-lg border-bottom nav-custom">
    <div class="container-fluid">
        {{-- Buscador Móvil --}}
        <div class="d-flex d-lg-none flex-grow-1 px-4 position-relative">
            <form class="d-flex w-100" action="{{ route('search') }}" method="GET">
                <input id="mobile-search" class="form-control form-control-sm rounded-start-pill" type="search"
                    name="query" placeholder="Buscar..." value="{{ request('query') }}" autocomplete="off">
                <button class="btn btn-outline-secondary btn-sm rounded-end-pill" type="submit">
                    <img src="{{ asset('icons/svg/buscar.svg') }}" alt="buscar" width="16" class="icon-adaptive">
                </button>
            </form>
            {{-- Contenedor de sugerencias móvil --}}
            <div id="mobile-search-suggestions" class="list-group position-absolute w-100 shadow d-none"
                style="z-index: 1050; top: 100%; left: 0; padding: 0 1.5rem;">
            </div>
        </div>

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto py-2 text-center">
                {{-- Los enlaces ahora usan una clase personalizada 'nav-link-custom' --}}
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('home') ? 'active fw-bold' : '' }}"
                        href="{{ route('home') }}">PRINCIPAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('about') ? 'active fw-bold' : '' }}"
                        href="{{ route('about') }}">QUIENES SOMOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('marketing') ? 'active fw-bold' : '' }}"
                        href="{{ route('marketing') }}">COMERCIALIZACIÓN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('contact') ? 'active fw-bold' : '' }}"
                        href="{{ route('contact') }}">CONTACTO</a>
                </li>
                <li class="nav-item">
                    <a @class([
                        'nav-link',
                        'nav-link-custom',
                        'active fw-bold' => request()->routeIs('terms'),
                    ]) href="{{ route('terms') }}">TÉRMINOS DE USO</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('catalog') ? 'active fw-bold' : '' }}"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        CATÁLOGO
                    </a>
                    <ul class="dropdown-menu pages-decoration">
                        <li><a @class([
                            'dropdown-item',
                            'item-catalogo',
                            'text-center',
                            'text-lg-start',
                        ]) href="{{ route('catalog') }}">VER TODO</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        {{-- Categorías desde la Base de Datos --}}
                        @foreach ($categorias as $categoria)
                            <li>
                                <a @class([
                                    'dropdown-item',
                                    'item-catalogo',
                                    'text-center',
                                    'text-lg-start',
                                    'overflow-hidden',
                                    // Si en la URL usas el ID o el slug
                                    'item-catalogo-active' => request()->route('categoria') == $categoria->id,
                                ]) href="{{ route('catalog', $categoria->id) }}">

                                    {{-- Imprime el nombre directo de la BD en mayúsculas --}}
                                    {{-- Str::upper($categoria->name) --}}
                                    {{ Str::upper($categoria->display_title) }}

                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom {{ request()->routeIs('queries') ? 'active fw-bold' : '' }}"
                        href="{{ route('queries') }}">CONSULTA</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
