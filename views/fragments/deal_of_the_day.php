<?php 
use App\Repositories\ProductRepository;

function deal_of_the_day() {
    $dealOfTheDay = ProductRepository::getDealOfTheDay();
?>
    <section id="DealOfTheDay" class="py-5">
        <div class="container">
            <h1 class="mb-4 text-primary">🔥 Deal Of The Day</h1>
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
                            <p class="fs-2 text-success fw-bold"><?= htmlspecialchars($dealOfTheDay[3]) ?> TND</p>
                            <ul class="list-unstyled mb-4 text-secondary">
                                <li>✔ Best Price Guaranteed</li>
                                <li>✔ High Quality Product</li>
                                <li>✔ Limited Time Offer</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
