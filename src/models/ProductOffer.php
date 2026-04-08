<?php

namespace App\models;

class ProductOffer {
    private $_id;
    private $_product_id;
    private $_link;
    private $_price;
    private $_providerId;
    
    public function __construct($id, $product_id, $link, $price, $providerId) {
        $this->_id = $id;
        $this->_product_id = $product_id;
        $this->_link = $link;
        $this->_price = $price;
        $this->_providerId = $providerId;
    }
    
    public function getId() {
        return $this->_id;
    }
    
    public function getProductId() {
        return $this->_product_id;
    }
    
    public function getLink() {
        return $this->_link;
    }
    
    public function getPrice() {
        return $this->_price;
    }
    
    public function getProviderId() {
        return $this->_providerId;
    }
    
    public function setProductId($product_id) {
        $this->_product_id = $product_id;
    }
    
    public function setLink($link) {
        $this->_link = $link;
    }
    
    public function setPrice($price) {
        $this->_price = $price;
    }
    
    public function setProviderId($providerId) {
        $this->_providerId = $providerId;
    }
}