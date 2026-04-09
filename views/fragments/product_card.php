<?php 
use App\Repositories\ProductRepository;
use App\Entities\Product;


function product_card(Product $product) { ?>
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            <div class="position-relative" style="height: 220px; display: flex; align-items: center; justify-content: center; background: #fff;">
                <img src="<?= htmlspecialchars($product->image) ?>" 
                    class="card-img-top p-3" 
                    alt="product image"
                    style="max-height: 100%; max-width: 100%; object-fit: contain;">
            </div>
            <div class="card-body d-flex flex-column text-center">
                <h5 class="card-title fw-bold"><?= htmlspecialchars($product->name) ?></h5>
                <p class="text-muted small mb-3">Ref: <?= htmlspecialchars($product->reference) ?></p>
                <?php 
                $minPrice = ProductRepository::getMinPriceForProduct($product->id);
                ?>
                <p class="text-success fw-bold fs-5 mb-3">
                    Starting at <?= number_format($minPrice, 2)?> TND
                </p>
                <a href="/product?ref=<?= urlencode($product->reference) ?>" class="btn btn-outline-primary btn-sm w-100">
                    View Details 👀
                </a>
            </div>
        </div>
    </div>
<?php } ?>

