function showProductModal(productId) {
    const modal = new bootstrap.Modal(document.getElementById('productModal'));
    modal.show();

    fetch(`/catalog/getProductAjax?id=${productId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                updateModalContent('error', data.error);
                return;
            }

            if (!data.product) {
                updateModalContent('warning', 'No product data received');
                return;
            }

            const offersHtml = buildOffersHtml(data.offers);
            const infoHtml = buildInfoHtml(data.info);
            
            const modalBody = `
                <div class="row">
                    <div class="col-md-5 mb-3">
                        <div class="product-image-modal">
                            <img src="${escapeHtml(data.product.image)}" 
                                 style="width: 100%; max-height: 250px; object-fit: contain;"
                                 onerror="this.src='/images/placeholder.jpg';">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="info-card">
                            <h4 class="text-white mb-2">${escapeHtml(data.product.name)}</h4>
                            <p class="text-white-50 mb-2">Reference: ${escapeHtml(data.product.reference)}</p>
                            <p class="text-white-50 mb-2">Category Name: ${data.product.categoryName || 'N/A'}</p>
                        </div>
                    </div>
                </div>
                ${infoHtml ? '<hr style="border-color: rgba(255,255,255,0.2);">' + infoHtml : ''}
                ${offersHtml ? '<hr style="border-color: rgba(255,255,255,0.2);">' + offersHtml : ''}
            `;

            document.getElementById('modalBody').innerHTML = modalBody;
            document.getElementById('modalProductTitle').innerText = data.product.name;
        })
        .catch(error => {
            console.error('Error:', error);
            updateModalContent('error', 'Failed to load product details. Please try again.');
        });
}

function updateModalContent(type, message) {
    const alertClass = type === 'error' ? 'alert-danger' : 'alert-warning';
    document.getElementById('modalBody').innerHTML = `
        <div class="text-center text-white">
            <div class="alert ${alertClass}">
                ${message}
            </div>
        </div>
    `;
    document.getElementById('modalProductTitle').innerText = type === 'error' ? 'Error' : 'Warning';
}

function buildOffersHtml(offers) {
    if (!offers || offers.length === 0) {
        return '<p class="text-muted">No offers available for this product.</p>';
    }
    
    let html = '<h5 class="text-white mb-3">💰 Available Offers</h5>';
    offers.forEach(offer => {
        html += `
            <div class="offer-card d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-muted medium">Provider Name: ${escapeHtml(offer.providerName)}</div>
                    <div class="text-muted medium">Product ID: ${escapeHtml(offer.product_id)}</div>
                </div>
                <div class="text-end">
                    <div class="price-tag">$${parseFloat(offer.price).toFixed(2)}</div>
                    <a href="${escapeHtml(offer.link)}" target="_blank" class="btn btn-view-offer btn-sm text-white mt-2">View Offer 🚀</a>
                </div>
            </div>
        `;
    });
    return html;
}

function buildInfoHtml(info) {
    if (!info || info.length === 0) {
        return '';
    }
    
    let html = '<h5 class="text-white mb-3">📋 Product Information</h5><div class="row">';
    info.forEach(item => {
        html += `
            <div class="col-md-6">
                <div class="info-badge">
                    <div class="info-key">${escapeHtml(item.key)}</div>
                    <div class="info-value">${escapeHtml(item.value)}</div>
                </div>
            </div>
        `;
    });
    html += '</div>';
    return html;
}

function escapeHtml(str) {
    if (!str) return '';
    return String(str).replace(/[&<>]/g, function(m) {
        if (m === '&') return '&amp;';
        if (m === '<') return '&lt;';
        if (m === '>') return '&gt;';
        return m;
    });
}

function toggleBookmark(productId, button) {
    const img = button.querySelector('img');
    const originalSrc = img.src;
    
    fetch('/bookmark/toggle', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (data.bookmarked) {
                img.src = '/images/bookmark-full.svg';
                showToast('✅ Added to bookmarks!', 'success');
            } else {
                img.src = '/images/bookmark-empty.svg';
                showToast('❌ Removed from bookmarks', 'info');
            }
        } else {
            showToast(data.error || 'Failed to update bookmark', 'error');
            // Revert image on error
            img.src = originalSrc;
        }
    })
    .catch(error => {
        showToast('Something went wrong', 'error');
        // Revert image on error
        img.src = originalSrc;
    });
}

function showToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    toast.innerHTML = `<div class="toast-content"><span>${message}</span></div>`;
    document.body.appendChild(toast);
    
    setTimeout(() => toast.classList.add('show'), 100);
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 2000);
}