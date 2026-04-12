bookmarkButtons = document.querySelectorAll(".product-bookmark-btn");

bookmarkButtons.forEach((button) => {
    button.addEventListener("click", async _event => {
        const added = await addBookmark(button.dataset.reference);
        if (added) {
            button.classList.toggle("bookmark-full")
        }
    })
})


async function addBookmark(productReference) {
    const data = new FormData();

    data.append("productReference", productReference);

    return await fetch('/bookmarks/add', {
        method: 'POST',
        body: data,
    }).then(response => response.ok);
}


function showBookmarksModal() {
    const modal = new bootstrap.Modal(document.getElementById('bookmarksModal'));
    modal.show();

    fetch('/bookmarks/items')
        .then(response => response.json())
        .then(data => {
            if (data.items && data.items.length > 0) {
                let html = '<div class="bookmarks-items-list">';
                data.items.forEach(item => {
                    html += `
                            <div class="d-flex align-items-center mb-3 pb-2 border-bottom" data-item-id="${item.id}">
                                <img src="${item.image}" style="width: 60px; height: 60px; object-fit: contain;" class="me-3">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">${item.name}</h6>
                                    <small class="text-muted">Qty: ${item.quantity}</small>
                                </div>
                                <div class="text-end">
                                    <strong>$${item.total}</strong>
                                    <button class="btn btn-sm btn-danger ms-2" onclick="removeFromBookmarks(${item.id})">×</button>
                                </div>
                            </div>
                        `;
                });
                html += `
                    <div class="mt-3 pt-2 border-top">
                        <div class="d-flex justify-content-between">
                            <strong>Total:</strong>
                            <strong class="text-primary">$${data.total}</strong>
                        </div>
                    </div>
                `;
                document.getElementById('bookmarksModalBody').innerHTML = html;
            } else {
                document.getElementById('bookmarksModalBody').innerHTML = `
                    <div class="text-center py-4">
                        <p>Your bookmarks is empty</p>
                        <a href="/catalog" class="btn btn-primary btn-sm">Browse Products</a>
                    </div>
                `;
            }
        });
}

function removeFromBookmarks(itemId) {
    fetch('/bookmarks/remove', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ bookmarks_item_id: itemId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the item element directly from DOM
                const itemElement = document.querySelector(`[data-item-id="${itemId}"]`);
                if (itemElement) {
                    itemElement.remove();
                }

                // Update totals without reloading modal
                fetch('/bookmarks/items')
                    .then(response => response.json())
                    .then(bookmarksData => {
                        // Update total price
                        const totalElement = document.querySelector('#bookmarksModalBody .total-price');
                        if (totalElement) {
                            totalElement.textContent = `$${bookmarksData.total}`;
                        }

                        // Update item count
                        const count = bookmarksData.items.length;
                        const badge = document.querySelector('.nav-link .badge');
                        if (badge) {
                            if (count > 0) {
                                badge.textContent = count;
                            } else {
                                badge.style.display = 'none';
                            }
                        }

                        // If bookmarks is empty, show empty message
                        if (count === 0) {
                            document.getElementById('bookmarksModalBody').innerHTML = `
                        <div class="text-center py-4">
                            <p>Your bookmarks is empty</p>
                            <a href="/catalog" class="btn btn-primary btn-sm">Browse Products</a>
                        </div>
                    `;
                        }
                    });
            }
        });
}

function updateBookmarksCount() {
    fetch('/bookmarks/items')
        .then(response => response.json())
        .then(data => {
            const count = data.items ? data.items.length : 0;
            const badge = document.querySelector('.nav-link .badge');
            if (badge) {
                if (count > 0) {
                    badge.textContent = count;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }
            }
        });
}

function checkout() {
    window.location.href = '/checkout';
}

