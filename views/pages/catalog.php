<?php require __DIR__ . "/../fragments/head.php"; ?>
<?php require __DIR__ . "/../fragments/navbar.php"; ?>

<!doctype html>
<html lang="en">
    <?php head("Pickpocket | Home", 'css/home.css') ?>
<body>

<!-- Floating Stickers/Coins Animation -->
<div class="stickers-container">
    <div class="sticker">🪙</div>
    <div class="sticker">💰</div>
    <div class="sticker">💵</div>
    <div class="sticker">🪙</div>
    <div class="sticker">💸</div>
    <div class="sticker">🪙</div>
    <div class="sticker">💰</div>
    <div class="sticker">💵</div>
    <div class="sticker">🪙</div>
    <div class="sticker">💸</div>
    <div class="sticker">🪙</div>
    <div class="sticker">💰</div>
</div>

<?php navbar(true) ?>

<!-- Catalog Header -->
<header class="catalog-header text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">📦 Product Catalog</h1>
        <p class="lead mb-0">Compare prices and choose where to buy the best deals!</p>
    </div>
</header>

<!-- Product Catalog Main Content -->
<main class="container my-5">
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <?php 
                    $id = $product->id;
                    $ref = $product->reference;
                    $image = $product->image;
                    $name = $product->name;
                ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 text-center shadow-sm border-0" onclick="showProductModal(<?= $id ?>)">
                        <div class="position-relative" style="height: 220px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.9);">
                            <img src="<?= htmlspecialchars($image) ?>" 
                                 class="card-img-top p-3" 
                                 alt="image"
                                 style="max-height: 100%; max-width: 100%; object-fit: contain;"
                                 onerror="this.onerror=null; this.src='/images/placeholder.jpg';" />
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($name) ?></h5>
                            <p class="text-muted small mb-3">Ref: <?= htmlspecialchars($ref) ?></p>
                            <button class="btn btn-primary mt-auto" onclick="event.stopPropagation(); showProductModal(<?= $id ?>)">
                                View Details 👀
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <div class="card p-5" style="background: rgba(255,255,255,0.95);">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#64748b" class="bi bi-box-seam" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.752a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 4.05v8.9a.5.5 0 0 1-.314.464l-7.129 2.852a1.5 1.5 0 0 1-1.114 0L.314 13.414A.5.5 0 0 1 0 12.95v-8.9a.5.5 0 0 1 .314-.464z"/>
                        </svg>
                    </div>
                    <h3 class="text-muted">No products found in the catalog</h3>
                    <p class="text-muted">Check back later for amazing deals!</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<!-- Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-white" id="productModalLabel">
                    <span id="modalProductTitle">Loading...</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                <div class="text-center text-white">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3">Loading product details...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
  function showProductModal(productId) {
    // Show modal first with loading state
    const modal = new bootstrap.Modal(document.getElementById('productModal'));
    modal.show();
    
    // Fetch product data via AJAX
    fetch(`/catalog/getProductAjax?id=${productId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Received data:', data);
            
            if (data.error) {
                document.getElementById('modalBody').innerHTML = `
                    <div class="text-center text-white">
                        <div class="alert alert-danger">
                            Error: ${data.error}
                        </div>
                    </div>
                `;
                document.getElementById('modalProductTitle').innerText = 'Error';
                return;
            }
            
            // Check if we have product data
            if (!data.product) {
                document.getElementById('modalBody').innerHTML = `
                    <div class="text-center text-white">
                        <div class="alert alert-warning">
                            No product data received
                        </div>
                    </div>
                `;
                return;
            }
            
            // Build the offers HTML
            let offersHtml = '';
            if (data.offers && data.offers.length > 0) {
                offersHtml = '<h5 class="text-white mb-3">💰 Available Offers</h5>';
                data.offers.forEach(offer => {
                    offersHtml += `
                        <div class="offer-card d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small">Provider Name: ${escapeHtml(offer.providerName)}</div>
                                <div class="text-muted small">Product ID: ${escapeHtml(offer.product_id)}</div>
                            </div>
                            <div class="text-end">
                                <div class="price-tag">$${parseFloat(offer.price).toFixed(2)}</div>
                                <a href="${escapeHtml(offer.link)}" target="_blank" class="btn btn-view-offer btn-sm text-white mt-2">View Offer 🚀</a>
                            </div>
                        </div>
                    `;
                });
            } else {
                offersHtml = '<p class="text-muted">No offers available for this product.</p>';
            }
            
            // Build the product info HTML
            let infoHtml = '';
            if (data.info && data.info.length > 0) {
                infoHtml = '<h5 class="text-white mb-3">📋 Product Information</h5><div class="row">';
                data.info.forEach(info => {
                    infoHtml += `
                        <div class="col-md-6">
                            <div class="info-badge">
                                <div class="info-key">${escapeHtml(info.key)}</div>
                                <div class="info-value">${escapeHtml(info.value)}</div>
                            </div>
                        </div>
                    `;
                });
                infoHtml += '</div>';
            }
            
            // Build the complete modal body
            const modalBody = `
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <div class="product-image-modal">
                            <img src="${escapeHtml(data.product.image)}" 
                                 alt="${escapeHtml(data.product.description)}"
                                 style="width: 100%; max-height: 250px; object-fit: contain;"
                                 onerror="this.src='/images/placeholder.jpg';">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="info-card">
                            <h4 class="text-white mb-2">${escapeHtml(data.product.description)}</h4>
                            <p class="text-white-50 mb-2">Reference: ${escapeHtml(data.product.reference)}</p>
                            <p class="text-white-50 mb-2">Category Name: ${data.product.categoryName || 'N/A'}</p>
                        </div>
                    </div>
                </div>
                
                ${infoHtml ? '<hr style="border-color: rgba(255,255,255,0.2);">' + infoHtml : ''}
                
                ${offersHtml ? '<hr style="border-color: rgba(255,255,255,0.2);">' + offersHtml : ''}
            `;
            
            document.getElementById('modalBody').innerHTML = modalBody;
            document.getElementById('modalProductTitle').innerText = data.product.description;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalBody').innerHTML = `
                <div class="text-center text-white">
                    <div class="alert alert-danger">
                        Failed to load product details. Please try again.
                    </div>
                </div>
            `;
            document.getElementById('modalProductTitle').innerText = 'Error';
        });
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str).replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}


</script>

</body>
</html>
