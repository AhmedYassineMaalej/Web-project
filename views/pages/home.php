<?php require __DIR__ . "/../fragments/head.php"; ?>
<!doctype html>
<html lang="en">
    <?php head("Pickpocket | Home", 'css/home.css') ?>
<body>
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
<?php require __DIR__ . "/../fragments/navbar.php"; navbar($is_logged); ?>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: relative; z-index: 2; max-width: 600px; margin: 20px auto;">
        <strong>⚠️ Error!</strong> <?php echo htmlspecialchars($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<section id="DealOfTheDay" class="py-5">
    <div class="container">
        <h1 class="mb-4 text-primary">🔥 Deal Of The Day</h1>
        <?php if (!empty($dealOfTheDay)): ?>
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 text-center p-4 bg-white position-relative">
                    <div class="badge bg-danger position-absolute top-0 start-0 m-3 fs-5">PROMO</div>
                    <img src="<?= htmlspecialchars($dealOfTheDay[2]) ?>" 
                         alt="Deal Image" class="img-fluid rounded" style="max-height: 300px; object-fit: contain;"
                         onerror="this.onerror=null; this.src='/images/placeholder.jpg';">
                </div>
                <div class="col-md-8 p-4">
                    <div class="card-body">
                        <span class="badge bg-secondary mb-2">⭐ Featured Brand</span>
                        <h2 class="card-title display-6 fw-bold"><?= htmlspecialchars($dealOfTheDay[1]) ?></h2>
                        <p class="text-muted small mb-3">Product Reference: <?= htmlspecialchars($dealOfTheDay[0]) ?></p>
                        <p class="fs-2 text-success fw-bold">💰 Special Price!</p>
                        <ul class="list-unstyled mb-4 text-secondary">
                            <li>✔ Best Price Guaranteed</li>
                            <li>✔ High Quality Product</li>
                            <li>✔ Limited Time Offer</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php 
$sections = [
    ['title' => '🌟 Best Deals', 'data' => $bestDeals, 'bg' => ''],
    ['title' => '⏰ Expiring Deals', 'data' => $expiringDeals, 'bg' => 'py-5'],
    ['title' => '🆕 Newest Deals', 'data' => $newestDeals, 'bg' => 'py-5']
];

foreach ($sections as $section): 
    if (empty($section['data'])) continue;
?>
<section class="<?= $section['bg'] ?>">
    <div class="container mb-5">
        <h1 class="mb-4"><?= $section['title'] ?></h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($bestDeals as $product): ?>
<div class="col">
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
</div>
<?php endforeach; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

</body>
</html>
