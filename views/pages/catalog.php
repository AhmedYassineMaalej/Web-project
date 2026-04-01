<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Product Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="/css/navbar.css" />
  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img
            src="https://staging.svgrepo.com/show/15477/coin.svg"
            alt="Logo"
            width="40"
            height="30"
            class="d-inline-block align-text-center"
          />
          PickPocket
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/"
                >Home</a
              >
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Categories
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Category1</a></li>
                <li><a class="dropdown-item" href="#">Category2</a></li>
                <li><a class="dropdown-item" href="#">Category3</a></li>
              </ul>
            </li>
          </ul>
          <form class="d-flex me-auto" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                fill="currentColor"
                class="bi bi-search"
                viewBox="0 0 16 16"
              >
                <path
                  d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"
                />
              </svg>
            </button>
          </form>
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/myspace"
                >My Space</a
              >
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Login
              </a>
              <div class="dropdown-menu dropdown-menu-end min-vw-25 p-3">
                <form>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                      >Email address</label
                    >
                    <input
                      type="email"
                      class="form-control"
                      id="exampleInputEmail1"
                      aria-describedby="emailHelp"
                    />
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"
                      >Password</label
                    >
                    <input
                      type="password"
                      class="form-control"
                      id="exampleInputPassword1"
                    />
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <header class="bg-primary text-white text-center py-4">
      <h1>Product Catalog</h1>
      <p class="mb-0">Compare prices and choose where to buy</p>
    </header>

    <main class="container my-4">
      <div class="row">
    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <?php 
                // Mapping the tuple fields based on your requirements:
                // [0] = Product_Reference, [1] = Description, [2] = ImageLink
                $ref   = $product[0];
                $desc  = $product[1];
                $image = $product[2];
            ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card h-100 text-center shadow-sm">
                    <img
                        src="<?= htmlspecialchars($image) ?>"
                        class="card-img-top object-fit-contain p-2"
                        alt="<?= htmlspecialchars($desc) ?>"
                        style="height: 200px;"
                        onerror="this.src='/images/placeholder.png';"
                    />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($desc) ?></h5>
                        <p class="text-muted small">Ref: <?= htmlspecialchars($ref) ?></p>
                        <a href="/product?ref=<?= urlencode($ref) ?>" class="btn btn-primary mt-auto">View Product</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center">
            <p class="lead">No products found in the catalog.</p>
        </div>
    <?php endif; ?>
</div>
    </main>
  </body>
</html>
