<footer class="container-fluid border-top border-secondary  text-light pt-5">
    <div class="container">
        <div class="row align-items-start py-4">
            {{-- Categorías --}}
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <h5 class="texto-rojo text-uppercase mb-3 small fw-bold text-md-center">Categorías</h5>
                <ul class="list-unstyled text-md-center">
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('catalog', 'Audio') }}">Audio</a></li>
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('catalog', 'Instrumentos') }}">Instrumentos Musicales</a></li>
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('catalog', 'Fotografia') }}">Fotografía</a></li>
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('catalog', 'Iluminacion') }}">Iluminación y Estudio</a></li>
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('catalog', 'Bolsos') }}">Bolsos y Mochilas</a></li>
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('catalog', 'Soportes') }}">Trípodes y Soportes</a></li>
                    <li><a class="link-secondary text-decoration-none" href="{{ route('catalog', 'Outlet') }}">Outlet</a></li>
                </ul>
            </div>

            {{-- Navegación --}}
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <h5 class="texto-rojo text-uppercase mb-3 small fw-bold text-md-center">Navegación</h5>
                <ul class="list-unstyled text-md-center">
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('home') }}">Principal</a></li>
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('about') }}">Quiénes Somos</a></li>
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('marketing') }}">Comercialización</a></li>
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('contact') }}">Contacto</a></li>
                    <li class="mb-2"><a class="link-secondary text-decoration-none" href="{{ route('terms') }}">Términos de Uso</a></li>
                    <li><a class="link-secondary text-decoration-none" href="{{ route('queries') }}">Consultas</a></li>
                </ul>
            </div>

            {{-- Contacto --}}
            <div class="col-12 col-md-4">
                <h5 class="texto-rojo text-uppercase mb-3 small fw-bold text-md-center">Contactanos</h5>
                <ul class="list-unstyled text-md-center">
                    <li class="mb-2 text-secondary">
                        <i class="bi bi-telephone me-2 texto-rojo"></i> 11 4938-2277
                    </li>
                    <li class="mb-2">
                        <a class="link-secondary text-decoration-none" href="https://wa.me/5493795372819">
                            <i class="bi bi-whatsapp me-2 text-success"></i> 379 537-2819
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="link-secondary text-decoration-none" href="mailto:info@soundwavestore.com">
                            <i class="bi bi-envelope me-2 texto-rojo"></i> info@sw-store.com
                        </a>
                    </li>
                    <li>
                        <a class="link-secondary text-decoration-none" href="https://maps.app.goo.gl/yhESDqhKsFdvNLtk6">
                            <i class="bi bi-geo-alt me-2 texto-rojo"></i> 9 de Julio 1449, Corrientes
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="row border-top border-secondary py-4 mt-2">
            <div class="col text-center">
                <p class="mb-0 text-secondary small">
                    <span class="d-block d-md-none">
                        © {{ date('Y') }} <strong>Soundwave Store</strong>
                    </span>
                    <span class="d-none d-md-inline">
                        © {{ date('Y') }} <strong>Soundwave Store</strong>. Todos los derechos reservados.
                    </span>
                </p>
            </div>
        </div>
    </div>
</footer>
