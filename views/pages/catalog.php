<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PickPocket | Product Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b, #3b82f6);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.85) !important;
        }

        .stickers-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .sticker {
            position: absolute;
            font-size: 30px;
            opacity: 0.8;
            animation: floatRandom linear infinite;
        }
        .sticker:nth-child(1)  { left: 5%;  top: 80%; animation-duration: 12s; }
        .sticker:nth-child(2)  { left: 15%; top: 60%; animation-duration: 18s; font-size: 40px; }
        .sticker:nth-child(3)  { left: 25%; top: 90%; animation-duration: 14s; }
        .sticker:nth-child(4)  { left: 35%; top: 70%; animation-duration: 20s; font-size: 45px; }
        .sticker:nth-child(5)  { left: 45%; top: 85%; animation-duration: 16s; }
        .sticker:nth-child(6)  { left: 55%; top: 75%; animation-duration: 22s; }
        .sticker:nth-child(7)  { left: 65%; top: 95%; animation-duration: 17s; font-size: 38px; }
        .sticker:nth-child(8)  { left: 75%; top: 65%; animation-duration: 19s; }
        .sticker:nth-child(9)  { left: 85%; top: 88%; animation-duration: 15s; }
        .sticker:nth-child(10) { left: 10%; top: 95%; animation-duration: 21s; }
        .sticker:nth-child(11) { left: 50%; top: 92%; animation-duration: 18s; }
        .sticker:nth-child(12) { left: 90%; top: 85%; animation-duration: 23s; font-size: 42px; }

        @keyframes floatRandom {
            0% {
                transform: translateY(0px) translateX(0px);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            50% {
                transform: translateY(-300px) translateX(20px);
            }
            100% {
                transform: translateY(-700px) translateX(-20px);
                opacity: 0;
            }
        }

        .catalog-header {
            position: relative;
            z-index: 2;
            background: linear-gradient(135deg, rgba(59,130,246,0.9), rgba(37,99,235,0.9));
            backdrop-filter: blur(10px);
            border-radius: 0 0 30px 30px;
            margin-bottom: 30px;
            padding: 40px 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .catalog-header h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .catalog-header p {
            font-size: 1.2rem;
            opacity: 0.95;
        }

        .card {
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2) !important;
        }

        .card-img-top {
            transition: transform 0.3s ease;
            background: rgba(255,255,255,0.9);
            padding: 20px;
        }

        .card:hover .card-img-top {
            transform: scale(1.05);
        }

        .btn-primary {
            border-radius: 12px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(59,130,246,0.4);
        }

        /* Modal Styles */
        .modal-content {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            border-radius: 25px;
            border: none;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        .modal-header {
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding: 20px 25px;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            border-top: 1px solid rgba(255,255,255,0.2);
            padding: 20px 25px;
        }

        .btn-close-white {
            filter: brightness(0) invert(1);
        }

        .product-image-modal {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
        }

        .product-image-modal img {
            max-height: 250px;
            object-fit: contain;
        }

        .info-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .offer-card {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .offer-card:hover {
            transform: translateX(5px);
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .price-tag {
            font-size: 24px;
            font-weight: bold;
            color: #3b82f6;
        }

        .btn-view-offer {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            border-radius: 10px;
            padding: 8px 20px;
            transition: all 0.3s ease;
        }

        .btn-view-offer:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(59,130,246,0.4);
        }

        .info-badge {
            background: rgba(59,130,246,0.2);
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .info-key {
            font-weight: bold;
            color: #3b82f6;
            margin-bottom: 5px;
        }

        .info-value {
            color: white;
            font-size: 0.95rem;
        }

        .btn-outline-success {
            color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-outline-success:hover {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-color: transparent;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }

        main {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/">
            <img src="https://staging.svgrepo.com/show/15477/coin.svg" alt="Logo" width="40" height="30" class="d-inline-block align-text-center" />
            PickPocket
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                
            </ul>
            <form class="d-flex me-auto" role="search">
                <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </form>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/myspace">My Space</a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sign_up">Sign Up</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

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
                    $id = $product->getId();
                    $ref = $product->getReference();
                    $desc = $product->getDescription();
                    $image = $product->getImage();
                ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 text-center shadow-sm border-0" onclick="showProductModal(<?= $id ?>)">
                        <div class="position-relative" style="height: 220px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.9);">
                            <img src="<?= htmlspecialchars($image) ?>" 
                                 class="card-img-top p-3" 
                                 alt="<?= htmlspecialchars($desc) ?>"
                                 style="max-height: 100%; max-width: 100%; object-fit: contain;"
                                 onerror="this.onerror=null; this.src='/images/placeholder.jpg';" />
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($desc) ?></h5>
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
                                <div class="fw-bold text-primary">Provider ID: ${escapeHtml(offer.providerId)}</div>
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
                            <p class="text-white-50 mb-2">Category ID: ${data.product.categoryId || 'N/A'}</p>
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