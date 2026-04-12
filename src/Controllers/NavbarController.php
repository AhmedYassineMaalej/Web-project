<?php

namespace App\Controllers;

class NavbarController {
    public static function index(): void {
        $path = __DIR__ . '/../../views/pages/navbar.php';

        if (file_exists($path)) {
            require $path;
        } else {
            echo "Error: View file not found at " . $path;
        }
    }
}
