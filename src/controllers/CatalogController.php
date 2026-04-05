<?php

namespace App\Controllers;
use App\models\ProductRepository;
use App\models\Product;
use App\Helpers\JWT;

class CatalogController {
    
    public function index() {
        if (! JWT::isLoggedIn()){
            header('Location : /?error=not_logged_in');
            exit;
        }
        $products = [
            new Product(1, "SNY-100", "Sony Headphones", "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500", 1),
            new Product(2, "APL-600", "Apple Watch", "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500", 1),
            new Product(3, "LOG-999", "Gaming Mouse", "https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500", 2),
            new Product(4, "RZR-111", "Mechanical Keyboard", "https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?w=500", 2),
            new Product(5, "DL-XPS", "Dell XPS Laptop", "https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500", 3),
            new Product(6, "GXY-S24", "Samsung S24", "https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=500", 1)
        ];
        require __DIR__ . '/../../views/pages/catalog.php';
        //$products = ProductRepository::getAllProducts(); // Fetch products from repository "::" means static btw!
        // whereas "->" for dynamically created objects like $productrepo = new ProductRepository()
        // For simplicity, we'll hardcode some products here (n7eb el api traja3 kif li ena ketebhom ellouta)
        
        
    }
}