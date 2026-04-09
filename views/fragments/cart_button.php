<?php
function cart_button() {
    $cartCount = $_SESSION['cart_count'] ?? 0;
    ?>
    <li class="nav-item">
        <a class="nav-link position-relative" href="#" onclick="showCartModal(); return false;">
            🛒 Cart
            <?php if ($cartCount > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $cartCount ?>
                </span>
            <?php endif; ?>
        </a>
    </li>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">🛒 Your Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="cartModalBody" style="max-height: 400px; overflow-y: auto;">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-2">Loading cart...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/cart" class="btn btn-primary">View Full Cart</a>
                    <button class="btn btn-success" onclick="checkout()">Checkout 🚀</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function showCartModal() {
        const modal = new bootstrap.Modal(document.getElementById('cartModal'));
        modal.show();
        
        fetch('/cart/items')
            .then(response => response.json())
            .then(data => {
                if (data.items && data.items.length > 0) {
                    let html = '<div class="cart-items-list">';
                    data.items.forEach(item => {
                        html += `
                                <div class="d-flex align-items-center mb-3 pb-2 border-bottom" data-item-id="${item.id}">
                                    <img src="${item.image}" style="width: 60px; height: 60px; object-fit: contain;" class="me-3">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">${item.name}</h6>
                                        <small class="text-muted">Qty: ${item.quantity}</small>
                                    </div>
                                    <div class="text-end">
                                        <strong>$${item.total}</strong>
                                        <button class="btn btn-sm btn-danger ms-2" onclick="removeFromCart(${item.id})">×</button>
                                    </div>
                                </div>
                            `;
                    });
                    html += `
                        <div class="mt-3 pt-2 border-top">
                            <div class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong class="text-primary">$${data.total}</strong>
                            </div>
                        </div>
                    `;
                    document.getElementById('cartModalBody').innerHTML = html;
                } else {
                    document.getElementById('cartModalBody').innerHTML = `
                        <div class="text-center py-4">
                            <p>Your cart is empty</p>
                            <a href="/catalog" class="btn btn-primary btn-sm">Browse Products</a>
                        </div>
                    `;
                }
            });
    }
    
function removeFromCart(itemId) {
    fetch('/cart/remove', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ cart_item_id: itemId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the item element directly from DOM
            const itemElement = document.querySelector(`[data-item-id="${itemId}"]`);
            if (itemElement) {
                itemElement.remove();
            }
            
            // Update totals without reloading modal
            fetch('/cart/items')
                .then(response => response.json())
                .then(cartData => {
                    // Update total price
                    const totalElement = document.querySelector('#cartModalBody .total-price');
                    if (totalElement) {
                        totalElement.textContent = `$${cartData.total}`;
                    }
                    
                    // Update item count
                    const count = cartData.items.length;
                    const badge = document.querySelector('.nav-link .badge');
                    if (badge) {
                        if (count > 0) {
                            badge.textContent = count;
                        } else {
                            badge.style.display = 'none';
                        }
                    }
                    
                    // If cart is empty, show empty message
                    if (count === 0) {
                        document.getElementById('cartModalBody').innerHTML = `
                            <div class="text-center py-4">
                                <p>Your cart is empty</p>
                                <a href="/catalog" class="btn btn-primary btn-sm">Browse Products</a>
                            </div>
                        `;
                    }
                });
        }
    });
}

function updateCartCount() {
    fetch('/cart/items')
        .then(response => response.json())
        .then(data => {
            const count = data.items ? data.items.length : 0;
            const badge = document.querySelector('.nav-link .badge');
            if (badge) {
                if (count > 0) {
                    badge.textContent = count;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }
            }
        });
}
    
    function checkout() {
        window.location.href = '/checkout';
    }
    </script>
<?php
}