<?php function navbar(bool $logged_in) { ?>
    <?php require __DIR__ . "/logo.php";
        require __DIR__ . "/search_bar.php";
        require __DIR__ . "/login_button.php";
        require __DIR__ . "/logout_button.php";
    ?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <?php logo() ?>
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
          </ul>
          <?php search_bar() ?>
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/myspace"
                >My Space</a
              >
            </li>
                <?php
                if (!$logged_in) {
                    login_button();
                } else {
                    logout_button();
                }
                ?>
          </ul>
        </div>
      </div>
    </nav>
<?php } ?>
