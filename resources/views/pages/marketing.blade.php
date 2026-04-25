<x-layout>
    <x-slot name="title">Comercialización</x-slot>

    <div class="container p-2 p-md-4 px-lg-5">
        <div class="pages-decoration text-light my-4 px-3 px-md-5 pb-5">

            <h2 class="text-center border-bottom py-4 mb-5">Comercialización</h2>

            <div class="row align-items-center mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/comercializacion.webp') }}" alt="Comercialización Soundwave Store"
                        class="img-fluid rounded shadow border border-secondary">
                </div>
                <div class="col-md-6">
                    <p>En <strong class="texto-rojo text-uppercase">Soundwave Store</strong> desarrollamos un modelo de comercialización integral orientado a garantizar eficiencia, transparencia y sostenibilidad en cada operación.</p>
                    <p>Nuestra gestión se basa en procesos estandarizados que permiten optimizar la cadena de valor, desde la adquisición de instrumentos hasta la entrega final al cliente, asegurando que la pasión por la música llegue a cada hogar sin contratiempos.</p>
                </div>
            </div>

            <div class="row align-items-center mb-5 py-4 border-top border-secondary">
                <div class="col-md-6 order-2 order-md-1">
                    <h3 class="mb-3"><i class="bi bi-box-seam me-2" style="color:#C0392B;"></i>Estrategia de Abastecimiento</h3>
                    <p>Trabajamos con proveedores nacionales e internacionales cuidadosamente seleccionados, priorizando la calidad, la trazabilidad y la continuidad en el suministro.</p>
                    <p>Buscamos socios estratégicos que compartan nuestro estándar de excelencia para ofrecer un catálogo que cumpla con las expectativas de los músicos más exigentes.</p>
                </div>
                <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                    <img src="{{ asset('images/proveedores.webp') }}" alt="Proveedores de instrumentos"
                        class="img-fluid rounded shadow border border-secondary">
                </div>
            </div>

            <div class="row align-items-center mb-5 py-4 border-top border-secondary">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/ecommerce.png') }}" alt="E-commerce Soundwave Store"
                        class="img-fluid rounded shadow border border-secondary">
                </div>
                <div class="col-md-6">
                    <h3 class="mb-3"><i class="bi bi-cart-fill me-2" style="color:#E8C547;"></i>Canales de Venta</h3>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <strong class="texto-rojo">E-commerce propio:</strong>
                            Plataforma digital con alcance nacional, diseñada para ofrecer una experiencia de compra segura, rápida y eficiente desde cualquier dispositivo.
                        </li>
                        <li>
                            <strong class="texto-rojo">Distribución regional:</strong>
                            Presencia activa en Corrientes y provincias aledañas, con una logística adaptada específicamente a las necesidades del mercado local.
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row align-items-center mb-5 py-4 border-top border-secondary">
                <div class="col-md-6 order-2 order-md-1">
                    <h3 class="mb-3"><i class="bi bi-credit-card-fill me-2" style="color:#C0392B;"></i>Precios y Logística</h3>
                    <p>Implementamos una política de precios transparente y competitiva, acompañada de opciones de financiación flexibles para que el acceso a la música sea una realidad para todos.</p>
                    <p>Contamos con alianzas estratégicas con operadores logísticos de primer nivel, garantizando que cada instrumento sea transportado con el cuidado que merece y entregado en plazos confiables.</p>
                </div>
                <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                    <img src="{{ asset('images/logistica.png') }}" alt="Logística y distribución"
                        class="img-fluid rounded shadow border border-secondary">
                </div>
            </div>

            <div class="pt-4 border-top border-secondary">
                <h2 class="text-center mb-5">Nuestro Compromiso Corporativo</h2>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-dark text-light h-100 border-secondary shadow-sm text-center p-4">
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center border border-danger" style="width: 80px; height: 80px; background: #1a1a1a;">
                                <i class="bi bi-gear-fill fs-2 texto-rojo"></i>
                            </div>
                            <h5 class="card-title texto-rojo">Eficiencia Operativa</h5>
                            <p class="card-text small">Optimización constante de nuestros procesos internos para reducir costos y tiempos de respuesta, beneficiando directamente al cliente final.</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card bg-dark text-light h-100 border-secondary shadow-sm text-center p-4">
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center border border-danger" style="width: 80px; height: 80px; background: #1a1a1a;">
                                <i class="bi bi-shield-check fs-2 texto-rojo"></i>
                            </div>
                            <h5 class="card-title texto-rojo">Transparencia</h5>
                            <p class="card-text small">Mantenemos una comunicación clara y un cumplimiento estricto de todas las condiciones pactadas, construyendo relaciones de confianza a largo plazo.</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card bg-dark text-light h-100 border-secondary shadow-sm text-center p-4">
                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center border border-danger" style="width: 80px; height: 80px; background: #1a1a1a;">
                               <i class="bi bi-globe fs-2 texto-rojo"></i>
                            </div>
                            <h5 class="card-title texto-rojo">Sostenibilidad</h5>
                            <p class="card-text small">Desarrollamos prácticas responsables que favorecen el crecimiento de la comunidad musical y aseguran la viabilidad de nuestro modelo de negocio.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
