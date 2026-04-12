<?php
function product_card($product, $isBookmarked = false) {
    $id = $product->id;
    $ref = $product->reference;
    $image = $product->image;
    $name = $product->name;
    $bookmarkIcon = $isBookmarked ? 'bookmark-full.svg' : 'bookmark-empty.svg' ;
    ?>
    <div class="col-md-3 col-sm-6 mb-4">
        <div class="card h-100 text-center shadow-sm border-0" onclick="showProductModal(<?= $id ?>)">
            <div class="position-relative" style="height: 220px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.9);">
                <img src="<?= htmlspecialchars($image) ?>" 
                     class="card-img-top p-3" 
                     alt="image"
                     style="max-height: 100%; max-width: 100%; object-fit: contain;"
                     onerror="this.onerror=null; this.src='/images/placeholder.jpg';" />
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold"><?= htmlspecialchars($name) ?></h5>
                <p class="text-muted small mb-3">Ref: <?= htmlspecialchars($ref) ?></p>
                <div class="d-flex gap-2 mt-auto">
                    <button class="btn btn-primary flex-grow-1" onclick="event.stopPropagation(); showProductModal(<?= $id ?>)">
                        View Details 👀
                    </button>
                    <button class="bookmark-btn" onclick="event.stopPropagation(); toggleBookmark(<?= $id ?>, this)" style="border: none; outline: none; background: transparent; padding: 0;">
                        <img src="/images/<?= $bookmarkIcon ?>" 
                             alt="Bookmark" 
                             style="width: 38px; height: 38px; object-fit: contain;">
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php
}