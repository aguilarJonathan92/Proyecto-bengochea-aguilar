document.addEventListener('DOMContentLoaded', function () {
    const flashMessage = document.getElementById('flash-message');

    if (flashMessage) {
        // Espera 3 segundos (3000ms) y luego inicia la animación de salida
        setTimeout(() => {
            // Quitamos la animación de entrada y metemos la de salida de animate.css
            flashMessage.classList.remove('animate__fadeInUp');
            flashMessage.classList.add('animate__fadeOutDown');

            // Una vez que termina la animación de salida (0.5s), lo removemos del DOM
            flashMessage.addEventListener('animationend', function() {
                flashMessage.remove();
            });
        }, 3000);
    }
});