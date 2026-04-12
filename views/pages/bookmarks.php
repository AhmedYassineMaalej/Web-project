<?php require __DIR__ . "/../fragments/head.php"; ?>
<?php require __DIR__ . "/../fragments/navbar.php"; ?>

<!doctype html>
<html lang="en">
    <?php head("Pickpocket | Bookmarks", 'home.css', 'bookmarks.css') ?>

    <link rel="stylesheet" href="css/catalog.css">
    <link rel="stylesheet" href="css/to_organize.css">
    
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

<?php navbar() ?>

<header class="bookmark-header text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">📖 Your Bookmarks</h1>
        <p class="lead mb-0">Products you've saved for later</p>
    </div>
</header>

<main class="container my-5">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (empty($bookmarkedProducts)): ?>
        <div class="text-center py-5">
            <div class="card p-5" style="background: rgba(255,255,255,0.95);">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#64748b" class="bi bi-bookmark-x" viewBox="0 0 16 16">
                        <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                        <path d="M6.646 5.646a.5.5 0 0 1 .708 0L8 6.293l.646-.647a.5.5 0 0 1 .708.708L8.707 7l.647.646a.5.5 0 0 1-.708.708L8 7.707l-.646.647a.5.5 0 0 1-.708-.708L7.293 7l-.647-.646a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>
                <h3 class="text-muted">No bookmarks yet</h3>
                <p class="text-muted">Start adding products to your bookmarks!</p>
                <a href="/catalog" class="btn btn-primary mt-3">Browse Products 🛍️</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($bookmarkedProducts as $product): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="position-relative" style="height: 200px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.9);">
                            <img src="<?= htmlspecialchars($product->image) ?>" 
                                 alt="<?= htmlspecialchars($product->name) ?>"
                                 style="max-height: 150px; max-width: 100%; object-fit: contain;">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($product->name) ?></h5>
                            <p class="text-muted small">Ref: <?= htmlspecialchars($product->reference) ?></p>
                            <form action="/bookmark/remove" method="POST" class="d-inline">
                                <input type="hidden" name="product_id" value="<?= $product->id ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove from bookmarks?')">
                                    ❌ Remove
                                </button>
                            </form>
                            <button class="btn btn-primary btn-sm mt-2 w-100" onclick="showProductModal(<?= $product->id ?>)">
                                View Details 👀
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    </main>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/catalog.js"></script>
</body>
</html>