<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PickPocket | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/css/home.css" />
    <link rel="stylesheet" href="/css/navbar.css" />
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm">
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
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/myspace">My Space</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Login</a>
                        <div class="dropdown-menu dropdown-menu-end p-3" style="min-width: 250px;">
                            <form>
                                <div class="mb-3">
                                    <label class="form-label text-dark">Email</label>
                                    <input type="email" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-dark">Password</label>
                                    <input type="password" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Submit</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="DealOfTheDay" class="py-5">
        <div class="container">
            <h1 class="mb-4 text-primary">Deal Of The Day</h1>
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
                            <span class="badge bg-secondary mb-2">Featured Brand</span>
                            <h2 class="card-title display-6 fw-bold"><?= htmlspecialchars($dealOfTheDay[1]) ?></h2>
                            <p class="text-muted small mb-3">Product Reference: <?= htmlspecialchars($dealOfTheDay[0]) ?></p>
                            <p class="fs-2 text-success fw-bold">Special Price!</p>
                            <ul class="list-unstyled mb-4 text-secondary">
                                <li>✔ Best Price Guaranteed</li>
                                <li>✔ High Quality Product</li>
                                <li>✔ Limited Time Offer</li>
                            </ul>
                            <a href="/product?ref=<?= urlencode($dealOfTheDay[0]) ?>" class="btn btn-primary btn-lg px-5">Get it Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php 
    $sections = [
        ['title' => 'Best Deals', 'data' => $bestDeals, 'bg' => ''],
        ['title' => 'Expiring Deals ', 'data' => $expiringDeals, 'bg' => 'bg-white py-5'],
        ['title' => 'Newest Deals', 'data' => $newestDeals, 'bg' => 'py-5']
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
                        <div class="position-relative" style="height: 220px; display: flex; align-items: center; justify-content: center; background: #fff;">
                            <img src="<?= htmlspecialchars($product[2]) ?>" 
                                 class="card-img-top p-3" 
                                 alt="<?= htmlspecialchars($product[1]) ?>"
                                 style="max-height: 100%; max-width: 100%; object-fit: contain;"
                                 onerror="this.onerror=null; this.src='/images/placeholder.jpg';">
                        </div>
                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title fw-bold small text-truncate" title="<?= htmlspecialchars($product[1]) ?>">
                                <?= htmlspecialchars($product[1]) ?>
                            </h5>
                            <p class="text-muted small mt-1 mb-3">Ref: <?= htmlspecialchars($product[0]) ?></p>
                            <div class="mt-auto">
                                <p class="text-success fw-bold fs-5 mb-3">Starting At ...</p>
                                <a href="/product?ref=<?= urlencode($product[0]) ?>" class="btn btn-outline-primary btn-sm w-100">
                                    View Details
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