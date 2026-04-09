<?php

namespace App\Models;

class ProductOffer {
    public int $id;
    public Product $product;
    public string $link;
    public float $price;
    public Provider $provider;

    public function __construct(int $id, Product $product, string $link, float $price, Provider $provider) {
        $this->id = $id;
        $this->product = $product;
        $this->link = $link;
        $this->price = $price;
        $this->provider = $provider;
    }
}
