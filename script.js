// Obtener elementos del DOM
const productCards = document.querySelectorAll('.product-card');
const modalOverlay = document.getElementById('productModal');
const modalClose = document.getElementById('modalClose');
const modalImage = document.getElementById('modalImage');
const modalProductName = document.getElementById('modalProductName');
const modalProductCategory = document.getElementById('modalProductCategory');
const modalProductDescription = document.getElementById('modalProductDescription');
const modalProductPrice = document.getElementById('modalProductPrice');
const quantityInput = document.getElementById('quantity');
const decreaseQuantityBtn = document.getElementById('decreaseQuantity');
const increaseQuantityBtn = document.getElementById('increaseQuantity');
const modalAddToCartBtn = document.getElementById('modalAddToCart');
const cartModal = document.getElementById('cartModal');
const cartModalClose = document.getElementById('cartModalClose');
const cartItems = document.getElementById('cartItems');
const cartTotal = document.getElementById('cartTotal');
const continueShoppingBtn = document.getElementById('continueShoppingBtn');
const checkoutBtn = document.getElementById('checkoutBtn');
const cartIcon = document.querySelector('.cart-icon');
const cartCount = document.querySelector('.cart-count');
const sizeButtons = document.querySelectorAll('.size-btn');

let cart = [];
let selectedSize = null;

// Agregar event listeners a las tarjetas de productos
productCards.forEach(card => {
    card.addEventListener('click', (e) => {
        // Prevenir acción por defecto si se hace clic en el botón de añadir al carrito
        if (e.target.classList.contains('add-to-cart') || e.target.closest('.add-to-cart')) {
            e.stopPropagation();
            e.preventDefault();
            const productId = parseInt(card.dataset.productId);
            const productName = card.dataset.productName;
            const productPrice = parseFloat(card.dataset.productPrice);
            const productImage = card.dataset.productImage;
            addToCart({ id: productId, name: productName, price: productPrice, image: productImage }, 1);
            alert(`¡${productName} añadido a tu carrito!`);
            return;
        }
        
        // Obtener datos del producto de los atributos data
        const productId = card.dataset.productId;
        const productName = card.dataset.productName;
        const productCategory = card.dataset.productCategory;
        const productPrice = card.dataset.productPrice;
        const productImage = card.dataset.productImage;
        const productDescription = card.dataset.productDescription;
        
        // Poblar el modal con los datos del producto
        modalImage.src = productImage;
        modalImage.alt = productName;
        modalProductName.textContent = productName;
        modalProductName.dataset.productId = productId;
        modalProductCategory.textContent = productCategory;
        modalProductDescription.textContent = productDescription;
        modalProductPrice.textContent = `$${productPrice}`;
        
        // Resetear cantidad a 1
        quantityInput.value = 1;
        selectedSize = null;
        sizeButtons.forEach(btn => btn.classList.remove('active'));
        
        // Mostrar modal
        modalOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });
});

// Evento para capturar la talla seleccionada
sizeButtons.forEach(button => {
    button.addEventListener('click', () => {
        sizeButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        selectedSize = button.dataset.size;
        console.log(`Talla seleccionada: ${selectedSize}`);
    });
});

// Cuando se agrega al carrito
modalAddToCartBtn.addEventListener('click', () => {
    if (!selectedSize) {
        alert('Por favor, selecciona una talla antes de añadir al carrito.');
        return;
    }

    const productId = parseInt(modalProductName.dataset.productId);
    const productName = modalProductName.textContent;
    const productPrice = parseFloat(modalProductPrice.textContent.replace('$', ''));
    const productImage = modalImage.src;
    const quantity = parseInt(quantityInput.value);

    addToCart({ id: productId, name: productName, price: productPrice, image: productImage, size: selectedSize }, quantity);
    alert(`¡${quantity} ${productName}(s) de talla ${selectedSize} añadido(s) a tu carrito!`);
    closeModal();
});

// Cerrar modal al hacer clic en el botón de cerrar
modalClose.addEventListener('click', () => {
    closeModal();
});

// Cerrar modal al hacer clic fuera del contenido del modal
modalOverlay.addEventListener('click', (e) => {
    if (e.target === modalOverlay) {
        closeModal();
    }
});

// Cerrar modal al presionar la tecla Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modalOverlay.classList.contains('active')) {
        closeModal();
    }
});

// Función para cerrar el modal
function closeModal() {
    modalOverlay.classList.remove('active');
    document.body.style.overflow = '';
}

// Controles de cantidad
decreaseQuantityBtn.addEventListener('click', () => {
    if (quantityInput.value > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    }
});

increaseQuantityBtn.addEventListener('click', () => {
    if (quantityInput.value < 10) {
        quantityInput.value = parseInt(quantityInput.value) + 1;
    }
});

// Asegurar que la entrada de cantidad se mantenga dentro del rango
quantityInput.addEventListener('change', () => {
    let value = parseInt(quantityInput.value);
    if (isNaN(value) || value < 1) {
        quantityInput.value = 1;
    } else if (value > 10) {
        quantityInput.value = 10;
    }
});

function updateCartIcon() {
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCount.textContent = totalItems;
}

function addToCart(product, quantity) {
    const existingItem = cart.find(item => item.id === product.id && item.size === product.size);
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({ ...product, quantity });
    }
    updateCartIcon();
}

function removeFromCart(productId, productSize) {
    cart = cart.filter(item => !(item.id === productId && item.size === productSize));
    updateCartIcon();
    renderCart();
}

function updateCartItemQuantity(productId, productSize, newQuantity) {
    const item = cart.find(item => item.id === productId && item.size === productSize);
    if (item) {
        item.quantity = Math.max(1, Math.min(10, newQuantity));
        updateCartIcon();
        renderCart();
    }
}

function renderCart() {
    if (cart.length === 0) {
        cartItems.innerHTML = '<p class="empty-cart-message">Tu carrito está vacío.</p>';
        cartTotal.textContent = '0.00';
        return;
    }

    cartItems.innerHTML = cart.map(item => `
        <div class="cart-item">
            <img src="${item.image}" alt="${item.name}" class="cart-item-image">
            <div class="cart-item-info">
                <div class="cart-item-name">${item.name}</div>
                ${item.size ? `<div class="cart-item-size">Talla: ${item.size}</div>` : ''}
                <div class="cart-item-price">$${item.price.toFixed(2)}</div>
                <div class="cart-item-quantity">
                    <button class="cart-quantity-btn" onclick="updateCartItemQuantity(${item.id}, '${item.size || ''}', ${item.quantity - 1})">-</button>
                    <input type="number" class="cart-quantity-input" value="${item.quantity}" min="1" max="10" onchange="updateCartItemQuantity(${item.id}, '${item.size || ''}', parseInt(this.value))">
                    <button class="cart-quantity-btn" onclick="updateCartItemQuantity(${item.id}, '${item.size || ''}', ${item.quantity + 1})">+</button>
                </div>
            </div>
            <div class="cart-item-total">$${(item.price * item.quantity).toFixed(2)}</div>
            <button class="btn" onclick="removeFromCart(${item.id}, '${item.size || ''}')">Eliminar</button>
        </div>
    `).join('');

    const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    cartTotal.textContent = total.toFixed(2);
}

function openCartModal() {
    renderCart();
    cartModal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeCartModal() {
    cartModal.classList.remove('active');
    document.body.style.overflow = '';
}

cartIcon.addEventListener('click', (e) => {
    e.preventDefault();
    openCartModal();
});

cartModalClose.addEventListener('click', closeCartModal);

continueShoppingBtn.addEventListener('click', closeCartModal);

checkoutBtn.addEventListener('click', () => {
    if (cart.length === 0) {
        alert('Tu carrito está vacío. Añade algunos productos antes de finalizar la compra.');
        return;
    }

    const message = encodeURIComponent(`¡Hola! Me gustaría hacer un pedido de los siguientes productos:\n\n${cart.map(item => `${item.name} ${item.size ? `(Talla: ${item.size})` : ''} x${item.quantity} - $${(item.price * item.quantity).toFixed(2)}`).join('\n')}\n\nTotal: $${cartTotal.textContent}`);
    
    window.open(`https://wa.me/+529971153510?text=${message}`, '_blank');
});

// Inicializar icono del carrito
updateCartIcon();