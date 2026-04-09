<?php

namespace App\Models;

class Product {
    private $_id;
    private $_reference;
    private $_description;
    private $_image;
    private $_categoryId;
    
    public function __construct($id, $reference, $description, $image, $categoryId) {
        $this->_id = $id;
        $this->_reference = $reference;
        $this->_description = $description;
        $this->_image = $image;
        $this->_categoryId = $categoryId;
    }
    
    // Getters
    public function getId() {
        return $this->_id;
    }
    
    public function getReference() {
        return $this->_reference;
    }
    
    public function getDescription() {
        return $this->_description;
    }
    
    public function getImage() {
        return $this->_image;
    }
    
    public function getCategoryId() {
        return $this->_categoryId;
    }
    
    // Setters
    public function setId($id) {
        $this->_id = $id;
    }
    
    public function setReference($reference) {
        $this->_reference = $reference;
    }
    
    public function setDescription($description) {
        $this->_description = $description;
    }
    
    public function setImage($image) {
        $this->_image = $image;
    }
    
    public function setCategoryId($categoryId) {
        $this->_categoryId = $categoryId;
    }
}
