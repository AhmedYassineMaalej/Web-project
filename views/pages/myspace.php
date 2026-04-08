<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PickPocket | My Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b, #3b82f6);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.85) !important;
        }

        .stickers-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .sticker {
            position: absolute;
            font-size: 30px;
            opacity: 0.8;
            animation: floatRandom linear infinite;
        }
        .sticker:nth-child(1)  { left: 5%;  top: 80%; animation-duration: 12s; }
        .sticker:nth-child(2)  { left: 15%; top: 60%; animation-duration: 18s; font-size: 40px; }
        .sticker:nth-child(3)  { left: 25%; top: 90%; animation-duration: 14s; }
        .sticker:nth-child(4)  { left: 35%; top: 70%; animation-duration: 20s; font-size: 45px; }
        .sticker:nth-child(5)  { left: 45%; top: 85%; animation-duration: 16s; }
        .sticker:nth-child(6)  { left: 55%; top: 75%; animation-duration: 22s; }
        .sticker:nth-child(7)  { left: 65%; top: 95%; animation-duration: 17s; font-size: 38px; }
        .sticker:nth-child(8)  { left: 75%; top: 65%; animation-duration: 19s; }
        .sticker:nth-child(9)  { left: 85%; top: 88%; animation-duration: 15s; }
        .sticker:nth-child(10) { left: 10%; top: 95%; animation-duration: 21s; }
        .sticker:nth-child(11) { left: 50%; top: 92%; animation-duration: 18s; }
        .sticker:nth-child(12) { left: 90%; top: 85%; animation-duration: 23s; font-size: 42px; }

        @keyframes floatRandom {
            0% {
                transform: translateY(0px) translateX(0px);
                opacity: 0;
            }
            10% {
                opacity: 0.8;
            }
            50% {
                transform: translateY(-300px) translateX(20px);
            }
            100% {
                transform: translateY(-700px) translateX(-20px);
                opacity: 0;
            }
        }

        .main-content {
            position: relative;
            z-index: 2;
            padding: 20px;
        }

        .content-limit-wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }

        .card {
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2) !important;
        }

        .product-card {
            position: relative;
            overflow: hidden;
        }

        .badge-price {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            z-index: 1;
        }

        .placeholder-img {
            width: 100%;
            height: 150px;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .price-tag {
            font-size: 24px;
            font-weight: bold;
            color: #3b82f6;
            margin: 10px 0;
        }

        .btn-coral {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px;
            transition: all 0.3s ease;
        }

        .btn-coral:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(59,130,246,0.4);
        }

        .section-title {
            color: white;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .table {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .table thead th {
            border: none;
            padding: 15px;
        }

        .table tbody tr:hover {
            background: rgba(59,130,246,0.1);
            transition: background 0.3s ease;
        }

        .text-coral {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .text-coral:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        .profile-circle {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .profile-circle:hover {
            transform: scale(1.1);
        }

        .border-bottom {
            border-bottom: 2px solid rgba(255,255,255,0.3) !important;
        }

        .h2, h1, h3 {
            color: white;
        }

        .profile-info span {
            color: white;
            font-weight: 600;
        }

        .btn-outline-success {
            color: #3b82f6;
            border-color: #3b82f6;
        }

        .btn-outline-success:hover {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-color: transparent;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }
    </style>
</head>
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="/">
            <img src="https://staging.svgrepo.com/show/15477/coin.svg" alt="Logo" width="40" height="30" class="d-inline-block align-text-center" />
            PickPocket
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Categories
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Electronics</a></li>
                        <li><a class="dropdown-item" href="#">Fashion</a></li>
                        <li><a class="dropdown-item" href="#">Home</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-auto" role="search">
                <input class="form-control me-2" type="search" placeholder="Search products..." aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </form>
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active fw-bold" href="/myspace">My Space</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
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