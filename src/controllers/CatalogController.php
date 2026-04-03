<?php

namespace App\Controllers;

class CatalogController {
    public function index() {
        $path = __DIR__ . '/../../views/pages/catalog.php';
        //$products = ProductRepository::getAllProducts(); // Fetch products from repository "::" means static btw!
        // whereas "->" for dynamically created objects like $productrepo = new ProductRepository()
        // For simplicity, we'll hardcode some products here (n7eb el api traja3 kif li ena ketebhom ellouta)
        $products = [
        ["SNY-100", "Sony Headphones", "https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500"],
        ["APL-600", "Apple Watch", "https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500"],
        ["LOG-999", "Gaming Mouse", "https://images.unsplash.com/photo-1527443224154-c4a3942d3acf?w=500"],
        ["RZR-111", "Mechanical Keyboard", "https://images.unsplash.com/photo-1511467687858-23d96c32e4ae?w=500"],
        ["DL-XPS", "Dell XPS Laptop", "https://images.unsplash.com/photo-1593642632823-8f785ba67e45?w=500"],
        ["GXY-S24", "Samsung S24", "https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=500"]
        ];
        if (file_exists($path)) {
            require $path;
        } else {
            echo "Error: View file not found at " . $path;
        }
    }
}