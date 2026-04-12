<?php 
require __DIR__ . "/../fragments/head.php"; 
require __DIR__ . "/../fragments/navbar.php";
require __DIR__ . "/../fragments/product_card.php";
use App\Repositories\BookmarkItemRepository;
?>


<!doctype html>
<html lang="en">
    <?php head("Pickpocket | Home", 'home.css', 'bookmarks.css') ?>
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

        <!-- Catalog Header -->
        <header class="catalog-header text-white text-center py-5">
            <div class="container">
                <h1 class="display-4 fw-bold">📦 Product Catalog</h1>
                <p class="lead mb-0">Compare prices and choose where to buy the best deals!</p>
            </div>
        </header>

        <!-- Product Catalog Main Content -->
            <div class="products-container catalog-container">
                <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                <?php product_card($product)?>
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
        <script src="js/catalog.js"></script>
        <script src="js/bookmark_button.js"></script>
    </body>
</html>
