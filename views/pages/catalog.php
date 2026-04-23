<?php 
require __DIR__ . "/../fragments/head.php"; 
require __DIR__ . "/../fragments/navbar.php";
require __DIR__ . "/../fragments/product_section.php";
require __DIR__ . "/../fragments/stickers.php";
?>


<!doctype html>
<html lang="en">
    <?php head("Pickpocket | Home", 'home.css', 'bookmarks.css') ?>
    <link rel="stylesheet" href="css/catalog.css">

    <body>

    <?php stickers(); ?>

        <?php navbar() ?>

         Catalog Header
        <header class="catalog-header text-white text-center py-5">
            <div class="container">
                <h1 class="display-4 fw-bold">📦 Product Catalog</h1>
                <p class="lead mb-0">Compare prices and choose where to buy the best deals!</p>
            </div>
        </header>

<!--         Product Catalog Main Content -->
<!--            <div class="products-container catalog-container">-->
<!--                --><?php //if (!empty($products)): ?>
<!--                --><?php //foreach ($products as $product): ?>
<!--                --><?php //product_card($product)?>
<!--                --><?php //endforeach; ?>
<!--                --><?php //else: ?>
<!--                <div class="col-12 text-center py-5">-->
<!--                    <div class="card p-5" style="background: rgba(255,255,255,0.95);">-->
<!--                        <div class="mb-4">-->
<!--                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#64748b" class="bi bi-box-seam" viewBox="0 0 16 16">-->
<!--                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.752a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 4.05v8.9a.5.5 0 0 1-.314.464l-7.129 2.852a1.5 1.5 0 0 1-1.114 0L.314 13.414A.5.5 0 0 1 0 12.95v-8.9a.5.5 0 0 1 .314-.464z"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                        <h3 class="text-muted">No products found in the catalog</h3>-->
<!--                        <p class="text-muted">Check back later for amazing deals!</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                --><?php //endif; ?>
<!--            </div>-->

        <?php product_section("", $products); ?>
        <?php require __DIR__ . "/../fragments/productModal.php"; ?>
        <script src="js/catalog.js"></script>
    </body>
</html>
