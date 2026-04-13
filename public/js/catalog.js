function showProductModal(productId) {
    // Show modal first with loading state
    const modal = new bootstrap.Modal(document.getElementById('productModal'));
    modal.show();

    // Fetch product data via AJAX
    fetch(`/catalog/getProductAjax?id=${productId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Received data:', data);

            if (data.error) {
                document.getElementById('modalBody').innerHTML = `
<div class="text-center text-white">
    <div class="alert alert-danger">
        Error: ${data.error}
    </div>
</div>
`;
                document.getElementById('modalProductTitle').innerText = 'Error';
                return;
            }

            // Check if we have product data
            if (!data.product) {
                document.getElementById('modalBody').innerHTML = `
<div class="text-center text-white">
    <div class="alert alert-warning">
        No product data received
    </div>
</div>
`;
                return;
            }

            // Build the offers HTML
            let offersHtml = '';
            if (data.offers && data.offers.length > 0) {
                offersHtml = '<h5 class="text-white mb-3">💰 Available Offers</h5>';
                data.offers.forEach(offer => {
                    offersHtml += `
<div class="offer-card d-flex justify-content-between align-items-center">
<div>
<div class="text-muted small">Provider Name: ${escapeHtml(offer.providerName)}</div>
<div class="text-muted small">Product ID: ${escapeHtml(offer.product_id)}</div>
</div>
<div class="text-end">
<div class="price-tag">$${parseFloat(offer.price).toFixed(2)}</div>
<a href="${escapeHtml(offer.link)}" target="_blank" class="btn btn-view-offer btn-sm text-white mt-2">View Offer 🚀</a>
</div>
</div>
`;
                });
            } else {
                offersHtml = '<p class="text-muted">No offers available for this product.</p>';
            }

            // Build the product info HTML
            let infoHtml = '';
            if (data.info && data.info.length > 0) {
                infoHtml = '<h5 class="text-white mb-3">📋 Product Information</h5><div class="row">';
                data.info.forEach(info => {
                    infoHtml += `
<div class="col-md-6">
<div class="info-badge">
<div class="info-key">${escapeHtml(info.key)}</div>
<div class="info-value">${escapeHtml(info.value)}</div>
</div>
</div>
`;
                });
                infoHtml += '</div>';
            }

            // Build the complete modal body
            const modalBody = `
<div class="row">
<div class="col-md-5 mb-3">
<div class="product-image-modal">
<img src="${escapeHtml(data.product.image)}" 
alt="${escapeHtml(data.product.description)}"
style="width: 100%; max-height: 250px; object-fit: contain;"
onerror="this.src='/images/placeholder.jpg';">
</div>
</div>
<div class="col-md-7">
<div class="info-card">
<h4 class="text-white mb-2">${escapeHtml(data.product.description)}</h4>
<p class="text-white-50 mb-2">Reference: ${escapeHtml(data.product.reference)}</p>
<p class="text-white-50 mb-2">Category Name: ${data.product.categoryName || 'N/A'}</p>
</div>
</div>
</div>

${infoHtml ? '<hr style="border-color: rgba(255,255,255,0.2);">' + infoHtml : ''}

${offersHtml ? '<hr style="border-color: rgba(255,255,255,0.2);">' + offersHtml : ''}
`;

            document.getElementById('modalBody').innerHTML = modalBody;
            document.getElementById('modalProductTitle').innerText = data.product.description;
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalBody').innerHTML = `
<div class="text-center text-white">
    <div class="alert alert-danger">
        Failed to load product details. Please try again.
    </div>
</div>
`;
            document.getElementById('modalProductTitle').innerText = 'Error';
        });
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str).replace(/[&<>]/g, function (m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}

function addBookmark(productId, button) {
    // Change button text and disable it
    const originalText = button.innerHTML;
    button.innerHTML = 'Adding...';
    button.disabled = true;

    fetch(`/bookmarks/add?id=${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('✅ Added to bookmarks!', 'success');
                // Change button permanently to "Add more"
                button.innerHTML = 'Add more +';
                button.disabled = false;
            } else {
                showToast(data.error || 'Failed to add', 'error');
                button.innerHTML = originalText;
                button.disabled = false;
            }
        })
        .catch(error => {
            showToast('Something went wrong', 'error');
            button.innerHTML = originalText;
            button.disabled = false;
        });
}

function addBookmark(message, type) {
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    toast.innerHTML = `
<div class="toast-content">
    <span>${message}</span>
</div>
`;

    document.body.appendChild(toast);

    // Animate in
    setTimeout(() => {
        toast.classList.add('show');
    }, 100);

    // Remove after 2 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 2000);
}



