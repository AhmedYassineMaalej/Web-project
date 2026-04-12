<?php
namespace App\Controllers;

use App\Helpers\JWT;
use App\Repositories\BookmarkRepository;
use App\Repositories\ProductRepository;

class BookmarkController {



    public static function index() {
        if (!JWT::isLoggedIn()) {
            $_SESSION['error'] = "You're not logged in";
            header('Location: /login');
            exit;
        }
        
        $userId = JWT::getUserId();
        $bookmarks = BookmarkRepository::getUserBookmarks($userId);
        
        $bookmarkedProducts = [];
        foreach ($bookmarks as $bookmark) {
            $product = ProductRepository::getProductById($bookmark->product->id);
            if ($product) {
                $bookmarkedProducts[] = $product;
            }
        }
        
        require __DIR__ . '/../../views/pages/bookmarks.php';
    }
    
    public static function getBookmarksJson() {
        header('Content-Type: application/json');

        if (!JWT::isLoggedIn()) {
            echo json_encode(['items' => []]);
            exit;
        }

        $userId = JWT::getUserId();
        $bookmarks = BookmarkRepository::getUserBookmarks($userId);

        $response = ['items' => []];

        foreach ($bookmarks as $bookmark) {
            $product = ProductRepository::getProductById($bookmark->productId);
            if ($product) {
                $response['items'][] = [
                    'id' => $bookmark->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'reference' => $product->reference
                ];
            }
        }

        echo json_encode($response);
        exit;
    }

    public static function addBookmark() {
        header('Content-Type: application/json');

        if (!JWT::isLoggedIn()) {
            echo json_encode(['success' => false, 'error' => 'Not logged in']);
            exit;
        }

        // Read JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        $productId = $input['product_id'] ?? $_POST['product_id'] ?? null;

        if (!$productId) {
            echo json_encode(['success' => false, 'error' => 'Invalid product']);
            exit;
        }

        $userId = JWT::getUserId();
        $result = BookmarkRepository::addUserBookmark($userId, (int)$productId);

        if ($result) {
            echo json_encode(['success' => true, 'bookmarked' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to add to bookmarks']);
        }
        exit;
    }

    public static function removeBookmark() {
        header('Content-Type: application/json');

        if (!JWT::isLoggedIn()) {
            echo json_encode(['success' => false, 'error' => 'Not logged in']);
            exit;
        }

        // Read JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        $productId = $input['product_id'] ?? $_POST['product_id'] ?? null;

        if (!$productId) {
            echo json_encode(['success' => false, 'error' => 'Invalid product']);
            exit;
        }

        $userId = JWT::getUserId();
        $result = BookmarkRepository::removeUserBookmark($userId, (int)$productId);

        if ($result) {
            echo json_encode(['success' => true, 'bookmarked' => false]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to remove bookmark']);
        }
        exit;
    }

    public static function toggleBookmark() {
        header('Content-Type: application/json');
        
        if (!JWT::isLoggedIn()) {
            echo json_encode(['success' => false, 'error' => 'Not logged in']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $productId = $input['product_id'] ?? null;

        if (!$productId) {
            echo json_encode(['success' => false, 'error' => 'Invalid product']);
            exit;
        }

        $userId = JWT::getUserId();
        $isBookmarked = BookmarkRepository::isBookmarked($userId, (int)$productId);

        if ($isBookmarked) {
            $result = BookmarkRepository::removeUserBookmark($userId, (int)$productId);
            echo json_encode(['success' => $result, 'bookmarked' => false]);
        } else {
            $result = BookmarkRepository::addUserBookmark($userId, (int)$productId);
            echo json_encode(['success' => $result, 'bookmarked' => true]);
        }
        exit;
    }
}