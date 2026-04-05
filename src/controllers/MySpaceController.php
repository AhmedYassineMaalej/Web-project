<?php

namespace App\Controllers;

class MySpaceController {
    public function index() {
        $path = __DIR__ . '/../../views/pages/myspace.php';

        if (file_exists($path)) {
            require $path;
        } else {
            echo "Error: View file not found at " . $path;
        }
    }
    
}