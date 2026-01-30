<div class="pos-layout">
    <!-- Main Content Area -->
    <div class="pos-main">
        <!-- Header -->
        <header class="pos-header">
            <div class="header-info">
                <h1>Nueva Venta</h1>
                <p>Selecciona los productos para la orden actual</p>
            </div>

        </header>

        <!-- Products Grid -->
        <div class="products-grid custom-scrollbar">
            <?php foreach ($combos as $combo): ?>
                <div class="product-card"
                    onclick="addToCart(<?php echo $combo['id']; ?>, '<?php echo addslashes($combo['nombre']); ?>', <?php echo $combo['precio']; ?>)">
                    <div class="product-image"
                        style="background-image: url('https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=400&h=300&fit=crop');">
                        <button class="btn-info">
                            <i class="fa-solid fa-info"></i>
                        </button>
                        <?php if ($combo['stock'] < 20): ?>
                            <span class="badge-promo">¡Pocos boletos disponibles!</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-details">
                        <h3 class="product-title">
                            <?php echo $combo['nombre']; ?>
                        </h3>
                        <p class="product-desc">
                            <?php echo $combo['descripcion'] ?? 'Incluye hamburguesa, papas y refresco grande.'; ?>
                        </p>
                        <div class="product-meta">
                            <span class="product-price">$<?php echo number_format($combo['precio'], 2); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Right Sidebar: Cart -->
    <aside class="pos-sidebar">
        <div class="cart-header">
            <h2>Detalle de Orden</h2>
            <span class="order-id">ORD-<?php echo date('His'); ?></span>
        </div>

        <!-- Combo Multi-Selector -->
        <div style="padding: 1.5rem; border-bottom: 1px solid #f3f4f6;">
            <label
                style="font-size: 11px; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">Venta
                Rápida (Combos)</label>
            <select id="combo-multi-select" multiple
                style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.75rem; font-weight: 700; font-size: 14px; height: 120px; outline: none;">
                <?php foreach ($combos as $combo): ?>
                    <option value="<?php echo $combo['id']; ?>"
                        data-name="<?php echo htmlspecialchars($combo['nombre']); ?>"
                        data-price="<?php echo $combo['precio']; ?>">
                        <?php echo $combo['nombre']; ?> - $<?php echo number_format($combo['precio'], 2); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button onclick="addSelectedCombos()"
                style="width: 100%; margin-top: 0.75rem; padding: 0.75rem; background: v.$primary; background-color: #2b8cee; color: white; border: none; border-radius: 0.75rem; font-weight: 700; cursor: pointer; transition: all 0.2s;">
                <i class="fa-solid fa-plus" style="margin-right: 0.5rem;"></i>Añadir Seleccionados
            </button>
        </div>

        <!-- Physical Ticket Selection (Still needed for the sale) -->
        <div style="padding: 1.5rem; border-bottom: 1px solid #f3f4f6;">
            <label
                style="font-size: 11px; font-weight: 700; color: #9ca3af; text-transform: uppercase; margin-bottom: 0.5rem; display: block;">Asignar
                a Boleto Físico</label>
            <select
                style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 0.75rem; font-weight: 700; font-size: 14px; outline: none;">
                <option value="">Seleccionar número...</option>
                <?php foreach ($boletos as $boleto): ?>
                    <option value="<?php echo $boleto['id']; ?>">#<?php echo $boleto['numero']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="cart-items" id="cart-items">
            <!-- Empty State -->
            <div class="cart-empty" id="empty-cart-msg">
                <div class="empty-icon">
                    <i class="fa-solid fa-shopping-basket"></i>
                </div>
                <p>El carrito está vacío</p>
                <span>Agrega productos para comenzar</span>
            </div>
        </div>

        <div class="cart-summary">
            <div class="summary-total">
                <span>Total</span>
                <span class="total-amount" id="total-amount">$0.00</span>
            </div>

            <button class="btn-checkout" id="btn-checkout" disabled>
                <i class="fa-solid fa-cash-register"></i>
                Pagar y Finalizar
            </button>
        </div>
    </aside>


</div>