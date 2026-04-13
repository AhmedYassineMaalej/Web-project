<?php require __DIR__ . "/../fragments/head.php"; ?>
<?php require __DIR__ . "/../fragments/navbar.php"; ?>

<!doctype html>
<html lang="en">
    <?php head("Pickpocket | Bookmarks", 'bookmarks.css') ?>
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
        <h1 class="display-4 fw-bold">Your Bookmarks</h1>
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

    <?php if ($bookmark->isEmpty()): ?>
        <div class="text-center py-5">
            <div class="card p-5" style="background: rgba(255,255,255,0.95);">
                <div class="mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#64748b" class="bi bi-bookmark-x" viewBox="0 0 16 16">
                        <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793z"/>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.884 2.464 1.044 2.89 1.032 2.867c.073.203.27.34.48.34h7.9c.21 0 .407-.137.48-.34l1.032-2.867 1.044-2.89L14.89 2H15.5a.5.5 0 0 0 0-1h-1.11a.5.5 0 0 0-.47.33L12.9 4.5H3.1L2.08 1.33A.5.5 0 0 0 1.61 1zM3.5 5.5h9l-1.032 2.867a.5.5 0 0 1-.48.34h-7.9a.5.5 0 0 1-.48-.34zM5 13a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                </div>
                <h3 class="text-muted">Your bookmark is empty</h3>
                <p class="text-muted">Start adding some great deals to your bookmark!</p>
                <a href="/catalog" class="btn btn-primary mt-3">Browse Products 🛍️</a>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-8 bookmark-items-scroll">
                <?php foreach ($bookmark->getItems() as $item): ?>
                    <?php $productOffer = $item->getProductOffer(); ?>
                    <?php if ($productOffer): ?>
                        <div class="bookmark-item card mb-3 shadow-sm border-0">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-2 text-center p-3">
                                    <img src="<?= htmlspecialchars($productOffer->getProduct()->image) ?>" 
                                         alt="<?= htmlspecialchars($productOffer->getProduct()->name) ?>"
                                         style="max-height: 80px; max-width: 100%; object-fit: contain;">
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?= htmlspecialchars($productOffer->getProduct()->name) ?></h5>
                                        <p class="text-muted small">Ref: <?= htmlspecialchars($productOffer->getProduct()->reference) ?></p>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <p class="mb-0 text-muted">Quantity</p>
                                    <h5><?= $item->quantity ?></h5>
                                </div>
                                <div class="col-md-2 text-center">
                                    <p class="mb-0 text-muted">Price</p>
                                    <h5 class="text-primary">$<?= number_format($item->price, 2) ?></h5>
                                </div>
                                
                                <div class="col-md-2 text-center">
                                    <form action="/bookmark/remove" method="POST" onsubmit="return confirm('Remove this item?')">
                                        <input type="hidden" name="bookmark_item_id" value="<?= $item->id ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove ❌</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-sm border-0 order-summary-card">
                    <div class="card-body">
                        <h4 class="card-title fw-bold mb-4">Order Summary</h4>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal (<?= $bookmark->getItemCount() ?> items)</span>
                            <span>$<?= number_format($bookmark->getTotalCost(), 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong class="text-primary fs-4">$<?= number_format($bookmark->getTotalCost(), 2) ?></strong>
                        </div>
                        <button class="btn btn-primary w-100 py-2" onclick="alert('Checkout coming soon!')">
                            Proceed to Checkout 🚀
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</main>

</body>
</html>
