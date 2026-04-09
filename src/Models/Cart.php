<?php

namespace App\Models;

class Cart {
    public $ID;
    public $CartItem;
    public $UserId;

    public function __construct(int $id, int $user_id , int $product_id) {
        $this->ID = $id;
        $this->ProductId = $product_id;
        $this->UserId = $user_id;
        $this->Quantity = 0;
    }
    public function AddItem(){
        $this->Quantity += 1; 
    }
}
