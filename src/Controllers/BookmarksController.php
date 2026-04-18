<?php
namespace App\Controllers;
use App\Entities\Product;
use App\Helpers\JWT;
use App\Repositories\BookmarkRepository;
use App\Repositories\ProductRepository;

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
            $response['items'][] = [
                'id'       => $bookmark['id'],
                'name'     => $bookmark['name'],
                'image'    => $bookmark['image'],
                'quantity' => $bookmark['quantity'],
                'price'    => $bookmark['price'],
                'total'    => $bookmark['total'],
            ];
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

        $userId = JWT::getUserId();

        $productReference = $_POST['productReference'];
        $productID = ProductRepository::getProductByReference($productReference)->id;
        $result = BookmarkRepository::addUserBookmark($userId, $productID);

        error_log(print_r($result, true));


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
        $cartItemId = $input['bookmarks_item_id'] ?? $_POST['bookmarks_item_id'] ?? null;

        error_log("BookmarksItemId to remove: " . $cartItemId);

        if (!$cartItemId) {
            echo json_encode(['success' => false, 'error' => 'Invalid item']);
            exit;
        }

        $result = BookmarkRepository::delete((int)$cartItemId);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to remove item']);
        }
        exit;
    }
}
