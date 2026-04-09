<?php 
use App\Models\Product;
function product_card(Product $product) { ?>
    <div class="card h-100 shadow-sm border-0">
        <div class="position-relative" style="height: 220px; display: flex; align-items: center; justify-content: center; background: #fff;">
            <img src="<?= htmlspecialchars($product->getImage()) ?>" 
                 class="card-img-top p-3" 
                 alt="<?= htmlspecialchars($product->getDescription()) ?>"
                 style="max-height: 100%; max-width: 100%; object-fit: contain;">
        </div>
        <div class="card-body d-flex flex-column text-center">
            <h5 class="card-title fw-bold"><?= htmlspecialchars($product->getDescription()) ?></h5>
            <p class="text-muted small mb-3">Ref: <?= htmlspecialchars($product->getReference()) ?></p>
            <?php 
            $minPrice = $product_repo->getMinPriceForProduct($product->getId());
            ?>
            <p class="text-success fw-bold fs-5 mb-3">
                Starting at $<?= number_format($minPrice, 2) ?>
            </p>
            <a href="/product?ref=<?= urlencode($product->getReference()) ?>" class="btn btn-outline-primary btn-sm w-100">
                View Details 👀
            </a>
        </div>
    </div>
<?php } ?>

