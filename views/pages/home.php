<?php 
use App\Repositories\ProductRepository;
require __DIR__ . "/../fragments/head.php"; ?>
<?php require __DIR__ . "/../fragments/navbar.php"; ?>
<?php require __DIR__ . "/../fragments/deal_of_the_day.php"; ?>
<?php require __DIR__ . "/../fragments/product_section.php"; ?>

<!doctype html>
<html lang="en">
    <?php head("Pickpocket | Home", 'home.css') ?>
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
        <?php navbar(); ?>

        <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: relative; z-index: 2; max-width: 600px; margin: 20px auto;">
            <strong>⚠️ Error!</strong> <?php echo htmlspecialchars($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php deal_of_the_day() ?>
        <?php 
        product_section('🌟 Best Deals', ProductRepository::getProductsWithMostOffers(6));
        product_section('⏰ Expiring Deals', ProductRepository::getTopOffers(6), "py-5");
        product_section('🆕 Newest Deals', ProductRepository::getNewestProducts(6), "py-5");
        ?>

    </body>
</html>
