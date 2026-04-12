<?php require __DIR__ . "/../fragments/head.php"; ?>
<?php require __DIR__ . "/../fragments/navbar.php"; ?>

<!doctype html>
<html lang="en">
    
    <?php head("My Space", "myspace.css","home.css","bookmarks.css") ?>
    <link rel="stylesheet" href="css/catalog.css">
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

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: relative; z-index: 2; max-width: 600px; margin: 20px auto;">
        <strong>⚠️ Error!</strong> <?php echo htmlspecialchars($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<main class="main-content">
    <div class="content-limit-wrapper p-4">
        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
            <h1 class="h2 fw-bold">My Space 👤</h1>
            <div class="profile-info d-flex align-items-center">
                <span class="me-3 fw-bold"><?php echo htmlspecialchars($username ?? ''); ?></span>
                <div class="rounded-circle profile-circle"></div>
            </div>
        </div>

        <!-- Recommended Products Section -->
<!-- Recommended Products Section -->
<?php if (!empty($recommendedProducts)): ?>
<section class="mb-5">
    <h3 class="section-title mb-4">🎯 Recommended For You</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
        <?php foreach ($recommendedProducts as $product): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <div class="card-body text-center p-4">
                        <img src="<?= htmlspecialchars($product->image) ?>" 
                             alt="<?= htmlspecialchars($product->name) ?>"
                             style="height: 150px; object-fit: contain; margin-bottom: 15px;">
                        <h5 class="card-title fw-bold"><?= htmlspecialchars($product->name) ?></h5>
                        <p class="text-muted small">Ref: <?= htmlspecialchars($product->reference) ?></p>
                        <button class="btn btn-primary w-100 mt-auto" onclick="showProductModal(<?= $product->id ?>)">
                            View Details 👀
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php else: ?>
<section class="mb-5">
    <h3 class="section-title mb-4">🎯 Recommended For You</h3>
    <p class="text-muted">Bookmark some products to get personalized recommendations!</p>
</section>
<?php endif; ?>
    </div>
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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/catalog.js"></script>
</html>