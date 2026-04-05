<?php

namespace App\models;

class ProductInfo {
    private $_id;
    private $_productId;
    private $_key;
    private $_value;
    
    public function __construct($id, $productId, $key, $value) {
        $this->_id = $id;
        $this->_productId = $productId;
        $this->_key = $key;
        $this->_value = $value;
    }
    
    public function getId() {
        return $this->_id;
    }
    
    public function getProductId() {
        return $this->_productId;
    }
    
    public function getKey() {
        return $this->_key;
    }
    
    public function getValue() {
        return $this->_value;
    }
    
    public function setProductId($productId) {
        $this->_productId = $productId;
    }
    
    public function setKey($key) {
        $this->_key = $key;
    }
    
    public function setValue($value) {
        $this->_value = $value;
    }
}