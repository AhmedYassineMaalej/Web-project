<?php

namespace App\Controllers;
use App\Helpers\JWT;

class MySpaceController {
    public function index() {
        if (! JWT::isLoggedIn()){
            $_SESSION['error'] = "You're not logged in";
            header("Location : /");
            exit;
        }
        $username = JWT::decode_jwt($_COOKIE['JWT'],$_ENV['JWT_SECRET'])['user'];

        require __DIR__ . '/../../views/pages/myspace.php';
    }
    
}