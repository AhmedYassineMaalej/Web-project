<?php

namespace App\Repositories;

use App\Entities\CartItem;
use Exception;

class CartItemRepository extends Repository {
    protected static string $tableName = "CartItem";

    public static function getCartItems(int $cartId): array {
        $data = self::select(['cart_id' => $cartId]);
        
        $items = [];
        foreach ($data as $itemData) {
            $price = $itemData->totalprice / $itemData->quantity;
            
            $item = new CartItem(
                $itemData->id,
                $itemData->cart_id,
                $itemData->product_offer_id,
                $itemData->quantity,
                $price,
                $itemData->created_at,
                $itemData->updated_at
            );
        
        
        
            $items[] = $item;
        }
    
        return $items;
    }

    public static function addToCart(int $cartId, int $productOfferId, int $quantity = 1): bool {
        $existing = self::select([
            'cart_id' => $cartId,
            'product_offer_id' => $productOfferId
        ]);
        
        $result = false;
        
        if (!empty($existing)) {
            $item = $existing[0];
            $newQuantity = $item->quantity + $quantity;
            $newTotalPrice = ($item->totalprice / $item->quantity) * $newQuantity;
            
            try {
                $conn = self::getConnection();
                $stmt = $conn->prepare("UPDATE CartItem SET quantity = ?, totalprice = ? WHERE id = ?");
                $result = $stmt->execute([$newQuantity, $newTotalPrice, $item->id]);
            } catch (Exception $e) {
                return false;
            }
        } else {
            $offer = ProductOfferRepository::getProductOfferById($productOfferId);
            if (!$offer) return false;
            
            $price = $offer->price;
            $totalPrice = $price * $quantity;
            
            $result = self::insert([
                'cart_id' => $cartId,
                'product_offer_id' => $productOfferId,
                'quantity' => $quantity,
                'totalprice' => $totalPrice
            ]);
            
            if ($result) {
                // Get user_id from cart
                $cart = CartRepository::getCartById($cartId);
                if ($cart) {
                    RecommendationRepository::updateWeightsOnBookmark($cart->userId, $productOfferId,true);
                }
            }
        }
        
        if ($result) {
            self::updateCartTotal($cartId);
        }
        
        return $result;
    }




    public static function updateQuantity(int $cartItemId, int $quantity): bool {
        try {
            $item = self::findById($cartItemId);
            if (!$item) return false;
            
            $price = $item->totalprice / $item->quantity;
            $newTotalPrice = $price * $quantity;
            
            $conn = self::getConnection();
            $stmt = $conn->prepare("UPDATE CartItem SET quantity = ?, totalprice = ? WHERE id = ?");
            $result = $stmt->execute([$quantity, $newTotalPrice, $cartItemId]);
            
            if ($result) {
                self::updateCartTotal($item->cart_id);
            }
            
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function removeFromCart(int $cartItemId): bool {
        $item = self::findById($cartItemId);
        if (!$item) return false;
        
        $cartId = $item->cart_id;
        
        // Get cart to find user_id
        $cart = CartRepository::getCartById($cartId);
        
        $result = self::delete($cartItemId);
        
        if ($result) {
            self::updateCartTotal($cartId);
            
            // Decrease weights when removing
            if ($cart) {
                RecommendationRepository::updateWeightsOnBookmark($cart->userId, $item->product_offer_id,false); //here increment=false
            }
        }
        
        return $result;
    }

    public static function clearCart(int $cartId): bool {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare("DELETE FROM CartItem WHERE cart_id = ?");
            $result = $stmt->execute([$cartId]);
            
            if ($result) {
                self::updateCartTotal($cartId);
            }
            
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function getCartItemCount(int $cartId): int {
        $items = self::getCartItems($cartId);
        $count = 0;
        foreach ($items as $item) {
            $count += $item->quantity;
        }
        return $count;
    }

    public static function getCartTotal(int $cartId): float {
        $items = self::getCartItems($cartId);
        $total = 0;
        foreach ($items as $item) {
            $total += $item->totalPrice;
        }
        return $total;
    }

    private static function updateCartTotal(int $cartId): void {
        try {
            $conn = self::getConnection();
            $stmt = $conn->prepare("SELECT SUM(totalprice) as total FROM CartItem WHERE cart_id = ?");
            $stmt->execute([$cartId]);
            $result = $stmt->fetch(\PDO::FETCH_OBJ);
            
            $newTotal = $result->total ?? 0;
            
            $stmt = $conn->prepare("UPDATE Cart SET total_price = ? WHERE id = ?");
            $stmt->execute([$newTotal, $cartId]);
        } catch (Exception $e) {
            error_log("Failed to update cart total: " . $e->getMessage());
        }
    }
}