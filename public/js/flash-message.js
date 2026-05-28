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

document.addEventListener('DOMContentLoaded', function () {
    
    // ... Mantén aquí arriba tu código existente que oculta el #flash-message después de 3 segundos ...

    // NUEVO BLOQUE PARA VACIAR EL CARRITO (Con delegación de eventos)
    document.addEventListener('click', function (event) {
        // Verificamos si el elemento clickeado (o su icono interno) es el botón de vaciar
        const btnVaciar = event.target.closest('#btn-vaciar-carrito');
        
        if (btnVaciar) {
            const formVaciar = document.getElementById('form-vaciar-carrito');
            
            if (formVaciar) {
                // Prevenimos cualquier acción por defecto
                event.preventDefault();

                // Disparar SweetAlert2
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Se eliminarán todos los productos de tu carrito.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, vaciar',
                    cancelButtonText: 'Cancelar',
                    background: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#212529' : '#ffffff',
                    color: document.documentElement.getAttribute('data-bs-theme') === 'dark' ? '#ffffff' : '#212529'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formVaciar.submit();
                    }
                });
            }
        }
    });

});