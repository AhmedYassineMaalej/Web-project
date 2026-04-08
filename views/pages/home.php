<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PickPocket | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b, #3b82f6);
            min-height: 100vh;
            overflow-x: hidden;
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

        .btn-primary {
            border-radius: 12px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(59,130,246,0.4);
        }

        .btn-outline-primary {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59,130,246,0.3);
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #ddd;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
        }

        .badge {
            border-radius: 10px;
        }

        section {
            position: relative;
            z-index: 2;
        }

        .navbar-text {
            color: #3b82f6 !important;
            font-weight: 600;
        }

        h1, h2, h3 {
            background: linear-gradient(135deg, #fff, #e0e7ff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .text-primary {
            color: #fff !important;
        }

        .card-title, .card-text {
            color: #1e293b;
        }

        .text-muted {
            color: #64748b !important;
        }
    </style>
</head>
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
                <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Categories</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Electronics</a></li>
                        <li><a class="dropdown-item" href="#">Fashion</a></li>
                        <li><a class="dropdown-item" href="#">Home</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex me-auto" role="search">
                <input class="form-control me-2" type="search" placeholder="Search products...">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            
            <?php if ($is_logged): ?>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/catalog">Catalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="/myspace">My Space</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Logout</a></li>
                    <li class="nav-item"><span class="navbar-text text-success ms-2">Welcome, <?= htmlspecialchars($username) ?>!</span></li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/sign_up">Sign Up</a></li>
                </ul>
            <?php endif; ?>
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

<section id="DealOfTheDay" class="py-5">
    <div class="container">
        <h1 class="mb-4 text-primary">🔥 Deal Of The Day</h1>
        <?php if (!empty($dealOfTheDay)): ?>
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
                        <p class="fs-2 text-success fw-bold">💰 Special Price!</p>
                        <ul class="list-unstyled mb-4 text-secondary">
                            <li>✔ Best Price Guaranteed</li>
                            <li>✔ High Quality Product</li>
                            <li>✔ Limited Time Offer</li>
                        </ul>
                        <a href="/product?ref=<?= urlencode($dealOfTheDay[0]) ?>" class="btn btn-primary btn-lg px-5">Get it Now 🚀</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php 
$sections = [
    ['title' => '🌟 Best Deals', 'data' => $bestDeals, 'bg' => ''],
    ['title' => '⏰ Expiring Deals', 'data' => $expiringDeals, 'bg' => 'py-5'],
    ['title' => '🆕 Newest Deals', 'data' => $newestDeals, 'bg' => 'py-5']
];

foreach ($sections as $section): 
    if (empty($section['data'])) continue;
?>
<section class="<?= $section['bg'] ?>">
    <div class="container mb-5">
        <h1 class="mb-4"><?= $section['title'] ?></h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            <?php foreach ($section['data'] as $product): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="position-relative" style="height: 220px; display: flex; align-items: center; justify-content: center; background: rgba(255,255,255,0.9); border-radius: 20px 20px 0 0;">
                        <img src="<?= htmlspecialchars($product[2]) ?>" 
                             class="card-img-top p-3" 
                             alt="<?= htmlspecialchars($product[1]) ?>"
                             style="max-height: 100%; max-width: 100%; object-fit: contain;"
                             onerror="this.onerror=null; this.src='/images/placeholder.jpg';">
                    </div>
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title fw-bold text-truncate" title="<?= htmlspecialchars($product[1]) ?>">
                            <?= htmlspecialchars($product[1]) ?>
                        </h5>
                        <p class="text-muted small mt-1 mb-3">Ref: <?= htmlspecialchars($product[0]) ?></p>
                        <div class="mt-auto">
                            <p class="text-success fw-bold fs-5 mb-3">Starting At ...</p>
                            <a href="/product?ref=<?= urlencode($product[0]) ?>" class="btn btn-outline-primary btn-sm w-100">
                                View Details 👀
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

</body>
</html>