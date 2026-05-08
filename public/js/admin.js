document.addEventListener('DOMContentLoaded', function() {
    // Usamos querySelector para buscar por clase, que es más seguro
    const sidebar = document.querySelector('.admin-sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const toggleIcon = document.getElementById('toggleIcon');
    const mainContent = document.querySelector('.admin-main-content');

    // IMPORTANTE: Verificamos que AMBOS existan antes de hacer nada
    if (toggleBtn && sidebar && mainContent) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('main-expanded');

            // Cambiar icono con validación
            if (toggleIcon) {
                if (sidebar.classList.contains('collapsed')) {
                    toggleIcon.classList.replace('fa-chevron-left', 'fa-chevron-right');
                } else {
                    toggleIcon.classList.replace('fa-chevron-right', 'fa-chevron-left');
                }
            }
        });
    } else {
        console.warn("No se encontraron los elementos del Sidebar. Revisa las clases en el HTML.");
    }
});