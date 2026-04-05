<?php

namespace App\models;
use PDO;



class ProductRepository extends Repository {
    
    public function __construct() {
        parent::__construct("Product");
    }
    
    /*
    the three methods below, all they do is return one of the three objects whose classes are inside Product.php, ProductInfo.php and ProductOffer.php
    Example of $data = (object)['ID' => 1, 'Reference' => 'aa', etc];
    */
    private function convertToProduct($data) {
        if (!$data) return false;
        return new Product(
            $data->ID,
            $data->Reference,
            $data->Description,
            $data->Image,
            $data->CategoryID
        );
    }
    
    private function convertToProductInfo($data) {
        if (!$data) return false;
        return new ProductInfo(
            $data->ID,
            $data->ProductID,
            $data->Key,
            $data->Value
        );
    }
    
    private function convertToProductOffer($data) {
        if (!$data) return false;
        return new ProductOffer(
            $data->ID,
            $data->Reference,
            $data->Link,
            $data->Price,
            $data->ProviderID
        );
    }
    
    // return product object or false (read Repository class to see the error handling that allows that ofc)
    public function getProductById($id) {
        $result = $this->findById($id);
        return $this->convertToProduct($result);
    }

    //expect as return type an array of Product objects (Read PRoduct.php)
    public function getAllProducts() {
        $results = $this->findAll();
        return array_map([$this, 'convertToProduct'], $results);
    }


    //save a product into a database given four fields(which are the same columns of the db table), a successful add returns true otherwise false
    public function saveProduct($reference, $description, $image, $categoryId) :bool {
        return $this->add([
            'Reference' => $reference,
            'Description' => $description,
            'Image' => $image,
            'CategoryID' => $categoryId
        ]);
        
    }
    

    public function getProductInfo($productId) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM ProductInfo WHERE ProductID = ?");
            $stmt->execute([$productId]);
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return array_map([$this, 'convertToProductInfo'], $results);
        } catch (Exception $e) {
            return [];
        }
    }
    
    //successful adding into ProductInfo table gives true otherwise false
    public function addProductInfo($productId, $key, $value) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO ProductInfo (ProductID, `Key`, Value) VALUES (?, ?, ?)");
            return $stmt->execute([$productId, $key, $value]);
        } catch (Exception $e) {
            return false;
        }
    }
    
    // given a reference of a product, it returns an array of objects ProductInfo (read PRODuctInfo.php to udnerstand what that is)
    public function getProductOffers($reference) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM ProductOffer WHERE Reference = ?");
            $stmt->execute([$reference]);
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return array_map([$this, 'convertToProductOffer'], $results);
        } catch (Exception $e) {
            return [];
        }
    }
    // success add returns true otherwise false
    public function addProductOffer($reference, $link, $price, $providerId) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO ProductOffer (Reference, Link, Price, ProviderID) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$reference, $link, $price, $providerId]);
        } catch (Exception $e) {
            return false;
        }
    }
    
    
    /*
    get the whole entire info needed for a product
    returns object that u access it like so:
    $obj = getCompleteProduct(6784)
    $product_object = $obj->product
    $productinfo_object = $obj->info
    $productoffer_object = $obj->offers
    */
    public function getCompleteProduct($id) {
        $product = $this->getProductById($id);
        if (!$product) return false;
        
        return (object)[
            'product' => $product,
            'info' => $this->getProductInfo($id),
            'offers' => $this->getProductOffers($product->getReference())
        ];
    }
}

