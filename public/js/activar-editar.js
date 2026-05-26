const app = document.getElementById('perfil-app');
const tieneErrores = app.dataset.tieneErrores === 'true';

function activarEdicion() {
    document.getElementById('modo-vista').classList.add('hidden');
    document.getElementById('modo-edicion').classList.remove('hidden');
}

function cancelarEdicion() {
    document.getElementById('modo-edicion').classList.add('hidden');
    document.getElementById('modo-vista').classList.remove('hidden');
}

if (tieneErrores) {
    activarEdicion();
}
