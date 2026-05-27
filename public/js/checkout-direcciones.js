function evaluarDireccionNueva(select) {
    const bloque = document.getElementById('bloque-nueva-direccion');
    const inputs = bloque.querySelectorAll('input, select');

    if (select.value === 'nueva_direccion') {
        // Mostrar bloque y habilitar inputs para que viajen en el request
        bloque.classList.remove('hidden');
        inputs.forEach(input => {
            if(input.id !== 'select-ciudad-checkout') input.disabled = false;
            input.required = true;
        });
    } else {
        // Ocultar bloque y deshabilitar inputs (así Laravel no valida campos vacíos ocultos)
        bloque.classList.add('hidden');
        inputs.forEach(input => {
            input.disabled = true;
            input.required = false;
        });
    }
}

function cargarCiudadesCheckout(selectProvincia) {
    const selectCiudad = document.getElementById('select-ciudad-checkout');
    const provinciaId = selectProvincia.value;

    if (!provinciaId) return;

    selectCiudad.disabled = true;
    selectCiudad.innerHTML = '<option value="" disabled selected>Cargando ciudades...</option>';

    // Reutilizamos la misma ruta tipo API que creamos anteriormente en web.php
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
            console.error("Error:", error);
            selectCiudad.innerHTML = '<option value="" disabled selected>Error al cargar</option>';
        });
}