<?php

namespace App\Models;

class ProductInfo {
    public $id;
    public $productId;
    public $key;
    public $value;
    
    public function __construct($id, $productId, $key, $value) {
        $this->id = $id;
        $this->productId = $productId;
        $this->key = $key;
        $this->value = $value;
    }
}
