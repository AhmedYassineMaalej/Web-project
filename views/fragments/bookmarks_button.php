<?php
function bookmarks_button() {
    $bookmarkCount = $_SESSION['bookmarks_count'] ?? 0;
    ?>
    <li class="nav-item">
        <a class="nav-link position-relative" href="#" onclick="showBookmarksModal(); return false;">
            🔖 Bookmarks
            <?php if ($bookmarkCount > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $bookmarkCount ?>
                </span>
            <?php endif; ?>
        </a>
    </li>

    <!-- Cart Modal -->
    <div class="modal fade" id="bookmarksModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">🔖 Your Bookmarks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="bookmarksModalBody" style="max-height: 400px; overflow-y: auto;">
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-2">Loading bookmarks...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="/bookmarks" class="btn btn-primary">View Full Cart</a>
                    <button class="btn btn-success" onclick="checkout()">Checkout 🚀</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
