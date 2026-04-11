<?php require __DIR__ . "/../fragments/head.php"; ?>
<?php require __DIR__ . "/../fragments/navbar.php"; ?>

<!doctype html>
<html lang="en">
    <?php head("My Space", "myspace.css") ?>
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

        <section class="mb-5">
            <h3 class="section-title mb-4">⭐ My Favorites</h3>
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <div class="badge-price">-15%</div>
                        <div class="card-body text-center p-4">
                            <div class="placeholder-img mb-3"></div>
                            <h5 class="card-title fw-bold">Wireless Headphones</h5>
                            <p class="price-tag">$199.99</p>
                            <button class="btn btn-coral w-100">View Deals 🎧</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <div class="badge-price">-20%</div>
                        <div class="card-body text-center p-4">
                            <div class="placeholder-img mb-3"></div>
                            <h5 class="card-title fw-bold">Smart Watch Pro</h5>
                            <p class="price-tag">$299.99</p>
                            <button class="btn btn-coral w-100">View Deals ⌚</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 product-card">
                        <div class="badge-price">-10%</div>
                        <div class="card-body text-center p-4">
                            <div class="placeholder-img mb-3"></div>
                            <h5 class="card-title fw-bold">Gaming Mouse</h5>
                            <p class="price-tag">$59.99</p>
                            <button class="btn btn-coral w-100">View Deals 🖱️</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h3 class="section-title mb-4">📜 Recent History</h3>
            <div class="table-responsive bg-white p-3 rounded shadow-sm">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Date Viewed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Apple Smart Watch</td>
                            <td>Electronics</td>
                            <td>Feb 5, 2026</td>
                            <td><a href="#" class="text-coral">Revisit 👀</a></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Power Bank 20000mAh</td>
                            <td>Electronics</td>
                            <td>Jul 16, 2025</td>
                            <td><a href="#" class="text-coral">Revisit 👀</a></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Noise Cancelling Headphones</td>
                            <td>Electronics</td>
                            <td>Jan 28, 2026</td>
                            <td><a href="#" class="text-coral">Revisit 👀</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>

</body>
</html>
