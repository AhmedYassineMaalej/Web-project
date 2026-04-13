<?php 
use App\Repositories\ProductRepository;
use App\Entities\Product;


function product_card(Product $product) {
    $minPrice = ProductRepository::getMinPriceForProduct($product->id);
    ?>
    <div class="product-card">
        <img src="<?= htmlspecialchars($product->image) ?>" class="product-img" alt="product image">
        <h5 class="product-title fw-bold"><?= htmlspecialchars($product->name) ?></h5>
        <p class="product-reference text-muted">Ref: <?= htmlspecialchars($product->reference) ?></p>
        <p class="product-price text-success fs-5 fw-bold">Starting at <?= number_format($minPrice, 2)?> TND</p>
        <a href="/product?ref=<?= urlencode($product->reference) ?>" class="product-details-btn">
            View Details
        </a>
        <button class="product-bookmark-btn" data-reference="<?= htmlspecialchars($product->reference) ?>"></button>
    </div>
<?php } ?>

