<?php

namespace App\Controllers;
use App\Helpers\JWT;

class MySpaceController {
    public function index() {
        if (! JWT::isLoggedIn()){
            header("Location : /?error=not_logged_in");
            exit;
        }
        require __DIR__ . '/../../views/pages/myspace.php';
    }
    
}