<?php
namespace App\Controllers;
use App\Helpers\JWT;
use App\Repositories\BookmarksRepository;
use App\Repositories\BookmarksItemRepository;

class BookmarksController {
    public static function getBookmarksJson() {
        header('Content-Type: application/json');

        if (!JWT::isLoggedIn()) {
            echo json_encode(['items' => [], 'total' => 0]);
            exit;
        }

        $userId = JWT::getUserId();
        $cart = BookmarksRepository::getOrCreateBookmarksByUserId($userId);
        $items = BookmarksItemRepository::getBookmarksItems($cart->id);
        $cart->setItems($items);

        $response = [
            'items' => [],
            'total' => $cart->getTotalCost()
        ];

        foreach ($items as $item) {
            $offer = $item->productOffer;
            if ($offer) {
                $response['items'][] = [
                    'id' => $item->id,
                    'name' => $offer->product->name,
                    'image' => $offer->product->image,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->price * $item->quantity
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

        $productId = $_GET['id'] ?? null;
        if (!$productId) {
            echo json_encode(['success' => false, 'error' => 'Invalid product']);
            exit;
        }

        $userId = JWT::getUserId();

        $result = BookmarksItemRepository::addToBookmarks($cart->id, (int)$productOfferId, $quantity);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to add to cart']);
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
        $cartItemId = $input['cart_item_id'] ?? $_POST['cart_item_id'] ?? null;

        error_log("BookmarksItemId to remove: " . $cartItemId);

        if (!$cartItemId) {
            echo json_encode(['success' => false, 'error' => 'Invalid item']);
            exit;
        }

        $result = BookmarksItemRepository::removeFromBookmarks((int)$cartItemId);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to remove item']);
        }
        exit;
    }
}
