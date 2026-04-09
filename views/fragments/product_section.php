<?php 
require __DIR__ . "/product_card.php";

function product_section(string $title, array $products, string $bg = "") {
    ?>
<section class="<?= $bg ?>">
    <div class="container mb-5">
        <h1 class="mb-4"><?= $title ?></h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($products as $product): ?>
            <?php product_card($product) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php } ?>

