<?php

namespace App\Models;

class CartItem {
    public $ID;
    public $ProductOfferId;
    public $UserId;
    public $Quantity;
    public $TotalCost;

    public function __construct(int $id, int $user_id , int $product_id) {
        $this->ID = $id;
        $this->ProductId = $product_id;
        $this->UserId = $user_id;
        $this->Quantity = 0;
        $this->TotalCost = 0;
    }
    public function AddItem(){
        $this->Quantity += 1;
        $this->TotalCost += "idk";
    }
}
