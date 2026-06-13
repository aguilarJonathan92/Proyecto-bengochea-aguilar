// public/js/product-stock-sync.js

function changeMainImage(thumbnail) {
    const mainImage = document.getElementById('mainImage');
    if (!mainImage) return;
    mainImage.src = thumbnail.src;
    document.querySelectorAll('.thumb-container').forEach(container => {
        container.classList.remove('active');
    });
    thumbnail.parentElement.classList.add('active');
}

function incrementQty() {
    const input = document.getElementById('quantity');
    const stockAlert = document.getElementById('stock-alert');
    const typeAlert = document.getElementById('type-alert');
    if (!input) return;

    const max = parseInt(input.getAttribute('max'));
    if (input.value === '') input.value = 0;
    if (typeAlert) typeAlert.classList.add('d-none');

    let value = parseInt(input.value);
    if (value < max) {
        input.value = value + 1;
        if (stockAlert) stockAlert.classList.add('d-none');
    } else {
        if (stockAlert) stockAlert.classList.remove('d-none');
    }
}

function decrementQty() {
    const input = document.getElementById('quantity');
    const stockAlert = document.getElementById('stock-alert');
    const typeAlert = document.getElementById('type-alert');
    if (!input) return;

    if (input.value === '') input.value = 2;
    if (typeAlert) typeAlert.classList.add('d-none');

    let value = parseInt(input.value);
    if (value > 1) {
        input.value = value - 1;
        if (stockAlert) stockAlert.classList.add('d-none');
    }
}

function validateKeyboardInput(input) {
    const stockAlert = document.getElementById('stock-alert');
    const typeAlert = document.getElementById('type-alert');
    const max = parseInt(input.getAttribute('max'));

    if (input.value === '') {
        if (typeAlert) typeAlert.classList.remove('d-none');
        if (stockAlert) stockAlert.classList.add('d-none');
        return;
    }
    if (typeAlert) typeAlert.classList.add('d-none');
    let value = parseInt(input.value);
    if (value < 1) {
        input.value = 1;
        if (stockAlert) stockAlert.classList.add('d-none');
    } else if (value > max) {
        input.value = max;
        if (stockAlert) stockAlert.classList.remove('d-none');
    } else {
        if (stockAlert) stockAlert.classList.add('d-none');
    }
}

/**
 * Función global adaptada para recibir el stock desde afuera
 */
function actualizarStockDesdeCarrito(cantidadEnCarrito, stockFisicoReal) {
    const disponible = Math.max(0, stockFisicoReal - cantidadEnCarrito);

    const container = document.getElementById('stock-status-container');
    const selector = document.getElementById('quantity-selector-container');
    const outOfStockBtn = document.getElementById('out-of-stock-button');
    const input = document.getElementById('quantity');

    if (container) {
        if (disponible > 5) {
            container.innerHTML = `<span class="text-success small fw-bold"><i class="bi bi-box-seam me-1"></i> Disponible (${disponible} unidades)</span>`;
        } else if (disponible > 1) {
            container.innerHTML = `<span class="text-warning small fw-bold"><i class="bi bi-exclamation-triangle me-1"></i> ¡Últimas ${disponible} unidades disponibles!</span>`;
        } else if (disponible === 1) {
            container.innerHTML = `<span class="text-warning small fw-bold"><i class="bi bi-x-circle me-1"></i> ¡Última unidad disponible!</span>`;
        } else {
            container.innerHTML = `<span class="text-danger small fw-bold"><i class="bi bi-x-circle me-1"></i> Agotado (Ya añadiste el máximo disponible a tu carrito)</span>`;
        }
    }

    if (disponible > 0) {
        if (selector) selector.classList.remove('d-none');
        if (outOfStockBtn) outOfStockBtn.classList.add('d-none');
        if (input) {
            input.setAttribute('max', disponible);
            if (parseInt(input.value) > disponible) input.value = disponible;
        }
    } else {
        if (selector) selector.classList.add('d-none');
        if (outOfStockBtn) outOfStockBtn.classList.remove('d-none');
    }
}
