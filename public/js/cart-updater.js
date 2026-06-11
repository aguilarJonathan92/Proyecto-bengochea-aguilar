/**
 * Maneja la actualización dinámica de cantidades respetando el stock.
 */
document.addEventListener('DOMContentLoaded', function () {

    // 1. DECREMENTO (-)
    document.querySelectorAll('.btn-qty-decrement').forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            const input = document.querySelector(`.input-qty-cart[data-item-id="${itemId}"]`);
            const cardBody = input.closest('.card-body');
            const maxAlert = cardBody.querySelector('.label-stock-max');
            const typeAlert = cardBody.querySelector('.label-type-err');
            let value = parseInt(input.value);

            typeAlert.classList.add('d-none');

            if (value > 1) {
                input.value = value - 1;
                maxAlert.classList.add('d-none');
                updateCartQuantity(itemId, input.value, input);
            }
        });
    });

    // 2. INCREMENTO (+)
    document.querySelectorAll('.btn-qty-increment').forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            const input = document.querySelector(`.input-qty-cart[data-item-id="${itemId}"]`);
            const cardBody = input.closest('.card-body');
            const maxAlert = cardBody.querySelector('.label-stock-max');
            const typeAlert = cardBody.querySelector('.label-type-err');
            const max = parseInt(input.getAttribute('max'));
            let value = parseInt(input.value);

            typeAlert.classList.add('d-none');

            if (value < max) {
                input.value = value + 1;
                maxAlert.classList.add('d-none');
                updateCartQuantity(itemId, input.value, input);
            } else {
                maxAlert.classList.remove('d-none');
            }
        });
    });

    // 3. INPUT MANUAL (oninput — validación en tiempo real)
    document.querySelectorAll('.input-qty-cart').forEach(input => {
        input.addEventListener('input', function () {
            const cardBody = this.closest('.card-body');
            const maxAlert = cardBody.querySelector('.label-stock-max');
            const typeAlert = cardBody.querySelector('.label-type-err');
            const max = parseInt(this.getAttribute('max'));

            if (this.value === '') {
                typeAlert.classList.remove('d-none');
                maxAlert.classList.add('d-none');
                return;
            }

            typeAlert.classList.add('d-none');
            let value = parseInt(this.value);

            if (value < 1) {
                this.value = 1;
                maxAlert.classList.add('d-none');
            } else if (value > max) {
                this.value = max;
                maxAlert.classList.remove('d-none');
            } else {
                maxAlert.classList.add('d-none');
            }
        });

        // 4. CHANGE — dispara el AJAX cuando el usuario termina de escribir
        input.addEventListener('change', function () {
            const itemId = this.getAttribute('data-item-id');
            let value = parseInt(this.value);
            const max = parseInt(this.getAttribute('max'));
            const initialValue = parseInt(this.getAttribute('data-initial-value'));

            if (isNaN(value) || value < 1) {
                this.value = 1;
                value = 1;
            } else if (value > max) {
                this.value = max;
                value = max;
            }

            if (value !== initialValue) {
                updateCartQuantity(itemId, value, this);
            }
        });
    });

    // 5. AJAX — actualización en base de datos y refresco del DOM
    function updateCartQuantity(itemId, quantity, inputElement) {
        const url = `/cart/update/${itemId}`;
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        if (!csrfToken) {
            console.error('Error: No se encontró el meta tag del CSRF token.');
            return;
        }

        fetch(url, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ quantity: parseInt(quantity) })
        })
        .then(async response => {
            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.error || 'Error en el servidor');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                inputElement.setAttribute('data-initial-value', quantity);

                const itemCard = document.querySelector(`.item-cart-card[data-item-id="${itemId}"]`);
                if (itemCard) {
                    const itemTotalDisplay = itemCard.querySelector('.item-total-display');
                    if (itemTotalDisplay) itemTotalDisplay.textContent = data.formatted_item_total;
                }

                const subtotalDisplay = document.querySelector('.cart-subtotal-display');
                const totalDisplay = document.querySelector('.cart-total-display');
                if (subtotalDisplay) subtotalDisplay.textContent = data.formatted_subtotal;
                if (totalDisplay) totalDisplay.textContent = data.formatted_subtotal;

                // =========================================================================
                // ACTUALIZACIÓN DINÁMICA DEL BADGE GLOBAL (MEJORADO)
                // =========================================================================
                const cartBadge = document.getElementById('global-cart-badge');
                const totalQuantity = parseInt(data.total_quantity) || 0;

                if (cartBadge) {
                    // Actualizamos el número del contador con la respuesta del servidor
                    cartBadge.textContent = totalQuantity;

                    // Si el carrito se quedó vacío, ocultamos el badge y recargamos
                    if (totalQuantity <= 0) {
                        cartBadge.classList.add('d-none');

                        // Forzamos una recarga rápida para que Blade dibuje el estado "Carrito Vacío"
                        setTimeout(() => {
                            window.location.reload();
                        }, 300);
                    } else {
                        cartBadge.classList.remove('d-none');
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error al actualizar el carrito:', error);
            alert(error.message || 'Ocurrió un error al actualizar la cantidad.');
            inputElement.value = inputElement.getAttribute('data-initial-value');
        });
    }

});
