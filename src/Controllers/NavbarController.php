<?php

namespace App\Controllers;

class NavbarController {
    public function index() {
        $path = __DIR__ . '/../../views/pages/navbar.php';

        if (file_exists($path)) {
            require $path;
        } else {
            echo "Error: View file not found at " . $path;
        }
    }
}
