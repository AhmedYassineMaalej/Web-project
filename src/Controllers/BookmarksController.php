<?php
namespace App\Controllers;
use App\Helpers\JWT;
use App\Repositories\BookmarkRepository;

class BookmarksController {
    public static function getBookmarksJson() {
        header('Content-Type: application/json');

        if (!JWT::isLoggedIn()) {
            echo json_encode(['items' => [], 'total' => 0]);
            exit;
        }

        $userId = JWT::getUserId();
        $bookmarks = BookmarkRepository::getUserBookmarks($userId);

        $response = [
            'items' => [],
        ];

        foreach ($bookmarks as $bookmark) {
            $offer = $bookmark->productOffer;
            if ($offer) {
                $response['items'][] = [
                    'id' => $bookmark->id,
                    'name' => $bookmark->product->name,
                    'image' => $bookmark->product->image,
                    'quantity' => $bookmark->quantity,
                    'price' => $bookmark->price,
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
<<<<<<< HEAD

        $result = BookmarksItemRepository::addToBookmarks($cart->id, (int)$productOfferId, $quantity);
=======
        $result = BookmarkRepository::addUserBookmark($userId, $productId);
>>>>>>> 1b2dbaf (add bookmarks)

        if ($result) {
            echo json_encode(['success' => true]);
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
