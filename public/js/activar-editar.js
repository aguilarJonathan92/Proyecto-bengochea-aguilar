const app = document.getElementById('perfil-app');
const tieneErrores = app.dataset.tieneErrores === 'true';

let contadorDirecciones = 0;

function activarEdicion() {
    document.getElementById('modo-vista').classList.add('hidden');
    document.getElementById('modo-edicion').classList.remove('hidden');
}

function cancelarEdicion() {
    document.getElementById('modo-edicion').classList.add('hidden');
    document.getElementById('modo-vista').classList.remove('hidden');
    
    // Al cancelar, limpiamos los cambios temporales y restauramos las direcciones originales
    restaurarDireccionesOriginales();
}

if (tieneErrores) {
    activarEdicion();
}

// ==========================================
// LÓGICA COMPLEMENTARIA PARA DIRECCIONES DINAMICAS
// ==========================================

function agregarDireccion(data = null) {
    const contenedor = document.getElementById('contenedor-direcciones');
    const template = document.getElementById('template-direccion').innerHTML;

    const datosHTML = {
        index: contadorDirecciones,
        numero: contadorDirecciones + 1,
        id: data ? data.id : '',
        alias: data ? data.alias : '',
        street: data ? data.street : '',
        postal_code: data ? data.postal_code : '',
        checked: data && data.is_default ? 'checked' : ''
    };

    let htmlRenderizado = template
        .replace(/{index}/g, datosHTML.index)
        .replace(/{numero}/g, datosHTML.numero)
        .replace(/{id}/g, datosHTML.id)
        .replace(/{alias}/g, datosHTML.alias)
        .replace(/{street}/g, datosHTML.street)
        .replace(/{postal_code}/g, datosHTML.postal_code)
        .replace(/{checked}/g, datosHTML.checked);

    contenedor.insertAdjacentHTML('beforeend', htmlRenderizado);

    // Capturamos la tarjeta que acabamos de insertar
    const cardActual = contenedor.querySelector(`.posicion-direccion[data-index="${contadorDirecciones}"]`);
    const selectProvincia = cardActual.querySelector('.select-provincia');
    const selectCiudad = cardActual.querySelector('.select-ciudad');

    // SI LA DIRECCIÓN YA EXISTÍA EN LA BASE DE DATOS:
    if (data && data.city && data.city.province_id) {
        // 1. Seleccionar la provincia guardada
        selectProvincia.value = data.city.province_id;
        
        // 2. Cargar las ciudades de esa provincia y preseleccionar la ciudad guardada
        fetch(`/api/provincias/${data.city.province_id}/ciudades`)
            .then(response => response.json())
            .then(ciudades => {
                selectCiudad.innerHTML = '<option value="" disabled>Selecciona Ciudad...</option>';
                ciudades.forEach(ciudad => {
                    const option = document.createElement('option');
                    option.value = ciudad.id;
                    option.text = ciudad.name;
                    if (ciudad.id === data.city_id) {
                        option.selected = true;
                    }
                    selectCiudad.appendChild(option);
                });
                selectCiudad.disabled = false;
            });
    }

    contadorDirecciones++;
}

// FUNCIÓN QUE SE ACTIVA CUANDO EL USUARIO CAMBIA LA PROVINCIA DE FORMA MANUAL
function cargarCiudadesDinamico(selectProvincia) {
    const card = selectProvincia.closest('.posicion-direccion');
    const selectCiudad = card.querySelector('.select-ciudad');
    const provinciaId = selectProvincia.value;

    if (!provinciaId) return;

    selectCiudad.disabled = true;
    selectCiudad.innerHTML = '<option value="" disabled selected>Cargando ciudades...</option>';

    // Hacemos la consulta asíncrona al método del controlador que creamos
    fetch(`/api/provincias/${provinciaId}/ciudades`)
        .then(response => response.json())
        .then(ciudades => {
            selectCiudad.innerHTML = '<option value="" disabled selected>Selecciona Ciudad...</option>';
            
            ciudades.forEach(ciudad => {
                const option = document.createElement('option');
                option.value = ciudad.id;
                option.text = ciudad.name;
                selectCiudad.appendChild(option);
            });

            selectCiudad.disabled = false;
        })
        .catch(error => {
            console.error("Error cargando ciudades:", error);
            selectCiudad.innerHTML = '<option value="" disabled selected>Error al cargar</option>';
        });
}

function eliminarDireccionElemento(boton) {
    const card = boton.closest('.posicion-direccion');
    card.remove();
    reindexarDirecciones();
}

function reindexarDirecciones() {
    const contenedor = document.getElementById('contenedor-direcciones');
    const cards = contenedor.querySelectorAll('.posicion-direccion');
    contadorDirecciones = 0;

    cards.forEach((card, idx) => {
        card.setAttribute('data-index', idx);
        card.querySelector('.fw-bold').innerText = `Dirección #${idx + 1}`;

        card.querySelectorAll('input, select').forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const nuevoName = name.replace(/addresses\[\d+\]/, `addresses[${idx}]`);
                input.setAttribute('name', nuevoName);
            }
            
            if (input.type === 'checkbox') {
                input.setAttribute('id', `def-${idx}`);
                const label = card.querySelector('label');
                if (label) label.setAttribute('for', `def-${idx}`);
            }
        });
        contadorDirecciones++;
    });
}

function restaurarDireccionesOriginales() {
    const contenedor = document.getElementById('contenedor-direcciones');
    if (!contenedor) return;

    contenedor.innerHTML = '';
    contadorDirecciones = 0;

    if (typeof direccionesIniciales !== 'undefined' && direccionesIniciales.length > 0) {
        direccionesIniciales.forEach(dir => agregarDireccion(dir));
    }
}

document.addEventListener("DOMContentLoaded", function() {
    restaurarDireccionesOriginales();
});

// Escucha cuando se hace click en cualquier checkbox de predeterminado
document.addEventListener('change', function(e) {
    if (e.target && e.target.classList.contains('form-check-input') && e.target.name.includes('[is_default]')) {
        // Si el checkbox fue marcado (true)
        if (e.target.checked) {
            const contenedor = document.getElementById('contenedor-direcciones');
            const todosLosCheckboxes = contenedor.querySelectorAll('input[type="checkbox"]');
            
            // Destildamos absolutamente todos los DEMÁS checkboxes de la sección
            todosLosCheckboxes.forEach(cb => {
                if (cb !== e.target) {
                    cb.checked = false;
                }
            });
        }
    }
});