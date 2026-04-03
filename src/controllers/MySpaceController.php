<?php

namespace App\Controllers;

class MySpaceController {
    public function index() {
        // Path: src/controllers -> src -> root -> views/pages/myspace.php
        $path = __DIR__ . '/../../views/pages/myspace.php';

        if (file_exists($path)) {
            require $path;
        } else {
            echo "Error: View file not found at " . $path;
        }
    }
}