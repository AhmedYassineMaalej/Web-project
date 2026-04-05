<?php
namespace App\Controllers;
use App\models\ProductRepository;
use App\Helpers\JWT;
class HomeController {
    public function index() {
        // We fetch different lists for different sections of the Home Page
        // must be able to call these static methods without creating an object of ProductRepository
        /*
        $dealOfTheDay  = ProductRepository::getDailyDeal();     // Expects 1 tuple
        $bestDeals     = ProductRepository::getBestDeals();    // Expects list of tuples
        $expiringDeals = ProductRepository::getExpiringDeals(); // Expects list of tuples
        */
        // hardcoded as an example
        // FAKE DATA FOR TESTING
        $dealOfTheDay = ["REF-DAILY", "Ultra Premium Airpods", "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500"];

        $bestDeals = [
            ["PC-001", "Gaming Laptop", "https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500"],
            ["MS-002", "Wireless Mouse", "https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500"]
        ];

        $expiringDeals = [
            ["TV-99", "Smart TV 4K", "https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=500"]
        ];

        $newestDeals = [
            ["NEW-01", "Latest Smartwatch", "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500"],
            ["NEW-02", "New Mechanical Keyboard", "https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?w=500"]
        ];
        if (JWT::isLoggedIn()){
            $username = JWT::decode_jwt($_COOKIE['JWT'],$_ENV['JWT_SECRET'])['user'];
            $is_logged = true;
        }
        else $is_logged=false;
        require __DIR__ . '/../../views/pages/home.php';
    }
}