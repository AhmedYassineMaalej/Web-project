<?php

namespace App\Entities;

use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;

class Bookmark {
    public int $id;
    public User $user;
    public Product $product;
    public string $createdAt;
    public string $updatedAt;

    public function __construct(int $id, int|User $user, int|Product $product, string $createdAt, string $updatedAt) {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        
        if ($user instanceof User) {
            $this->user = $user;
        } else {
            $this->user = UserRepository::getUserById($user);
        }
        
        if ($product instanceof Product) {
            $this->product = $product;
        } else {
            $this->product = ProductRepository::getProductById($product);
        }
    }
}