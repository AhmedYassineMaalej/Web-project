<?php

namespace App\controllers;

class NavbarController {
    public function index() {
        // Path: src/controllers -> src -> root -> views/pages/navbar.php
        $path = __DIR__ . '/../../views/pages/navbar.php';

        if (file_exists($path)) {
            require $path;
        } else {
            echo "Error: View file not found at " . $path;
        }
    }
}