<?php

namespace App\Entities;
use App\Repositories\ProductOfferRepository;

class CartItem {
    public int $id;
    public int $cartId;
    public ProductOffer $productOffer;
    public int $quantity;
    public float $price;
    public float $totalPrice;
    public string $createdAt;
    public string $updatedAt;
    
    public function __construct(int $id, int $cartId, int|ProductOffer $productOffer, int $quantity, float $price, string $createdAt, string $updatedAt) {
        $this->id = $id;
        $this->cartId = $cartId;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->totalPrice = $price * $quantity;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        
        if ($productOffer instanceof ProductOffer) {
            $this->productOffer = $productOffer;
        } else {
            $this->productOffer = ProductOfferRepository::getProductOfferById($productOffer);
        }
    }

    public function getSubtotal() : float {
        return $this->price * $this->quantity;
    }

    public function updateQuantity(int $quantity): void {
        $this->quantity = $quantity;
        $this->totalPrice = $this->price * $quantity;
    }

    public function updatePrice(float $price): void {
        $this->price = $price;
        $this->totalPrice = $price * $this->quantity;
    }
}
