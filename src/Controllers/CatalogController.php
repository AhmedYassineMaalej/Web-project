<?php

namespace App\Controllers;
use App\Models\ProductRepository;
use App\Models\Product;
use App\Helpers\JWT;

class CatalogController {
    
    public function index() {
        if (! JWT::isLoggedIn()){
            $_SESSION['error'] = "You're not logged in yet !";
            header('Location: /');
            exit;
        }
        $products = ProductRepository::getAllProducts();

        require __DIR__ . '/../../views/pages/catalog.php';
    }
    
    // Add this method for AJAX requests
    public function getProductAjax() {
        // Set headers first
        header('Content-Type: application/json');
        
        // Check login
        if (!JWT::isLoggedIn()) {
            echo json_encode(['error' => 'Not logged in']);
            exit;
        }
        
        // Get product ID
        $productId = isset($_GET['id']) ? (int)$_GET['id'] : null;
        
        if (!$productId) {
            echo json_encode(['error' => 'Product ID required']);
            exit;
        }
        
        $completeProduct = ProductRepository::getCompleteProduct($productId);
        
        // Check if product exists
        if (!$completeProduct || !$completeProduct->product) {
            echo json_encode(['error' => 'Product not found']);
            exit;
        }
        
        $response = [
            'product' => [
                'id' => $completeProduct->product->id,
                'reference' => $completeProduct->product->reference,
                'image' => $completeProduct->product->image,
                'categoryName' => $completeProduct->product->category->Name
            ],
            'info' => [],
            'offers' => []
        ];
        
        // Add product info if exists
        if (isset($completeProduct->info) && is_array($completeProduct->info)) {
            foreach ($completeProduct->info as $info) {
                if ($info) {
                    $response['info'][] = [
                        'key' => $info->key,
                        'value' => $info->value
                    ];
                }
            }
        }
        
        // Add offers if exists - using product_id now
        if (isset($completeProduct->offers) && is_array($completeProduct->offers)) {
            foreach ($completeProduct->offers as $offer) {
                if ($offer) {
                    $response['offers'][] = [
                        'id' => $offer->id,
                        'product_id' => $offer->product->id,  // Changed from reference to product_id
                        'link' => $offer->link,
                        'price' => $offer->price,
                        'providerName' => $offer->provider->Name
                    ];
                }
            }
        }
        
        // Output JSON and exit
        echo json_encode($response);
        exit;
    }


}
