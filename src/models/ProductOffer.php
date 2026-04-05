<?php

namespace App\models;

class ProductOffer {
    private $_id;
    private $_reference;
    private $_link;
    private $_price;
    private $_providerId;
    
    public function __construct($id, $reference, $link, $price, $providerId) {
        $this->_id = $id;
        $this->_reference = $reference;
        $this->_link = $link;
        $this->_price = $price;
        $this->_providerId = $providerId;
    }
    
    public function getId() {
        return $this->_id;
    }
    
    public function getReference() {
        return $this->_reference;
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
    
    public function setReference($reference) {
        $this->_reference = $reference;
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