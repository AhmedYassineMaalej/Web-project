<?php

namespace App\Models;
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
            $data->ProductID,
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
    
    // given a product id, it returns an array of objects ProductOffer
    public function getProductOffers($productId) {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM ProductOffer WHERE ProductID = ?");
            $stmt->execute([$productId]);
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return array_map([$this, 'convertToProductOffer'], $results);
        } catch (Exception $e) {
            return [];
        }
    }
    
    // success add returns true otherwise false
    public function addProductOffer($productId, $link, $price, $providerId) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO ProductOffer (ProductID, Link, Price, ProviderID) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$productId, $link, $price, $providerId]);
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
            'offers' => $this->getProductOffers($id)
        ];
    }

    public function getProductsWithMostOffers($limit = 6) {
        try {
            $limit = (int)$limit; // Cast to integer for safety
            $stmt = $this->connection->prepare("
                SELECT p.*, COUNT(po.ID) as offer_count, MIN(po.Price) as min_price
                FROM Product p
                INNER JOIN ProductOffer po ON p.ID = po.ProductID
                GROUP BY p.ID
                ORDER BY offer_count DESC
                LIMIT $limit
            ");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $products = [];
            foreach ($results as $row) {
                $products[] = [
                    'product' => $this->convertToProduct($row),
                    'offer_count' => $row->offer_count,
                    'min_price' => $row->min_price
                ];
            }
            return $products;
        } catch (Exception $e) {
            return [];
        }
    }

    //simply fetches the min price
    public function getTopOffers($limit = 6) {
        try {
            $limit = (int)$limit;
            $stmt = $this->connection->prepare("
                SELECT p.*, MIN(po.Price) as min_price, COUNT(po.ID) as offer_count
                FROM Product p
                INNER JOIN ProductOffer po ON p.ID = po.ProductID
                GROUP BY p.ID
                ORDER BY min_price ASC
                LIMIT $limit
            ");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $products = [];
            foreach ($results as $row) {
                $products[] = [
                    'product' => $this->convertToProduct($row),
                    'min_price' => $row->min_price,
                    'offer_count' => $row->offer_count
                ];
            }
            return $products;
        } catch (Exception $e) {
            return [];
        }
    }


    public function getMostInfoProducts($limit = 6) {
        try {
            $limit = (int)$limit;
            $stmt = $this->connection->prepare("
                SELECT p.*, COUNT(pi.ID) as info_count
                FROM Product p
                INNER JOIN ProductInfo pi ON p.ID = pi.ProductID
                GROUP BY p.ID
                ORDER BY info_count DESC
                LIMIT $limit
            ");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            $products = [];
            foreach ($results as $row) {
                $products[] = [
                    'product' => $this->convertToProduct($row),
                    'info_count' => $row->info_count
                ];
            }
            return $products;
        } catch (Exception $e) {
            return [];
        }
    }


    public function getNewestProducts($limit = 6) {
        try {
            $limit = (int)$limit;
            $stmt = $this->connection->prepare("
                SELECT * FROM Product 
                ORDER BY ID DESC 
                LIMIT $limit
            ");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_OBJ);
            return array_map([$this, 'convertToProduct'], $results);
        } catch (Exception $e) {
            return [];
        }
    }


    public function getDealOfTheDay() {
        try {
            $stmt = $this->connection->prepare("
                SELECT p.*, MIN(po.Price) as min_price
                FROM Product p
                INNER JOIN ProductOffer po ON p.ID = po.ProductID
                GROUP BY p.ID
                ORDER BY RAND()
                LIMIT 1
            ");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_OBJ);
            
            if (!$row) return null;
            
            return [
                $row->Reference ?? '',
                $row->Description ?? 'Product',
                $row->Image ?? '/images/placeholder.png',
                $row->min_price ?? 0
            ];
        } catch (Exception $e) {
            return null;
        }
    }
    public function getMinPriceForProduct($productId) {
        try {
            $stmt = $this->connection->prepare("
                SELECT MIN(Price) as min_price
                FROM ProductOffer
                WHERE ProductID = ?
            ");
            $stmt->execute([$productId]);
            $result = $stmt->fetch(PDO::FETCH_OBJ);
            
            return $result->min_price ? (float)$result->min_price : null;
        } catch (Exception $e) {
            return null;
        }
    }



}
