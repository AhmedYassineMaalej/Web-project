<?php

namespace App\Controllers;

use App\Helpers\JWT;
use App\Repositories\RecommendationRepository;
use App\Repositories\CartRepository;
use App\Repositories\CartItemRepository;

class MySpaceController {
    public function index() {
        if (!JWT::isLoggedIn()){
            $_SESSION['error'] = "You're not logged in";
            header("Location: /");
            exit;
        }
        
        $payload = JWT::decode_jwt($_COOKIE['JWT'], $_ENV['JWT_SECRET']);
        $username = $payload['user'];
        $userId = $payload['user_id'];
        
        // Get recommended products based on user's id (who must have at most one cart)
        $recommendedProducts = RecommendationRepository::getRecommendationsForUser($userId, 6);
        

        
        require __DIR__ . '/../../views/pages/myspace.php';
    }
}