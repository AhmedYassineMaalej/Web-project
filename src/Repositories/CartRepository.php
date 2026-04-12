<?php

namespace App\Repositories;

use App\Entities\Cart;
use Exception;

class CartRepository extends Repository {
    protected static string $tableName = "Cart";

    public static function getCartById(int $cart_id): ?Cart {
        $data = self::findById($cart_id);
        if (!$data) {
            return null;
        }
        
        return new Cart(
            $data->id,
            $data->user_id,
            (float)$data->total_price,
            $data->created_at,
            $data->updated_at
        );
    }

    public static function getCartByUserId(int $userId): ?Cart {
        $data = self::select(['user_id' => $userId]);
        if (empty($data)) return null;
        
        $cartData = $data[0];
        return new Cart(
            $cartData->id,
            $cartData->user_id,
            (float)$cartData->total_price,
            $cartData->created_at,
            $cartData->updated_at
        );
    }

    public static function createCartForUser(int $userId): Cart {
        self::insert([
            'user_id' => $userId,
            'total_price' => 0.00
        ]);
        $cartId = self::getConnection()->lastInsertId();
        
        return new Cart($cartId, $userId, 0.00, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
    }

    public static function getOrCreateCartByUserId(int $userId): Cart {
        $cart = self::getCartByUserId($userId);
        if (!$cart) {
            $cart = self::createCartForUser($userId);
        }
        return $cart;
    }

    public static function updateCartTotal(int $cartId, float $totalPrice): bool {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare("UPDATE Cart SET total_price = ? WHERE id = ?");
            return $stmt->execute([$totalPrice, $cartId]);
        } catch (Exception $e) {
            return false;
        }
    }

    public static function deleteCart(int $cartId): bool {
        return self::delete($cartId);
    }
    public static function removeItem(int $cartItemId): bool {
        $item = CartItemRepository::findById($cartItemId);
        if (!$item) return false;
        
        $cartId = $item->cart_id;
        
        $result = CartItemRepository::removeFromCart($cartItemId);
        
        if ($result) {
            $newTotal = CartItemRepository::getCartTotal($cartId);
            self::updateCartTotal($cartId, $newTotal);
        }
        
        return $result;
    }
}