
let cart = [];

function addToCart(id, name, price) {
    const existingItem = cart.find(item => item.id === id);

    if (existingItem) {
        existingItem.qty++;
    } else {
        cart.push({ id, name, price, qty: 1 });
    }

    renderCart();
}

function addSelectedCombos() {
    const select = document.getElementById('combo-multi-select');
    if (!select) return;

    const selectedOptions = Array.from(select.selectedOptions);

    if (selectedOptions.length === 0) {
        alert('Por favor selecciona al menos un combo.');
        return;
    }

    selectedOptions.forEach(option => {
        const id = parseInt(option.value);
        const name = option.getAttribute('data-name');
        const price = parseFloat(option.getAttribute('data-price'));
        addToCart(id, name, price);
    });

    // Clear selection after adding
    select.selectedIndex = -1;
}

function renderCart() {
    const cartContainer = document.getElementById('cart-items');
    const emptyMsg = document.getElementById('empty-cart-msg');
    const totalAmount = document.getElementById('total-amount');
    const btnCheckout = document.getElementById('btn-checkout');

    if (!cartContainer || !emptyMsg || !totalAmount || !btnCheckout) return;

    if (cart.length === 0) {
        emptyMsg.style.display = 'flex';
        cartContainer.querySelectorAll('.cart-item').forEach(el => el.remove());
        btnCheckout.disabled = true;
        totalAmount.innerText = '$0.00';
        return;
    }

    emptyMsg.style.display = 'none';

    // Clear previous items but keep empty msg
    cartContainer.querySelectorAll('.cart-item').forEach(el => el.remove());

    let total = 0;

    cart.forEach(item => {
        total += item.price * item.qty;
        const itemEl = document.createElement('div');
        itemEl.className = 'cart-item';
        itemEl.innerHTML = `
            <div class="item-info">
                <h4>${item.name}</h4>
                <span class="item-price">$${item.price.toFixed(2)} x ${item.qty}</span>
            </div>
            <div class="item-controls">
                <button class="btn-qty" onclick="updateQty(${item.id}, -1)">-</button>
                <span style="font-weight: 700; width: 20px; text-align: center;">${item.qty}</span>
                <button class="btn-qty" onclick="updateQty(${item.id}, 1)">+</button>
            </div>
        `;
        cartContainer.appendChild(itemEl);
    });

    totalAmount.innerText = `$${total.toFixed(2)}`;
    btnCheckout.disabled = false;
}

function updateQty(id, delta) {
    const item = cart.find(i => i.id === id);
    if (item) {
        item.qty += delta;
        if (item.qty <= 0) {
            cart = cart.filter(i => i.id !== id);
        }
    }
    renderCart();
}
