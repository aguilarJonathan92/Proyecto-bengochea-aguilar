/**
 * Maneja la actualización dinámica de cantidades respetando el stock.
 */
document.addEventListener('DOMContentLoaded', function () {
    
    // NOTA: Ya no hace falta el código de persistencia de sessionStorage 
    // porque al no recargarse la página, el Offcanvas nunca se cierra solo.

    // 1. CONTROL DEL BOTÓN DE DECREMENTO (-)
    document.querySelectorAll('.btn-qty-decrement').forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            const input = document.querySelector(`.input-qty-cart[data-item-id="${itemId}"]`);
            let currentValue = parseInt(input.value);
            
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateCartQuantity(itemId, input.value, input);
            }
        });
    });

    // 2. CONTROL DEL BOTÓN DE INCREMENTO (+)
    document.querySelectorAll('.btn-qty-increment').forEach(button => {
        button.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            const input = document.querySelector(`.input-qty-cart[data-item-id="${itemId}"]`);
            let currentValue = parseInt(input.value);
            let maxStock = parseInt(input.getAttribute('max'));
            
            if (currentValue < maxStock) {
                input.value = currentValue + 1;
                updateCartQuantity(itemId, input.value, input);
            } else {
                alert(`No puedes agregar más de este producto. Stock máximo disponible: ${maxStock}`);
            }
        });
    });

    // 3. CONTROL DE CAMBIO MANUAL
    document.querySelectorAll('.input-qty-cart').forEach(input => {
        input.addEventListener('change', function () {
            const itemId = this.getAttribute('data-item-id');
            let value = parseInt(this.value);
            let maxStock = parseInt(this.getAttribute('max'));
            let initialValue = parseInt(this.getAttribute('data-initial-value'));

            if (isNaN(value) || value < 1) {
                this.value = 1;
                value = 1;
            } else if (value > maxStock) {
                alert(`Límite de stock superado. El inventario disponible es de ${maxStock} unidades.`);
                this.value = maxStock;
                value = maxStock;
            }

            if (value !== initialValue) {
                updateCartQuantity(itemId, value, this);
            }
        });
    });

    // 4. PETICIÓN ASÍNCRONA Y ACTUALIZACIÓN EN TIEMPO REAL
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
                // Actualizamos el valor de respaldo por si el usuario vuelve a cambiarlo equívocamente
                inputElement.setAttribute('data-initial-value', quantity);

                // 1. Buscar la tarjeta de este producto específico y actualizar su precio total
                const itemCard = document.querySelector(`.item-cart-card[data-item-id="${itemId}"]`);
                if (itemCard) {
                    const itemTotalDisplay = itemCard.querySelector('.item-total-display');
                    if (itemTotalDisplay) {
                        itemTotalDisplay.textContent = data.formatted_item_total;
                    }
                }

                // 2. Actualizar los bloques del resumen de compra abajo
                const subtotalDisplay = document.querySelector('.cart-subtotal-display');
                const totalDisplay = document.querySelector('.cart-total-display');
                
                if (subtotalDisplay) subtotalDisplay.textContent = data.formatted_subtotal;
                if (totalDisplay) totalDisplay.textContent = data.formatted_subtotal; // El total es igual al subtotal (envío gratis)
            }
        })
        .catch(error => {
            console.error('Error al actualizar el carrito:', error);
            alert(error.message || 'Ocurrió un error al actualizar la cantidad.');
            // Revertimos el input al último valor seguro guardado en el backend
            inputElement.value = inputElement.getAttribute('data-initial-value');
        });
    }
});