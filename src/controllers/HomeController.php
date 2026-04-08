<?php

namespace App\Controllers;

use App\models\ProductRepository;
use App\Helpers\JWT;

class HomeController {
    
    public function index() {
        $is_logged = JWT::isLoggedIn();
        $username = $_SESSION['username'] ?? '';
        
        $product_repo = new ProductRepository();
        
        // Get products with most offers (best deals) - keep as objects
        $bestDealsData = $product_repo->getProductsWithMostOffers(6);
        $bestDeals = [];
        foreach ($bestDealsData as $item) {
            $bestDeals[] = $item['product']; // Pass the actual product object
        }
        
        // Get top offers (expiring deals)
        $expiringDealsData = $product_repo->getTopOffers(6);
        $expiringDeals = [];
        foreach ($expiringDealsData as $item) {
            $expiringDeals[] = $item['product']; // Pass the actual product object
        }
        
        // Get newest products
        $newestDeals = $product_repo->getNewestProducts(6); // Already returns product objects
        
        // Get deal of the day
        $dealOfTheDayData = $product_repo->getDealOfTheDay();
        $dealOfTheDay = $dealOfTheDayData ? [
            $dealOfTheDayData[0],
            $dealOfTheDayData[1],
            $dealOfTheDayData[2]
        ] : null;
        
        require __DIR__ . '/../../views/pages/home.php';
    }
}