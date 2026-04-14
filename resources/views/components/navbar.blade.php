<nav class="container-fluid navbar-expand-lg border-bottom">
    <!--Posible boton hamburguesa aqui-->
    <ul class="nav justify-content-center py-2">
        <li class="nav-item">
            <a class="nav-link link-light {{ request()->routeIs('home') ? 'active fw-bold border-bottom':'' }}" href="{{ route('home') }}">PRINCIPAL</a>
        </li>
        <li class="nav-item">
            <a class="nav-link link-light {{ request()->routeIs('about') ? 'active fw-bold border-bottom':'' }}" href="{{ route('about') }}">QUIENES SOMOS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link link-light {{ request()->routeIs('marketing') ? 'active fw-bold border-bottom':'' }}" href="{{ route('marketing') }}">COMERCIALIZACIÓN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link link-light {{ request()->routeIs('contact') ? 'active fw-bold border-bottom':'' }}" href="{{ route('contact') }}">CONTACTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link link-light {{ request()->routeIs('terms') ? 'active fw-bold border-bottom':'' }}" href="{{ route('terms') }}">TÉRMINOS DE USO</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link link-light dropdown-toggle {{ request()->routeIs('catalog')? 'active fw-bold border-bottom': '' }}" role="button" data-bs-toggle="dropdown">CATÁLOGO</a>
            <ul class="dropdown-menu">
                <li>
                    <a class="item-catalogo dropdown-item" href="{{ route('catalog') }}">VER TODO</a>
                </li>
                <li>
                    <a class="item-catalogo dropdown-item" href="#">AUDIO</a>
                </li>
                <li>
                    <a class="item-catalogo dropdown-item" href="#">INSTRUMENTOS MUSICALES</a>
                </li>
                <li>
                    <a class="item-catalogo dropdown-item" href="#">FOTOGRAFIA</a>
                </li>
                <li>
                    <a class="item-catalogo dropdown-item" href="#">ILUMINACION Y ESTUDIO</a>
                </li>
                <li>
                    <a class="item-catalogo dropdown-item" href="#">BOLSOS Y MOCHILAS</a>
                </li>
                <li>
                    <a class="item-catalogo dropdown-item" href="#">TRIPODES Y SOPORTES</a>
                </li>
                <li>
                    <a class="item-catalogo dropdown-item" href="#">OUTLET</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link link-light {{ request()->routeIs('queries')? 'active fw-bold border-bottom': '' }}" href="{{ route('queries') }}">CONSULTA</a>
        </li>
    </ul>
</nav>


