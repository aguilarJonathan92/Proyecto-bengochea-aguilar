<footer class="container-fluid border-top pt-5 footer-custom">
    <div class="container">
        <div class="row align-items-start py-4">
            {{-- Categorías --}}
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <h5 class="texto-rojo text-uppercase mb-3 small fw-bold text-center">Categorías</h5>
                <ul class="list-unstyled text-center">
                    @foreach ($categorias as $categoria)
                        <li class="mb-2">
                            <a class="footer-link text-decoration-none" href="{{ route('catalog', $categoria->id) }}">{{ $categoria->display_title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Navegación --}}
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <h5 class="texto-rojo text-uppercase mb-3 small fw-bold text-center">Navegación</h5>
                <ul class="list-unstyled text-center">
                    <li class="mb-2"><a class="footer-link text-decoration-none" href="{{ route('home') }}">Principal</a></li>
                    <li class="mb-2"><a class="footer-link text-decoration-none" href="{{ route('about') }}">Quiénes Somos</a></li>
                    <li class="mb-2"><a class="footer-link text-decoration-none" href="{{ route('marketing') }}">Comercialización</a></li>
                    <li class="mb-2"><a class="footer-link text-decoration-none" href="{{ route('contact') }}">Contacto</a></li>
                    <li class="mb-2"><a class="footer-link text-decoration-none" href="{{ route('terms') }}">Términos de Uso</a></li>
                    <li class="mb-2"><a class="footer-link text-decoration-none" href="{{ route('catalog') }}">Nuestro Catálogo</a></li>
                    <li><a class="footer-link text-decoration-none" href="{{ route('queries') }}">Consultas</a></li>
                </ul>
            </div>

            {{-- Contacto --}}
            <div class="col-12 col-md-4">
                <h5 class="texto-rojo text-uppercase mb-3 small fw-bold text-center">Contactanos</h5>
                <ul class="list-unstyled text-center">
                    <li class="mb-2">
                        <a href="tel:+543795372819" class="footer-link text-decoration-none">
                            <i class="bi bi-telephone me-2 texto-rojo"></i> 379 537-2819
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="footer-link text-decoration-none" href="mailto:info@sw-store.com">
                            <i class="bi bi-envelope me-2 texto-rojo"></i> info@sw-store.com
                        </a>
                    </li>
                    <li>
                        <a class="footer-link text-decoration-none" href="https://maps.app.goo.gl/yhESDqhKsFdvNLtk6">
                            <i class="bi bi-geo-alt me-2 texto-rojo"></i> 9 de Julio 1449, Corrientes
                        </a>
                    </li>
                </ul>
                {{-- Redes Sociales --}}
                <div class="d-flex justify-content-center gap-3 mt-2">
                    <a href="https://wa.me/5493795372819" class="footer-link fs-5 social-icon-hover" title="Whatsapp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    <a href="https://instagram.com" class="footer-link fs-5 social-icon-hover" title="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://facebook.com" class="footer-link fs-5 social-icon-hover" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://tiktok.com" class="footer-link fs-5 social-icon-hover" title="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="row border-top border-muted-custom py-4 mt-2">
            <div class="col text-center">
                <p class="mb-0 text-muted-custom small">
                    © {{ date('Y') }} <strong>Soundwave Store</strong>. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </div>
</footer>
