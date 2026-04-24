<x-layout>
    <x-slot name="title">Acerca De</x-slot>
    <div class="container p-2 p-md-4 px-lg-5 my-4 pages-decoration">
        <!-- Sección principal -->
        <div class=" text-light my-4 px-3 px-md-5 pb-4 border-bottom">
            <h2 class="text-center text-light py-4">Quiénes Somos</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('images/empresa.webp') }}" 
                         alt="Equipo Soundwave Store" 
                         class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6">
                    <p>En <strong class="texto-rojo text-uppercase">Soundwave Store</strong> creemos que la música no es solo sonido: es emoción, identidad y conexión. Nacimos con la misión de acercar instrumentos de calidad a quienes buscan expresarse, crear y vivir la experiencia musical en todas sus formas.</p>
                    <p>Somos más que una tienda en línea: somos un espacio para artistas, estudiantes y apasionados de la música que desean encontrar el instrumento perfecto para su viaje creativo. Cada producto que ofrecemos está cuidadosamente seleccionado para garantizar excelencia, durabilidad y respaldo de marcas reconocidas.</p>
                    <p>Nuestro compromiso es acompañarte desde el primer acorde hasta el escenario, brindándote asesoramiento, confianza y la seguridad de que tu compra está en manos de especialistas que comparten tu misma pasión.</p>
                    <p>En <strong class="texto-rojo text-uppercase">Soundwave Store</strong>, cada instrumento cuenta una historia. Queremos ser parte de la tuya.</p>
                </div>
            </div>
        </div>
        <!-- Misión -->
        <div class=" text-light my-4 px-3 px-md-5 pb-4 border-bottom">
            <h2 class="text-center text-light py-4"><i class="bi bi-bullseye" style="font-size:2rem; color:#C0392B;"></i> Misión</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>En <strong class="texto-rojo text-uppercase">Soundwave Store</strong>, creemos que cada nota puede transformar una historia. Nuestra misión es acercar instrumentos de calidad y asesoramiento especializado a todas las personas que viven la música como una forma de expresión, identidad y conexión.</p>
                    <p>Nos apasiona inspirar a músicos, estudiantes y aficionados, brindando un espacio donde puedan descubrir el instrumento ideal para su viaje creativo. Cada producto que ofrecemos está cuidadosamente seleccionado para garantizar excelencia, durabilidad y el respaldo de marcas reconocidas.</p>
                    <p>Más que vender instrumentos, buscamos acompañarte en cada paso de tu evolución musical, compartiendo conocimiento, confianza y la misma pasión que te impulsa a crear.</p>
                </div>

                <div class="col-md-6">
                    <img src="{{ asset('images/mision.webp') }}" 
                         alt="Equipo Soundwave Store" 
                         class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
        <!-- Misión -->
        <div class=" text-light my-4 px-3 px-md-5 pb-4 border-bottom">
            <h2 class="text-center text-light py-4"><i class="bi bi-eye-fill" style="font-size:2rem; color:#E8C547;"></i> Visión</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('images/vision.webp') }}" 
                         alt="Equipo Soundwave Store" 
                         class="img-fluid rounded shadow">
                </div>

                <div class="col-md-6">
                    <p>En <strong class="texto-rojo text-uppercase">Soundwave Store</strong>, soñamos con un mundo donde la música sea el puente que conecte a las personas, las culturas y las emociones. Nuestra visión es convertirnos en el referente regional del comercio musical, ofreciendo una experiencia que inspire a cada artista a alcanzar su máximo potencial.</p>
                    <p>Queremos ser más que una tienda: aspiramos a construir una comunidad vibrante de músicos, donde la pasión se encuentre con la innovación. Buscamos acompañar a cada cliente desde sus primeros acordes hasta los grandes escenarios, impulsando su crecimiento con tecnología, calidad y compromiso.</p>
                    <p>Creemos que el futuro de la música se escribe con cada nota, y queremos estar presentes en cada una de ellas.</p>
                </div>
            </div>
        </div>
            
        <!-- Equipo -->
        <div class="container my-5 text-light">
            <h2 class="text-center mb-4">Personas que inspiran nuestra música</h2>
            <div class="row justify-content-center">
                <!-- Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-light h-100 shadow text-center p-3">
                        <img src="{{ asset('images/Fundador.webp') }}" 
                            class="rounded-circle mx-auto mb-3 shadow" 
                            alt="Fundador Soundwave Store" 
                            width="250" height="250">
                        <h5 class="card-title texto-rojo">Juan Pérez</h5>
                        <p class="card-subtitle mb-2 text-light">Fundador y Director</p>
                        <p class="card-text mt-3">Apasionado por la música y la tecnología, Juan dio vida a Soundwave Store con la idea de crear un espacio donde cada músico encuentre inspiración. Su visión combina calidad, innovación y atención personalizada para cada cliente.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-light h-100 shadow text-center p-3">
                        <img src="{{ asset('images/asesora.webp') }}" 
                            class="rounded-circle mx-auto mb-3 shadow" 
                            alt="Asesora Musical Soundwave Store" 
                            width="250" height="250">
                        <h5 class="card-title texto-rojo">María López</h5>
                        <p class="card-subtitle mb-2 text-light">Asesora Musical</p>
                        <p class="card-text mt-3">Músico y docente, María aporta su experiencia para guiar a cada cliente en la elección del instrumento ideal. Su compromiso es ayudar a transformar la pasión por la música en una experiencia auténtica y duradera.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card bg-dark text-light h-100 shadow text-center p-3">
                        <img src="{{ asset('images/responsable-ventas.webp') }}" 
                            class="rounded-circle mx-auto mb-3 shadow" 
                            alt="Responsable de Ventas Soundwave Store" 
                            width="250" height="250">
                        <h5 class="card-title texto-rojo">Carlos Gómez</h5>
                        <p class="card-subtitle mb-2 text-light">Responsable de Ventas</p>
                        <p class="card-text mt-3">Con una sólida trayectoria en comercio y atención al cliente, Carlos se encarga de que cada compra sea fluida y confiable. Su energía y dedicación reflejan el espíritu de servicio que distingue a Soundwave Store.</p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</x-layout>
