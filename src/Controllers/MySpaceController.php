<?php

namespace App\Controllers;

use App\Helpers\JWT;
use App\Repositories\RecommendationRepository;

class MySpaceController {
    public static function index() {
        if (!JWT::isLoggedIn()){
            $_SESSION['error'] = "You're not logged in";
            header("Location: /");
            exit;
        }
        
        $payload = JWT::decode_jwt($_COOKIE['JWT'], $_ENV['JWT_SECRET']);
        $username = $payload['user'];
        $userId = $payload['user_id'];
        
        // Make sure this line exists
        $recommendedProducts = RecommendationRepository::getRecommendationsForUser($userId, 6);
        
        require __DIR__ . '/../../views/pages/myspace.php';
    }
}