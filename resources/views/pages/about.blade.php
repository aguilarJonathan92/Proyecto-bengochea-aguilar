<x-layout>
    <x-slot name="title">Acerca De</x-slot>

    <div class="container p-2 p-md-4 px-lg-5">
        <div class="pages-decoration text-light my-4 px-3 px-md-5 pb-5">

            <h2 class="text-center border-bottom py-4 mb-5">Quiénes Somos</h2>

            <div class="row align-items-center mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/empresa.webp') }}" alt="Equipo Soundwave Store"
                        class="img-fluid rounded shadow border border-secondary">
                </div>
                <div class="col-md-6">
                    <p>En <strong class="texto-rojo text-uppercase">Soundwave Store</strong> creemos que la música no es
                        solo sonido: es emoción, identidad y conexión. Nacimos con la misión de acercar instrumentos de
                        calidad a quienes buscan expresarse, crear y vivir la experiencia musical en todas sus formas.
                    </p>
                    <p>Somos más que una tienda en línea: somos un espacio para artistas, estudiantes y apasionados de
                        la música que desean encontrar el instrumento perfecto para su viaje creativo.</p>
                    <p>Nuestro compromiso es acompañarte desde el primer acorde hasta el escenario, brindándote
                        asesoramiento y confianza.</p>
                </div>
            </div>

            <div class="row align-items-center mb-5 py-4 border-top border-secondary">
                <div class="col-md-6 order-2 order-md-1">
                    <h3 class="mb-3"><i class="bi bi-bullseye me-2" style="color:#C0392B;"></i>Misión</h3>
                    <p>Nuestra misión es acercar instrumentos de calidad y asesoramiento especializado a todas las
                        personas que viven la música como una forma de expresión e identidad.</p>
                    <p>Buscamos inspirar a músicos brindando un catálogo seleccionado que garantiza excelencia,
                        durabilidad y el respaldo de marcas reconocidas mundialmente.</p>
                </div>
                <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
                    <img src="{{ asset('images/mision.webp') }}" alt="Misión Soundwave Store"
                        class="img-fluid rounded shadow border border-secondary">
                </div>
            </div>

            <div class="row align-items-center mb-5 py-4 border-top border-secondary">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/vision.webp') }}" alt="Visión Soundwave Store"
                        class="img-fluid rounded shadow border border-secondary">
                </div>
                <div class="col-md-6">
                    <h3 class="mb-3"><i class="bi bi-eye-fill me-2" style="color:#E8C547;"></i>Visión</h3>
                    <p>Soñamos con un mundo donde la música sea el puente que conecte a las personas. Nuestra visión es
                        convertirnos en el referente regional del comercio musical.</p>
                    <p>Aspiramos a construir una comunidad vibrante donde la pasión se encuentre con la innovación,
                        acompañando a cada cliente desde sus primeros acordes hasta los grandes escenarios.</p>
                </div>
            </div>

            <div class="pt-4 border-top border-secondary">
                <h2 class="text-center mb-5">Personas que inspiran nuestra música</h2>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-dark text-light h-100 border-secondary shadow-sm text-center p-3">
                            <img src="{{ asset('images/Fundador.webp') }}"
                                class="rounded-circle mx-auto mb-3 border border-danger" alt="Juan Pérez"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            <h5 class="card-title texto-rojo">Juan Pérez</h5>
                            <small class="text-secondary uppercase mb-3 d-block">Fundador y Director</small>
                            <p class="card-text small">Juan dio vida a Soundwave Store con la idea de crear un espacio
                                donde cada músico encuentre inspiración y atención personalizada.</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card bg-dark text-light h-100 border-secondary shadow-sm text-center p-3">
                            <img src="{{ asset('images/asesora.webp') }}"
                                class="rounded-circle mx-auto mb-3 border border-danger" alt="María López"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            <h5 class="card-title texto-rojo">María López</h5>
                            <small class="text-secondary uppercase mb-3 d-block">Asesora Musical</small>
                            <p class="card-text small">Músico y docente, María aporta su experiencia para guiar a cada
                                cliente en la elección del instrumento ideal para su nivel.</p>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card bg-dark text-light h-100 border-secondary shadow-sm text-center p-3">
                            <img src="{{ asset('images/responsable-ventas.webp') }}"
                                class="rounded-circle mx-auto mb-3 border border-danger" alt="Carlos Gómez"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            <h5 class="card-title texto-rojo">Carlos Gómez</h5>
                            <small class="text-secondary uppercase mb-3 d-block">Responsable de Ventas</small>
                            <p class="card-text small">Se encarga de que cada compra sea fluida y confiable, reflejando
                                el espíritu de servicio que nos distingue.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
